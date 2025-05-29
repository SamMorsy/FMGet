<?php
return [
    "welcome" => "Witamy w programie FMGet. Przed rozpoczęciem będziesz potrzebował następujących elementów.",

    "req_ssl" => "Strona internetowa z włączonym protokołem SSL [https://]", 
    "req_php" => "Wersja PHP 7.3 lub wyższa",
    "req_fms" => "Serwer FileMaker w wersji 18 lub nowszej (SSL musi być włączony)",
    "req_api" => "Ustawienia serwera FM > Musi być włączony interfejs API danych",
    "req_acc" => "Konto bazy danych z pełnym dostępem [Full Access] i uprawnieniami rozszerzonymi fmrest włączone",

    "back1" => "Wybierz inny język",

    "button_install" => "Zainstaluj FMGet",

    "intro1" => "Potrzebujesz więcej pomocy przy konfigurowaniu strony internetowej i serwera FileMaker?",
    "intro2" => "Przeczytaj artykuł pomocy dotyczący instalacji.",

    "error_ssl" => "Certyfikat SSL nie został wykryty, zazwyczaj jest on dostarczany przez hosta internetowego. Jeśli nie masz go włączonego, skontaktuj się z nim przed kontynuowaniem.",
    "back2" => "Spróbuj ponownie",

    "error_curl1" => "cURL nie jest włączony na tym serwerze. Zazwyczaj jest on dostarczany przez hosta internetowego. Jeśli nie masz go włączonego, skontaktuj się z nim przed kontynuowaniem.",
    "error_curl2" => "Funkcje cURL nie działają poprawnie na tym serwerze. Zazwyczaj jest on dostarczany przez hosta internetowego. Skontaktuj się z nim przed kontynuowaniem.",

    "config_details1" => "Twoja strona jest gotowa! Pomyślnie przebrnąłeś przez tę część instalacji. FMGet jest teraz gotowy do połączenia z Twoim serwerem FileMaker.",

    "config_important" => "Ważne",
    "config_warning1" => "Nie udostępniaj swojej nazwy użytkownika i hasła nikomu — to umożliwia użytkownikowi pełną kontrolę nad aplikacją FMGet i dostęp do podłączonych baz danych.",

    "error_config" => "Błąd: Nie można utworzyć pliku fmg-config.php. Sprawdź ustawienia serwera internetowego przed kontynuowaniem.",

    "config_title" => "Konfiguracje FMGet",
    "example" => "Przykład",
    "try_again" => "Spróbuj ponownie",
    "continue" => "Kontynuuj",
    "config_fmserver_hint" => "Adres internetowy serwera FileMaker, bez wiodącego www ani https:// oraz końcowych ukośników, adresy IP są niedozwolone, adres musi być publiczną domeną.",
    "config_fmserver_label" => "Adres serwera FileMaker",
    "config_timezone_label"=> "Strefa czasowa",
    "config_dateformat_label"=> "Format daty",
    "config_username_label"=> "Nazwa użytkownika administratora FMGet",
    "config_username_hint" => "Nazwa użytkownika może zawierać tylko znaki alfanumeryczne, podkreślenia, spacje, kropki i myślniki.",
    "config_password_label"=> "Hasło administratora FMGet",
    "config_password_hint"=> "Będziesz potrzebował tego hasła, aby zarządzać FMGet, zachowaj je w bezpiecznym miejscu.",
    "config_email_label"=> "Adres e-mail administratora FMGet",
    "config_email_hint"=> "Dwukrotnie sprawdź swój adres e-mail przed kontynuowaniem.",

    "error_title" => "Błąd",
    "error_fmserver_error" => "Ten adres serwera FM jest nieprawidłowy, sprawdź go ponownie.",
    "error_fmserver_required" => "Adres serwera FM jest wymagany do zainstalowania FMGet.",
    "config_title2" => "Konfiguracja bazy danych",
    "config_details2" => "Wybierz swoją bazę danych i wprowadź nazwę użytkownika i hasło FMGet. Nie martw się, zawsze możesz zmienić te ustawienia później.",

    "config_sitename_label"=> "Nazwa witryny",
    "config_fmusername_label"=> "Nazwa użytkownika bazy danych",
    "config_fmpassword_label"=> "Hasło bazy danych",

    "config_selectdb"=> "Dostępne bazy danych na Twoim serwerze:",
    "config_dbaccess"=> "Poniżej należy wprowadzić dane konta używanego do uzyskania dostępu do bazy danych.",

    "error_sitename_required" => "Nazwa witryny jest wymagana do zainstalowania FMGet.",
    "error_timezone_required" => "Strefa czasowa jest wymagana do zainstalowania FMGet.",
    "error_fmusername_required" => "Nazwa użytkownika bazy danych jest wymagana do zainstalowania FMGet.",
    "error_fmpassword_required" => "Hasło bazy danych jest wymagane do zainstalowania FMGet.",

    "error_dateformat_required" => "Format daty jest wymagany do zainstalowania FMGet.",
    "error_fmgusername_required" => "Nazwa użytkownika administratora jest wymagana do zainstalowania FMGet.",
    "error_fmgpassword_required" => "Hasło administratora jest wymagane do zainstalowania FMGet.",
    "error_email_required" => "Adres e-mail jest wymagany do zainstalowania FMGet.",
    "error_fmdatabase_required" => "Nie wybrano żadnej bazy danych.",

    "error_dateformat_error" => "Ten format daty jest nieprawidłowy, sprawdź go ponownie.",
    "error_timezone_error" => "Ta strefa czasowa jest nieprawidłowa, sprawdź ją ponownie.",
    "error_email_error" => "Ten adres e-mail jest nieprawidłowy, sprawdź go ponownie.",

    "error_fmserver_invalid" => "FMGet nie mógł wykryć tego serwera FM, sprawdź ponownie adres serwera.",
    "error_fmserver_nodatabase" => "Serwer FM został wykryty, ale dla tej nazwy użytkownika/hasła nie znaleziono żadnej bazy danych.",

    "fmserver_otherdatabase" => "Jeśli nie możesz znaleźć swojej bazy danych na powyższej liście, mogła ona zostać ukryta lub interfejs API danych nie jest dla niej włączony, możesz spróbować nawiązać z nią połączenie, wpisując jej nazwę w poniższym polu.",
    "config_named_fmdatabase_label" => "Nazwa bazy danych",
    "config_named_fmdatabase_hint" => "Rozróżnianie wielkości liter - Nazwa bazy danych bez .fmp12.",

    "error_database_noaccess" => "FMGet nie może uzyskać dostępu do bazy danych za pomocą tej nazwy użytkownika / hasła.",
    "fmcloud_notice" => "Dla baz danych hostowanych przez FileMaker Cloud ta wersja nie obsługuje łączenia się z bazą danych za pomocą konta Claris ID, opcja będzie dostępna wkrótce.",


    "welcome_title" => "Witamy",
    "welcome_details" => "FMGet został zainstalowany. Zaloguj się do panelu administracyjnego, aby tworzyć i zarządzać stronami i formularzami.",
    "button_login" => "Zaloguj się",

    "alert_username_colon" => "Nazwa użytkownika bazy danych nie może zawierać dwukropka ( : ), ponieważ powoduje to konflikt z uwierzytelnieniem API danych.",
    "error_fmusername_colon" => "Nazwa użytkownika bazy danych nie powinna zawierać dwukropka.",

    "error_sqlite3" => "Rozszerzenie SQLite3 nie jest włączone na tym serwerze.",
    "fail_sqlite3" => "Nie udało się utworzyć wewnętrznej tabeli bazy danych FMGet",
];