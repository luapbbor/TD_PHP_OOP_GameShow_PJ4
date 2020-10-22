<?php

class Phrase {
    // A string containing the current phrase to be used in the game
    public $currentPhrase;
    // An array of letters the user has guessed
    public $selected = [];

    public $phrases = ['Boldness my friend', 'Leave no stone unturned', 'Broken crayons still colour', 'The adventure begins', 'love without limites'];

    function __construct($phrase = null, $selected = []) {

        if (!empty($phrase)) {
            $this->currentPhrase = $phrase;
            } else {
             $arrayKey = array_rand($this->phrases,1);  
             $this->currentPhrase = $this->phrases[$arrayKey];
            }
       
        if (!empty($selected)) {
            $this->selected = $selected;            
        }

    }

    
    // This function formats and displays the current phrase
    public function addPhraseToDisplay() {
        $currentPhraseLower = strtolower($this->currentPhrase);
        $letters = str_split($currentPhraseLower);
       
        foreach($letters as $letter){
            
            echo "<ul>";
            if ($letter == " "){
                echo "<li class='hide space'></li>";

            } else {
                if(in_array($letter,$this->selected)) {
                    echo "<li class='show letter " . $letter . "'>" . $letter . "</li>"; 
                } else {
                 echo "<li class='hide letter " . $letter . "'>" . $letter . "</li>";
                }
            }
            echo "</ul>";
        }

    }


    // This function will return the unique letters from $currentPhrase as an array  
     
    public function getLetterArray() {
        //array of unique lowercase letters only in the currentPhrase
  $uniqueLetters = array_unique(str_split(str_replace(
      ' ',
      '',
      strtolower($this->currentPhrase)
      )));

  return $uniqueLetters;
  }
     
    // Checks to see if a specific letter is in the current phrase and returns true or false
    public function checkLetter($letter) {
    
    $uniqueLetters = $this->getLetterArray();
    // var_dump($uniqueLetters);
    // var_dump($letter);
    if (in_array($letter,$uniqueLetters)) {
    return true;
    } else {

    return false;
    }
    }

    //This function compares the selected letters to the unique letters in currentphrase
    // It puts the difference in an array and then the array is counted
    public function numberLost(){
        $difference = array_diff($this->selected,$this->getLetterArray());
        return count($difference);
    }

}

?>