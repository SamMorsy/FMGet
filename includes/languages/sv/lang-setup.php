<?php
return [
    "welcome" => "Välkommen till FMGet. Innan du börjar behöver du följande saker.",

    "req_ssl" => "Webbplats med SSL aktiverat [https://]", 
    "req_php" => "PHP-version 7.3 eller nyare",
    "req_fms" => "FileMaker-server version 18 eller nyare (SSL måste vara aktiverat)",
    "req_api" => "FM-serverinställningar > Data API måste vara aktiverat",
    "req_acc" => "[Full åtkomst]-databaskonto och måste ha utökade rättigheter för fmrest aktiverade",

    "back1" => "Välj ett annat språk",

    "button_install" => "Installera FMGet",

    "intro1" => "Behöver du mer hjälp med att konfigurera din webbplats och FileMaker-server?",
    "intro2" => "Läs supportartikeln om installation.",

    "error_ssl" => "Inget SSL-certifikat hittades, vanligtvis tillhandahålls detta av din webbhotell-leverantör. Om det inte är aktiverat måste du kontakta dem innan du kan fortsätta.",
    "back2" => "Försök igen",

    "error_curl1" => "cURL är inte aktiverat på denna server. Vanligtvis tillhandahålls detta av din webbhotell-leverantör. Om det inte är aktiverat måste du kontakta dem innan du kan fortsätta.",
    "error_curl2" => "cURL-funktioner fungerar inte korrekt på denna server. Vanligtvis tillhandahålls detta av din webbhotell-leverantör. Du måste kontakta dem innan du kan fortsätta.",

    "config_details1" => "Din webbplats är klar! Du har kommit igenom denna del av installationen. FMGet är nu redo att anslutas till din FileMaker-server.",

    "config_important" => "Viktigt",
    "config_warning1" => "Dela inte ditt användarnamn och lösenord med någon, detta ger användaren full kontroll över FMGet-programmet och tillgång till de anslutna databaserna.",
    "error_config" => "Fel: Kunde inte skapa fmg-config.php, vänligen kontrollera dina webbserverkonfigurationer innan du kan fortsätta.",
    "config_title" => "FMGet-konfigurationer",

    "example" => "Exempel",
    "try_again" => "Försök igen",
    "continue" => "Fortsätt",
    "config_fmserver_hint" => "Webbadressen till din FileMaker-server, utan www eller https:// i början eller snedstreck i slutet, IP-adresser är inte tillåtna, adressen måste vara en offentlig domän.",
    "config_fmserver_label" => "FileMaker-serveradress",
    "config_timezone_label"=> "Tidszon",
    "config_dateformat_label"=> "Datumformat",
    "config_username_label"=> "FMGet-administratörens användarnamn",
    "config_username_hint" => "Användarnamn får bara innehålla alfanumeriska tecken, understreck, mellanslag, punkter och bindestreck.",
    "config_password_label"=> "FMGet-administratörens lösenord",
    "config_password_hint"=> "Du kommer att behöva detta lösenord för att hantera din FMGet, vänligen spara det på en säker plats.",
    "config_email_label"=> "FMGet-administratörens e-postadress",
    "config_email_hint"=> "Dubbelkolla din e-postadress innan du fortsätter.",
    "error_title" => "Fel",

    "error_fmserver_error" => "Denna FM-serveradress är ogiltig, vänligen kontrollera igen.",
    "error_fmserver_required" => "FM-serveradress krävs för att installera FMGet.",
    "config_title2" => "Databaskonfigurationer",
    "config_details2" => "Vänligen välj din databas och ange ditt FMGet-användarnamn och lösenord. Oroa dig inte, du kan alltid ändra dessa inställningar senare.",
    "config_sitename_label"=> "Webbplatsnamn",

    "config_fmusername_label"=> "Databasanvändarnamn",
    "config_fmpassword_label"=> "Databaslösenord",
    "config_selectdb"=> "Tillgängliga databaser på din server:",

    "config_dbaccess"=> "Nedan ska du ange detaljer för det konto du använder för att få tillgång till databasen.",
    "error_sitename_required" => "Webbplatsnamnet krävs för att installera FMGet.",

    "error_timezone_required" => "Tidszonen krävs för att installera FMGet.",
    "error_fmusername_required" => "Databasanvändarnamnet krävs för att installera FMGet.",
    "error_fmpassword_required" => "Databaslösenordet krävs för att installera FMGet.",
    "error_dateformat_required" => "Datumformatet krävs för att installera FMGet.",

    "error_fmgusername_required" => "Administratörens användarnamn krävs för att installera FMGet.",
    "error_fmgpassword_required" => "Administratörens lösenord krävs för att installera FMGet.",
    "error_email_required" => "E-postadressen krävs för att installera FMGet.",
    "error_fmdatabase_required" => "Ingen databas valdes.",
    "error_dateformat_error" => "Detta datumformat är ogiltigt, vänligen kontrollera igen.",

    "error_timezone_error" => "Denna tidszon är ogiltig, vänligen kontrollera igen.",
    "error_email_error" => "Denna e-postadress är ogiltig, vänligen kontrollera igen.",
    "error_fmserver_invalid" => "FMGet kunde inte identifiera denna FM-server, vänligen kontrollera serveradressen igen.",

    "error_fmserver_nodatabase" => "FM-servern identifierades men ingen databas hittades för detta användarnamn/lösenord.",
    "fmserver_otherdatabase" => "Om du inte kan hitta din databas i listan ovan kan den ha varit dold eller så är data-API:t inte aktiverat för den, du kan försöka ansluta till den genom att skriva in dess namn i fältet nedan.",

    "config_named_fmdatabase_label" => "Databasnamn",
    "config_named_fmdatabase_hint" => "Skiljer mellan stora och små bokstäver - Databasnamnet utan .fmp12.",
    "error_database_noaccess" => "FMGet kan inte komma åt databasen med detta användarnamn / lösenord.",

    "fmcloud_notice" => "För databaser som är värd för FileMaker Cloud stöder inte denna version anslutning till en databas med ett Claris ID-konto, detta alternativ blir tillgängligt inom kort.",
    "welcome_title" => "Välkommen",


    "welcome_details" => "FMGet har blivit installerat. Logga in på admininstrumentpanelen för att skapa och hantera dina sidor och formulär.",
    "button_login" => "Logga in",
    "alert_username_colon" => "Databasanvändarnamnet kan inte innehålla kolon ( : ) eftersom det orsakar konflikt med data API-autentisering.",

    "error_fmusername_colon" => "Databasanvändarnamnet får inte innehålla kolon.",
    "error_sqlite3" => "SQLite3-tillägget är inte aktiverat på denna server.",

    "fail_sqlite3" => "Kunde inte skapa intern databastabell för FMGet",
];