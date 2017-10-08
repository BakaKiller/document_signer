<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
            integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
            crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f4f4;
        }

        #content {
            background-color: #ffffff;
            margin: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12),
            0 1px 2px rgba(0, 0, 0, 0.24);
            padding: 12px;
            border-radius: 2px;
            width: calc(100% - 40px);
        }

        #footer {
            width: 100%;
            background-color: #242424;
            color: #ffffff;
            position: absolute;
            bottom: 0;
            text-align: center;
            padding: 15px;
        }

        .alert {
            width: calc(100% - 40px);
            margin: 20px;
        }
    </style>
</head>
<body>
<?php
if (isset($_GET['notif'])) {
    ?>
<div class="alert alert-primary" role="alert">
    <?php
    echo urldecode($_GET['notif']);
    ?>
</div>
    <?php
}
?>