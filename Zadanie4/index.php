<?php
include "simple_html_dom.php";
$team = 0;
class Run {
	function findteam($team){
		$html = file_get_html('https://terrikon.com/football/italy/championship/');
		foreach($html->find('#champs-table td.team') as $article) {
			if($article->find('a', 0)->plaintext == $team){
			$item['title'] = $article->find('a', 0)->plaintext;
			$i = count($article->parent()->find('td'));
			for ($i=0, $z=count($article->parent()->find('td')); $i<$z; $i++) {
				$item['td'][$i] = $article->parent()->find('td', $i)->plaintext;
			}
			$articles[] = $item;
			}
		}
		return $articles;
	}
	
}
$run = new Run();
?>
<html>
<head>
<script src="jquery-3.6.0.js"></script>
<style>
form {
	width: 460px;
    margin: auto;
	display: flex;
    flex-direction: column;
}
label {
	    margin: 0px 10 0;
}
input, select {
    margin: 0 0 10px;
    font-size: 19px;
    height: 41px;
}
h1 {
	text-align: center;
}
input[type="submit"] {
	width: 37%;
    align-self: flex-end;
}
.block {
	width: 443px;
    margin: auto;
	display: flex;
    flex-direction: column;
	background-color:#dae8fc;
	border: 2px solid #c1d4ec;
	padding: 8px;
}
.wrong {
	display: block;
	background-color: #fff2cc;
    border: 2px solid #dccda1;
	padding: 8px;
}
table {
	display: block;
    background-color: #fff2cc;
    border-collapse: collapse;
	margin: auto;
}
td {
	border: 2px solid #dccda1;
    width: 1%;
    padding: 6px;
    text-align: center;
}
</style>
</head>
<body>

<form action="" method="post">
	<h1>Задание 4</h1>
	<label>Команда</label>
	<select name="team">
	<?php
		$teams = $run->findteam($team);
		foreach ($teams as $teams) {
			echo '<option value="'.$teams["title"].'">'.$teams["title"].'</option>';
		}
	?>
	</select>
	<input type="submit" values="Отправить">
</form>

<div class="block">
	<span>Ответ:</span>
	<div id="result">
	<?php
	$team = $_POST['team'];
	if (isset($team)){
		$teams = $run->findteam($team);
		echo "<table><tr><td>Название<td>И<td>В<td>Н<td>П<td>З<td>-<td>П<td>О";
		foreach ($teams as $teams) {
			echo "<tr>";
			for($i=1, $z=count($teams["td"]); $i<$z; $i++){
				echo "<td>".$teams["td"][$i];
			}
		}
		echo "</table>";
	}
	?>
	
	</div>
</div>
</div>
</body>
</html>