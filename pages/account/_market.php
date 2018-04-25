<?PHP
$_OPTIMIZATION["title"] = "Hisob - Bank";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

?>

<div class="s-bk-lf">
	<div class="acc-title">BANK</div>
</div>
<div class="silver-bk" align="center">Bank orqali siz <font color="blue">Tanga</font>laringizni <font color="green">So'm</font>ga almashtirishingiz mumkin. Almashtirishdan tushgan mablag' "Asosiy hisob" va "Ikkilamchi hisob" orasida mos ravishda   <?=100-$sonfig_site["percent_sell"]; ?>%  va <?=$sonfig_site["percent_sell"]; ?>% nisbatda taqsimlanadi.<br /><br />
Bank kursi: <b><font color="green"><?=$sonfig_site["items_per_coin"]; ?> Tanga = 1 <font color="blue">So'm</font>.</font></b>
<div class="clr"></div><BR />
<?PHP
# Продажа
if(isset($_POST["sell"])){

$all_items = $user_data["a_b"] + $user_data["b_b"] + $user_data["c_b"] + $user_data["d_b"] + $user_data["e_b"] + $user_data["f_b"] + $user_data["g_b"];

	if($all_items > 0){
	
		$money_add = $func->SellItems($all_items, $sonfig_site["items_per_coin"]);
		
		$tomat_b = $user_data["a_b"];
		$straw_b = $user_data["b_b"];
		$pump_b = $user_data["c_b"];
		$pean_b = $user_data["d_b"];
		$peas_b = $user_data["e_b"];
		$peach_b = $user_data["f_b"];
		$watermelon_b = $user_data["g_b"];
		
		$money_b = ( (100 - $sonfig_site["percent_sell"]) / 100) * $money_add;
		$money_p = ( ($sonfig_site["percent_sell"]) / 100) * $money_add;
		
		# Обновляем юзверя
		$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_b', money_p = money_p + '$money_p', a_b = 0, b_b = 0, c_b = 0, d_b = 0, e_b = 0, f_b = 0, g_b = 0   
		WHERE id = '$usid'");
		
		$da = time();
		$dd = $da + 60*60*24*15;
		
		# Вставляем запись в статистику
		$db->Query("INSERT INTO db_sell_items (user, user_id, a_s, b_s, c_s, d_s, e_s, f_s, g_s, amount, all_sell, date_add, date_del) VALUES 
		('$usname','$usid','$tomat_b','$straw_b','$pump_b','$pean_b','$peas_b','$peach_b','$watermelon_b','$money_add','$all_items','$da','$dd')");
		
		echo "<center><font color = 'green'><b>Siz {$all_items} tangani {$money_add} So'mga muvaffaqiyatli almashtirdingiz</b></font></center><BR />";
		
		$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
		$user_data = $db->FetchArray();
		
	}else echo "<center><font color = 'red'><b>Sizda almashtirish uchun tangalar mavjud emas :(</b></font></center><BR />";

}
?>	       
<form action="" method="post">
<table width="480" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" align="center" valign="middle">&nbsp;</td>
    <td height="30" align="center" valign="middle"><h1><strong>Sizdagi tangalar</strong></h1></font></td>
    <td height="30" align="center" valign="middle"><h1><strong>Hisobingizga qo'shiladi [So'm]</strong></h1><td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>
    <td align="center" valign="middle"><font color="green"><b><?=$user_data["a_b"]; ?></b></font> ШТ.</td>
    <td align="center" valign="middle"><font color="green"><b><?=$func->SellItems($user_data["a_b"], $sonfig_site["items_per_coin"]); ?></b></font></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>
    <td align="center" valign="middle"><font color="green"><b><?=$user_data["b_b"]; ?></b></font> ШТ.</td>
    <td align="center" valign="middle"><font color="green"><b><?=$func->SellItems($user_data["b_b"], $sonfig_site["items_per_coin"]); ?></b></font></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>
    <td align="center" valign="middle"><font color="green"><b><?=$user_data["c_b"]; ?></b></font> ШТ.</td>
    <td align="center" valign="middle"><font color="green"><b><?=$func->SellItems($user_data["c_b"], $sonfig_site["items_per_coin"]); ?></b></font></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></td>
    <td align="center" valign="middle"><font color="green"><b><?=$user_data["d_b"]; ?></b></font> ШТ.</td>
    <td align="center" valign="middle"><font color="green"><b><?=$func->SellItems($user_data["d_b"], $sonfig_site["items_per_coin"]); ?></b></font></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></td>
    <td align="center" valign="middle"><font color="green"><b><?=$user_data["f_b"]; ?></b></font> ШТ.</td>
    <td align="center" valign="middle"><font color="green"><b><?=$func->SellItems($user_data["f_b"], $sonfig_site["items_per_coin"]); ?></b></font></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>
    <td align="center" valign="middle"><font color="green"><b><?=$user_data["e_b"]; ?></b></font> ШТ.</td>
    <td align="center" valign="middle"><font color="green"><b><?=$func->SellItems($user_data["e_b"], $sonfig_site["items_per_coin"]); ?></b></font></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></td>
    <td align="center" valign="middle"><font color="green"><b><?=$user_data["g_b"]; ?></b></font> ШТ.</td>
    <td align="center" valign="middle"><font color="green"><b><?=$func->SellItems($user_data["g_b"], $sonfig_site["items_per_coin"]); ?></b></font></td>
  </tr>
  
  <tr>
    <td align="center" valign="middle" colspan="3">
	<BR />
	<input type="submit" name="sell" value="Barchasini almashtirish" class="button_0" style="height: 30px;"></td>
  </tr>
  
</table>
</form>

</div>
								
<div class="clr"></div>	
