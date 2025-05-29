<?php
return [
    "welcome" => "Tere tulemast FMGet'i. Enne alustamist vajad järgmisi asju.",

    "req_ssl" => "Veebileht SSL-i abil [https://]", 
    "req_php" => "PHP versioon 7.3 või uuem",
    "req_fms" => "FileMaker serveri versioon 18 või uuem (SSL peab olema lubatud)",
    "req_api" => "FM serveri seaded > Andmete API peab olema lubatud",
    "req_acc" => "[Täielik ligipääs] andmebaasi konto ja fmrest laiendatud õigused peavad olema lubatud",

    "back1" => "Valige teine keel",

    "button_install" => "Installi FMGet",

    "intro1" => "Vajad rohkem abi oma veebilehe ja FileMaker serveri seadistamisel?",
    "intro2" => "Loe häälestamise kohta toetav artikkel.",

    "error_ssl" => "SSL-sertifikaati ei leitud, tavaliselt annab selle sulle veebihotell. Kui see pole lubatud, siis pead enne jätkamist nendega ühendust võtma.",
    "back2" => "Proovi uuesti",

    "error_curl1" => "cURL ei ole sellel serveris lubatud. Tavaliselt annab selle sulle veebihotell. Kui see pole lubatud, siis pead enne jätkamist nendega ühendust võtma.",
    "error_curl2" => "cURL funktsionaalsus ei tööta korrektselt sellel serveril. Tavaliselt annab selle sulle veebihotell. Peate enne jätkamist nendega ühendust võtma.",

    "config_details1" => "Sinu veebileht on valmis! Oled jõudnud selle osa installatsioonist edasi. FMGet on nüüd valmis ühendama sinu FileMaker serveriga.",

    "config_important" => "Tähtis",
    "config_warning1" => "Ära jaga oma kasutajanime ja parooli kellegi muuga, see võimaldab kasutajal täielikult kontrollida FMGet rakendust ja pääseda seotud andmebaasidele.",

    "error_config" => "Viga: fmg-config.php loomine ebaõnnestus, enne jätkamist kontrollige oma veebiserveri seadeid.",

    "config_title" => "FMGet seaded",
    "example" => "Näide",
    "try_again" => "Proovi uuesti",
    "continue" => "Jätka",
    "config_fmserver_hint" => "Sinu FileMaker serveri veebiaadress, ilma www või https:// eesliite ja kaldkriipsude lisaosata, IP-aadressid ei ole lubatud, aadress peab olema avalik domeen.",
    "config_fmserver_label" => "FileMaker Serveri aadress",
    "config_timezone_label"=> "Ajavöönd",
    "config_dateformat_label"=> "Kuupäevavorming",
    "config_username_label"=> "FMGet administraatori kasutajanimi",
    "config_username_hint" => "Kasutajanimel võib olla ainult tähti ja numbreid, alakriipse, tühikuid, punkte ja sidekriipse.",
    "config_password_label"=> "FMGet administraatori parool",
    "config_password_hint"=> "Selle parooli vajad, et hallata oma FMGet'i, salvesta see turvalisse kohta.",
    "config_email_label"=> "FMGet administraatori e-posti aadress",
    "config_email_hint"=> "Kontrolli oma e-posti aadressi enne jätkamist veelkord läbi.",

    "error_title" => "Viga",
    "error_fmserver_error" => "See FM serveri aadress ei ole kehtiv, palun kontrolli uuesti.",
    "error_fmserver_required" => "FM serveri aadress on vajalik FMGet'i installimiseks.",
    "config_title2" => "Andmebaasi seaded",
    "config_details2" => "Palun vali oma andmebaas ja sisesta oma FMGet kasutajanimi ja parool. Ära muretse, saad alati neid seadeid hiljem muuta.",

    "config_sitename_label"=> "Saidinimi",
    "config_fmusername_label"=> "Andmebaasi kasutajanimi",
    "config_fmpassword_label"=> "Andmebaasi parool",

    "config_selectdb"=> "Saadaolevad andmebaasid sinu serveris:",
    "config_dbaccess"=> "Allpool peaksid sisestama kontoandmed, mida kasutad andmebaasi juurdepääsuks.",

    "error_sitename_required" => "FMGet'i installimiseks on vajalik saidinimi.",
    "error_timezone_required" => "FMGet'i installimiseks on vajalik ajavöönd.",
    "error_fmusername_required" => "FMGet'i installimiseks on vajalik andmebaasi kasutajanimi.",
    "error_fmpassword_required" => "FMGet'i installimiseks on vajalik andmebaasi parool.",

    "error_dateformat_required" => "FMGet'i installimiseks on vajalik kuupäevavorming.",
    "error_fmgusername_required" => "FMGet'i installimiseks on vajalik administraatori kasutajanimi.",
    "error_fmgpassword_required" => "FMGet'i installimiseks on vajalik administraatori parool.",
    "error_email_required" => "FMGet'i installimiseks on vajalik e-posti aadress.",
    "error_fmdatabase_required" => "Andmebaasi pole valitud.",

    "error_dateformat_error" => "See kuupäevavorming pole kehtiv, palun kontrolli uuesti.",
    "error_timezone_error" => "See ajavöönd pole kehtiv, palun kontrolli uuesti.",
    "error_email_error" => "See e-posti aadress pole kehtiv, palun kontrolli uuesti.",

    "error_fmserver_invalid" => "FMGet ei suutnud seda FM serverit tuvastada, palun kontrolli serveri aadressi uuesti.",
    "error_fmserver_nodatabase" => "FM server tuvastati, aga selle kasutajanime/parooliga ei leitud ühtegi andmebaasi.",

    "fmserver_otherdatabase" => "Kui ülaltoodud loendist ei leia oma andmebaasi, võib see olla peidetud või andmete API ei ole selle jaoks lubatud, proovige sellele ühenduda, sisestades selle nime allolevale väljale.",
    "config_named_fmdatabase_label" => "Andmebaasi nimi",
    "config_named_fmdatabase_hint" => "Tõusõltuv - Andmebaasi nimi ilma .fmp12-ta.",

    "error_database_noaccess" => "FMGet ei saa selle kasutajanime / parooliga andmebaasi pääseda.",
    "fmcloud_notice" => "FileMaker Cloud'is majutatud andmebaaside puhul ei toeta see versioon Claris ID kontoga andmebaasi ühendamist, see valik saad saadaval varsti.",


    "welcome_title" => "Tere tulemast",
    "welcome_details" => "FMGet on installitud. Logi sisse administraatori armatuurlaua, et luua ja hallata oma lehti ja vorme.",
    "button_login" => "Logi sisse",

    "alert_username_colon" => "Andmebaasi kasutajanimi ei tohi sisaldada kooloni ( : ), kuna see põhjustab konflikti andmete API autentimisega.",
    "error_fmusername_colon" => "Andmebaasi kasutajanime ei tohi sisaldada kooloni.",

    "error_sqlite3" => "SQLite3 laiend pole sellel serveril lubatud.",
    "fail_sqlite3" => "Ei õnnestunud luua FMGet'i sisemise andmebaasi tabelit",
];