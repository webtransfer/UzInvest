<?PHP
$_OPTIMIZATION["title"] = "Конкурс рефералов";
$_OPTIMIZATION["description"] = "Конкурс рефералов";
$_OPTIMIZATION["keywords"] = "Конкурс, конкурс рефералов";
?>
<div class="s-bk-lf">
	<div class="acc-title">Конкурс рефералов</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<center><a href="/competition" class="stn">Текущие конкурсы</a> || <a href="/competition/list" class="stn">Завершенные</a></center><BR />
<?PHP

# Список конкурсов
if(isset($_GET["list"])){


	# Список пользователей
	$db->Query("SELECT * FROM db_competition WHERE status > 0");
	if($db->NumRows() > 0){
	
	?>
	
	
	<?PHP
		while($data = $db->FetchArray()){
		
		?>
			<table width="99%" border="0" align="center">
			<tr bgcolor="#efefef">
				<td align="center" width="75" class="m-tb">ID</td>
				<td align="center" class="m-tb">Начат</td>
				<td align="center" class="m-tb">Завершен</td>
				<td align="center" class="m-tb">Фонд</td>
			</tr>
			<tr class="htt" >
				<td align="center"><?=$data["id"]; ?></td>
				<td align="center"><?=date("d.m.Y", $data["date_add"]); ?></td>
				<td align="center"><?=date("d.m.Y", $data["date_end"]); ?></td>
				<td align="center"><?=$data["1m"]+$data["2m"]+$data["3m"]; ?> RUB</td>
		 	</tr>
			<tr bgcolor="#efefef">
				<td align="center" width="75" class="m-tb">Статус</td>
				<td align="center" class="m-tb">1 место / приз</td>
				<td align="center" class="m-tb">2 место / приз</td>
				<td align="center" class="m-tb">3 место / приз</td>
			</tr>
			<tr class="htt" >
				<td align="center"><?=($data["status"] > 1) ? "Отменен" : "Завершен"; ?></td>
				<td align="center"><?=$data["user_1"]; ?> / <?=$data["1m"]; ?></td>
				<td align="center"><?=$data["user_2"]; ?> / <?=$data["2m"]; ?></td>
				<td align="center"><?=$data["user_3"]; ?> / <?=$data["3m"]; ?></td>
		 	</tr>
			</table>
		<BR /><BR />
		<?PHP
		}

	}else echo "<center><b><font color = 'red'>Нет завершенных конкурсов</font></b></center><BR />";


?>
</div>
<div class="clr"></div>	
<?PHP

return;
}


$db->Query("SELECT * FROM db_competition WHERE status = 0 LIMIT 1");
if($db->NumRows() == 1){
$comp = $db->FetchArray();	
	?>
<b>Конкурс рефералов № <?=$comp["id"]; ?> с общим призовым фондом <?=$comp["1m"]+$comp["2m"]+$comp["3m"]; ?> RUB<BR /><BR />
Старт конкурса: <?=date("d.m.Y в H:i:s", $comp["date_add"]); ?> <BR />Завершение: <?=date("d.m.Y в H:i:s", $comp["date_end"]); ?>
<BR /><BR />
<u>Призовые места:</u><BR />
<font color="red">1 - <?=$comp["1m"]; ?> RUB</font> <BR />
<font color="red">2 - <?=$comp["2m"]; ?> RUB</font> <BR />
<font color="red">3 - <?=$comp["3m"]; ?> RUB</font> <BR /><BR />
<b><font color=red>Призы выдаются на счет для покупка.</font></b><br>
В конкурсе учитываются только активные рефералы, которые зарегистрировались после запуска конкурса. <BR ><BR />
Баллы даются за пополнение рефералами 1руб = 1балл<BR ><BR />
<font color=red>Минималное количество баллов для участие: 20 баллов!</font><BR ><BR />
</b>
	<?PHP
	
	# Список пользователей
	$db->Query("SELECT * FROM db_competition_users ORDER BY points DESC LIMIT 10");
	if($db->NumRows() > 0){
	
	?>
	<center><h1><b>Таблица лидеров</b></h1></center>
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" width="75" class="m-tb"><b>Позиция</b></td>
    <td align="center" class="m-tb"><b>Пользователь</b></td>
    <td align="center" class="m-tb"><b>Баллов</b></td>
	<td align="center" class="m-tb"><b>Приз</b></td>
  </tr>
	<?PHP
		$position = 1;
		while($data = $db->FetchArray()){
		
		?>
			<tr class="htt" >
				<td align="center" width="75"><?=$position; ?></td>
				<td align="center"><b><?=$data["user"]; ?></b></td>
				<td align="center"><b><font color="green"><?=sprintf("%.0f",$data["points"]); ?></font></b></td>
				<td align="center"><font color="red"><?=(intval($comp["{$position}m"]) > 0) ? $comp["{$position}m"]." RUB" : "-" ?></font></td>
		 	</tr>
		<?PHP
		$position++;
		}
	
	?>
</table>
<BR />
	<?PHP
	
	}else echo "<center><b><font color = 'red'>Нет участников в конкурсе</font></b></center><BR />";

}else echo "<center><b><font color = 'red'>В данный момент конкурс не проводится</font></b></center><BR />";

?>
</div>
<div class="clr"></div>	