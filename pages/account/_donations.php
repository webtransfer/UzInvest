<?PHP
$_OPTIMIZATION["title"] = "Пожертвования";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid'");
$user_data = $db->FetchArray();
?>
<div class="s-bk-lf">
	<div class="acc-title">Proyektga yordam</div>
</div>
<div class="silver-bk">Siz istalgan miqdordagi <font color = 'blue'>mablag'larni</font> proyekt uchun ko'mak sifatida taqdim etishingiz mumkin.
<div class="clr"></div>
<BR />
<?PHP
# Пожертвование
if(isset($_POST["sum"])){

$sum = intval($_POST["sum"]);

	if($sum > 0){

		if($sum <= $user_data["money_b"]){

		# Снимаем с баланса
		$db->Query("UPDATE db_users_b SET money_b = money_b - '$sum' WHERE id = '$usid'");
		$db->Query("INSERT INTO db_donations (user, sum, date_add, date_del) VALUES ('".$_SESSION["user"]."','$sum','".time()."','".(time()+60*60*24*3)."')");
		$db->Query("UPDATE db_stats SET donations = donations + '$sum' WHERE id = '1'");
		$db->Query("UPDATE db_users_b SET donations = donations + '$sum' WHERE id = '$usid'");

		echo "<center><font color = 'blue'><b>Katta rahmat :)</b></font></center><BR />";

		}else echo "<center><font color = 'blue'><b>Balansingizdagi mablag' yetarli emas!</b></font></center><BR />";

	}else echo "<center><font color = 'blue'><b>Eng kam moliyaviy ko'mak miqdori 1 so'm</b></font></center><BR />";

}

?>
<form action="" method="post">
<table width="320" border="0" align="center">
  <tr>
    <td><b>Miqdori [so'm]:</b></td>
    <td align="center"><input type="text" name="sum" value="10" size="10"/></td>
  </tr>

  <tr>
    <td align="center" colspan="2"><input type="submit" value="Hadya etish" /></td>
  </tr>
</table>

</form>
<BR />
<BR />

<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="3" align="center"><h4>So'nggi 15 nafar ko'mak</h4></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">Foydalanuvchi</h3></td>
    <td align="center" class="m-tb">Miqdori [so'm]</h3></td>
	<td align="center" class="m-tb">Vaqt</h3></td>
  </tr>
  <?PHP

  $db->Query("SELECT * FROM db_donations ORDER BY id DESC LIMIT 15");

	if($db->NumRows() > 0){

  		while($ref = $db->FetchArray()){

		?>
		<tr class="htt">
    		<td align="center"><?=$ref["user"]; ?></td>
    		<td align="center"><?=$ref["sum"]; ?></td>
			<td align="center"><?=date("d.m.Y - H:i:s",$ref["date_add"]); ?></td>
  		</tr>
		<?PHP

		}

	}else echo '<tr><td align="center" colspan="3">В последние время пожертвований не было</td></tr>'
  ?>


</table>

<div class="clr"></div>
</div>




