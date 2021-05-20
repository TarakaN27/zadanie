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
input {
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
    width: 222px;
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

<form action="result.php" method="post">
	<h1>Банкомат</h1>
	<label>Номинал в наличии</label>
	<input type="text" name="nominal" required placeholder="5, 10, 20, 50, 100, 200, 500">
	<label>Ваша сумма:</label>
	<input type="text" required name="sum">
	<input type="submit" values="Отправить">
</form>

<div class="block">
	<span>Ответ:</span>
	<div id="result"></div>
</div>

<script>
$(function() {
      $('form').submit(function(e) {
        var $form = $(this);
        $.ajax({
          type: $form.attr('method'),
          url: $form.attr('action'),
          data: $form.serialize()
        }).done(function(e) {
          console.log('success');
		  $("#result").html(e);
        }).fail(function() {
          console.log('fail');
        });
        e.preventDefault(); 
      });
    });
</script>
</body>
</html>