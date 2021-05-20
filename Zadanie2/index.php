<?php
class Run {
	public $words = array("red", "blue", "green", "yellow", "lime", "magenta", "black", "gold", "gray", "tomato");
    public $result = array();
    public function Result(){
    	foreach ($this->words as $word) {
        	do{
            	$color = array_rand($this->words);
            }while($word === $this->words[$color]);
			$this->result[$word] = $this->words[$color];
        }
        return $this->result;
    }
}

$run = new Run();
for ($i=0;$i<5;$i++){
  foreach ($run->Result() as $values => $keys) {
      echo "<font color='".$keys."'>".$values."</font> ";
  }
  echo "<br>";
}
?>