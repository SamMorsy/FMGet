<?php
return [
    "welcome" => "Willkommen bei FMGet. Bevor Sie loslegen, benötigen Sie die folgenden Dinge.",
   
   "req_ssl" => "Website mit aktivierter SSL-Verschlüsselung [https://]", 
    "req_php" => "PHP-Version 7.3 oder höher",
    "req_fms" => "FileMaker-Server Version 18 oder neuer (SSL muss aktiviert sein)",
    "req_api" => "FM-Server-Einstellungen > Data API muss aktiviert sein",
    "req_acc" => "[Vollzugriff]-Datenbankkonto und das fmrest erweiterte Recht muss aktiviert sein",
  
  "back1" => "Wählen Sie eine andere Sprache",

    "button_install" => "FMGet installieren",

    "intro1" => "Brauchen Sie weitere Hilfe bei der Einrichtung Ihrer Website und des FileMaker-Servers?",
    "intro2" => "Lesen Sie den Support-Artikel zur Installation.",

    "error_ssl" => "Kein SSL-Zertifikat gefunden. Normalerweise stellt Ihr Webhoster dies bereit. Wenn es nicht aktiviert ist, müssen Sie sich an Ihren Host kontaktieren, bevor Sie fortfahren können.",
    "back2" => "Erneut versuchen",

    "error_curl1" => "cURL ist auf diesem Server nicht aktiviert. Normalerweise stellt Ihr Webhoster dies bereit. Wenn es nicht aktiviert ist, müssen Sie sich an Ihren Host kontaktieren, bevor Sie fortfahren können.",
    "error_curl2" => "cURL-Funktionen funktionieren auf diesem Server nicht korrekt. Normalerweise stellt Ihr Webhoster dies bereit. Sie müssen sich an Ihren Host wenden, bevor Sie fortfahren können.",

    "config_details1" => "Ihre Website ist bereit! Sie haben diesen Teil der Installation erfolgreich abgeschlossen. FMGet ist nun bereit, mit Ihrem FileMaker-Server verbunden zu werden.",

    "config_important" => "Wichtig",
    "config_warning1" => "Teilen Sie Ihren Benutzernamen und Ihr Passwort mit niemandem. Dies ermöglicht dem Benutzer, die FMGet-Anwendung vollständig zu steuern und auf die verbundenen Datenbanken zuzugreifen.",

    "error_config" => "Fehler: fmg-config.php konnte nicht erstellt werden. Prüfen Sie Ihre Server-Konfiguration, bevor Sie fortfahren können.",

    "config_title" => "FMGet Konfigurationen",
    "example" => "Beispiel",
    "try_again" => "Erneut versuchen",
    "continue" => "Weiter",
    "config_fmserver_hint" => "Die Webadresse für Ihren FileMaker-Server. Ohne vorangestelltes www oder https:// oder abschließende Schrägstriche. IP-Adressen sind nicht erlaubt. Die Adresse muss eine öffentliche Domain sein.",
    "config_fmserver_label" => "FileMaker Serveradresse",
    "config_timezone_label"=> "Zeitzone",
    "config_dateformat_label"=> "Datumsformat",
    "config_username_label"=> "FMGet Admin-Benutzername",
    "config_username_hint" => "Benutzername darf nur alphanumerische Zeichen, Unterstriche, Leerzeichen, Punkte und Bindestriche enthalten.",
    "config_password_label"=> "FMGet Admin-Passwort",
    "config_password_hint"=> "Sie benötigen dieses Passwort, um Ihr FMGet zu verwalten. Bewahren Sie es an einem sicheren Ort auf.",
    "config_email_label"=> "FMGet Admin-E-Mail-Adresse",
    "config_email_hint"=> "Überprüfen Sie Ihre E-Mail-Adresse, bevor Sie fortfahren.",
   
   "error_title" => "Fehler",
    "error_fmserver_error" => "Diese FM-Serveradresse ist ungültig. Bitte überprüfen Sie sie erneut.",
    "error_fmserver_required" => "Die FM-Serveradresse ist erforderlich, um FMGet zu installieren.",
    "config_title2" => "Datenbankkonfigurationen",
    "config_details2" => "Bitte wählen Sie Ihre Datenbank aus und geben Sie Ihren FMGet-Benutzernamen und -Passwort ein. Keine Sorge, diese Einstellungen können später geändert werden.",

    "config_sitename_label"=> "Seitenname",
    "config_fmusername_label"=> "Datenbankbenutzername",
    "config_fmpassword_label"=> "Datenbankpasswort",

    "config_selectdb"=> "Verfügbare Datenbanken auf Ihrem Server:",
    "config_dbaccess"=> "Geben Sie unten die Details des Kontos ein, das Sie zum Zugriff auf die Datenbank verwenden.",

    "error_sitename_required" => "Der Seitenname ist erforderlich, um FMGet zu installieren.",
    "error_timezone_required" => "Die Zeitzone ist erforderlich, um FMGet zu installieren.",
    "error_fmusername_required" => "Der Datenbankbenutzername ist erforderlich, um FMGet zu installieren.",
    "error_fmpassword_required" => "Das Datenbankpasswort ist erforderlich, um FMGet zu installieren.",

    "error_dateformat_required" => "Das Datumsformat ist erforderlich, um FMGet zu installieren.",
    "error_fmgusername_required" => "Der Admin-Benutzername ist erforderlich, um FMGet zu installieren.",
    "error_fmgpassword_required" => "Das Admin-Passwort ist erforderlich, um FMGet zu installieren.",
    "error_email_required" => "Die E-Mail-Adresse ist erforderlich, um FMGet zu installieren.",
    "error_fmdatabase_required" => "Keine Datenbank ausgewählt.",

    "error_dateformat_error" => "Dieses Datumsformat ist ungültig. Bitte überprüfen Sie es erneut.",
    "error_timezone_error" => "Diese Zeitzone ist ungültig. Bitte überprüfen Sie sie erneut.",
    "error_email_error" => "Diese E-Mail-Adresse ist ungültig. Bitte überprüfen Sie sie erneut.",

    "error_fmserver_invalid" => "FMGet konnte diesen FM-Server nicht erkennen. Bitte prüfen Sie die Serveradresse erneut.",
    "error_fmserver_nodatabase" => "Der FM-Server wurde erkannt, aber keine Datenbank für diesen Benutzernamen/Passwort gefunden.",

    "fmserver_otherdatabase" => "Wenn Sie Ihre Datenbank in der obigen Liste nicht finden können, könnte sie ausgeblendet worden sein oder die Data API ist nicht aktiviert. Sie können versuchen, eine Verbindung herzustellen, indem Sie den Namen unten eingeben.",
    "config_named_fmdatabase_label" => "Datenbankname",
    "config_named_fmdatabase_hint" => "Groß-/Kleinschreibung beachten – Der Datenbankname ohne .fmp12.",

    "error_database_noaccess" => "FMGet kann nicht auf die Datenbank mit diesem Benutzernamen / Passwort zugreifen.",
    "fmcloud_notice" => "Für Datenbanken, die von FileMaker Cloud gehostet werden, wird die Verbindung über ein Claris-ID-Konto in dieser Version noch nicht unterstützt. Diese Option wird bald verfügbar sein.",


    "welcome_title" => "Willkommen",
    "welcome_details" => "FMGet wurde installiert. Melden Sie sich am Admin-Dashboard an, um Seiten und Formulare zu erstellen und zu verwalten.",
    "button_login" => "Anmelden",

    "alert_username_colon" => "Der Datenbankbenutzername darf keinen Doppelpunkt ( : ) enthalten, da dies einen Konflikt mit der Data API Authentifizierung verursacht.",
    "error_fmusername_colon" => "Der Datenbankbenutzername darf keinen Doppelpunkt enthalten.",

    "error_sqlite3" => "SQLite3-Erweiterung ist auf diesem Server nicht aktiviert.",
    "fail_sqlite3" => "Fehler beim Erstellen der FMGet internen Datenbanktabelle",
];