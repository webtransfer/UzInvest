<?php
$_OPTIMIZATION["title"] = "Аккаунт - Камень-Ножницы-Бумага";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

$knbItem[1] = 'Камень';
$knbItem[2] = 'Ножницы';
$knbItem[3] = 'Бумага';
if(isset($_POST['del'])) {
	$del=intval($_POST['del']);
	$db->Query("SELECT * FROM `db_games_knb` WHERE `id` = ".$del);
	$row = $db->FetchArray();
	$db->Query("UPDATE `db_users_b` SET `money_b` = `money_b` + ".$row["summa"]." WHERE `user`  = '".$row["login"]."'");
	$db->Query("DELETE FROM `db_games_knb` WHERE `id` = ".$del);
	$deleted=1;
}
if(isset($_POST['del2'])) {
	$del=intval($_POST['del2']);
	$db->Query("DELETE FROM `db_games_knb` WHERE `id` = ".$del);
	$deleted=1;
}
?>
<div class="s-bk-lf">
	<div class="acc-title">Вывод текущих игр</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?php
$db->Query("SELECT * FROM `db_games_knb` WHERE `last`='0' ORDER BY `id`");
if($deleted) {
	echo '<font color="red">Удалено!</font><br/>';
}
if($db->NumRows() == 0){
	echo '<ul><li>Игр нет</li></ul>';
}
else
{
?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
<?php
	echo '<tr>';
	echo '<td class="m-tb" align="center">Сумма</td>';
	echo '<td class="m-tb" align="center">от пользователя</td>';
	echo '<td class="m-tb" align="center">Удалить</td>';
	echo '</tr>';
	while($row = $db->FetchArray()){
	echo "<div id='play-".$row["id"]."'>
	<tr class='htt'>
	<td align='center'>".$row["summa"]."</td>
	<td align='center'>".htmlspecialchars($row["login"])."</td>
	<td align='center'>
	<form action='' method='post'>
	<input type='hidden' name='del' value=".$row['id']." />
	<input type='submit' value='Удалить' />
	</form>
	</td></tr></div>";
	}
	echo '</table>';
}
?>
</div>
<br/><br/>
<div class="s-bk-lf">
	<div class="acc-title">Вывод предыдущих</div>
</div>
<div class="silver-bk"><div class="clr"></div>
<?php
$db->Query("SELECT * FROM `db_games_knb` WHERE `last`='1' ORDER BY `id`");
if($db->NumRows() == 0){
	echo '<ul><li>Игр нет</li></ul>';
}
else
{
?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
<?php
	echo '<tr>';
	echo '<td class="m-tb" align="center">Сумма</td>';
	echo '<td class="m-tb" align="center">От пользователя</td>';
	echo '<td class="m-tb" align="center">Статус</td>';
	echo '<td class="m-tb" align="center">Удалить</td>';
	echo '</tr>';
	while($row = $db->FetchArray()){
	echo "<div id='play-".$row["id"]."'>
	<tr class='htt'>
	<td align='center'>".$row["summa"]."</td>
	<td align='center'>".htmlspecialchars($row["login"])."</td><td align='center'>";
	if($row['win']==1) {
		echo '<font color="red">Поражение</font>';
	}
	else if($row['win']==2) {
		echo '<font color="blue">Ничья</font>';
	}
	else if($row['win']==3) {
		echo '<font color="green">Победа</font>';
	}
	echo "</td><td align='center'>
	<form action='' method='post'>
	<input type='hidden' name='del2' value=".$row['id']." />
	<input type='submit' value='Удалить' />
	</form>
	</td></tr></div>";
	}
	echo '</table>';
}
?>
</div>