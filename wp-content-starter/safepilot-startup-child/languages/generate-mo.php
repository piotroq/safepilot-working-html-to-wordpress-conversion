<?php
/**
 * Generator pliku .mo z pliku .po dla motywu SafePilot
 * Uruchom ten skrypt raz, aby wygenerować plik g5-startup-pl_PL.mo
 */

// Ścieżki do plików
$po_file = __DIR__ . '/wp-content/themes/safepilot-startup-child/languages/g5-startup-pl_PL.po';
$mo_file = __DIR__ . '/wp-content/themes/safepilot-startup-child/languages/g5-startup-pl_PL.mo';

// Funkcja konwertująca PO na MO
function po2mo($input, $output) {
    if (!file_exists($input)) {
        die("❌ Błąd: Plik .po nie istnieje: $input\n");
    }
    
    $hash = array();
    $temp_hash = array();
    $catalog = false;
    $state = '-';
    $msgid = '';
    $msgstr = '';
    $msgid_plural = '';
    $msgstr_plural = array();
    
    // Parsowanie pliku PO
    $lines = file($input);
    foreach ($lines as $line) {
        $line = trim($line);
        
        if ($line === '') continue;
        
        if (substr($line, 0, 2) == '#,') {
            // Flagi
            $flags = explode(',', substr($line, 2));
            $temp_hash['flags'] = array_map('trim', $flags);
        } elseif (substr($line, 0, 1) == '#') {
            // Komentarz
            continue;
        } elseif (preg_match('/^msgid\s+"(.*)"/', $line, $matches)) {
            // msgid - początek nowego tłumaczenia
            if ($msgid != '' && $msgstr != '') {
                $hash[$msgid] = $msgstr;
            }
            $msgid = stripcslashes($matches[1]);
            $msgstr = '';
            $msgstr_plural = array();
            $state = 'msgid';
        } elseif (preg_match('/^msgid_plural\s+"(.*)"/', $line, $matches)) {
            // msgid_plural
            $msgid_plural = stripcslashes($matches[1]);
            $state = 'msgid_plural';
        } elseif (preg_match('/^msgstr\s+"(.*)"/', $line, $matches)) {
            // msgstr
            $msgstr = stripcslashes($matches[1]);
            $state = 'msgstr';
        } elseif (preg_match('/^msgstr\[(\d+)\]\s+"(.*)"/', $line, $matches)) {
            // msgstr[n] dla form plural
            $msgstr_plural[$matches[1]] = stripcslashes($matches[2]);
            $state = 'msgstr_plural';
        } elseif (preg_match('/^"(.*)"/', $line, $matches)) {
            // Kontynuacja poprzedniej linii
            $string = stripcslashes($matches[1]);
            if ($state == 'msgid') {
                $msgid .= $string;
            } elseif ($state == 'msgid_plural') {
                $msgid_plural .= $string;
            } elseif ($state == 'msgstr') {
                $msgstr .= $string;
            } elseif ($state == 'msgstr_plural') {
                end($msgstr_plural);
                $key = key($msgstr_plural);
                $msgstr_plural[$key] .= $string;
            }
        }
    }
    
    // Dodaj ostatnie tłumaczenie
    if ($msgid != '' && $msgstr != '') {
        $hash[$msgid] = $msgstr;
    }
    
    // Tworzenie pliku MO
    $mo = new MoWriter();
    $mo->write($output, $hash);
    
    return true;
}

/**
 * Klasa do zapisu pliku MO
 */
class MoWriter {
    private $strings = array();
    
    public function write($file, $translations) {
        // Sortuj tłumaczenia
        ksort($translations);
        
        // Przygotuj stringi
        $ids = '';
        $strs = '';
        $array_ids = array();
        $array_strs = array();
        
        foreach ($translations as $id => $str) {
            if ($id === '') {
                // Nagłówek
                $header = "Project-Id-Version: g5-startup\n";
                $header .= "POT-Creation-Date: 2022-05-24 16:41+0700\n";
                $header .= "PO-Revision-Date: 2025-01-19 21:00+0100\n";
                $header .= "Last-Translator: SafePilot Team\n";
                $header .= "Language-Team: Polish\n";
                $header .= "Language: pl_PL\n";
                $header .= "MIME-Version: 1.0\n";
                $header .= "Content-Type: text/plain; charset=UTF-8\n";
                $header .= "Content-Transfer-Encoding: 8bit\n";
                $header .= "X-Generator: SafePilot MO Generator 1.0\n";
                $header .= "Plural-Forms: nplurals=3; plural=(n==1 ? 0 : n%10>=2 && n%10<=4 && (n%100<12 || n%100>14) ? 1 : 2);\n";
                $str = $header;
            }
            
            $array_ids[] = strlen($ids);
            $ids .= $id . "\x00";
            $array_strs[] = strlen($strs);
            $strs .= $str . "\x00";
        }
        
        $count = count($translations);
        $key_start = 7 * 4 + $count * 2 * 4;
        $value_start = $key_start + strlen($ids);
        
        // Nagłówek pliku MO
        $mo = '';
        $mo .= pack('L', 0x950412de); // Magic number
        $mo .= pack('L', 0); // Version
        $mo .= pack('L', $count); // Liczba stringów
        $mo .= pack('L', 28); // Offset tabeli oryginalnych stringów
        $mo .= pack('L', 28 + $count * 8); // Offset tabeli tłumaczeń
        $mo .= pack('L', 0); // Rozmiar hashtable
        $mo .= pack('L', $key_start + strlen($ids) + strlen($strs)); // Offset hashtable
        
        // Tabela oryginalnych stringów
        foreach ($array_ids as $i => $pos) {
            $id = '';
            $j = $pos;
            while ($j < strlen($ids) && $ids[$j] !== "\x00") {
                $id .= $ids[$j];
                $j++;
            }
            $mo .= pack('L', strlen($id));
            $mo .= pack('L', $key_start + $pos);
        }
        
        // Tabela tłumaczeń
        foreach ($array_strs as $i => $pos) {
            $str = '';
            $j = $pos;
            while ($j < strlen($strs) && $strs[$j] !== "\x00") {
                $str .= $strs[$j];
                $j++;
            }
            $mo .= pack('L', strlen($str));
            $mo .= pack('L', $value_start + $pos);
        }
        
        // Dane
        $mo .= $ids;
        $mo .= $strs;
        
        // Zapis do pliku
        file_put_contents($file, $mo);
    }
}

// Sprawdzenie czy katalog istnieje
$dir = dirname($mo_file);
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
    echo "✅ Utworzono katalog: $dir\n";
}

// Konwersja
echo "🔄 Konwersja pliku PO na MO...\n";
echo "📂 Plik źródłowy: $po_file\n";
echo "📂 Plik docelowy: $mo_file\n\n";

if (po2mo($po_file, $mo_file)) {
    echo "✅ SUKCES! Plik .mo został wygenerowany!\n";
    echo "📊 Rozmiar pliku: " . filesize($mo_file) . " bajtów\n";
} else {
    echo "❌ BŁĄD: Nie udało się utworzyć pliku .mo\n";
}
?>