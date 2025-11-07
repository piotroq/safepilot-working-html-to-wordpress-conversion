# SafePilot WordPress Theme

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![WordPress](https://img.shields.io/badge/WordPress-6.0+-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![License](https://img.shields.io/badge/license-GPL--2.0+-blue.svg)

Nowoczesny motyw WordPress dla firmy SafePilot - kompleksowe usługi BHP, PPOŻ i Pierwszej Pomocy.

## 🌟 Funkcje

- **Full Site Editing (FSE)** - Pełna edycja witryny z użyciem bloków Gutenberg
- **Responsywny design** - Mobile-first, w pełni responsywny
- **Custom Post Types** - Portfolio i Usługi
- **SEO Friendly** - Wbudowane meta tagi i Open Graph
- **WCAG 2.2** - Zgodność z wytycznymi dostępności
- **Bootstrap 5** - Zintegrowany framework CSS
- **Wielojęzyczność** - Gotowy do tłumaczenia (Pollyglots ready)
- **Performance** - Zoptymalizowany pod Google PageSpeed

## 📋 Wymagania

- WordPress 6.0 lub nowszy
- PHP 8.2 lub nowszy
- MySQL 5.7 lub nowszy / MariaDB 10.3 lub nowszy

## 🚀 Instalacja

1. Pobierz motyw z repozytorium
2. Prześlij folder `safepilot-main` do katalogu `/wp-content/themes/`
3. Aktywuj motyw w Panelu WordPress (**Wygląd → Motywy**)
4. Skonfiguruj ustawienia w **SafePilot → Ustawienia motywu**

## ⚙️ Konfiguracja

### Podstawowa konfiguracja

1. **Logo i Favicon**
   - Przejdź do **Wygląd → Dostosuj → Identyfikacja witryny**
   - Prześlij logo i ikonę witryny

2. **Menu**
   - Przejdź do **Wygląd → Menu**
   - Utwórz menu i przypisz je do lokalizacji "Primary Menu"

3. **Informacje kontaktowe**
   - Przejdź do **SafePilot → Ustawienia motywu**
   - Uzupełnij email, telefon i social media

4. **Widgety**
   - Przejdź do **Wygląd → Widgety**
   - Skonfiguruj 4 obszary widgetów stopki

### Kolory marki

Motyw wykorzystuje następujące kolory:

- **Primary**: #4fb9ad
- **Secondary**: #213543
- **Background**: #d8d5c8
- **Tertiary**: #19222a
- **Hover**: #213542

Kolory można dostosować w pliku `theme.json` lub przez panel Dostosowywania.

## 📁 Struktura plików

```
safepilot-main/
├── assets/               # Zasoby (CSS, JS, obrazy)
├── inc/                  # Dodatkowe funkcje PHP
│   └── admin-settings.php
├── template-parts/       # Części szablonów
│   ├── top-bar.php
│   ├── menu-main.php
│   ├── footer-widget.php
│   ├── content.php
│   └── content-none.php
├── 404.php              # Strona błędu 404
├── archive.php          # Archiwum postów
├── comments.php         # Komentarze
├── footer.php           # Stopka
├── functions.php        # Funkcje motywu
├── header.php           # Nagłówek
├── index.php            # Główny szablon
├── page.php             # Szablon strony
├── page-faq.php         # Szablon FAQ
├── searchform.php       # Formularz wyszukiwania
├── single.php           # Pojedynczy post
├── single-portfolio.php # Pojedyncze portfolio
├── style.css            # Główny arkusz stylów
└── theme.json           # Konfiguracja FSE
```

## 🎨 Custom Post Types

### Portfolio

Służy do prezentacji wykonanych projektów.

**Pola meta:**
- Client (Klient)
- Date (Data realizacji)
- Category (Kategoria)
- URL (Adres strony projektu)

### Services (Usługi)

Służy do prezentacji oferowanych usług.

## 📄 Szablony stron

- **Domyślny** - `page.php`
- **FAQ** - `page-faq.php` (Template Name: FAQ Page)

## 🔌 Zalecane wtyczki

- **Contact Form 7** - Formularze kontaktowe
- **Yoast SEO** lub **Rank Math** - Rozszerzone SEO
- **Polylang** - Wielojęzyczność
- **WooCommerce** - Sklep internetowy (opcjonalnie)

## 🌐 Wielojęzyczność

Motyw jest gotowy do tłumaczenia. Pliki tłumaczeń powinny znajdować się w katalogu `/languages/`.

**Text Domain**: `safepilot`

## 🔒 Bezpieczeństwo

- Wszystkie dane wejściowe są sanityzowane
- Wszystkie dane wyjściowe są escapowane
- Wykorzystuje WordPress nonces dla formularzy
- Zobacz [SECURITY.md](SECURITY.md) dla więcej informacji

## ♿ Dostępność

Motyw jest zgodny z WCAG 2.2 Level AA:
- Skip to content link
- ARIA labels
- Keyboard navigation
- Screen reader friendly
- High contrast support

## 🤝 Wsparcie

Jeśli masz pytania lub problemy:
- Utwórz issue na GitHub
- Skontaktuj się przez formularz kontaktowy

## 📝 Changelog

### 1.0.0 (2025-10-28)
- Pierwsze wydanie
- Full Site Editing support
- Custom Post Types (Portfolio, Services)
- SEO meta fields
- Responsive design
- WCAG 2.2 compliance

## 📄 Licencja

Ten motyw jest licencjonowany na zasadach GNU General Public License v2 lub nowszej.

## 👥 Autorzy

- **SafePilot Team** - [https://safepilot.pl](https://safepilot.pl)

## 🙏 Podziękowania

- Bootstrap Team
- WordPress Community
- Font Awesome

---

Made with ❤️ by SafePilot Team
