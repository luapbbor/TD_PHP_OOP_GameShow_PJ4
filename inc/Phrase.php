<?php

class Phrase {
    // A string containing the current phrase to be used in the game
    public $currentPhrase = "dream big";
    // An array of letters the user has guessed
    public $selected = array();

    function __construct($currentPhrase = "", $selected = null) {

        if (!empty($currentPhrase)) {
            $this->$currentPhrase = $currentPhrase;
            } 
       
        if (!empty($selected)) {
            $this->selected = $selected;
        }

    }

    public function addPhraseToDisplay() {
        $currentPhraseLower = strtolower($this->currentPhrase);
        $letters = str_split($currentPhraseLower);
       
        foreach($letters as $letter){
            
            echo "<ul>";
            if ($letter == " "){
                echo "<li class='hide space'></li>";
            } else {
                 echo "<li class='hide letter " . $letter . "'>" . $letter . "</li>";
            }
            echo "</ul>";
        }

    }

    public function checkLetter() {

    }

}

?>