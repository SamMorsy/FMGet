<?php
return [
    "welcome" => "Laipni lūdzam FMGet! Pirms sākuma tev būs vajadzīgi šādi elementi.",

    "req_ssl" => "Tīmekļa lapa ar iespēlotu SSL [https://]", 
    "req_php" => "PHP versija 7.3 vai jaunāka",
    "req_fms" => "FileMaker serveris versija 18 vai jaunāks (jābūt iespēlotam SSL)",
    "req_api" => "FM servera iestatījumi > Jābūt iespēlotam Data API",
    "req_acc" => "[Pilnā piekļuve] datubāzes konts un jābūt iespēlotai paplašinātai fmrest privilēģijai",

    "back1" => "Izvēlies citu valodu",

    "button_install" => "Instalēt FMGet",

    "intro1" => "Vajag vairāk palīdzības, konfigurējot savu tīmekļa lapu un FileMaker serveri?",
    "intro2" => "Lasi atbalsta rakstu par iestādīšanu.",

    "error_ssl" => "SSL sertifikāts netika atrasts, parasti to nodrošina tavs tīmekļa resursdators. Ja tas nav iespēlots, pirms turpināšanas tev jāsaņem ar viņiem saziņa.",
    "back2" => "Mēģiniet vēlreiz",

    "error_curl1" => "cURL nav iespēlots uz šī servera. Parasti to nodrošina tavs tīmekļa resursdators. Ja tas nav iespēlots, pirms turpināšanas tev jāsaņem ar viņiem saziņa.",
    "error_curl2" => "cURL funkcijas uz šī servera nedarbojas pareizi. Parasti to nodrošina tavs tīmekļa resursdators. Tev jāsazinās ar viņiem, pirms turpināt.",

    "config_details1" => "Tava tīmekļa lapa ir gatava! Tu esi veiksmīgi izgājis cauri šai instalācijas daļai. FMGet tagad ir gatavs pieslēgties tavam FileMaker serverim.",

    "config_important" => "Svarīgi",
    "config_warning1" => "Nedalies ar savu lietotājvārdu un paroli ar nevienu, tas ļauj lietotājam pilnībā kontrolēt FMGet programmu un piekļūt pievienotajām datubāzēm.",

    "error_config" => "Kļūda: Nevar izveidot fmg-config.php, pirms turpināšanas pārbaudi sava tīmekļa servera konfigurāciju.",

    "config_title" => "FMGet Konfigurācijas",
    "example" => "Piemērs",
    "try_again" => "Mēģiniet vēlreiz",
    "continue" => "Turpināt",
    "config_fmserver_hint" => "Tavs FileMaker servera interneta adrese, bez www vai https:// priekšā vai slīpsvītriem beigās, IP adreses nav atļautas, adresei jābūt publiskai domēnu vērtībai.",
    "config_fmserver_label" => "FileMaker Servera Adrese",
    "config_timezone_label"=> "Laika josla",
    "config_dateformat_label"=> "Datuma formāts",
    "config_username_label"=> "FMGet administratora lietotājvārds",
    "config_username_hint" => "Lietotājvārdā drīkst būt tikai alfabēta un ciparu simboli, apakšsvītras, atstarpes, punkti un domenes zīmes.",
    "config_password_label"=> "FMGet administratora parole",
    "config_password_hint"=> "Tevis izmantotā parole būs nepieciešama FMGet pārvaldīšanai, lūdzu, saglabā to drošā vietā.",
    "config_email_label"=> "FMGet administratora e-pasta adrese",
    "config_email_hint"=> "Pirms turpināšanas divreiz pārbaudi savu e-pasta adresi.",

    "error_title" => "Kļūda",
    "error_fmserver_error" => "Šī FM servera adrese nav derīga, lūdzu, pārbaudi vēlreiz.",
    "error_fmserver_required" => "FM servera adrese ir nepieciešama FMGet instalācijai.",
    "config_title2" => "Datubāžu konfigurācijas",
    "config_details2" => "Lūdzu, izvēlies savu datubāzi un ievadi savu FMGet lietotājvārdu un paroli. Neuztraucies, šos iestatījumus vienmēr var mainīt vēlāk.",

    "config_sitename_label"=> "Vietnes nosaukums",
    "config_fmusername_label"=> "Datubāzes lietotājvārds",
    "config_fmpassword_label"=> "Datubāzes parole",

    "config_selectdb"=> "Pieejamas datubāzes tavā serverī:",
    "config_dbaccess"=> "Zemāk tev jāievada konta informācija, kuru izmanto pieeju datubāzei.",

    "error_sitename_required" => "FMGet instalācijai ir nepieciešams vietnes nosaukums.",
    "error_timezone_required" => "FMGet instalācijai ir nepieciešama laika josla.",
    "error_fmusername_required" => "FMGet instalācijai ir nepieciešams datubāzes lietotājvārds.",
    "error_fmpassword_required" => "FMGet instalācijai ir nepieciešama datubāzes parole.",

    "error_dateformat_required" => "FMGet instalācijai ir nepieciešams datuma formāts.",
    "error_fmgusername_required" => "FMGet instalācijai ir nepieciešams administrators lietotājvārds.",
    "error_fmgpassword_required" => "FMGet instalācijai ir nepieciešama administrators parole.",
    "error_email_required" => "FMGet instalācijai ir nepieciešama e-pasta adrese.",
    "error_fmdatabase_required" => "Nav atlasīta neviena datubāze.",

    "error_dateformat_error" => "Šis datuma formāts nav derīgs, lūdzu, pārbaudi vēlreiz.",
    "error_timezone_error" => "Šī laika josla nav derīga, lūdzu, pārbaudi vēlreiz.",
    "error_email_error" => "Šī e-pasta adrese nav derīga, lūdzu, pārbaudi vēlreiz.",

    "error_fmserver_invalid" => "FMGet nevarēja noteikt šo FM serveri, lūdzu, pārbaudiet servera adresi vēlreiz.",
    "error_fmserver_nodatabase" => "FM servers tika noteikts, bet ar šo lietotājvārdu/paroli netika atrasta neviena datubāze.",

    "fmserver_otherdatabase" => "Ja augšējā sarakstā neatrodas tava datubāze, iespējams, tā ir paslēpta vai tai nav iespēlots Data API, tu vari mēģināt pieslēgties tam, ievadot tās nosaukumu laukā zemāk.",
    "config_named_fmdatabase_label" => "Datubāzes nosaukums",
    "config_named_fmdatabase_hint" => "Reģistra jutība - Datubāzes nosaukums bez .fmp12.",

    "error_database_noaccess" => "FMGet nevar piekļūt datubāzei, izmantojot šo lietotājvārdu / paroli.",
    "fmcloud_notice" => "Datubāzēm, kas tiek izplatītas ar FileMaker Cloud, šī versija neatbalsta pieslēgšanos datubāzei, izmantojot Claris ID kontu, šī opcija būs drīz pieejama.",


    "welcome_title" => "Laipni lūdzam",
    "welcome_details" => "FMGet ir instalēts. Ielogojies administrēšanas panelī, lai izveidotu un pārvaldītu savas lapas un formas.",
    "button_login" => "Pieslēgties",

    "alert_username_colon" => "Datubāzes lietotājvārdā nedrīkst būt koliņam ( : ), jo tas izraisa konfliktu ar datu API autentifikāciju.",
    "error_fmusername_colon" => "Datubāzes lietotājvārdā nedrīkst būt koliņam.",

    "error_sqlite3" => "SQLite3 paplašinājums nav iespēlots šajā serverī.",
    "fail_sqlite3" => "Neizdevās izveidot FMGet iekšējo datubāzes tabulu",
];