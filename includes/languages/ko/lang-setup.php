<?php
return [
    "welcome" => "FMGet에 오신 것을 환영합니다. 시작하기 전에 다음 항목이 필요합니다.",

    "req_ssl" => "SSL이 활성화된 웹사이트 [https://]", 
    "req_php" => "PHP 버전 7.3 이상",
    "req_fms" => "FileMaker 서버 버전 18 이상 (SSL이 활성화되어야 함)",
    "req_api" => "FM 서버 설정 > Data API가 활성화되어야 합니다.",
    "req_acc" => "[풀 액세스] 데이터베이스 계정이며 fmrest 확장 권한이 활성화되어야 합니다.",

    "back1" => "다른 언어를 선택하세요",

    "button_install" => "FMGet 설치",

    "intro1" => "웹사이트와 FileMaker 서버 설정에 대해 추가 도움이 필요하신가요?",
    "intro2" => "설치 관련 지원 문서를 읽어보세요.",

    "error_ssl" => "SSL 인증서가 감지되지 않았습니다. 일반적으로 웹 호스트에서 제공합니다. 활성화되어 있지 않다면 계속 진행하기 전에 연락해야 합니다.",
    "back2" => "다시 시도",

    "error_curl1" => "이 서버에서 cURL이 활성화되지 않았습니다. 일반적으로 웹 호스트에서 제공합니다. 활성화되어 있지 않다면 계속 진행하기 전에 연락해야 합니다.",
    "error_curl2" => "이 서버에서 cURL 기능이 올바르게 작동하지 않습니다. 일반적으로 웹 호스트에서 제공합니다. 계속 진행하기 전에 연락해야 합니다.",

    "config_details1" => "당신의 웹사이트가 준비되었습니다! 설치 과정을 무사히 마쳤습니다. 이제 FMGet를 FileMaker 서버에 연결할 수 있습니다.",

    "config_important" => "중요",
    "config_warning1" => "사용자 이름과 비밀번호를 다른 사람과 공유하지 마세요. 이를 통해 사용자가 FMGet 애플리케이션을 완전히 제어하고 연결된 데이터베이스에 접근할 수 있습니다.",

    "error_config" => "오류: fmg-config.php 파일을 생성할 수 없습니다. 계속 진행하기 전에 웹 서버 설정을 확인하십시오.",

    "config_title" => "FMGet 설정",
    "example" => "예시",
    "try_again" => "다시 시도",
    "continue" => "계속",
    "config_fmserver_hint" => "FileMaker 서버의 웹 주소입니다. 앞에 www 또는 https:// 없이, 끝에 슬래시(/) 없이 입력하세요. IP 주소는 허용되지 않습니다. 주소는 공개 도메인이어야 합니다.",
    "config_fmserver_label" => "FileMaker 서버 주소",
    "config_timezone_label"=> "시간대",
    "config_dateformat_label"=> "날짜 형식",
    "config_username_label"=> "FMGet 관리자 사용자 이름",
    "config_username_hint" => "사용자 이름은 영문자, 숫자, 밑줄, 공백, 마침표, 하이픈만 포함할 수 있습니다.",
    "config_password_label"=> "FMGet 관리자 비밀번호",
    "config_password_hint"=> "이 비밀번호는 FMGet를 관리하는 데 필요합니다. 안전한 장소에 보관하십시오.",
    "config_email_label"=> "FMGet 관리자 이메일 주소",
    "config_email_hint"=> "계속하기 전에 이메일 주소를 다시 확인하십시오.",

    "error_title" => "오류",
    "error_fmserver_error" => "이 FM 서버 주소는 유효하지 않습니다. 다시 확인하십시오.",
    "error_fmserver_required" => "FMGet 설치에는 FM 서버 주소가 필요합니다.",
    "config_title2" => "데이터베이스 설정",
    "config_details2" => "데이터베이스를 선택하고 FMGet 사용자 이름과 비밀번호를 입력하십시오. 걱정 마세요. 나중에 언제든지 이러한 설정을 변경할 수 있습니다.",

    "config_sitename_label"=> "사이트 이름",
    "config_fmusername_label"=> "데이터베이스 사용자 이름",
    "config_fmpassword_label"=> "데이터베이스 비밀번호",

    "config_selectdb"=> "서버에서 사용 가능한 데이터베이스:",
    "config_dbaccess"=> "아래에 데이터베이스에 액세스하는 데 사용하는 계정 정보를 입력하십시오.",

    "error_sitename_required" => "FMGet 설치에는 사이트 이름이 필요합니다.",
    "error_timezone_required" => "FMGet 설치에는 시간대가 필요합니다.",
    "error_fmusername_required" => "FMGet 설치에는 데이터베이스 사용자 이름이 필요합니다.",
    "error_fmpassword_required" => "FMGet 설치에는 데이터베이스 비밀번호가 필요합니다.",

    "error_dateformat_required" => "FMGet 설치에는 날짜 형식이 필요합니다.",
    "error_fmgusername_required" => "FMGet 설치에는 관리자 사용자 이름이 필요합니다.",
    "error_fmgpassword_required" => "FMGet 설치에는 관리자 비밀번호가 필요합니다.",
    "error_email_required" => "FMGet 설치에는 이메일 주소가 필요합니다.",
    "error_fmdatabase_required" => "데이터베이스가 선택되지 않았습니다.",

    "error_dateformat_error" => "이 날짜 형식은 유효하지 않습니다. 다시 확인하십시오.",
    "error_timezone_error" => "이 시간대는 유효하지 않습니다. 다시 확인하십시오.",
    "error_email_error" => "이 이메일 주소는 유효하지 않습니다. 다시 확인하십시오.",

    "error_fmserver_invalid" => "FMGet가 이 FM 서버를 감지할 수 없습니다. 서버 주소를 다시 확인하십시오.",
    "error_fmserver_nodatabase" => "FM 서버는 감지되었으나, 이 사용자 이름/비밀번호로는 데이터베이스를 찾을 수 없습니다.",

    "fmserver_otherdatabase" => "위 목록에서 원하는 데이터베이스를 찾을 수 없다면 숨겨져 있거나 데이터 API가 비활성화되었을 수 있습니다. 아래 입력란에 이름을 입력하여 연결해 보세요.",
    "config_named_fmdatabase_label" => "데이터베이스 이름",
    "config_named_fmdatabase_hint" => "대소문자 구분 - .fmp12을 제외한 데이터베이스 이름",

    "error_database_noaccess" => "이 사용자 이름 / 비밀번호로는 FMGet가 데이터베이스에 액세스할 수 없습니다.",
    "fmcloud_notice" => "FileMaker Cloud에서 호스팅되는 데이터베이스의 경우, 이 버전에서는 Claris ID 계정을 사용한 데이터베이스 연결이 지원되지 않습니다. 이 옵션은 곧 제공될 예정입니다.",


    "welcome_title" => "환영합니다",
    "welcome_details" => "FMGet 설치가 완료되었습니다. 관리자 대시보드에 로그인하여 페이지 및 양식을 생성 및 관리하십시오.",
    "button_login" => "로그인",

    "alert_username_colon" => "데이터베이스 사용자 이름에 콜론( : )을 포함할 수 없습니다. 데이터 API 인증과 충돌이 발생합니다.",
    "error_fmusername_colon" => "데이터베이스 사용자 이름에 콜론이 포함되어선 안 됩니다.",

    "error_sqlite3" => "이 서버에서 SQLite3 확장이 활성화되지 않았습니다.",
    "fail_sqlite3" => "FMGet 내부 데이터베이스 테이블 생성 실패",
];