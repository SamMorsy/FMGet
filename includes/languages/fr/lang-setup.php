<?php
return [
    "welcome" => "Bienvenue sur FMGet. Avant de commencer, vous aurez besoin des éléments suivants.",

    "req_ssl" => "Site web avec SSL activé [https://]", 
    "req_php" => "Version PHP 7.3 ou supérieure",
    "req_fms" => "Serveur FileMaker version 18 ou plus récent (le SSL doit être activé)",
    "req_api" => "Paramètres du serveur FM > L'API de données doit être activée",
    "req_acc" => "Compte base de données [Accès complet] et les privilèges étendus fmrest doivent être activés",

    "back1" => "Sélectionnez une autre langue",

    "button_install" => "Installer FMGet",

    "intro1" => "Besoin d'aide pour configurer votre site web et votre serveur FileMaker ?",
    "intro2" => "Lisez l'article d'assistance sur la configuration.",

    "error_ssl" => "Aucun certificat SSL détecté, celui-ci vous est généralement fourni par votre hébergeur web. Si vous ne l'avez pas activé, vous devrez le contacter avant de pouvoir continuer.",
    "back2" => "Réessayer",

    "error_curl1" => "cURL n'est pas activé sur ce serveur. Généralement, cela vous est fourni par votre hébergeur web. Si vous ne l'avez pas activé, vous devrez le contacter avant de pouvoir continuer.",
    "error_curl2" => "Les fonctions cURL ne fonctionnent pas correctement sur ce serveur. Généralement, cela vous est fourni par votre hébergeur web. Vous devrez le contacter avant de pouvoir continuer.",

    "config_details1" => "Votre site web est prêt ! Vous avez réussi cette partie de l'installation. FMGet est maintenant prêt à être connecté à votre serveur FileMaker.",

    "config_important" => "Important",
    "config_warning1" => "Ne partagez pas votre nom d'utilisateur et votre mot de passe avec qui que ce soit, cela permettrait à l'utilisateur de contrôler entièrement l'application FMGet et d'accéder aux bases de données connectées.",

    "error_config" => "Erreur : Impossible de créer fmg-config.php, veuillez vérifier vos configurations du serveur web avant de pouvoir continuer.",

    "config_title" => "Configurations FMGet",
    "example" => "Exemple",
    "try_again" => "Réessayer",
    "continue" => "Continuer",
    "config_fmserver_hint" => "L'adresse web de votre serveur FileMaker, sans www ou https:// en début ou slash final, les adresses IP ne sont pas autorisées, l'adresse doit être un domaine public.",
    "config_fmserver_label" => "Adresse du serveur FileMaker",
    "config_timezone_label"=> "Fuseau horaire",
    "config_dateformat_label"=> "Format de date",
    "config_username_label"=> "Nom d'utilisateur administrateur FMGet",
    "config_username_hint" => "Le nom d'utilisateur peut uniquement contenir des caractères alphanumériques, des tirets bas, des espaces, des points et des traits d'union.",
    "config_password_label"=> "Mot de passe administrateur FMGet",
    "config_password_hint"=> "Vous aurez besoin de ce mot de passe pour gérer FMGet, veuillez le stocker dans un endroit sécurisé.",
    "config_email_label"=> "Adresse e-mail de l'administrateur FMGet",
    "config_email_hint"=> "Vérifiez attentivement votre adresse e-mail avant de continuer.",

    "error_title" => "Erreur",
    "error_fmserver_error" => "Cette adresse de serveur FM n'est pas valide, veuillez vérifier à nouveau.",
    "error_fmserver_required" => "L'adresse du serveur FM est requise pour installer FMGet.",
    "config_title2" => "Configurations de la base de données",
    "config_details2" => "Veuillez sélectionner votre base de données et entrer votre nom d'utilisateur et mot de passe FMGet. Pas d'inquiétude, vous pourrez toujours modifier ces paramètres ultérieurement.",

    "config_sitename_label"=> "Nom du site",
    "config_fmusername_label"=> "Nom d'utilisateur de la base de données",
    "config_fmpassword_label"=> "Mot de passe de la base de données",

    "config_selectdb"=> "Bases de données disponibles sur votre serveur :",
    "config_dbaccess"=> "Vous devez ci-dessous saisir les détails du compte que vous utilisez pour accéder à la base de données.",

    "error_sitename_required" => "Le nom du site est requis pour installer FMGet.",
    "error_timezone_required" => "Le fuseau horaire est requis pour installer FMGet.",
    "error_fmusername_required" => "Le nom d'utilisateur de la base de données est requis pour installer FMGet.",
    "error_fmpassword_required" => "Le mot de passe de la base de données est requis pour installer FMGet.",

    "error_dateformat_required" => "Le format de date est requis pour installer FMGet.",
    "error_fmgusername_required" => "Le nom d'utilisateur administrateur est requis pour installer FMGet.",
    "error_fmgpassword_required" => "Le mot de passe administrateur est requis pour installer FMGet.",
    "error_email_required" => "L'adresse e-mail est requise pour installer FMGet.",
    "error_fmdatabase_required" => "Aucune base de données sélectionnée.",

    "error_dateformat_error" => "Ce format de date n'est pas valide, veuillez vérifier à nouveau.",
    "error_timezone_error" => "Ce fuseau horaire n'est pas valide, veuillez vérifier à nouveau.",
    "error_email_error" => "Cette adresse e-mail n'est pas valide, veuillez vérifier à nouveau.",

    "error_fmserver_invalid" => "FMGet n'a pas pu détecter ce serveur FM, veuillez vérifier à nouveau l'adresse du serveur.",
    "error_fmserver_nodatabase" => "Le serveur FM a été détecté, mais aucune base de données n'a été trouvée pour ce couple nom d'utilisateur/mot de passe.",

    "fmserver_otherdatabase" => "Si vous ne trouvez pas votre base de données dans la liste ci-dessus, elle a peut-être été masquée ou l'API de données n'est pas activée pour celle-ci, vous pouvez essayer d'établir une connexion en saisissant son nom dans le champ ci-dessous.",
    "config_named_fmdatabase_label" => "Nom de la base de données",
    "config_named_fmdatabase_hint" => "Respecte la casse - Le nom de la base de données sans .fmp12.",

    "error_database_noaccess" => "FMGet ne peut pas accéder à la base de données avec ce nom d'utilisateur / mot de passe.",
    "fmcloud_notice" => "Pour les bases de données hébergées par FileMaker Cloud, cette version ne prend pas en charge la connexion à une base de données via un compte Claris ID, cette option sera bientôt disponible.",


    "welcome_title" => "Bienvenue",
    "welcome_details" => "FMGet a été installé. Connectez-vous au tableau de bord administrateur pour créer et gérer vos pages et formulaires.",
    "button_login" => "Se connecter",

    "alert_username_colon" => "Le nom d'utilisateur de la base de données ne peut pas contenir deux-points ( : ) car cela provoque un conflit avec l'authentification de l'API de données.",
    "error_fmusername_colon" => "Le nom d'utilisateur de la base de données ne doit pas inclure de deux-points.",
    "error_sqlite3" => "L'extension SQLite3 n'est pas activée sur ce serveur.",

    "fail_sqlite3" => "Échec de création de la table interne de la base de données FMGet",
];