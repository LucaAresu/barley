<?php
requiredLogin();

$auth = getAuthUser();
?>
<!doctype html>
<html lang="it">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Liu+Jian+Mao+Cao&family=Roboto:wght@500&family=Shadows+Into+Light&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/css.css">
    <title>Bar Game</title>
    <script>
        let userId = <?=$auth->id?>;
        let token = '<?=$_SESSION['token']?>';
    </script>
</head>
<body>
<?php require 'header.php'?>
<main>
    <?php require 'menu.php'?>
    <div class="content">
    <?=$this->content?>
    </div>
</main>

<script src="js/main.js"></script>
</body>
</html>