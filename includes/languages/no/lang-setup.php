<?php
return [
    "welcome" => "Velkommen til FMGet. Før du starter, vil du trenge følgende elementer.",

    "req_ssl" => "Nettside med SSL aktivert [https://]", 
    "req_php" => "PHP-versjon 7.3 eller nyere",
    "req_fms" => "FileMaker-server versjon 18 eller nyere (SSL må være aktivert)",
    "req_api" => "FM-serverinnstillinger > Data API må være aktivert",
    "req_acc" => "[Full tilgang]-databasekonto og må ha fmrest utvidede rettigheter satt aktivert",

    "back1" => "Velg et annet språk",

    "button_install" => "Installer FMGet",

    "intro1" => "Trenger du mer hjelp med å konfigurere nettsiden og FileMaker-serveren?",
    "intro2" => "Les supportartikkelen om installasjon.",

    "error_ssl" => "SSL-sertifikat ble ikke funnet, vanligvis levert av din webleverandør. Hvis du ikke har dette aktivert, må du kontakte dem før du kan fortsette.",
    "back2" => "Prøv igjen",

    "error_curl1" => "cURL er ikke aktivert på denne serveren. Vanligvis levert av din webleverandør. Hvis du ikke har dette aktivert, må du kontakte dem før du kan fortsette.",
    "error_curl2" => "cURL-funksjoner fungerer ikke riktig på denne serveren. Vanligvis levert av din webleverandør. Du må kontakte dem før du kan fortsette.",

    "config_details1" => "Nettsiden din er klar! Du har kommet gjennom denne delen av installasjonen. FMGet er nå klar for å bli koblet til din FileMaker-server.",

    "config_important" => "Viktig",
    "config_warning1" => "Del ikke brukernavn og passord med noen, dette gir brukeren full kontroll over FMGet-applikasjonen og tilgang til de tilkoblede databasene.",

    "error_config" => "Feil: Kunne ikke opprette fmg-config.php, vennligst sjekk nettserverkonfigurasjonen før du kan fortsette.",

    "config_title" => "FMGet-konfigurasjoner",
    "example" => "Eksempel",
    "try_again" => "Prøv igjen",
    "continue" => "Fortsett",
    "config_fmserver_hint" => "Webadressen til din FileMaker-server, uten www eller https:// i starten eller skråstreker på slutten, IP-adresser er ikke tillatt, adressen må være et offentlig domene.",
    "config_fmserver_label" => "FileMaker-serveradresse",
    "config_timezone_label"=> "Tidssone",
    "config_dateformat_label"=> "Datoformat",
    "config_username_label"=> "FMGet-administratorbrukernavn",
    "config_username_hint" => "Brukernavnet kan bare inneholde alfanumeriske tegn, understreker, mellomrom, punktum og bindestreker.",
    "config_password_label"=> "FMGet-administratorpassord",
    "config_password_hint"=> "Du trenger dette passordet for å administrere FMGet, vennligst lagre det et sikkert sted.",
    "config_email_label"=> "FMGet administrator e-postadresse",
    "config_email_hint"=> "Sjekk e-postadressen grundig før du fortsetter.",

    "error_title" => "Feil",
    "error_fmserver_error" => "Denne FM-serveradressen er ugyldig, vennligst sjekk den igjen.",
    "error_fmserver_required" => "FM-serveradressen er nødvendig for å installere FMGet.",
    "config_title2" => "Databasekonfigurasjoner",
    "config_details2" => "Vennligst velg databasen din og skriv inn ditt FMGet-brukernavn og -passord. Ingen bekymring, du kan alltid endre disse innstillingene senere.",

    "config_sitename_label"=> "Nettstednavn",
    "config_fmusername_label"=> "Databasebrukernavn",
    "config_fmpassword_label"=> "Databasepassord",
    "config_selectdb"=> "Tilgjengelige databaser på serveren din:",
    "config_dbaccess"=> "Nedenfor bør du skrive inn detaljene til kontoen du bruker for å få tilgang til databasen.",
    "error_sitename_required" => "Nettstednavnet er nødvendig for å installere FMGet.",

    "error_timezone_required" => "Tidssonen er nødvendig for å installere FMGet.",
    "error_fmusername_required" => "Databasebrukernavnet er nødvendig for å installere FMGet.",
    "error_fmpassword_required" => "Databasepassordet er nødvendig for å installere FMGet.",
    "error_dateformat_required" => "Datoformatet er nødvendig for å installere FMGet.",

    "error_fmgusername_required" => "Administratorbrukernavnet er nødvendig for å installere FMGet.",
    "error_fmgpassword_required" => "Administratorpassordet er nødvendig for å installere FMGet.",
    "error_email_required" => "E-postadressen er nødvendig for å installere FMGet.",
    "error_fmdatabase_required" => "Ingen database ble valgt.",
    "error_dateformat_error" => "Dette datoformatet er ugyldig, vennligst sjekk det igjen.",

    "error_timezone_error" => "Denne tidssonen er ugyldig, vennligst sjekk den igjen.",
    "error_email_error" => "Denne e-postadressen er ugyldig, vennligst sjekk den igjen.",
    "error_fmserver_invalid" => "FMGet kunne ikke finne denne FM-serveren, vennligst sjekk serveradressen igjen.",

    "error_fmserver_nodatabase" => "FM-serveren ble funnet, men ingen database ble funnet for dette brukernavn/passord.",
    "fmserver_otherdatabase" => "Hvis du ikke finner databasen din i listen ovenfor, kan den ha vært skjult eller data API er ikke aktivert for den, du kan prøve å koble deg til ved å skrive inn navnet under.",

    "config_named_fmdatabase_label" => "Databasenavn",
    "config_named_fmdatabase_hint" => "Skill mellom store og små bokstaver - Databasenavnet uten .fmp12.",
    "error_database_noaccess" => "FMGet har ikke tilgang til databasen med dette brukernavn / passord.",

    "fmcloud_notice" => "For databaser hostet av FileMaker Cloud, støtter ikke denne versjonen tilkobling til en database ved bruk av en Claris ID-konto, dette alternativet blir tilgjengelig snart.",
    "welcome_title" => "Velkommen",


    "welcome_details" => "FMGet har blitt installert. Logg inn på admin-dashboardet for å opprette og administrere sidene og skjemaene dine.",
    "button_login" => "Logg inn",
    "alert_username_colon" => "Databasebrukernavnet kan ikke inneholde kolon ( : ) fordi det forårsaker konflikt med data API-autentisering.",

    "error_fmusername_colon" => "Databasebrukernavnet må ikke inkludere kolon.",
    "error_sqlite3" => "SQLite3-utvidelsen er ikke aktivert på denne serveren.",

    "fail_sqlite3" => "Kunne ikke opprette FMGet intern databaseskjema",
];