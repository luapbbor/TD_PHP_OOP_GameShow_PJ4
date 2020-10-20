<?php
include('inc/Game.php');
include('inc/Phrase.php');
$phrase = new Phrase();
$game = new Game($currentPhrase);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Phrase Hunter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>

<body>

<div class="main-container">
    <div id="banner" class="section">
        <h2 class="header">Phrase Hunter</h2>
        <div id="phrase" class="section">
            <?php
            // var_dump($phrase);
            // var_dump($game);
            echo $phrase->addPhraseToDisplay();
            ?>
        </div>
</div>

</body>
</html>


