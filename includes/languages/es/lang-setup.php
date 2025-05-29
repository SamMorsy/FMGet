<?php
return [
    "welcome" => "Bienvenido a FMGet. Antes de comenzar, necesitarás los siguientes elementos.",

    "req_ssl" => "Sitio web con SSL activado [https://]", 
    "req_php" => "Versión de PHP 7.3 o superior",
    "req_fms" => "Servidor FileMaker versión 18 o más reciente (debe tener SSL activado)",
    "req_api" => "Configuración del servidor FM > La API de datos debe estar activada",
    "req_acc" => "Cuenta de base de datos [Acceso completo] y debe tener habilitado el privilegio extendido fmrest",

    "back1" => "Selecciona otro idioma",

    "button_install" => "Instalar FMGet",

    "intro1" => "¿Necesitas más ayuda para configurar tu sitio web y servidor FileMaker?",
    "intro2" => "Lee el artículo de soporte sobre la configuración.",

    "error_ssl" => "No se detectó un certificado SSL, normalmente te lo proporciona tu proveedor web. Si no lo tienes activado, deberás contactarlos antes de continuar.",
    "back2" => "Inténtalo de nuevo",

    "error_curl1" => "cURL no está habilitado en este servidor. Normalmente te lo proporciona tu proveedor web. Si no lo tienes activado, deberás contactarlos antes de continuar.",
    "error_curl2" => "Las funciones de cURL no están funcionando correctamente en este servidor. Normalmente te lo proporciona tu proveedor web. Deberás contactarlos antes de continuar.",

    "config_details1" => "¡Tu sitio web está listo! Has completado esta parte de la instalación. FMGet ya está preparado para conectarse a tu servidor FileMaker.",

    "config_important" => "Importante",
    "config_warning1" => "No compartas tu nombre de usuario ni contraseña con nadie, esto permite al usuario controlar completamente la aplicación FMGet y acceder a las bases de datos conectadas.",

    "error_config" => "Error: No se pudo crear fmg-config.php, revisa la configuración de tu servidor web antes de continuar.",

    "config_title" => "Configuraciones de FMGet",
    "example" => "Ejemplo",
    "try_again" => "Inténtalo de nuevo",
    "continue" => "Continuar",
    "config_fmserver_hint" => "La dirección web de tu servidor FileMaker, sin www o https:// al inicio ni barras diagonales al final, no se permiten direcciones IP, la dirección debe ser un dominio público.",
    "config_fmserver_label" => "Dirección del Servidor FileMaker",
    "config_timezone_label"=> "Zona horaria",
    "config_dateformat_label"=> "Formato de fecha",
    "config_username_label"=> "Nombre de administrador de FMGet",
    "config_username_hint" => "El nombre de usuario solo puede contener caracteres alfanuméricos, guiones bajos, espacios, puntos y guiones.",
    "config_password_label"=> "Contraseña de administrador de FMGet",
    "config_password_hint"=> "Necesitarás esta contraseña para gestionar FMGet, guárdala en un lugar seguro.",
    "config_email_label"=> "Dirección de correo electrónico del administrador de FMGet",
    "config_email_hint"=> "Verifica tu dirección de correo electrónico antes de continuar.",

    "error_title" => "Error",
    "error_fmserver_error" => "Esta dirección del servidor FM no es válida, por favor verifica de nuevo.",
    "error_fmserver_required" => "La dirección del servidor FM es necesaria para instalar FMGet.",
    "config_title2" => "Configuraciones de la base de datos",
    "config_details2" => "Por favor selecciona tu base de datos e introduce tu nombre de usuario y contraseña de FMGet. No te preocupes, siempre podrás cambiar estos ajustustes más tarde.",

    "config_sitename_label"=> "Nombre del sitio",
    "config_fmusername_label"=> "Nombre de usuario de la base de datos",
    "config_fmpassword_label"=> "Contraseña de la base de datos",

    "config_selectdb"=> "Bases de datos disponibles en tu servidor:",
    "config_dbaccess"=> "Deberás introducir los detalles de la cuenta que usas para acceder a la base de datos.",

    "error_sitename_required" => "El nombre del sitio es necesario para instalar FMGet.",
    "error_timezone_required" => "La zona horaria es necesaria para instalar FMGet.",
    "error_fmusername_required" => "El nombre de usuario de la base de datos es necesario para instalar FMGet.",
    "error_fmpassword_required" => "La contraseña de la base de datos es necesaria para instalar FMGet.",

    "error_dateformat_required" => "El formato de fecha es necesario para instalar FMGet.",
    "error_fmgusername_required" => "El nombre de usuario del administrador es necesario para instalar FMGet.",
    "error_fmgpassword_required" => "La contraseña del administrador es necesaria para instalar FMGet.",
    "error_email_required" => "La dirección de correo electrónico es necesaria para instalar FMGet.",
    "error_fmdatabase_required" => "No se seleccionó ninguna base de datos.",

    "error_dateformat_error" => "Este formato de fecha no es válido, por favor verifica de nuevo.",
    "error_timezone_error" => "Esta zona horaria no es válida, por favor verifica de nuevo.",
    "error_email_error" => "Esta dirección de correo electrónico no es válida, por favor verifica de nuevo.",

    "error_fmserver_invalid" => "FMGet no pudo detectar este servidor FM, por favor verifica la dirección del servidor.",
    "error_fmserver_nodatabase" => "Se detectó el servidor FM, pero no se encontró ninguna base de datos para este nombre de usuario/contraseña.",

    "fmserver_otherdatabase" => "Si no puedes encontrar tu base de datos en la lista anterior, puede que esté oculta o que la API de datos no esté activada para ella, puedes intentar conectarte ingresando su nombre en el campo inferior.",
    "config_named_fmdatabase_label" => "Nombre de la base de datos",
    "config_named_fmdatabase_hint" => "Sensible a mayúsculas/minúsculas - El nombre de la base de datos sin .fmp12.",

    "error_database_noaccess" => "FMGet no puede acceder a la base de datos usando este nombre de usuario / contraseña.",
    "fmcloud_notice" => "Para bases de datos alojadas en FileMaker Cloud, esta versión no admite la conexión mediante una cuenta Claris ID. Esta opción estará disponible pronto.",


    "welcome_title" => "Bienvenido",
    "welcome_details" => "FMGet ha sido instalado. Inicia sesión en el panel de administración para crear y gestionar tus páginas y formularios.",
    "button_login" => "Iniciar sesión",

    "alert_username_colon" => "El nombre de usuario de la base de datos no puede contener dos puntos ( : ) porque causa un conflicto con la autenticación de la API de datos.",
    "error_fmusername_colon" => "El nombre de usuario de la base de datos no debe incluir dos puntos.",

    "error_sqlite3" => "La extensión SQLite3 no está habilitada en este servidor.",
    "fail_sqlite3" => "Fallo al crear la tabla interna de la base de datos de FMGet",
];