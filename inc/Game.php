<?php

class Game {

    // will be set by the constructor
    public $phrase;
    // Used to set how many wrong guesses a player has before game over.
    public $lives = 5;

    function __construct(Phrase $phrase) {
       $this->phrase = $phrase;
    }

    public function keyHandler($letter) {
      
      if(!in_array($letter,$this->phrase->selected)) {
             return '<button type="submit" class="key" name="key" id="'.$letter.'"value="'.$letter.'">'.$letter.'</button>';
      } else {
        if($this->phrase->checkLetter($letter)) {
          
          return '<button type="submit" class="key correct" name="key" value="'.$letter.'" disabled>'.$letter.'</button>';
        } else {
          return '<button type="submit" class="key incorrect" name="key" value="'.$letter.'" disabled>'.$letter.'</button>';

        }
        
      } 
        // return '<button class="key" type="submit" name="key" value="q">q</button>';
      
      
    }

    public function displayKeyboard(){
    
      $topRow = ['q', 'w', 'e','r','t','y','u','i','o','p'];
      $middleRow = ['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l'];
      $bottomRow = ['z', 'x', 'c', 'v', 'b', 'n', 'm'];

    $keyboardHTML = "";
    $keyboardHTML .= '<div class="keyrow">';
    foreach($topRow as $letter){
      $keyboardHTML .= $this->keyHandler($letter);
    }
    $keyboardHTML .= '</div>';

    $keyboardHTML .= '<div class="keyrow">';
    foreach($middleRow as $letter){
      $keyboardHTML .= $this->keyHandler($letter);
    }
    $keyboardHTML .= '</div>';

    $keyboardHTML .= '<div class="keyrow">';
    foreach($bottomRow as $letter){
      $keyboardHTML .= $this->keyHandler($letter);
    }
    $keyboardHTML .= '</div>';
        
    return $keyboardHTML;

    }

    // This function displays the score on the screen
    public function displayScore() {
    $scoreHTML = "";
    // total number of lives at start of game
    $lives = $this->lives;
    // Livesleft decreases with each incorrect letter guess
    $livesLeft = $lives - $this->phrase->numberLost();
       
    // Loop through livesleft and show the liveheart html
    for ($j = 1; $j<=$livesLeft;$j+=1 ) {
          $scoreHTML .= '<li class="tries"><img src="images/liveHeart.png" height="35px" widght="30px"></li>';
    }
     
    // Loop through the number of incorrect guesses and show the lostheart html
    for($i = 1; $i<=$this->phrase->numberLost(); $i+=1) {
        $scoreHTML .= '<li class="tries"><img src="images/lostHeart.png" height="35px" widght="30px"></li>';        
    }

    echo $scoreHTML;
    }

    public function checkForLose() {
      if ($this->phrase->numberLost() >= $this->lives) {
        return true;
      } else {
        return false;
      }
    }

    public function checkForWin() {
      $resultArray = array_intersect($this->phrase->selected,$this->phrase->getLetterArray());
      if(count($resultArray) == count($this->phrase->getLetterArray())) {
         return true;
      } else  {
         return false;
      }
    }

    public function gameOver() {
      $gameOverHTML = "";
      if ($this->checkForLose()) {   
        $gameOverHTML .= '<div id="lose-overlay">';  
        $gameOverHTML .= '<div id="banner" class="section">';
        $gameOverHTML .= '<h2 class="header">Phrase Hunter</h2>'; 
        $gameOverHTML .= '</div>'; 
        $gameOverHTML .= '<h1 id="game-over-message">The phrase was: ' . $this->phrase->currentPhrase . '. Better luck next time!</h1>'; 
        $gameOverHTML .= '<form action="play.php" method="post">';
        $gameOverHTML .= '<input id="btn__reset" type="submit" name="start" value="Re-start Game" />';
        $gameOverHTML .= '</form>';
        $gameOverHTML .= '</div>';       
        return $gameOverHTML;
      } elseif ($this->checkForWin()) {
        $gameOverHTML .= '<div id="win-overlay">';  
        $gameOverHTML .= '<div id="banner" class="section">';
        $gameOverHTML .= '<h2 class="header">Phrase Hunter</h2>'; 
        $gameOverHTML .= '</div>';  
        $gameOverHTML .= '<h1 id="game-over-message">Congratualations on guessing the phrase: ' . $this->phrase->currentPhrase . '</h1>'; 
        $gameOverHTML .= '<form action="play.php" method="post">';
        $gameOverHTML .= '<input id="btn__reset" type="submit" name="start" value="Re-start Game" />';
        $gameOverHTML .= '</form>';
        $gameOverHTML .= '</div>';   
        return $gameOverHTML;

      } else {
        return false;
      }
    }
  
    
  }  

?>