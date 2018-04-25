<?php
$_OPTIMIZATION["title"] = "Аккаунт - Камень-Ножницы-Бумага";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

$knbItem[1] = 'Камень';
$knbItem[2] = 'Ножницы';
$knbItem[3] = 'Бумага';
?>
<div class="s-bk-lf">
	<div class="acc-title">Камень-Ножницы-Бумага</div>
</div>
<div class="silver-bk"> <ul>
<li>Минимальная ставка 10 кредитов, максимальной ставки нет.</li></ul>
	<table class="table1" align="center">
  <tr class="title">
    <td>
		<form action="/account/knb/" method="post">
		Ставка: <input name="summa" type="text" value="<?php echo isset($_POST['summa'])?htmlspecialchars($_POST['summa']):'100'; ?>" size="5" /> | Предмет: 
		<?php
			$r = rand(1, 3);
		?>
		<select name="item">
			<option value="1" <?php if($r == 1) echo 'selected="selected"'; ?>>Камень</option>
			<option value="2" <?php if($r == 2) echo 'selected="selected"'; ?>>Ножницы</option>
			<option value="3" <?php if($r == 3) echo 'selected="selected"'; ?>>Бумага</option>
		</select>
		<input class="green" name="play_sub" type="submit" value="Создать" />
		<input type="button" value="Обновить" onclick="location.reload();"/>
		</form>
	</td>
  </tr>
  </table>
  
<?php
if(isset($_POST["play_sub"])){
	$db->Query('SELECT `money_b` FROM `db_users_b` WHERE id = '.$usid);
	$u_balance = $db->FetchRow();
	
	$summa = round($_POST["summa"], 2);

		$err = NULL;
		if($summa < 10)
			$err .= "<li>Минимальная ставка 10</li>";
		if($_POST["item"] > 3 OR $_POST["item"] <1)
			$_POST["item"] = rand(1,3);
		if($summa > $u_balance)
			$err .= "<li>На балансе недостаточно средств</li>";
			
		if($err == NULL){
			$db->Query('UPDATE `db_users_b` SET `money_b` = `money_b` - '.$summa.' WHERE id = '.$usid);
			$db->Query("INSERT INTO `db_games_knb` (`summa`, `item`, `login`, `win`, `dat`,`last`) VALUES (".$summa.", ".intval($_POST['item']).", '".$uname."', '0', '".date("Y-m-d H:i:s")."','0')");
			header('location: /account/knb');
		}else{
			echo "<ul class='error'>".$err."</ul>";
		}
	}
	else if(isset($_POST['canc'])) {
		$db->Query("SELECT * FROM `db_games_knb` WHERE `id` = ".intval($_POST["id"])." AND `login`='$uname' AND `last`='0' ");
		if($db->NumRows() > 0){
			$tmp = $db->FetchArray();
			$db->Query("DELETE FROM `db_games_knb` WHERE `id` = ".intval($_POST["id"]));
			$db->Query('UPDATE `db_users_b` SET `money_b` = `money_b` + '.$tmp['summa'].' WHERE id = '.$usid);
		}
	}
?>			
<script type="text/javascript">
$(function(){

$('#imgitems img').hover(function(){
	$(this).attr('src', '/img/items/rooms-' + $(this).attr('alt') + '-1.png');
}, function(){
	$(this).attr('src', '/img/items/rooms-' + $(this).attr('alt') + '.png');
});


$('#imgitems img').click(function(){
$('input[name="item"]').val($(this).attr('alt'));
$('form.play'+$(this).attr('class')).submit();
});

$('#play').submit(function(e){
//отменяем стандартное действие при отправке формы
e.preventDefault();
//берем из формы метод передачи данных
var m_method=$(this).attr('method');
//получаем адрес скрипта на сервере, куда нужно отправить форму
var m_action=$(this).attr('action');
//получаем данные, введенные пользователем в формате input1=value1&input2=value2...,
//то есть в стандартном формате передачи данных формы
var m_data=$(this).serialize();
$.ajax({
type: m_method,
url: m_action,
data: m_data,
success: function(result){
$('#test_form').html(result);
}
});
});
});
</script>
<div id="test_form"></div>
<style type="text/css">
.table1 {border-collapse: collapse; border-spacing: 0px; margin: 0px; padding: 0 5px; width:100%; text-align:center;}
.table1 td{padding:6px; border-bottom: 1px solid #98C1D7; text-align:center;}
.table1 .title td{border-bottom: 2px solid #98C1D7; border-top: 2px solid #98C1D7; font-weight:700;}
.table1 tr:nth-child(2n+1){background: #F4F4F4;}
</style>

<?php
$db->Query("SELECT * FROM `db_games_knb` WHERE `last`='0' ORDER BY `id`");

if($db->NumRows() == 0){
	echo '<ul><li>Игр нет</li></ul>';
}
else
{
	echo '<table class="table1" align="center">';
	echo '<tr>';
	echo '<td>Сумма</td>';
	echo '<td>от пользователя</td>';
	echo '<td>&nbsp;</td>';
	echo '</tr>';
	while($row = $db->FetchArray()){
	echo "<div id='play-".$row["id"]."'>
	<tr>
	<td>".$row["summa"]."</td>
	<td>".htmlspecialchars($row["login"])."</td>";
	if($row['login'] == $uname) {
		echo "<td><font color='red'><form action='' method='post'>
		<input name='id' type='hidden' value='".$row["id"]."' />
		<input name='canc' type='submit' value='Отменить' /></form></font></td>";
	}
	else
	{
		echo "<td><form class='play-".$row["id"]."' id='play' action='/ajax/game_play.php' method='post'>
		<input name='id' type='hidden' value='".$row["id"]."' />
		<input id='item' name='item' type='hidden' value='' />
		<div id='imgitems'> 
			<img  class='-".$row["id"]."' src='/img/items/rooms-1.png' alt='1' />
			<img  class='-".$row["id"]."' src='/img/items/rooms-2.png' alt='2' />
			<img  class='-".$row["id"]."' src='/img/items/rooms-3.png' alt='3' />
		</div>
	</form></td>";
	}
	}
	echo '</tr></div></table>';
}
$db->Query("SELECT * FROM `db_games_knb` WHERE (`login`='$uname' OR `gamer`='$uname') AND `win` > 0 ORDER BY `id` DESC");
if($db->NumRows() > 0) {
	echo '<br/><b>Ваши ставки:</b><br/><br/>';
	echo '<table class="table1" align="center">';
	echo '<tr>';
	echo '<td>Сумма</td>';
	echo '<td>Статус</td>';
	echo '<td>Противник</td>';
	echo '</tr>';
	while($row = $db->FetchArray()){
		echo '<tr>';
		echo '<td>'.$row['summa'].'</td>';
		echo '<td>';
		if($row['login'] == $uname) {
			if($row['win']==1) {
				echo '<font color="red">Поражение</font>';
			}
			else if($row['win']==2) {
				echo '<font color="blue">Ничья</font>';
			}
			else if($row['win']==3) {
				echo '<font color="green">Победа</font>';
			}
			echo '</td>';
			echo '<td>'.$row['gamer'].'</td>';
		}
		else if($row['gamer'] == $uname) {
			if($row['win']==3) {
				echo '<font color="red">Поражение</font>';
			}
			else if($row['win']==2) {
				echo '<font color="blue">Ничья</font>';
			}
			else if($row['win']==1) {
				echo '<font color="green">Победа</font>';
			}
			echo '</td>';
			echo '<td>'.$row['login'].'</td>';
		}
		echo '</tr>';
	}
	echo '</table>';
}
?>
</div>