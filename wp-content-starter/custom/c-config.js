import './c-script.js';

/**
 * All config. options available here:
 * https://cookieconsent.orestbida.com/reference/configuration-reference.html
 */
CookieConsent.run({

    // NOWA SEKCJA: Konfiguracja wyglądu (GUI) dla stylu premium
    guiOptions: {
        consentModal: {
            layout: 'box',                      // 'box', 'cloud', 'bar'
            position: 'bottom center',          // 'bottom left', 'bottom right', 'middle center', etc.
            equalWeightButtons: true,           // Przyciski mają równą wagę i szerokość
            flipButtons: false                  // Odwrócenie kolejności przycisków
        },
        preferencesModal: {
            layout: 'box',                      // 'box', 'bar'
            position: 'right',                  // 'left', 'right'
            equalWeightButtons: true,
            flipButtons: false
        }
    },

    categories: {
        necessary: {
            enabled: true,  // this category is enabled by default
            readOnly: true  // this category cannot be disabled
        },
        analytics: {
            enabled: false
            }
    },

    language: {
        default: 'pl',
        autoDetect: 'browser',
        
        translations: {
            pl: {
                consentModal: {
                    title: 'Polityka Prywatności & RODO',
                    description: 'Używamy plików cookie, aby zapewnić najlepszą jakość korzystania z naszej witryny. Możesz zarządzać swoimi preferencjami, klikając w "Zarządzaj indywidualnymi preferencjami". <a href="https://pbmediaonline.smarthost.pl/wordpress-test/polityka-prywatnosci-rodo" data-cc="show-preferencesModal">Więcej informacji</a>',
                    acceptAllBtn: 'Akceptuj wszystko',
                    acceptNecessaryBtn: 'Tylko niezbędne',
                    showPreferencesBtn: 'Zarządzaj zgodami'
                },
                preferencesModal: {
                    title: 'Centrum Preferencji Prywatności',
                    acceptAllBtn: 'Akceptuj wszystko',
                    acceptNecessaryBtn: 'Tylko niezbędne',
                    savePreferencesBtn: 'Zapisz moje wybory',
                    closeIconLabel: 'Zamknij okno',
                    sections: [
                        {
                            title: 'Twoja prywatność jest dla nas ważna',
                            description: 'Gdy odwiedzasz naszą stronę, możemy przechowywać lub pobierać informacje w Twojej przeglądarce, głównie w formie plików cookie. Informacje te mogą dotyczyć Ciebie, Twoich preferencji lub Twojego urządzenia i są wykorzystywane głównie do tego, aby witryna działała zgodnie z Twoimi oczekiwaniami. Zazwyczaj nie identyfikują Cię one bezpośrednio, ale mogą zapewnić Ci bardziej spersonalizowane doświadczenie. Ponieważ szanujemy Twoje prawo do prywatności, możesz nie zezwalać na niektóre rodzaje plików cookie.'
                        },
                        {
                            title: 'Niezbędne pliki cookie',
                            description: 'Te pliki cookie są niezbędne do prawidłowego funkcjonowania witryny i nie można ich wyłączyć. Są one zazwyczaj ustawiane tylko w odpowiedzi na działania podejmowane przez Ciebie, takie jak ustawienie preferencji prywatności, logowanie czy wypełnianie formularzy.',
                            linkedCategory: 'necessary'
                        },
                        {
                            title: 'Analityka i wydajność',
                            description: 'Te pliki cookie pozwalają nam liczyć wizyty i źródła ruchu, dzięki czemu możemy mierzyć i poprawiać wydajność naszej witryny. Pomagają nam dowiedzieć się, które strony są najbardziej i najmniej popularne oraz zobaczyć, jak odwiedzający poruszają się po witrynie. Wszystkie informacje zbierane przez te pliki cookie są agregowane, a zatem anonimowe.',
                            linkedCategory: 'analytics'
                        },
                        {
                            title: 'Więcej informacji',
                            description: 'W przypadku pytań dotyczących naszej polityki plików cookie i Twoich wyborów, prosimy o <a href="mailto:biuro@safepilot.pl">kontakt z nami</a>.'
                        }
                    ]
                }
            }
        }
    }
});