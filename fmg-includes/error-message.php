<?php
/**
 * FMGet Version
 *
 * Shows a simple HTML page containing a message for the user.
 *
 * Most likely will be used with fatal errors, so we include all CSS inside the HTML
 * 
 * @package FMGet
 */


// Don't load directly.
if (!defined('ABSPATH')) {
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Error - <?php echo $title; ?></title>
    <link rel="icon" href="data:," />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#004458">
    <style>
        body {
            line-height: 22px;
            font-size: 14px;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #2e2e2e;
            color: #333;
            display: flex;
            justify-content: center;
            padding: 0 15px;
        }

        .container {
            width: 960px;
            background-color: #fff;
            margin: 30px 0;
            border: 6px solid #444;
        }

        a {
            color: #005d76;
            text-decoration: none;
        }

        .content-wrapper {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .main-content {
            box-sizing: border-box;
            width: 100%;
        }

        .footer {
            font-size: 12px;
            background-color: #ddd;
            padding: 5px 15px;
            border-top: 1px solid #bbb;
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .main-footer {
            box-sizing: border-box;
        }

        .side-footer {
            text-align: right;
            box-sizing: border-box;
        }

        .side-footer p {
            margin-block-start: 0px;
            margin-block-end: 0px;
        }

        .items-list {
            line-height: 30px;
        }

        .code-box {
            color: #333;
            font-family: monospace;
            display: block;
            padding: 9.5px;
            margin: 0 0 10px;
            font-size: 13px;
            line-height: 20px;
            word-wrap: break-word;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }

        .section-row-title H4 {
            margin-top: 0px;
            color: dimgray
        }

        .section-row-title H3 {
            margin-bottom: 7px;
        }

        .section-row {
            display: flex;
            gap: 10px;
        }

        .navigation-info {
            display: block;
            padding: 0px 15px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        @media (max-width: 940px) {
            .container {
                width: 80%;
            }
        }

        @media (max-width: 650px) {
            .container {
                width: unset;
            }

            h1 {
                font-size: 1.75rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            h3 {
                font-size: 1.25rem;
            }

            p {
                font-size: 1rem;
            }

            ul,
            ol {
                padding-left: 1rem;
            }

            button,
            input,
            textarea {
                font-size: 0.9rem;
                padding: 0.4rem;
            }

            img {
                max-width: 90%;
            }

            .footer {
                flex-direction: column;
            }

            .section-row {
                flex-direction: column;
                align-items: center;
            }

            .section-row-photo {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content-wrapper">
            <div class="main-content">
                <h2><?php echo $title; ?></h2>
                <hr>
                <?php echo $message; ?>
            </div>
        </div>
        <div class="footer">
            <div class="main-footer"></div>
            <div class="side-footer">
                <p>Powered by <a target="_blank" href="https://fmget.com">FMGet</a></p>
            </div>
        </div>
    </div>
</body>

</html>