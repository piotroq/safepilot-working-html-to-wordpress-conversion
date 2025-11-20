#!/usr/bin/env python3
# -*- coding: utf-8 -*-
"""
Script to translate startup-framework.pot from English to Polish
"""

import polib
import re
import os

# Comprehensive translation dictionary for WordPress and Startup Framework
TRANSLATIONS = {
    # Dashboard and Admin
    "%s Dashboard": "Panel %s",
    "System Status": "Status Systemu",
    "Install Demo": "Zainstaluj Demo",
    "Support": "Wsparcie",
    "Theme Options": "Opcje Motywu",
    "Permission error!": "Błąd uprawnień!",
    "Import Error": "Błąd Importu",
    "Support forum": "Forum Wsparcia",
    "Open Forum": "Otwórz Forum",
    "Documentation": "Dokumentacja",

    # Common WordPress terms
    "Settings": "Ustawienia",
    "Save": "Zapisz",
    "Save Changes": "Zapisz Zmiany",
    "Cancel": "Anuluj",
    "Delete": "Usuń",
    "Edit": "Edytuj",
    "Add": "Dodaj",
    "Add New": "Dodaj Nowy",
    "Update": "Aktualizuj",
    "Upload": "Prześlij",
    "Download": "Pobierz",
    "Search": "Szukaj",
    "Filter": "Filtruj",
    "All": "Wszystkie",
    "None": "Brak",
    "Yes": "Tak",
    "No": "Nie",
    "Enable": "Włącz",
    "Disable": "Wyłącz",
    "Enabled": "Włączony",
    "Disabled": "Wyłączony",
    "Active": "Aktywny",
    "Inactive": "Nieaktywny",
    "Name": "Nazwa",
    "Title": "Tytuł",
    "Description": "Opis",
    "Content": "Treść",
    "Type": "Typ",
    "Status": "Status",
    "Date": "Data",
    "Author": "Autor",
    "Categories": "Kategorie",
    "Category": "Kategoria",
    "Tags": "Tagi",
    "Tag": "Tag",
    "Image": "Obraz",
    "Images": "Obrazy",
    "Video": "Wideo",
    "Audio": "Audio",
    "File": "Plik",
    "Files": "Pliki",
    "Link": "Link",
    "Links": "Linki",
    "URL": "URL",
    "Email": "Email",
    "Phone": "Telefon",
    "Address": "Adres",
    "City": "Miasto",
    "Country": "Kraj",
    "State": "Stan",
    "Zip Code": "Kod Pocztowy",
    "Message": "Wiadomość",
    "Subject": "Temat",
    "Submit": "Wyślij",
    "Send": "Wyślij",
    "Preview": "Podgląd",
    "Publish": "Opublikuj",
    "Draft": "Szkic",
    "Pending": "Oczekujący",
    "Password": "Hasło",
    "Username": "Nazwa Użytkownika",
    "Login": "Zaloguj",
    "Logout": "Wyloguj",
    "Register": "Zarejestruj",
    "Lost Password": "Utracone Hasło",
    "Lost your password?": "Utracono hasło?",
    "Back": "Wstecz",
    "Next": "Następny",
    "Previous": "Poprzedni",
    "Close": "Zamknij",
    "Open": "Otwórz",
    "Show": "Pokaż",
    "Hide": "Ukryj",
    "More": "Więcej",
    "Less": "Mniej",
    "View": "Zobacz",
    "View All": "Zobacz Wszystko",
    "Read More": "Czytaj Więcej",
    "Learn More": "Dowiedz się Więcej",
    "Click Here": "Kliknij Tutaj",

    # Layout and Design
    "Layout": "Layout",
    "Design": "Projekt",
    "Style": "Styl",
    "Color": "Kolor",
    "Colors": "Kolory",
    "Background": "Tło",
    "Background Color": "Kolor Tła",
    "Background Image": "Obraz Tła",
    "Font": "Czcionka",
    "Font Size": "Rozmiar Czcionki",
    "Font Family": "Rodzina Czcionki",
    "Font Weight": "Grubość Czcionki",
    "Text": "Tekst",
    "Text Color": "Kolor Tekstu",
    "Text Align": "Wyrównanie Tekstu",
    "Left": "Lewo",
    "Right": "Prawo",
    "Center": "Środek",
    "Justify": "Justuj",
    "Width": "Szerokość",
    "Height": "Wysokość",
    "Size": "Rozmiar",
    "Position": "Pozycja",
    "Top": "Góra",
    "Bottom": "Dół",
    "Margin": "Margines",
    "Padding": "Odstęp",
    "Border": "Ramka",
    "Border Color": "Kolor Ramki",
    "Border Width": "Szerokość Ramki",
    "Border Radius": "Zaokrąglenie Ramki",
    "Shadow": "Cień",
    "Opacity": "Przezroczystość",
    "Animation": "Animacja",
    "Transition": "Przejście",

    # Navigation and Menu
    "Menu": "Menu",
    "Navigation": "Nawigacja",
    "Primary Menu": "Menu Główne",
    "Secondary Menu": "Menu Drugorzędne",
    "Footer Menu": "Menu Stopki",
    "Social Menu": "Menu Społecznościowe",
    "Home": "Strona Główna",
    "About": "O Nas",
    "About Us": "O Nas",
    "Services": "Usługi",
    "Portfolio": "Portfolio",
    "Blog": "Blog",
    "Contact": "Kontakt",
    "Contact Us": "Skontaktuj się z Nami",

    # Posts and Pages
    "Post": "Post",
    "Posts": "Posty",
    "Page": "Strona",
    "Pages": "Strony",
    "Post Type": "Typ Postu",
    "Featured Image": "Wyróżniony Obraz",
    "Excerpt": "Wyciąg",
    "Read more": "Czytaj więcej",
    "Continue reading": "Kontynuuj czytanie",
    "Posted on": "Opublikowano",
    "Posted in": "Opublikowano w",
    "Tagged": "Otagowano",
    "By": "Przez",
    "Leave a comment": "Zostaw komentarz",
    "Comment": "Komentarz",
    "Comments": "Komentarze",
    "No Comments": "Brak Komentarzy",
    "One Comment": "Jeden Komentarz",
    "%s Comments": "%s Komentarzy",
    "Reply": "Odpowiedz",
    "Edit Post": "Edytuj Post",
    "Edit Page": "Edytuj Stronę",

    # Sidebar and Widgets
    "Sidebar": "Sidebar",
    "Widget": "Widget",
    "Widgets": "Widgety",
    "Primary Sidebar": "Główny Sidebar",
    "Secondary Sidebar": "Drugorzędny Sidebar",
    "Footer": "Stopka",
    "Footer Widgets": "Widgety Stopki",
    "Header": "Nagłówek",

    # Forms and Fields
    "Form": "Formularz",
    "Field": "Pole",
    "Required": "Wymagane",
    "Optional": "Opcjonalne",
    "Your Name": "Twoje Imię",
    "Your Email": "Twój Email",
    "Your Message": "Twoja Wiadomość",
    "Your Phone": "Twój Telefon",
    "First Name": "Imię",
    "Last Name": "Nazwisko",
    "Full Name": "Pełne Imię",
    "Company": "Firma",
    "Website": "Strona Internetowa",
    "Select": "Wybierz",
    "Choose": "Wybierz",
    "Browse": "Przeglądaj",
    "Drag and Drop": "Przeciągnij i Upuść",

    # Social Media
    "Facebook": "Facebook",
    "Twitter": "Twitter",
    "Instagram": "Instagram",
    "LinkedIn": "LinkedIn",
    "YouTube": "YouTube",
    "Pinterest": "Pinterest",
    "Share": "Udostępnij",
    "Share on Facebook": "Udostępnij na Facebook",
    "Share on Twitter": "Udostępnij na Twitter",
    "Follow": "Obserwuj",
    "Follow Us": "Obserwuj Nas",
    "Social Links": "Linki Społecznościowe",

    # E-commerce
    "Product": "Produkt",
    "Products": "Produkty",
    "Price": "Cena",
    "Add to Cart": "Dodaj do Koszyka",
    "Cart": "Koszyk",
    "Checkout": "Zamówienie",
    "Order": "Zamówienie",
    "Quantity": "Ilość",
    "Total": "Suma",
    "Subtotal": "Suma Częściowa",
    "Shipping": "Wysyłka",
    "Tax": "Podatek",
    "Discount": "Zniżka",
    "Coupon": "Kupon",
    "Apply Coupon": "Zastosuj Kupon",

    # Gallery and Media
    "Gallery": "Galeria",
    "Album": "Album",
    "Photo": "Zdjęcie",
    "Photos": "Zdjęcia",
    "Thumbnail": "Miniatura",
    "Full Size": "Pełny Rozmiar",
    "Slideshow": "Pokaz Slajdów",
    "Slider": "Slider",
    "Carousel": "Karuzela",

    # Features and Elements
    "Feature": "Funkcja",
    "Features": "Funkcje",
    "Icon": "Ikona",
    "Button": "Przycisk",
    "Heading": "Nagłówek",
    "Subheading": "Podtytuł",
    "Section": "Sekcja",
    "Column": "Kolumna",
    "Row": "Wiersz",
    "Grid": "Siatka",
    "List": "Lista",
    "Item": "Element",
    "Items": "Elementy",

    # Team and Testimonials
    "Team": "Zespół",
    "Team Member": "Członek Zespołu",
    "Testimonial": "Referencja",
    "Testimonials": "Referencje",
    "Client": "Klient",
    "Clients": "Klienci",
    "Partner": "Partner",
    "Partners": "Partnerzy",

    # Miscellaneous
    "Loading": "Ładowanie",
    "Loading...": "Ładowanie...",
    "Please wait": "Proszę czekać",
    "Error": "Błąd",
    "Success": "Sukces",
    "Warning": "Ostrzeżenie",
    "Info": "Informacja",
    "Notice": "Powiadomienie",
    "Required field": "Pole wymagane",
    "Invalid email": "Nieprawidłowy email",
    "Invalid URL": "Nieprawidłowy URL",
    "File uploaded successfully": "Plik przesłany pomyślnie",
    "Upload failed": "Przesyłanie nie powiodło się",
    "Are you sure?": "Czy jesteś pewien?",
    "Confirm": "Potwierdź",
    "Default": "Domyślny",
    "Custom": "Niestandardowy",
    "General": "Ogólne",
    "Advanced": "Zaawansowane",
    "Options": "Opcje",
    "Configuration": "Konfiguracja",
    "Version": "Wersja",
    "License": "Licencja",
    "Help": "Pomoc",
    "FAQ": "FAQ",
    "Terms": "Warunki",
    "Privacy": "Prywatność",
    "Privacy Policy": "Polityka Prywatności",
    "Cookie Policy": "Polityka Cookies",
    "Copyright": "Prawa Autorskie",
    "All rights reserved": "Wszelkie prawa zastrzeżone",
}

