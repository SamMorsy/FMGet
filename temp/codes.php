<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Button</title>
    <style>
        .fmg-ui-button-basic {
            padding: 5px 10px;
            border: 2px solid #005d76;
            color: #005d76;
            font-size: 14px;
            background-color: transparent;
            cursor: pointer;
            outline: none;
            transition: all 0.3s ease;
        }
        .fmg-ui-button-basic:hover {
            background-color: #005d76;
            color: white;
        }
        .fmg-ui-button-basic:active {
            background-color: #003f52;
            color: white;
            border-color: #003f52;
        }
        .fmg-ui-button-basic:focus {
            box-shadow: 0 0 5px rgba(0, 93, 118, 0.7);
        }
    </style>
</head>
<body>
    <button class="fmg-ui-button-basic">Click Me</button>
</body>
</html>