<div class="s-bk-lf">
	<div class="acc-title">Список выплат на Yandex</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?


$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
$lim = $num_p * 100;

function colorSum($sum){

	if($sum >= 100) return "red";
	return "#000000";
}

if(isset($_POST['pay_here']) && is_numeric($_POST['pay_here'])) {
	$payed=$_POST['pay_here'];
	$db->Query("SELECT * FROM `db_request_payment_ya` WHERE `id` = '$payed' AND `status` = '0' LIMIT 1 ");
        if($db->NumRows() > 0) {
	     $db->Query("UPDATE `db_request_payment_ya` SET `status`='3' WHERE `id`='$payed' ");
        }
}
else if(isset($_POST['canc'])) {
	$payid = intval($_POST['canc']);
	$db->Query("SELECT * FROM `db_request_payment_ya` WHERE `id` = '$payid' AND `status` = '0' LIMIT 1 ");
	if($db->NumRows() > 0){
		$paydata = $db->FetchArray();
		$usid = $paydata['user_id'];
		$db->Query("SELECT * FROM db_payment WHERE id = '$paydata[payment_id]' ");
		$tmpresid = $db->FetchArray();
		$sum = $tmpresid['serebro'];
		$db->Query("UPDATE db_users_b SET money_p = money_p + '$sum' WHERE id = '$usid'");
		$db->Query("UPDATE  db_request_payment_ya SET status = '2' WHERE id = '$payid'");
		$paymentid = $paydata['payment_id'];
		$db->Query("UPDATE  db_payment SET status = '2' WHERE id = '$paymentid'");
	}
}

$db->Query("SELECT * FROM db_request_payment_ya ORDER BY id DESC LIMIT {$lim}, 100");

if($db->NumRows() > 0){

?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="m-tb">Пользователь</td>
	<td align="center" width="50" class="m-tb">Сумма</td>
	<td align="center" width="50" class="m-tb">Кошелек</td>
	<td align="center" width="50" class="m-tb">Одобрить</td>
	<td align="center" width="50" class="m-tb">Отменить</td>
	<td align="center" width="100" class="m-tb">Дата</td>
  </tr>


<?PHP

	while($data = $db->FetchArray()){
	
	?>
	<tr class="htt">
	<td align="center"><a href="/?menu=admin384&sel=users&edit=<?=$data["user_id"]; ?>"<?php if($data['gardener']==1) {echo ' style="color: red;"';}  ?> class="stn"><?=$data["user"]; ?></a></td>
    <td align="center"><font color="<?=colorSum($data["sum"]); ?>"><?=sprintf("%.2f",$data["sum"]); ?> RUB</font></td>
	<td align="center"><?=$data["purse"]; ?></td>
	<td align="center">
	<?php
		if($data["status"]==0) {
	?>
	<form action="" method="post">
	<input type="hidden" name="pay_here" value="<?=$data["id"]; ?>" />
	<input type="submit" value="Одобрить" />
	</form>
	<?php
	}
	else if($data["status"]==3) {
		echo "<center><font color = 'green'><b>Одобрено!</b></font></center><BR />";
	}
	else if($data["status"]==2) {
		echo "<center><font color = 'red'><b>Отменена!</b></font></center><BR />";
	}
	?>
	</td>
	<td align="center">
	<?php
		if($data["status"]==0) {
	?>
	<form action="" method="post">
	<input type="hidden" name="canc" value="<?=$data["id"]; ?>" />
	<input type="submit" value="Отменить" />
	</form>
	<?php
	}
	else if($data["status"]==3) {
		echo "<center><font color = 'green'><b>Одобрено!</b></font></center><BR />";
	}
	else if($data["status"]==2) {
		echo "<center><font color = 'red'><b>Отменена!</b></font></center><BR />";
	}
	?>
	</td>
	<td align="center"><?=date("d.m H:i:s",$data["date"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<BR />
<?PHP


}else echo "<center><b>На данной странице нет записей</b></center><BR />";

	
$db->Query("SELECT COUNT(*) FROM  db_request_payment_wm");
$all_pages = $db->FetchRow();

	if($all_pages > 100){
	
	$sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
	
	$nav = new navigator;
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
	
	echo "<BR /><center>".$nav->Navigation(10, $page, ceil($all_pages / 100), "/?menu=admin384&sel=payments_req_ya&page="), "</center>";
	
	}
?>
</div><div class='clr'></div>
