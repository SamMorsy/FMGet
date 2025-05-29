<?php
return [
    "welcome" => "Bem-vindo ao FMGet. Antes de começar, você precisará dos seguintes itens.",

    "req_ssl" => "Site com SSL ativado [https://]", 
    "req_php" => "Versão do PHP 7.3 ou superior",
    "req_fms" => "Servidor FileMaker versão 18 ou mais recente (SSL deve estar ativado)",
    "req_api" => "Configurações do servidor FM > A API de dados deve estar ativada",
    "req_acc" => "Conta de banco de dados [Acesso completo] e deve ter os privilégios estendidos fmrest ativados",

    "back1" => "Selecione outro idioma",

    "button_install" => "Instalar o FMGet",

    "intro1" => "Precisa de mais ajuda para configurar seu site e servidor FileMaker?",
    "intro2" => "Leia o artigo de suporte sobre a configuração.",

    "error_ssl" => "Certificado SSL não foi detectado, normalmente é fornecido pelo seu provedor web. Se você não tiver isso ativado, deverá contatar antes de continuar.",
    "back2" => "Tentar novamente",

    "error_curl1" => "O cURL não está ativado neste servidor. Normalmente é fornecido pelo seu provedor web. Se você não tiver isso ativado, deverá contatar antes de continuar.",
    "error_curl2" => "As funções do cURL não estão funcionando corretamente neste servidor. Normalmente é fornecido pelo seu provedor web. Você deverá contatar antes de continuar.",

    "config_details1" => "Seu site está pronto! Você concluiu esta parte da instalação. O FMGet agora está pronto para ser conectado ao seu servidor FileMaker.",

    "config_important" => "Importante",
    "config_warning1" => "Não compartilhe seu nome de usuário e senha com ninguém, isso permite ao usuário controlar totalmente o aplicativo FMGet e acessar os bancos de dados conectados.",

    "error_config" => "Erro: Não foi possível criar o fmg-config.php, verifique as configurações do seu servidor web antes de continuar.",

    "config_title" => "Configurações do FMGet",
    "example" => "Exemplo",
    "try_again" => "Tentar novamente",
    "continue" => "Continuar",
    "config_fmserver_hint" => "O endereço web do seu servidor FileMaker, sem www ou https:// no início nem barras no final, endereços IP não são permitidos, o endereço deve ser um domínio público.",
    "config_fmserver_label" => "Endereço do Servidor FileMaker",
    "config_timezone_label"=> "Fuso Horário",
    "config_dateformat_label"=> "Formato da Data",
    "config_username_label"=> "Nome de Usuário Admin do FMGet",

    "config_username_hint" => "O nome de usuário pode conter apenas caracteres alfanuméricos, sublinhados, espaços, pontos e hífens.",
    "config_password_label"=> "Senha Admin do FMGet",
    "config_password_hint"=> "Você precisará desta senha para gerenciar seu FMGet, guarde-a em um local seguro.",
    "config_email_label"=> "Endereço de Email Admin do FMGet",

    "config_email_hint"=> "Verifique cuidadosamente seu endereço de email antes de continuar.",
    "error_title" => "Erro",
    "error_fmserver_error" => "Este endereço do servidor FM não é válido, por favor verifique novamente.",
    "error_fmserver_required" => "O endereço do servidor FM é necessário para instalar o FMGet.",
    "config_title2" => "Configurações do Banco de Dados",

    "config_details2" => "Por favor selecione seu banco de dados e digite seu nome de usuário e senha do FMGet. Não se preocupe, você sempre poderá alterar essas configurações posteriormente.",
    "config_sitename_label"=> "Nome do Site",
    "config_fmusername_label"=> "Nome de Usuário do Banco de Dados",

    "config_fmpassword_label"=> "Senha do Banco de Dados",
    "config_selectdb"=> "Bancos de dados disponíveis no seu servidor:",

    "config_dbaccess"=> "Abaixo você deve inserir os detalhes da conta que usa para acessar o banco de dados.",
    "error_sitename_required" => "O nome do site é obrigatório para instalar o FMGet.",
    "error_timezone_required" => "O fuso horário é obrigatório para instalar o FMGet.",
    "error_fmusername_required" => "O nome de usuário do banco de dados é obrigatório para instalar o FMGet.",

    "error_fmpassword_required" => "A senha do banco de dados é obrigatória para instalar o FMGet.",
    "error_dateformat_required" => "O formato da data é obrigatório para instalar o FMGet.",
    "error_fmgusername_required" => "O nome de usuário do administrador é obrigatório para instalar o FMGet.",
    "error_fmgpassword_required" => "A senha do administrador é obrigatória para instalar o FMGet.",
    "error_email_required" => "O endereço de email é obrigatório para instalar o FMGet.",

    "error_fmdatabase_required" => "Nenhum banco de dados foi selecionado.",
    "error_dateformat_error" => "Este formato de data não é válido, por favor verifique novamente.",
    "error_timezone_error" => "Este fuso horário não é válido, por favor verifique novamente.",

    "error_email_error" => "Este endereço de email não é válido, por favor verifique novamente.",
    "error_fmserver_invalid" => "O FMGet não conseguiu detectar este servidor FM, por favor verifique o endereço do servidor novamente.",

    "error_fmserver_nodatabase" => "O servidor FM foi detectado, mas nenhum banco de dados foi encontrado para este nome de usuário/senha.",
    "fmserver_otherdatabase" => "Se você não encontrar seu banco de dados na lista acima, ele pode ter sido ocultado ou a API de dados não está ativada para ele, você pode tentar se conectar digitando seu nome no campo abaixo.",
    "config_named_fmdatabase_label" => "Nome do Banco de Dados",

    "config_named_fmdatabase_hint" => "Diferencia maiúsculas/minúsculas - O nome do banco de dados sem .fmp12.",
    "error_database_noaccess" => "O FMGet não consegue acessar o banco de dados usando este nome de usuário / senha.",


    "fmcloud_notice" => "Para bancos de dados hospedados pelo FileMaker Cloud, esta versão não suporta conexão usando uma conta Claris ID, esta opção estará disponível em breve.",
    "welcome_title" => "Bem-vindo",
    "welcome_details" => "O FMGet foi instalado. Faça login no painel administrativo para criar e gerenciar suas páginas e formulários.",

    "button_login" => "Entrar",
    "alert_username_colon" => "O nome de usuário do banco de dados não pode conter dois-pontos ( : ) porque causa conflito com a autenticação da API de dados.",

    "error_fmusername_colon" => "O nome de usuário do banco de dados não deve incluir dois-pontos.",
    "error_sqlite3" => "A extensão SQLite3 não está ativada neste servidor.",
    "fail_sqlite3" => "Falha ao criar a tabela interna do banco de dados do FMGet",
];