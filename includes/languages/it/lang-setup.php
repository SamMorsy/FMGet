<?php
return [
    "welcome" => "Benvenuto in FMGet. Prima di iniziare, avrai bisogno dei seguenti elementi.",

    "req_ssl" => "Sito web con SSL abilitato [https://]", 
    "req_php" => "Versione PHP 7.3 o superiore",
    "req_fms" => "Server FileMaker versione 18 o più recente (deve avere SSL abilitato)",
    "req_api" => "Impostazioni del server FM > L'API dati deve essere abilitata",
    "req_acc" => "Account database [Accesso completo] e deve avere i privilegi estesi fmrest abilitati",

    "back1" => "Seleziona un'altra lingua",

    "button_install" => "Installa FMGet",

    "intro1" => "Hai bisogno di ulteriore aiuto per configurare il tuo sito web e il server FileMaker?",
    "intro2" => "Leggi l'articolo di supporto sull'installazione.",

    "error_ssl" => "Nessun certificato SSL rilevato, normalmente ti viene fornito dal tuo provider web. Se non è attivo, dovrai contattarli prima di poter continuare.",
    "back2" => "Riprova",

    "error_curl1" => "cURL non è abilitato su questo server. Normalmente ti viene fornito dal tuo provider web. Se non è attivo, dovrai contattarli prima di poter continuare.",
    "error_curl2" => "Le funzioni cURL non stanno funzionando correttamente su questo server. Normalmente ti viene fornito dal tuo provider web. Dovrai contattarli prima di poter continuare.",

    "config_details1" => "Il tuo sito web è pronto! Hai completato questa parte dell'installazione. FMGet è ora pronto per essere collegato al tuo server FileMaker.",

    "config_important" => "Importante",
    "config_warning1" => "Non condividere mai il tuo nome utente e la tua password con nessuno. Questo permette all'utente di controllare completamente l'applicazione FMGet e accedere ai database connessi.",

    "error_config" => "Errore: Impossibile creare fmg-config.php, verifica le impostazioni del server web prima di continuare.",

    "config_title" => "Configurazioni FMGet",
    "example" => "Esempio",
    "try_again" => "Riprova",
    "continue" => "Continua",
    "config_fmserver_hint" => "L'indirizzo web del tuo server FileMaker, senza www o https:// iniziali né barre finali, gli indirizzi IP non sono consentiti, l'indirizzo deve essere un dominio pubblico.",
    "config_fmserver_label" => "Indirizzo Server FileMaker",
    "config_timezone_label"=> "Fuso Orario",
    "config_dateformat_label"=> "Formato Data",
    "config_username_label"=> "Nome Utente Amministratore FMGet",
    "config_username_hint" => "Il nome utente può contenere solo caratteri alfanumerici, trattini bassi, spazi, punti e trattini.",
    "config_password_label"=> "Password Amministratore FMGet",
    "config_password_hint"=> "Avrai bisogno di questa password per gestire FMGet, conservala in un luogo sicuro.",
    "config_email_label"=> "Indirizzo Email Amministratore FMGet",
    "config_email_hint"=> "Verifica attentamente il tuo indirizzo email prima di continuare.",

    "error_title" => "Errore",
    "error_fmserver_error" => "Questo indirizzo del server FM non è valido, riprova.",
    "error_fmserver_required" => "L'indirizzo del server FM è richiesto per installare FMGet.",
    "config_title2" => "Configurazioni Database",
    "config_details2" => "Per favore seleziona il tuo database e inserisci il tuo nome utente e password di FMGet. Non preoccuparti, potrai sempre modificare queste impostazioni in seguito.",

    "config_sitename_label"=> "Nome Sito",
    "config_fmusername_label"=> "Nome Utente Database",
    "config_fmpassword_label"=> "Password Database",

    "config_selectdb"=> "Database disponibili sul tuo server:",
    "config_dbaccess"=> "Di seguito devi inserire i dettagli dell'account che utilizzi per accedere al database.",

    "error_sitename_required" => "Il nome del sito è richiesto per installare FMGet.",
    "error_timezone_required" => "Il fuso orario è richiesto per installare FMGet.",
    "error_fmusername_required" => "Il nome utente del database è richiesto per installare FMGet.",
    "error_fmpassword_required" => "La password del database è richiesta per installare FMGet.",

    "error_dateformat_required" => "Il formato della data è richiesto per installare FMGet.",
    "error_fmgusername_required" => "Il nome utente dell'amministratore è richiesto per installare FMGet.",
    "error_fmgpassword_required" => "La password dell'amministratore è richiesta per installare FMGet.",
    "error_email_required" => "L'indirizzo email è richiesto per installare FMGet.",
    "error_fmdatabase_required" => "Nessun database selezionato.",

    "error_dateformat_error" => "Questo formato della data non è valido, riprova.",
    "error_timezone_error" => "Questo fuso orario non è valido, riprova.",
    "error_email_error" => "Questo indirizzo email non è valido, riprova.",

    "error_fmserver_invalid" => "FMGet non è riuscito a rilevare questo server FM, per favore verifica nuovamente l'indirizzo del server.",
    "error_fmserver_nodatabase" => "Il server FM è stato rilevato, ma non è stato trovato alcun database per questo nome utente/password.",

    "fmserver_otherdatabase" => "Se non trovi il tuo database nell'elenco sopra, potrebbe essere nascosto oppure l'API dati non è abilitata per esso, puoi provare a connetterti immettendone il nome nel campo qui sotto.",
    "config_named_fmdatabase_label" => "Nome Database",
    "config_named_fmdatabase_hint" => "Distingue maiuscole/minuscole - Il nome del database senza .fmp12.",

    "error_database_noaccess" => "FMGet non riesce ad accedere al database utilizzando questo nome utente / password.",
    "fmcloud_notice" => "Per i database ospitati da FileMaker Cloud, questa versione non supporta la connessione tramite account Claris ID, questa opzione sarà disponibile presto.",


    "welcome_title" => "Benvenuto",
    "welcome_details" => "FMGet è stato installato. Accedi alla dashboard amministrativa per creare e gestire le tue pagine e form.",
    "button_login" => "Accedi",

    "alert_username_colon" => "Il nome utente del database non può contenere due punti ( : ) perché causa un conflitto con l'autenticazione dell'API dati.",
    "error_fmusername_colon" => "Il nome utente del database non deve includere due punti.",

    "error_sqlite3" => "L'estensione SQLite3 non è abilitata su questo server.",
    "fail_sqlite3" => "Impossibile creare la tabella interna del database FMGet",
];