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
        
        <?php
        if ($game->gameOver()) {
             echo $game->gameOver();  
        
        } else {
            echo '<div id="banner" class="section">';   
            echo '<h2 class="header">Phrase Hunter</h2>';
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
         echo '</div>';
         echo '</div>';
        }
?>
           
</div> 

<script>

// Get all the keys with a class of key
var keys = document.querySelectorAll('.key');
// when a button on the keyboard is clicked
document.addEventListener("keyup", e => {
    // Loop through all the keys on the keyboard
    for (var i = 0; i < keys.length; i++) {
        // If the value of the key on the keyboard matches the button pressed on the keyboard
        if (keys[i].value == e.key) {
        // click that key
            keys[i].click();
        }        
}
});

</script>

</body>
</html>


