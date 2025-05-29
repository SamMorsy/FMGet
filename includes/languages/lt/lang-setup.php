<?php
return [
    "welcome" => "Sveiki atvykę į FMGet. Prieš pradėdami, jums reikės šių dalykų.",

    "req_ssl" => "Interneto svetainė su SSL įgalintas [https://]", 
    "req_php" => "PHP versija 7.3 arba naujesnė",
    "req_fms" => "FileMaker serverio versija 18 arba naujesnė (privalo būti įgalintas SSL)",
    "req_api" => "FM serverio nustatymai > Duomenų API turi būti įgalintas",
    "req_acc" => "[Pilnas prieiga] duomenų bazės paskyra ir turi turėti įgalintas papildytas teises fmrest",

    "back1" => "Pasirinkite kitą kalbą",

    "button_install" => "Įdiegti FMGet",

    "intro1" => "Reikia daugiau pagalbos konfigūruojant savo svetainę ir FileMaker serverį?",
    "intro2" => "Perskaitykite pagalbos straipsnį apie diegimą.",

    "error_ssl" => "SSL sertifikatas neaptiktas, paprastai jis pateikiamas jūsų viešintojo paslaugas teikiančios įmonės. Jei jis neaktyvus, turėsite susisiekti su jais, kad galėtumėte tęsti.",
    "back2" => "Bandykite dar kartą",

    "error_curl1" => "cURL neaktyvus šiame serveryje. Paprastai tai pateikiama jūsų viešintoju. Jei neaktyvuota, turėsite susisiekti su jais, kol galėsite tęsti.",
    "error_curl2" => "cURL funkcijos neteisingai veikia šiame serveryje. Paprastai tai pateikiama jūsų viešintoju. Turėsite susisiekti su jais, kad galėtumėte tęsti.",

    "config_details1" => "Jūsų svetainė paruošta! Jūs sėkmingai praėjote šią diegimo dalį. FMGet dabar yra pasirengęs prisijungti prie jūsų FileMaker serverio.",

    "config_important" => "Svarbu",
    "config_warning1" => "Nesidalinkite savo vartotojo vardu ir slaptažodžiu su niekuo, tai leidžia vartotojui visiškai valdyti FMGet programinę įrangą ir pasiekti prijungtas duomenų bazes.",

    "error_config" => "Klaida: Nepavyko sukurti fmg-config.php, patikrinkite savo interneto serverio konfigūracijas, prieš tęsdami.",

    "config_title" => "FMGet Konfigūracijos",
    "example" => "Pavyzdys",
    "try_again" => "Bandykite dar kartą",
    "continue" => "Tęsti",
    "config_fmserver_hint" => "Interneto adresas į jūsų FileMaker serverį, be www ar https:// priekyje ar pasvirus linijomis gale, IP adresai draudžiami, adresas turi būti viešas domenas.",
    "config_fmserver_label" => "FileMaker Serverio Adresas",
    "config_timezone_label"=> "Laiko skirtumas",
    "config_dateformat_label"=> "Datos formatas",
    "config_username_label"=> "FMGet Administratoriaus Vartotojo vardas",
    "config_username_hint" => "Vartotojo vardas gali turėti tik alfanumerius, pabraukimus, tarpu, taškus ir brūkšnius.",
    "config_password_label"=> "FMGet Administratoriaus Slaptažodis",
    "config_password_hint"=> "Jums prireiks šio slaptažodžio, kad galėtumėte valdyti FMGet, saugokite jį saugioje vietoje.",
    "config_email_label"=> "FMGet Administratoriaus El. pašto adresas",
    "config_email_hint"=> "Dvigubai peržiūrėkite savo el. pašto adresą prieš tęsdami.",

    "error_title" => "Klaida",
    "error_fmserver_error" => "Šis FM serverio adresas negalioja, prašome patikrinti dar kartą.",
    "error_fmserver_required" => "FM serverio adresas būtinas norint įdiegti FMGet.",
    "config_title2" => "Duomenų bazės konfigūracijos",
    "config_details2" => "Prašome pasirinkti savo duomenų bazę ir įvesti savo FMGet vartotojo vardą bei slaptažodį. Nenusiminkite, šiuos nustatymus visada galima pakeisti vėliau.",

    "config_sitename_label"=> "Svetainės pavadinimas",
    "config_fmusername_label"=> "Duomenų bazės vartotojo vardas",
    "config_fmpassword_label"=> "Duomenų bazės slaptažodis",

    "config_selectdb"=> "Prieinamos duomenų bazės jūsų serveryje:",
    "config_dbaccess"=> "Žemiau turėtumėte įvesti paskyros informaciją, kurią naudojate prisijungimui prie duomenų bazės.",

    "error_sitename_required" => "Norint įdiegti FMGet, būtinas svetainės pavadinimas.",
    "error_timezone_required" => "Norint įdiegti FMGet, būtinas laiko skirtumas.",
    "error_fmusername_required" => "Norint įdiegti FMGet, būtinas duomenų bazės vartotojo vardas.",
    "error_fmpassword_required" => "Norint įdiegti FMGet, būtinas duomenų bazės slaptažodis.",

    "error_dateformat_required" => "Norint įdiegti FMGet, būtinas datos formatas.",
    "error_fmgusername_required" => "Norint įdiegti FMGet, būtinas administratoriaus vartotojo vardas.",
    "error_fmgpassword_required" => "Norint įdiegti FMGet, būtinas administratoriaus slaptažodis.",
    "error_email_required" => "Norint įdiegti FMGet, būtinas el. pašto adresas.",
    "error_fmdatabase_required" => "Nepasirinkta jokia duomenų bazė.",

    "error_dateformat_error" => "Šis datos formatas negalioja, prašome patikrinti dar kartą.",
    "error_timezone_error" => "Šis laiko skirtumas negalioja, prašome patikrinti dar kartą.",
    "error_email_error" => "Šis el. pašto adresas negalioja, prašome patikrinti dar kartą.",

    "error_fmserver_invalid" => "FMGet nepavyko aptikti šio FM serverio, prašome dar kartą peržiūrėti serverio adresą.",
    "error_fmserver_nodatabase" => "FM serveris aptiktas, bet šiam vartotojo vardu / slaptažodžiu nerasta jokios duomenų bazės.",

    "fmserver_otherdatabase" => "Jeigu viršuje esančiame sąraše nerandate savo duomenų bazės, ji gali būti paslėpta arba duomenų API neleidžiama, bandykite prisijungti prie jos įvedę pavadinimą apačioje esančioje laukelio.",
    "config_named_fmdatabase_label" => "Duomenų bazės pavadinimas",
    "config_named_fmdatabase_hint" => "Raidžių dydžio jautrumas - Duomenų bazės pavadinimas be .fmp12.",

    "error_database_noaccess" => "FMGet negali pasiekti duomenų bazės naudojant šį vartotojo vardą / slaptažodį.",
    "fmcloud_notice" => "Duomenų bazėms, kurias valdo FileMaker Cloud, ši versija nepalaiko jungimosi prie duomenų bazės naudojant Claris ID paskyrą, ši parinktis bus netrukdyta.",


    "welcome_title" => "Sveiki",
    "welcome_details" => "FMGet buvo įdiegta. Prisijunkite prie administravimo skydelio, kad galėtumėte kurti ir tvarkyti savo puslapius ir formas.",
    "button_login" => "Prisijungti",

    "alert_username_colon" => "Duomenų bazės vartotojo vardas negali turėti dvitaškio ( : ), nes tai sukelia konfliktą su duomenų API autentifikacija.",
    "error_fmusername_colon" => "Duomenų bazės vartotojo vardas negali turėti dvitaškio.",

    "error_sqlite3" => "SQLite3 plėtinys neaktyvus šiame serveryje.",
    "fail_sqlite3" => "Nepavyko sukurti FMGet vidinės duomenų bazės lentelės",
];