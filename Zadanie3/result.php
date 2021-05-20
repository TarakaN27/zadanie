<?php

$nominal = $_POST['nominal'];
$sum = $_POST['sum'];

if($sum % 5 != 0) {
	$sum_one = (integer)$sum - ((integer)$sum % 5);
	$sum_two = $sum_one+5;
	$otv = "<span class='wrong'>Неверная сумма. Выберите ".$sum_one." или ".$sum_two."</span>";
} else {
	$nomin = explode(',', $nominal);
	arsort($nomin);
	$result = array();
	$count=0;
	foreach ($nomin as $key) {
		if($sum >= $key) {
			if ($count > 0) {
				$all = 0;
				foreach($result as $keys=>$values){
					$all = $all + $values * $keys;
				}
				$count = ($sum - $all)/$key;				
			} else {
				$count = $sum/$key;
			}
			$result[$key] = (integer)$count;
		} else {continue;}
	}
	$otv = "<table><tr><td>Номинал<td>Количество";
	foreach ($result as $key=>$values) {
		$otv .= "<tr><td>".$key."<td>".$values;
	}
	$otv .= "</table>";
}
#print_r($result);
echo $otv;
?>