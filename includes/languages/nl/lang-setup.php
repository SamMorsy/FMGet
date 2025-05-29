<?php
return [
    "welcome" => "Welkom bij FMGet. Voordat u begint, heeft u de volgende zaken nodig.",

    "req_ssl" => "Website met SSL ingeschakeld [https://]", 
    "req_php" => "PHP-versie 7.3 of nieuwer",
    "req_fms" => "FileMaker server versie 18 of nieuwer (SSL moet zijn ingeschakeld)",
    "req_api" => "FM-serverinstellingen > Data API moet zijn ingeschakeld",
    "req_acc" => "[Volledige toegang] databaseaccount en het fmrest uitgebreid bevoegdhedenpakket moet zijn ingeschakeld",

    "back1" => "Selecteer een andere taal",

    "button_install" => "Installeer FMGet",

    "intro1" => "Hebt u meer hulp nodig bij het configureren van uw website en FileMaker-server?",
    "intro2" => "Lees het ondersteuningsartikel over installatie.",

    "error_ssl" => "Er is geen SSL-certificaat gedetecteerd, meestal wordt dit aan u geleverd door uw webhost. Als u dit niet hebt ingeschakeld, moet u contact opnemen met hen voordat u verder kunt gaan.",
    "back2" => "Opnieuw proberen",

    "error_curl1" => "cURL is niet ingeschakeld op deze server. Meestal wordt dit aan u geleverd door uw webhost. Als u dit niet hebt ingeschakeld, moet u contact opnemen met hen voordat u verder kunt gaan.",
    "error_curl2" => "cURL-functies werken niet correct op deze server. Meestal wordt dit aan u geleverd door uw webhost. U moet contact opnemen met hen voordat u verder kunt gaan.",

    "config_details1" => "Uw website is klaar! U bent deze stap van de installatie succesvol doorgekomen. FMGet is nu klaar om verbonden te worden met uw FileMaker-server.",

    "config_important" => "Belangrijk",
    "config_warning1" => "Deel uw gebruikersnaam en wachtwoord met niemand, dit geeft de gebruiker de mogelijkheid om de FMGet-applicatie volledig te beheren en toegang te krijgen tot de verbonden databases.",

    "error_config" => "Fout: Kon fmg-config.php niet aanmaken, controleer uw webserverconfiguraties voordat u verder kunt gaan.",

    "config_title" => "FMGet Instellingen",
    "example" => "Voorbeeld",
    "try_again" => "Opnieuw proberen",
    "continue" => "Doorgaan",
    "config_fmserver_hint" => "Het webadres voor uw FileMaker-server, zonder www of https:// voorafgaand of schuine strepen achteraf, IP-adressen zijn niet toegestaan, Het adres moet een openbare domeinnaam zijn.",
    "config_fmserver_label" => "FileMaker Serveradres",
    "config_timezone_label"=> "Tijdzone",
    "config_dateformat_label"=> "Datumformaat",
    "config_username_label"=> "FMGet Beheerdersnaam",
    "config_username_hint" => "Gebruikersnaam mag alleen alfanumerieke tekens, underscores, spaties, punten en streepjes bevatten.",
    "config_password_label"=> "FMGet Beheerderswachtwoord",
    "config_password_hint"=> "U heeft dit wachtwoord nodig om uw FMGet te beheren, bewaar het op een veilige locatie.",
    "config_email_label"=> "FMGet Beheerder E-mailadres",
    "config_email_hint"=> "Controleer uw e-mailadres goed voordat u doorgaat.",

    "error_title" => "Fout",
    "error_fmserver_error" => "Dit FM Serveradres is ongeldig, controleer het opnieuw.",
    "error_fmserver_required" => "Het FM Serveradres is vereist om FMGet te installeren.",
    "config_title2" => "Database-instellingen",
    "config_details2" => "Selecteer uw database en voer uw FMGet-gebruikersnaam en -wachtwoord in. Maak u geen zorgen, u kunt deze instellingen later altijd wijzigen.",

    "config_sitename_label"=> "Naam van de site",
    "config_fmusername_label"=> "Database Gebruikersnaam",
    "config_fmpassword_label"=> "Database Wachtwoord",

    "config_selectdb"=> "Beschikbare databases op uw server:",
    "config_dbaccess"=> "Hieronder moet u de gegevens invoeren van het account dat u gebruikt om toegang te krijgen tot de database.",

    "error_sitename_required" => "De sitenaam is vereist om FMGet te installeren.",
    "error_timezone_required" => "De tijdzone is vereist om FMGet te installeren.",
    "error_fmusername_required" => "De databasegebruikersnaam is vereist om FMGet te installeren.",
    "error_fmpassword_required" => "Het databasewachtwoord is vereist om FMGet te installeren.",

    "error_dateformat_required" => "Het datumformaat is vereist om FMGet te installeren.",
    "error_fmgusername_required" => "De beheerdersnaam is vereist om FMGet te installeren.",
    "error_fmgpassword_required" => "Het beheerderswachtwoord is vereist om FMGet te installeren.",
    "error_email_required" => "Het e-mailadres is vereist om FMGet te installeren.",
    "error_fmdatabase_required" => "Er is geen database geselecteerd.",

    "error_dateformat_error" => "Dit datumformaat is ongeldig, controleer het opnieuw.",
    "error_timezone_error" => "Deze tijdzone is ongeldig, controleer het opnieuw.",
    "error_email_error" => "Dit e-mailadres is ongeldig, controleer het opnieuw.",

    "error_fmserver_invalid" => "FMGet kon deze FM-server niet detecteren, controleer het serveradres opnieuw.",
    "error_fmserver_nodatabase" => "De FM-server is gedetecteerd, maar er is geen database gevonden voor deze gebruikersnaam/wachtwoordcombinatie.",

    "fmserver_otherdatabase" => "Als u uw database niet in de bovenstaande lijst kunt vinden, kan het zijn dat deze verborgen is of dat de data API er niet voor is ingeschakeld, u kunt proberen er verbinding mee te maken door de naam hieronder in te voeren.",
    "config_named_fmdatabase_label" => "Databasenaam",
    "config_named_fmdatabase_hint" => "Hoofdlettergevoelig - De databasenaam zonder .fmp12.",

    "error_database_noaccess" => "FMGet kan geen toegang krijgen tot de database met deze gebruikersnaam / wachtwoord.",
    "fmcloud_notice" => "Voor databases die worden gehost door FileMaker Cloud, wordt in deze versie geen verbinding ondersteund met een Claris ID-account. Deze optie zal binnenkort beschikbaar komen.",


    "welcome_title" => "Welkom",
    "welcome_details" => "FMGet is geïnstalleerd. Log in op het beheerpaneel om uw pagina's en formulieren te maken en beheren.",
    "button_login" => "Inloggen",

    "alert_username_colon" => "De databasenaam mag geen dubbele punt ( : ) bevatten omdat dit conflicteert met de Data API authenticatie.",
    "error_fmusername_colon" => "De databasenaam mag geen dubbele punt bevatten.",

    "error_sqlite3" => "SQLite3-extensie is niet ingeschakeld op deze server.",
    "fail_sqlite3" => "Kan de interne FMGet-databasetabel niet aanmaken",
];