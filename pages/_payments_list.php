<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "So`nggi to`lovlar";
$_OPTIMIZATION["description"] = "So`nggi to`lovlar ro`yhati";
$_OPTIMIZATION["keywords"] = "So`nggi to`lovlar";
?>
<div class="s-bk-lf">
	<div class="acc-title">Hisobdan pul yechib olishlar tarixi</div>
</div>
<div class="silver-bk"><div class="clr"></div>	

<center><h1><b>So`nggi 20ta to`lovlar</b></h1></center>
<BR />
<?PHP

$dt = time() - 60*60*24*90;

$db->Query("SELECT * FROM db_payment WHERE status = '1' AND date_add > '$dt' ORDER BY date_add DESC LIMIT 20");



if($db->NumRows() > 0){

$all_pay = 0;
$all_pay_sum = 0;

?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="m-tb">Foydalanuvchi</td>
    
	<td align="center" width="50" class="m-tb">Miqdori</td>
	<td align="center" width="50" class="m-tb">Hisob raqami</td>
	<td align="center" width="50" class="m-tb">Vaqti</td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
	$all_pay ++;
	$all_pay_sum += $data["sum"];
	?>
	<tr class="htt">
	<td align="center"><?=$data["user"]; ?></td>
	
    <td align="center"><?=sprintf("%.2f",$data["sum"]*150); ?> so`m</td>
	<td align="center"><?=$data["pay_sys"]; ?>: <?=substr($data["purse"],0,-6); ?><font color = 'red'>XXX</font><?=substr($data["purse"],-3); ?></td>
	<td align="center"><?=date("d.m.Y H:i:s",$data["date_add"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>
	<tr bgcolor="#efefef">
		<td align="center" width="50" class="m-tb" colspan=2>Jami to`lovlar: <?=$all_pay; ?> dona.</td>
		<td align="center" width="50" class="m-tb" colspan=2>Jami to`lovlar miqdori: <?=sprintf("%.2f",$all_pay_sum)*150; ?> so`m</td>
	</tr>
</table>
<BR />
<?PHP


}else echo "<center><b>Выплат нет :(</b></center><BR />";


?>
</div>
<div class="clr"></div>	