def create_translation_rules():
    """Create additional translation rules for common patterns"""
    rules = [
        # Patterns for dynamic strings
        (r'^Choose (.+)$', r'Wybierz \1'),
        (r'^Select (.+)$', r'Wybierz \1'),
        (r'^Enter (.+)$', r'Wprowadź \1'),
        (r'^Add (.+)$', r'Dodaj \1'),
        (r'^Edit (.+)$', r'Edytuj \1'),
        (r'^Delete (.+)$', r'Usuń \1'),
        (r'^Remove (.+)$', r'Usuń \1'),
        (r'^Upload (.+)$', r'Prześlij \1'),
        (r'^Download (.+)$', r'Pobierz \1'),
        (r'^Show (.+)$', r'Pokaż \1'),
        (r'^Hide (.+)$', r'Ukryj \1'),
        (r'^Enable (.+)$', r'Włącz \1'),
        (r'^Disable (.+)$', r'Wyłącz \1'),
        (r'^View (.+)$', r'Zobacz \1'),
        (r'^Search (.+)$', r'Szukaj \1'),
        (r'^Filter by (.+)$', r'Filtruj według \1'),
        (r'^Sort by (.+)$', r'Sortuj według \1'),
    ]
    return rules

def translate_string(text):
    """Translate a string from English to Polish"""
    if not text or text.strip() == '':
        return text

    # Direct translation from dictionary
    if text in TRANSLATIONS:
        return TRANSLATIONS[text]

    # Apply pattern-based rules
    rules = create_translation_rules()
    for pattern, replacement in rules:
        match = re.match(pattern, text, re.IGNORECASE)
        if match:
            return re.sub(pattern, replacement, text)

    # Common WordPress word replacements
    word_replacements = {
        'setting': 'ustawienie',
        'settings': 'ustawienia',
        'option': 'opcja',
        'options': 'opcje',
        'configuration': 'konfiguracja',
        'general': 'ogólne',
        'advanced': 'zaawansowane',
        'layout': 'układ',
        'design': 'projekt',
        'style': 'styl',
        'color': 'kolor',
        'background': 'tło',
        'image': 'obraz',
        'text': 'tekst',
        'title': 'tytuł',
        'description': 'opis',
        'content': 'treść',
        'enable': 'włącz',
        'disable': 'wyłącz',
        'width': 'szerokość',
        'height': 'wysokość',
        'size': 'rozmiar',
        'position': 'pozycja',
        'button': 'przycisk',
        'icon': 'ikona',
        'menu': 'menu',
        'header': 'nagłówek',
        'footer': 'stopka',
        'sidebar': 'pasek boczny',
        'widget': 'widget',
        'section': 'sekcja',
        'column': 'kolumna',
        'border': 'ramka',
        'padding': 'odstęp',
        'margin': 'margines',
        'animation': 'animacja',
        'custom': 'niestandardowe',
        'default': 'domyślne',
        'upload': 'prześlij',
        'download': 'pobierz',
        'select': 'wybierz',
        'choose': 'wybierz',
        'search': 'szukaj',
        'filter': 'filtruj',
        'preview': 'podgląd',
        'link': 'link',
        'url': 'url',
        'email': 'email',
        'name': 'nazwa',
        'show': 'pokaż',
        'hide': 'ukryj',
        'open': 'otwórz',
        'close': 'zamknij',
    }

    # Try word-by-word translation for unknown strings
    translated_text = text
    for eng, pol in word_replacements.items():
        # Case-insensitive word replacement
        pattern = re.compile(r'\b' + eng + r'\b', re.IGNORECASE)
        translated_text = pattern.sub(pol, translated_text)

    # If nothing changed, return original (better to show English than nothing)
    if translated_text == text:
        # Add some common phrase translations
        common_phrases = {
            'Click here to': 'Kliknij tutaj, aby',
            'Learn more about': 'Dowiedz się więcej o',
            'Read more about': 'Czytaj więcej o',
            'Go back to': 'Wróć do',
            'Return to': 'Wróć do',
            'This field is required': 'To pole jest wymagane',
            'Please enter': 'Proszę wprowadzić',
            'Please select': 'Proszę wybrać',
            'Please choose': 'Proszę wybrać',
        }

        for eng_phrase, pol_phrase in common_phrases.items():
            if eng_phrase.lower() in text.lower():
                translated_text = text.replace(eng_phrase, pol_phrase)
                break

    return translated_text

