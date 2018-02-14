<div class="s-bk-lf">
	<div class="acc-title">Вывод мультяшек</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb"><a href="/?menu=admin384&sel=users&sort=0" class="stn-sort">ID</a></td>
    <td align="center" class="m-tb"><a href="/?menu=admin384&sel=users&sort=1" class="stn-sort">Пользователь</a></td>
    <td align="center" class="m-tb"><a href="/?menu=admin384&sel=users&sort=2" class="stn-sort">IP</a></td>
	<td align="center" class="m-tb"><a href="/?menu=admin384&sel=users&sort=3" class="stn-sort">BAN</a></td>
	<td align="center" class="m-tb"><a href="/?menu=admin384&sel=users&sort=3" class="stn-sort">BAN IP's</a></td>
	<td align="center" class="m-tb"><a href="/?menu=admin384&sel=users&sort=3" class="stn-sort">HIDE</a></td>
  </tr>
<?
if(isset($_POST["banned"])){
	$db->Query("UPDATE db_users_a SET banned = '1' WHERE id = '".intval($_POST["banned"])."'");
	echo "<center><b>Пользователь ".($_POST["banned"] > 0 ? "забанен" : "разбанен")."</b></center><BR />";
}else
if(isset($_POST["banneds"])){
	$db->Query("SELECT ip FROM db_users_a WHERE id = '".intval($_POST["banneds"])."'");
	$ip=$db->FetchArray();
	$ip=$ip['ip'];
	$db->Query("UPDATE db_users_a SET banned = '1' WHERE ip = '$ip' ");
	echo "<center><b>Пользователи с таким ip ".($_POST["banneds"] > 0 ? "забанены" : "разбанен")."</b></center><BR />";
}else
if(isset($_POST["hide"])){
	$db->Query("UPDATE db_users_a SET hide = '1' WHERE id = '".intval($_POST["hide"])."' ");
	echo "<center><b>Пользователь скрыт</b></center><BR />";
}
	$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a WHERE ip IN (SELECT ip FROM db_users_a GROUP BY ip HAVING COUNT(*) > 1) AND banned = 0 AND hide = 0 ORDER BY ip ");
	while($data = $db->FetchArray()) {
?>
	<tr class="htt">
    <td align="center"><?=$data["id"]; ?></td>
    <td align="center"><a href="/?menu=admin384&sel=users&edit=<?=$data["id"]; ?>" class="stn"><?=$data["user"]; ?></a></td>
    <td align="center"><?=$data["uip"]; ?></td>
	<td align="center">
	<form action="" method="post">
	<input type="hidden" name="banned" value="<?=$data["id"]; ?>" />
	<input type="submit" value="BAN" />
	</form>
	<td align="center">
	<form action="" method="post">
	<input type="hidden" name="banneds" value="<?=$data["id"]; ?>" />
	<input type="submit" value="BAN ALL IP" />
	</form>
	</td>
	<td align="center">
	<form action="" method="post">
	<input type="hidden" name="hide" value="<?=$data["id"]; ?>" />
	<input type="submit" value="HIDE" />
	</form>
	</td>
  	</tr>
<?php
	}
?>
</table>
</div>
<div class='clr'></div>