<?php
return [
    "welcome" => "Velkomin(n) í FMGet. Áður en þú byrjar þarftu eftirfarandi hluti.",

    "req_ssl" => "Vefsvæði með SSL virkt [https://]", 
    "req_php" => "PHP útgáfa 7.3 eða nýrri",
    "req_fms" => "FileMaker netþjónustan útgáfu 18 eða nýrri (SSL verður að vera virkt)",
    "req_api" => "Stillingar á FM netþjónustu > Data API verður að vera virkt",
    "req_acc" => "[Fullt aðgangur] gagnagrunnur og verður að hafa virkan fmrest viðbótarheimildum",

    "back1" => "Veldu annan tungumál",

    "button_install" => "Settu upp FMGet",

    "intro1" => "Þarfnast þú frekari hjálpar til að stilla vefsvæðið og FileMaker netþjónustuna?",
    "intro2" => "Lestu stuðningsgreinina um uppsetningu.",

    "error_ssl" => "SSL vottun fannst ekki, venjulega er hún veitt af vefþjóninum þínum. Ef hún er ekki virk þá verður þú að hafða samband við þá áður en þú getur haldið áfram.",
    "back2" => "Reyndu aftur",

    "error_curl1" => "cURL er ekki virkt á þessum netþjóni. Venjulega er hún veitt af vefþjóninum þínum. Ef hún er ekki virk þá verður þú að hafða samband við þá áður en þú getur haldið áfram.",
    "error_curl2" => "cURL fall eru ekki í réttu lagi á þessum netþjóni. Venjulega er hún veitt af vefþjóninum þínum. Þú verður að hafða samband við þá áður en þú getur haldið áfram.",

    "config_details1" => "Vefsvæðið þitt er tilbúið! Þú hefur komist í gegnum þessa hluta af uppsetningunni. FMGet er nú tilbúið til að tengjast FileMaker netþjónustunni þinni.",

    "config_important" => "Ágætlegt",
    "config_warning1" => "Deildu ekki notandanafni og lykilorði við neinn, þetta gerir notanda kleift að stjórna FMGet forritinu alveg og fá aðgang að tengdum gagnagrunnum.",

    "error_config" => "Villa: Gat ekki búið til fmg-config.php, athugaðu stillingar á vefnetþjóninum þínum áður en þú heldur áfram.",

    "config_title" => "FMGet Stillingar",
    "example" => "Dæmi",
    "try_again" => "Reynið aftur",
    "continue" => "Haltu áfram",
    "config_fmserver_hint" => "Vefslóðin til FileMaker netþjónustunnar þinnar, án www eða https:// fremst eða skástrik aftast, IP heimilisföng eru ekki leyfð, slóðin verður að vera opinber lén.",
    "config_fmserver_label" => "FileMaker Netþjónusta Slóð",
    "config_timezone_label"=> "Tímabelti",
    "config_dateformat_label"=> "Dagsetningar snið",
    "config_username_label"=> "FMGet Kerfisstjóri Notandanafn",
    "config_username_hint" => "Notandanafn má aðeins innihalda bókstafi, tölur, undirstikanleg, bil, punkta og bandstrik.",
    "config_password_label"=> "FMGet Kerfisstjóri Lykilorð",
    "config_password_hint"=> "Þú munt þurfa þetta lykilorð til að stjórna FMGet, vistaðu það á öruggan stað.",
    "config_email_label"=> "FMGet Kerfisstjóri Netfang",
    "config_email_hint"=> "Yfirfarðu netfangið þitt áður en þú heldur áfram.",

    "error_title" => "Villa",
    "error_fmserver_error" => "Þessi FM netþjónusta slóð er ógild, athugaðu aftur.",
    "error_fmserver_required" => "FM netþjónusta slóð er nauðsynleg til að setja upp FMGet.",
    "config_title2" => "Gagnagrunnstillingar",
    "config_details2" => "Vinsamlegast veldu gagnagrunninn þinn og sláðu inn notandanafn og lykilorð FMGet. Vertu ekki óttur, þú getur alltaf breytt þessum stillingum síðar.",

    "config_sitename_label"=> "Heiti vefsvæðis",
    "config_fmusername_label"=> "Gagnagrunnur Notandanafn",
    "config_fmpassword_label"=> "Gagnagrunnur Lykilorð",

    "config_selectdb"=> "Tiltækir gagnagrunnar á netþjóninum þínum:",
    "config_dbaccess"=> "Hér fyrir neðan ættirðu að slá inn upplýsingarnar um reikninginn sem þú notar til að fá aðgang að gagnagrunninum.",

    "error_sitename_required" => "Heiti vefsvæðis er krafist til að setja upp FMGet.",
    "error_timezone_required" => "Tímabelti er krafist til að setja upp FMGet.",
    "error_fmusername_required" => "Notandanafn á gagnagrunni er krafist til að setja upp FMGet.",
    "error_fmpassword_required" => "Lykilorð á gagnagrunni er krafist til að setja upp FMGet.",

    "error_dateformat_required" => "Dagsetningarsnið er krafist til að setja upp FMGet.",
    "error_fmgusername_required" => "Notandanafn kerfisstjóra er krafist til að setja upp FMGet.",
    "error_fmgpassword_required" => "Lykilorð kerfisstjóra er krafist til að setja upp FMGet.",
    "error_email_required" => "Netfang er krafist til að setja upp FMGet.",
    "error_fmdatabase_required" => "Enginn gagnagrunnur var valinn.",

    "error_dateformat_error" => "Þetta dagsetningarsnið er ekki gilt, athugaðu aftur.",
    "error_timezone_error" => "Þetta tímabelti er ekki gilt, athugaðu aftur.",
    "error_email_error" => "Þetta netfang er ekki gilt, athugaðu aftur.",

    "error_fmserver_invalid" => "FMGet gat ekki fundið þennan FM netþjón, athugaðu netþjónslóðina aftur.",
    "error_fmserver_nodatabase" => "FM netþjóninn fannst, en enginn gagnagrunnur fannst fyrir þetta notandanafn/lykilorð.",

    "fmserver_otherdatabase" => "Ef þú finnur ekki gagnagrunninn þinn á listanum hér fyrir ofan, gæti hann verið faliður eða data API ekki virkt fyrir hann, þú getur reynt að tengjast honum með því að slá inn nafnið hans í svæðinu fyrir neðan.",
    "config_named_fmdatabase_label" => "Gagnagrunnur Nafn",
    "config_named_fmdatabase_hint" => "Er há- og lágstafaaðgreining - Gagnagrunnsnafn án .fmp12.",

    "error_database_noaccess" => "FMGet getur ekki fengið aðgang að gagnagrunninum með þetta notandanafn / lykilorð.",
    "fmcloud_notice" => "Fyrir gagnagrunna sem eru á vefþjónustu hjá FileMaker Cloud, styður ekki þessi útgáfa að tengjast gagnagrunni með Claris ID reikningi, þessi möguleiki verður fljótlega aðgengilegur.",


    "welcome_title" => "Velkomin(n)",
    "welcome_details" => "FMGet hefur verið sett upp. Skráðu þig inn á stjórnborð kerfisstjórans til að búa til og stjórna síðum og eyðublöðum þínum.",
    "button_login" => "Innskrá",

    "alert_username_colon" => "Notandanafn gagnagrunnsins getur ekki haft tvopunkt ( : ) vegna þess að það valdið mótsögn við auðkenningu á data API.",
    "error_fmusername_colon" => "Notandanafn gagnagrunnsins má ekki innihalda tvopunkts.",

    "error_sqlite3" => "SQLite3 viðbót er ekki virk á þessum netþjóni.",
    "fail_sqlite3" => "Mistókst að búa til FMGet innri gagnatafla",
];