def process_pot_file(input_file, output_po_file):
    """Process POT file and create Polish PO file"""
    print(f"Reading POT file: {input_file}")

    # Load the POT file
    pot = polib.pofile(input_file)

    # Create new PO file for Polish
    po = polib.POFile()

    # Copy metadata and update for Polish
    po.metadata = {
        'Project-Id-Version': 'Startup Framework',
        'POT-Creation-Date': pot.metadata.get('POT-Creation-Date', ''),
        'PO-Revision-Date': '2025-01-20 12:00+0100',
        'Last-Translator': 'Auto Translation',
        'Language-Team': 'Polish',
        'Language': 'pl_PL',
        'MIME-Version': '1.0',
        'Content-Type': 'text/plain; charset=UTF-8',
        'Content-Transfer-Encoding': '8bit',
        'Plural-Forms': 'nplurals=3; plural=(n==1 ? 0 : n%10>=2 && n%10<=4 && (n%100<10 || n%100>=20) ? 1 : 2);',
        'X-Generator': 'Python polib',
    }

    # Process each entry
    total_entries = len(pot)
    translated_count = 0

    print(f"Translating {total_entries} entries...")

    for entry in pot:
        # Skip header
        if entry.msgid == '':
            continue

        # Create new entry
        new_entry = polib.POEntry(
            msgid=entry.msgid,
            msgstr='',
            occurrences=entry.occurrences,
            flags=entry.flags,
            comment=entry.comment,
            tcomment=entry.tcomment,
        )

        # Translate msgid
        if entry.msgid:
            translated = translate_string(entry.msgid)
            if translated != entry.msgid:
                translated_count += 1
            new_entry.msgstr = translated

        # Handle plural forms
        if entry.msgid_plural:
            new_entry.msgid_plural = entry.msgid_plural
            # Polish has 3 plural forms
            translated_singular = translate_string(entry.msgid)
            translated_plural = translate_string(entry.msgid_plural)
            new_entry.msgstr_plural = {
                0: translated_singular,
                1: translated_plural,
                2: translated_plural,
            }

        po.append(new_entry)

    # Save PO file
    print(f"Saving PO file: {output_po_file}")
    po.save(output_po_file)

    print(f"Translation complete!")
    print(f"Total entries: {total_entries}")
    print(f"Translated entries: {translated_count}")
    print(f"Translation rate: {(translated_count/total_entries)*100:.1f}%")

    return po

def compile_mo_file(po_file, mo_file):
    """Compile PO file to MO file"""
    print(f"Compiling MO file: {mo_file}")

    po = polib.pofile(po_file)
    po.save_as_mofile(mo_file)

    print(f"MO file compiled successfully!")

def main():
    # File paths
    script_dir = os.path.dirname(os.path.abspath(__file__))
    pot_file = os.path.join(script_dir, 'startup-framework.pot')
    po_file = os.path.join(script_dir, 'startup-framework-pl_PL.po')
    mo_file = os.path.join(script_dir, 'startup-framework-pl_PL.mo')

    # Check if POT file exists
    if not os.path.exists(pot_file):
        print(f"Error: POT file not found: {pot_file}")
        return

    # Process POT file
    process_pot_file(pot_file, po_file)

    # Compile MO file
    compile_mo_file(po_file, mo_file)

    print("\n" + "="*60)
    print("Translation files created successfully!")
    print("="*60)
    print(f"PO file: {po_file}")
    print(f"MO file: {mo_file}")
    print("\nYou can now use these files in your WordPress theme.")
    print("For manual editing, use Poedit or another PO editor.")

if __name__ == '__main__':
    main()
