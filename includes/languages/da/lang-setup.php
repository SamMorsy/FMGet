<?php
return [
    "welcome" => "Velkommen til FMGet. Før du starter, har du brug for følgende ting.",

    "req_ssl" => "Website med SSL aktiveret [https://]", 
    "req_php" => "PHP-version 7.3 eller nyere",
    "req_fms" => "FileMaker-server version 18 eller nyere (SSL skal være aktiveret)",
    "req_api" => "FM-serverindstillinger > Data API skal være aktiveret",
    "req_acc" => "[Fuld adgang] databasekonto og skal have fmrest udvidede rettigheder slået til",

    "back1" => "Vælg et andet sprog",

    "button_install" => "Installer FMGet",

    "intro1" => "Brug for mere hjælp til at konfigurere din hjemmeside og FileMaker-server?",
    "intro2" => "Læs supportartiklen om installation.",

    "error_ssl" => "SSL-certifikat blev ikke fundet, normalt leveres det af din webhost. Hvis du ikke har det aktiveret, skal du kontakte dem, før du kan fortsætte.",
    "back2" => "Prøv igen",

    "error_curl1" => "cURL er ikke aktiveret på denne server. Normalt leveres det af din webhost. Hvis du ikke har det aktiveret, skal du kontakte dem, før du kan fortsætte.",
    "error_curl2" => "cURL-funktioner virker ikke korrekt på denne server. Normalt leveres det af din webhost. Du skal kontakte dem, før du kan fortsætte.",

    "config_details1" => "Din hjemmeside er klar! Du har gennemført denne del af installationen. FMGet er nu klar til at blive forbundet med din FileMaker-server.",

    "config_important" => "Vigtigt",
    "config_warning1" => "Del ikke dit brugernavn og password med nogen, dette giver brugeren fuld kontrol over FMGet-applikationen og adgang til de forbundne databaser.",

    "error_config" => "Fejl: Kunne ikke oprette fmg-config.php, tjek venligst din webserverkonfiguration, før du kan fortsætte.",

    "config_title" => "FMGet-konfigurationer",
    "example" => "Eksempel",
    "try_again" => "Prøv igen",
    "continue" => "Fortsæt",
    "config_fmserver_hint" => "Webadressen til din FileMaker-server, uden www- eller https://-præfiks  eller skråstreger bagefter, IP-adresser er ikke tilladt, adressen skal være et offentligt domæne.",
    "config_fmserver_label" => "FileMaker-serveradresse",
    "config_timezone_label"=> "Tidszone",
    "config_dateformat_label"=> "Datoformat",
    "config_username_label"=> "FMGet-administratorbrugernavn",
    "config_username_hint" => "Brugernavnet må kun indeholde alfanumeriske tegn, understregninger, mellemrum, punktummer og bindestreger.",
    "config_password_label"=> "FMGet-administratoradgangskode",
    "config_password_hint"=> "Du får brug for denne adgangskode til at administrere din FMGet, gem den venligst et sikkert sted.",
    "config_email_label"=> "FMGet administrator e-mailadresse",
    "config_email_hint"=> "Tjek din e-mailadresse grundigt, før du fortsætter.",

    "error_title" => "Fejl",
    "error_fmserver_error" => "Denne FM-serveradresse er ugyldig, kontroller igen.",
    "error_fmserver_required" => "FM-serveradressen kræves for at installere FMGet.",
    "config_title2" => "Databasekonfigurationer",
    "config_details2" => "Vælg din database og indtast dit FMGet-brugernavn og -adgangskode. Ingen bekymring, du kan altid ændre disse indstillinger senere.",

    "config_sitename_label"=> "Sitenavn",
    "config_fmusername_label"=> "Databasebrugernavn",
    "config_fmpassword_label"=> "Databaseadgangskode",

    "config_selectdb"=> "Tilgængelige databaser på din server:",
    "config_dbaccess"=> "Nedenfor skal du indtaste detaljerne for den konto, du bruger til at få adgang til databasen.",

    "error_sitename_required" => "Sitenavnet kræves for at installere FMGet.",
    "error_timezone_required" => "Tidszonen kræves for at installere FMGet.",
    "error_fmusername_required" => "Databasebrugernavnet kræves for at installere FMGet.",
    "error_fmpassword_required" => "Databaseadgangskoden kræves for at installere FMGet.",

    "error_dateformat_required" => "Datoformatet kræves for at installere FMGet.",
    "error_fmgusername_required" => "Administratorbrugernavnet kræves for at installere FMGet.",
    "error_fmgpassword_required" => "Administratoradgangskoden kræves for at installere FMGet.",
    "error_email_required" => "E-mailadressen kræves for at installere FMGet.",
    "error_fmdatabase_required" => "Ingen database valgt.",

    "error_dateformat_error" => "Dette datoformat er ugyldigt, kontroller igen.",
    "error_timezone_error" => "Denne tidszone er ugyldig, kontroller igen.",
    "error_email_error" => "Denne e-mailadresse er ugyldig, kontroller igen.",

    "error_fmserver_invalid" => "FMGet kunne ikke finde denne FM-server, kontroller serveradressen igen.",
    "error_fmserver_nodatabase" => "FM-serveren blev fundet, men der blev ikke fundet nogen database til dette brugernavn/adgangskode.",

    "fmserver_otherdatabase" => "Hvis du ikke kan finde din database i listen ovenfor, kan den have været skjult, eller data API er ikke aktiveret for den, du kan forsøge at oprette forbindelse ved at indtaste navnet i feltet nedenfor.",
    "config_named_fmdatabase_label" => "Databasenavn",
    "config_named_fmdatabase_hint" => "Skiftes mellem store og små bogstaver - Databasenavnet uden .fmp12.",

    "error_database_noaccess" => "FMGet kan ikke få adgang til databasen med dette brugernavn / adgangskode.",
    "fmcloud_notice" => "For databaser hostet af FileMaker Cloud understøttes forbindelse til en database ved brug af en Claris ID-konto ikke i denne version, denne funktion vil være tilgængelig snart.",


    "welcome_title" => "Velkommen",
    "welcome_details" => "FMGet er blevet installeret. Log ind på admin-dashboardet for at oprette og administrere dine sider og formularer.",
    "button_login" => "Log ind",

    "alert_username_colon" => "Databasebrugernavnet må ikke indeholde et kolon ( : ), da det skaber konflikt med data API-autentificering.",
    "error_fmusername_colon" => "Databasebrugernavnet må ikke inkludere kolon.",

    "error_sqlite3" => "SQLite3-udvidelsen er ikke aktiveret på denne server.",
    "fail_sqlite3" => "Kunne ikke oprette FMGet intern databasetabel",
];