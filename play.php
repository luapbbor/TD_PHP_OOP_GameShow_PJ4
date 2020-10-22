<?php
require 'inc/Game.php';
require 'inc/Phrase.php';

error_reporting(E_ALL);
ini_set('display_errors','On');

// Start the session
session_start();

//When the START key is submitted it resets the Session Variables;
if (isset($_POST['start'])) {
   
unset($_SESSION['selected']);
unset($_SESSION['phrase']);
$phrase = new Phrase();
$game = new Game($phrase);
$_SESSION['phrase'] = $phrase;
$_SESSION['game'] = $game;     // pass the $phrase object when instantiating the Game object
$_SESSION["selected"] = array();
} else {
    $phrase = $_SESSION['phrase'];
    $game = $_SESSION['game'];
}


if(isset($_POST['key'])) {
    array_push($phrase->selected,$_POST['key']);
    array_push($_SESSION['selected'],$_POST['key']);
} 

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
        <?php
        if ($game->gameOver()) {
        echo $game->gameOver();
        echo '<form action="play.php" method="post">';
        echo '<input id="btn__reset" type="submit" name="start" value="Re-start Game" />';
        echo '</form>';
        } else {
         echo '<div id="phrase" class="section">';
         echo $phrase->addPhraseToDisplay();
         echo '</div>';
         echo '<div id="qwerty" class="section">';
         echo '<form method="post" action="play.php">';
         echo $game->displayKeyboard();
         echo '</form>';
         echo '</div>';
         echo '<div id="scoreboard" class="section">';
         echo '<ol>';
         echo $game->displayScore();
         echo '</ol>';
        }
?>
        
        
        
        </div> 
</div>

</body>
</html>


