<?php
class Run {	
	function first(){
		include("db.php");		
 		$sql = "SELECT `fullname`, sum(amount) as amount FROM `persons` LEFT JOIN ((SELECT (`amount`-`amount`*2) as amount, `from_person_id` as person_id FROM `transactions`) union all (SELECT `amount` as amount, `to_person_id` as person_id FROM `transactions`)) p ON persons.id = p.person_id GROUP BY person_id";
		$result = mysqli_query($link, $sql) or die("<b>Error:</b> Problem<br/>" . mysqli_error($link));
		while($row = mysqli_fetch_array($result)){
			$row["amount"] = 100 + $row["amount"];
			$otv .= "Имя: ".$row["fullname"]." || Осталось средств: ".$row["amount"]." руб. <br>";
		}
		return $otv;
	}
	function name($id){
		include("db.php");
		$sql = "SELECT * FROM `persons` WHERE `id`='$id'";
		$result = mysqli_query($link, $sql) or die("<b>Error:</b> Problem<br/>" . mysqli_error($link));
		$row = mysqli_fetch_array($result);
		return $row;
	}
	function two(){
		include("db.php");
		$sql = "SELECT `from_person_id`, COUNT(`from_person_id`) c FROM `transactions` GROUP BY `from_person_id` HAVING COUNT(`from_person_id`)=(SELECT MAX(mycount) FROM (SELECT `from_person_id`, COUNT(`from_person_id`) mycount FROM `transactions` GROUP BY `from_person_id`) as T)";
		$result = mysqli_query($link, $sql) or die("<b>Error:</b> Problem<br/>" . mysqli_error($link));
		while ($row = mysqli_fetch_array($result)){
			$from = $this->name($row["from_person_id"]);
			$to = $this->name($row["to_person_id"]);
			$otv .= "Имя: ".$from[2]." || Встречается ".$row["c"]." раза<br>";
		}
		return $otv;
	}
	function three(){
		include("db.php");
		$sql = "SELECT `from_person_id`, `to_person_id`, `amount`, cities.name FROM `transactions` LEFT JOIN `persons` ON persons.id = `from_person_id` LEFT JOIN `cities` ON `city_id`=cities.id";
		$result = mysqli_query($link, $sql) or die("<b>Error:</b> Problem<br/>" . mysqli_error($link));
		$otv = "";
		while($row = mysqli_fetch_array($result)){
			$from = $this->name($row["from_person_id"]);
			$to = $this->name($row["to_person_id"]);
			if($from[1] == $to[1]){
				$otv .= "Город: ".$row["name"]." || От кого: ".$from[2]." || Кому: ".$to[2]." || Сумма: ".$row["amount"]." руб. <br>";
			}
		}
		mysqli_close($link);
		return $otv;
	}
}

$run = new Run();
echo "<h3>Задание 1</h3>";
print_r($run->first());
echo "<h3>Задание 2</h3>";
print_r($run->two());
echo "<h3>Задание 3</h3>";
print_r($run->three());
?>