<?php
return [
    "welcome" => "Ласкаво просимо до FMGet. Перш ніж почати, вам знадобляться такі речі.",

    "req_ssl" => "Вебсайт із увімкненим SSL [https://]", 
    "req_php" => "Версія PHP 7.3 або новіша",
    "req_fms" => "Сервер FileMaker версії 18 або новіше (SSL має бути увімкненим)",
    "req_api" => "Налаштування сервера FM > API даних має бути увімкненим",
    "req_acc" => "Обліковий запис бази даних з повним доступом [Full Access] і активованими розширеними правами fmrest",

    "back1" => "Виберіть іншу мову",

    "button_install" => "Встановити FMGet",

    "intro1" => "Потрібна додаткова допомога з налаштування вашого вебсайту та сервера FileMaker?",
    "intro2" => "Прочитайте статтю підтримки щодо налаштування.",

    "error_ssl" => "SSL-сертифікат не виявлено, зазвичай його надає ваш хостинг-провайдер. Якщо він не увімкнений, вам потрібно зв’язатися з ними, перш ніж продовжити.",
    "back2" => "Спробуйте ще раз",

    "error_curl1" => "cURL не увімкнено на цьому сервері. Зазвичай його надає ваш хостинг-провайдер. Якщо він не увімкнений, вам потрібно зв’язатися з ними, перш ніж продовжити.",
    "error_curl2" => "Функції cURL не працюють правильно на цьому сервері. Зазвичай його надає ваш хостинг-провайдер. Вам потрібно зв’язатися з ними, перш ніж продовжити.",

    "config_details1" => "Ваш сайт готовий! Ви успішно пройшли цей етап встановлення. FMGet тепер готовий до підключення до вашого сервера FileMaker.",

    "config_important" => "Важливо",
    "config_warning1" => "Не діліться своїм ім'ям користувача та паролем ні з ким, це дасть користувачеві повний контроль над додатком FMGet і доступ до підключених баз даних.",

    "error_config" => "Помилка: Не вдалося створити fmg-config.php, перевірте налаштування веб-сервера перед тим, як продовжити.",

    "config_title" => "Налаштування FMGet",
    "example" => "Приклад",
    "try_again" => "Спробуйте ще раз",
    "continue" => "Продовжити",
    "config_fmserver_hint" => "Веб-адреса вашого сервера FileMaker, без префіксів www або https:// і закінчення слешами, IP-адреси заборонені, адреса має бути публічним доменом.",
    "config_fmserver_label" => "Адреса сервера FileMaker",
    "config_timezone_label"=> "Часовий пояс",
    "config_dateformat_label"=> "Формат дати",
    "config_username_label"=> "Ім’я адміністратора FMGet",
    "config_username_hint" => "Ім'я користувача може містити лише алфавітно-цифрові символи, нижнє підкреслення, пробіли, крапки та дефіси.",
    "config_password_label"=> "Пароль адміністратора FMGet",
    "config_password_hint"=> "Цей пароль буде потрібен для управління вашим FMGet, збережіть його в безпечному місці.",
    "config_email_label"=> "Електронна пошта адміністратора FMGet",
    "config_email_hint"=> "Уважно перевірте свою адресу електронної пошти перед продовженням.",

    "error_title" => "Помилка",
    "error_fmserver_error" => "Ця адреса сервера FM недійсна, перевірте ще раз.",
    "error_fmserver_required" => "Для встановлення FMGet потрібна адреса сервера FM.",
    "config_title2" => "Налаштування бази даних",
    "config_details2" => "Будь ласка, виберіть вашу базу даних і введіть ім’я користувача та пароль FMGet. Не хвилюйтеся, ви завжди можете змінити ці налаштування пізніше.",

    "config_sitename_label"=> "Назва сайту",
    "config_fmusername_label"=> "Ім'я користувача бази даних",
    "config_fmpassword_label"=> "Пароль бази даних",

    "config_selectdb"=> "Доступні бази даних на вашому сервері:",
    "config_dbaccess"=> "Нижче вкажіть дані облікового запису, який ви використовуєте для доступу до бази даних.",

    "error_sitename_required" => "Для встановлення FMGet потрібна назва сайту.",
    "error_timezone_required" => "Для встановлення FMGet потрібен часовий пояс.",
    "error_fmusername_required" => "Для встановлення FMGet потрібне ім'я користувача бази даних.",
    "error_fmpassword_required" => "Для встановлення FMGet потрібен пароль бази даних.",

    "error_dateformat_required" => "Для встановлення FMGet потрібен формат дати.",
    "error_fmgusername_required" => "Для встановлення FMGet потрібне ім'я адміністратора.",
    "error_fmgpassword_required" => "Для встановлення FMGet потрібен пароль адміністратора.",
    "error_email_required" => "Для встановлення FMGet потрібна адреса електронної пошти.",
    "error_fmdatabase_required" => "Не вибрано жодної бази даних.",

    "error_dateformat_error" => "Цей формат дати недійсний, перевірте ще раз.",
    "error_timezone_error" => "Цей часовий пояс недійсний, перевірте ще раз.",
    "error_email_error" => "Ця адреса електронної пошти недійсна, перевірте ще раз.",

    "error_fmserver_invalid" => "FMGet не зміг виявити цей сервер FM, перевірте адресу сервера ще раз.",
    "error_fmserver_nodatabase" => "Сервер FM виявлено, але для цього імені користувача / пароля не знайдено жодної бази даних.",

    "fmserver_otherdatabase" => "Якщо ви не можете знайти свою базу даних у списку вище, її могли приховати або API даних для неї вимкнено, ви можете спробувати підключитися до неї, ввівши її назву у полі нижче.",
    "config_named_fmdatabase_label" => "Назва бази даних",
    "config_named_fmdatabase_hint" => "Регістр має значення - Назва бази даних без .fmp12.",

    "error_database_noaccess" => "FMGet не може отримати доступ до бази даних за допомогою цього імені користувача / пароля.",
    "fmcloud_notice" => "Для баз даних, що хостяться через FileMaker Cloud, ця версія не підтримує підключення до бази даних за допомогою облікового запису Claris ID, ця опція стане доступною найближчим часом.",


    "welcome_title" => "Ласкаво просимо",
    "welcome_details" => "FMGet успішно встановлено. Увійдіть до панелі адміністратора, щоб створювати та керувати сторінками та формами.",
    "button_login" => "Увійти",

    "alert_username_colon" => "Ім'я користувача бази даних не може містити двокрапку ( : ), тому що це викликає конфлікт з автентифікацією через API даних.",
    "error_fmusername_colon" => "Ім'я користувача бази даних не має містити двокрапки.",

    "error_sqlite3" => "Розширення SQLite3 не увімкнено на цьому сервері.",
    "fail_sqlite3" => "Не вдалося створити внутрішню таблицю бази даних FMGet",
];