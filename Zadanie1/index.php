<?php
interface IChessmen {
	public function Move($x,$y);
    public function getPosition();
	public function Add($x,$y);
}
abstract class AbstractChessmen implements IChessmen {
	private $x;
	private $y;
	function getPosition(){
		$position = array($this->x,$this->y);
		return $position;
	}
	function Add($x,$y){
		$this->x = $x;
		$this->y = $y;
	}
}
class King extends AbstractChessmen {
	function Move($x,$y){
		if(abs($this->getPosition()[0]-$x) == 1 && $x<=8 && abs($this->getPosition()[1]-$y) == 1 && $y<=8){
			$this->Add($x,$y);
		}
	}
}
class Queen extends AbstractChessmen {
	function Move($x,$y){
		if($this->getPosition()[0]==$x || $this->getPosition()[1]==$y || $x==$y){
			if ($x<=8 && $y<=8){
				$this->Add($x,$y);
			}
		}
	}
}

$king = new King();
$queen = new Queen();

$king->Add(4,3);
$queen->Add(1,1);

echo "<br>==Начальное положение==<br>";
echo "King: x=".$king->getPosition()[0]."; y=".$king->getPosition()[1]."<br>";
echo "Queer: x=".$queen->getPosition()[0]."; y=".$queen->getPosition()[1]."<br>";

$king->Move(2,2);
$queen->Move(7,3);

echo "<br>==Ход==<br>";
echo "King: x=".$king->getPosition()[0]."; y=".$king->getPosition()[1]."<br>";
echo "Queer: x=".$queen->getPosition()[0]."; y=".$queen->getPosition()[1]."<br>";
?>