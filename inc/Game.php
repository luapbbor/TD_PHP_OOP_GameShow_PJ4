<?php


class Game {

    // will be set by the constructor
    private $phrase = "";
    // Used to set how many wrong guesses a player has before game over.
    private $lives = 5;

    function __construct($phrase = "") {
       $this->phrase = $phrase;
    }

}

?>