<?php
return [
    "welcome" => "FMGetへようこそ。始める前に、以下の項目を準備する必要があります。",

    "req_ssl" => "SSLが有効なウェブサイト [https://]", 
    "req_php" => "PHPバージョン7.3以上",
    "req_fms" => "FileMakerサーバーバージョン18以降（SSLを有効にする必要があります）",
    "req_api" => "FMサーバー設定 > Data APIを有効にする必要があります",
    "req_acc" => "[フルアクセス] データベースアカウントで、fmrestの拡張権限が有効になっている必要があります",

    "back1" => "別の言語を選択してください",

    "button_install" => "FMGetをインストール",

    "intro1" => "ウェブサイトとFileMakerサーバーの設定についてさらにサポートが必要ですか？",
    "intro2" => "セットアップに関するサポート記事を読んでください。",

    "error_ssl" => "SSL証明書が検出されませんでした。通常はウェブホストから提供されます。有効になっていない場合は、続行する前にそれらに連絡する必要があります。",
    "back2" => "再試行",

    "error_curl1" => "このサーバーではcURLが有効になっていません。通常はウェブホストから提供されます。有効になっていない場合は、続行する前にそれらに連絡する必要があります。",
    "error_curl2" => "このサーバーではcURL関数が正しく動作していません。通常はウェブホストから提供されます。続行する前にそれらに連絡する必要があります。",

    "config_details1" => "あなたのウェブサイトは準備完了です！インストールのこの部分を無事通過しました。FMGetは今やFileMakerサーバーに接続する準備ができています。",

    "config_important" => "重要",
    "config_warning1" => "ユーザー名とパスワードを他人と共有しないでください。これにより、ユーザーがFMGetアプリケーションを完全に制御し、接続されたデータベースにアクセスできるようになります。",

    "error_config" => "エラー: fmg-config.phpを作成できませんでした。続行する前にウェブサーバーの設定を確認してください。",

    "config_title" => "FMGet 設定",
    "example" => "例",
    "try_again" => "再試行",
    "continue" => "続ける",
    "config_fmserver_hint" => "FileMakerサーバーのウェブアドレス。先頭にwwwやhttps://をつけず、末尾にスラッシュも不要です。IPアドレスは許可されていません。アドレスはパブリックドメインである必要があります。", 
    "config_fmserver_label" => "FileMakerサーバーアドレス",
    "config_timezone_label"=> "タイムゾーン",
    "config_dateformat_label"=> "日付形式",
    "config_username_label"=> "FMGet管理者ユーザー名",
    "config_username_hint" => "ユーザー名には英数字、アンダースコア、スペース、ピリオド、ハイフンのみ使用できます。",
    "config_password_label"=> "FMGet管理者パスワード",
    "config_password_hint"=> "このパスワードはFMGetを管理するために必要です。安全な場所に保管してください。",
    "config_email_label"=> "FMGet管理者メールアドレス",
    "config_email_hint"=> "続行する前にメールアドレスを再確認してください。",

    "error_title" => "エラー",
    "error_fmserver_error" => "このFMサーバーアドレスは無効です。再度確認してください。",
    "error_fmserver_required" => "FMGetのインストールにはFMサーバーアドレスが必要です。",
    "config_title2" => "データベース設定",
    "config_details2" => "データベースを選択し、FMGetのユーザー名とパスワードを入力してください。ご心配なく、これらの設定は後で変更できます。",

    "config_sitename_label"=> "サイト名",
    "config_fmusername_label"=> "データベースユーザー名",
    "config_fmpassword_label"=> "データベースパスワード",

    "config_selectdb"=> "サーバー上の利用可能なデータベース:",
    "config_dbaccess"=> "以下にデータベースにアクセスするために使用するアカウントの詳細を入力してください。",

    "error_sitename_required" => "FMGetのインストールにはサイト名が必要です。",
    "error_timezone_required" => "FMGetのインストールにはタイムゾーンが必要です。",
    "error_fmusername_required" => "FMGetのインストールにはデータベースユーザー名が必要です。",
    "error_fmpassword_required" => "FMGetのインストールにはデータベースパスワードが必要です。",

    "error_dateformat_required" => "FMGetのインストールには日付形式が必要です。",
    "error_fmgusername_required" => "FMGetのインストールには管理者ユーザー名が必要です。",
    "error_fmgpassword_required" => "FMGetのインストールには管理者パスワードが必要です。",
    "error_email_required" => "FMGetのインストールにはメールアドレスが必要です。",
    "error_fmdatabase_required" => "データベースが選択されていません。",

    "error_dateformat_error" => "この日付形式は無効です。再度確認してください。",
    "error_timezone_error" => "このタイムゾーンは無効です。再度確認してください。",
    "error_email_error" => "このメールアドレスは無効です。再度確認してください。",

    "error_fmserver_invalid" => "FMGetはこのFMサーバーを検出できませんでした。サーバーアドレスを再度確認してください。",
    "error_fmserver_nodatabase" => "FMサーバーは検出されましたが、このユーザー名/パスワードではデータベースが見つかりませんでした。",

    "fmserver_otherdatabase" => "上記リストに自分のデータベースがない場合、それは非表示になっているか、またはそのデータAPIが有効になっていない可能性があります。下記のフィールドに名前を入力して接続を試みてください。",
    "config_named_fmdatabase_label" => "データベース名",
    "config_named_fmdatabase_hint" => "大文字・小文字区別あり - .fmp12を除いたデータベース名。",

    "error_database_noaccess" => "このユーザー名 / パスワードを使用してFMGetはデータベースにアクセスできません。",
    "fmcloud_notice" => "FileMaker Cloudでホストされているデータベースの場合、このバージョンではClaris IDアカウントを使用したデータベースへの接続はサポートされていません。このオプションは近日中に利用可能になります。",


    "welcome_title" => "ようこそ",
    "welcome_details" => "FMGetのインストールが完了しました。管理者ダッシュボードにログインして、ページやフォームを作成・管理してください。",
    "button_login" => "ログイン",

    "alert_username_colon" => "データベースのユーザー名にコロン ( : ) を含めることはできません。これはData API認証と競合します。",
    "error_fmusername_colon" => "データベースのユーザー名にコロンを含めないでください。",

    "error_sqlite3" => "SQLite3拡張機能がこのサーバーで有効になっていません。",
    "fail_sqlite3" => "FMGet内部データベーステーブルの作成に失敗しました",
];