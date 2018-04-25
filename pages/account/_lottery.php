<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Лотерея";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

# Настройки лотерея
$amount_lottery = 100; // Стоимость лотерейного билета
$num_bil = 5; // Количество билетов

?>
<div class="s-bk-lf">
	<div class="acc-title">Lotereya</div>
</div>
<div class="silver-bk">

<?PHP

# список предыдущих лотерей
if(isset($_GET["winners"])){ ?>

<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="6" align="center"><h4>Tugallangan lotereya natijalari</h4></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">№</td>
    <td align="center" class="m-tb">G'olib-1<BR />[Chipta]</td>
	<td align="center" class="m-tb">G'olib<BR />[Chipta]</td>
	<td align="center" class="m-tb">G'olib<BR />[Chipta]</td>
	<td align="center" class="m-tb">Bank</td>
	<td align="center" class="m-tb">Vaqt</td>
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_lottery_winners ORDER BY id DESC");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["id"]; ?></td>
			<td align="center"><?=$ref["user_a"]; ?><BR />Chipta: <?=$ref["bil_a"]; ?></td>
			<td align="center"><?=$ref["user_b"]; ?><BR />Chipta: <?=$ref["bil_b"]; ?></td>
			<td align="center"><?=$ref["user_c"]; ?><BR />Chipta: <?=$ref["bil_c"]; ?></td>
			<td align="center"><?=$ref["bank"]; ?></td>
			<td align="center"><?=date("d.m.Y H:i:s",$ref["date_add"]); ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="6">Нет записей</td></tr>'
  ?>

  
</table>

<div class="clr"></div></div>
<?PHP return; } ?>

<b>Qoida:</b> <br><div align="center">Jami <?=$num_bil; ?> dona lotereya chiptasi sotiladi. Barcha chiptalar sotilgach, omadli chipta egalari aniqlanadi. Tizim tasodifiy [random] tarzda 3 nafar omadli chiptani tanlaydi va yutuqlarni egalariga beradi. <BR />
1-o'rin - Jami bankning 45% qismi [<?=($amount_lottery * $num_bil) * 0.45; ?><font color="blue"><b> So'm</b></font>]. <BR />
2-o'rin - Jami bankning 30% qismi [<?=($amount_lottery * $num_bil) * 0.30; ?><font color="blue"><b> So'm</b></font>]. <BR />
3-o'rin - Jami bankning 15% qismi [<?=($amount_lottery * $num_bil) * 0.15; ?><font color="blue"><b> So'm</b></font>]. <BR />
Bankning qolgan 10% qismi tizim xarajatlari uchun sarflanadi.
<BR />
<u>Chipta narxi = <?=$amount_lottery; ?><font color="blue"><b> so'm</b></font></u>.
</div><BR /><BR />

<div class="s-bk-lf">
	<div class="acc-title">
<a href="/account/lottery/winners">Tugallangan o'yinlar natijalari</a></div></div>
<BR />


<?PHP


	if(isset($_POST["set_lottery"], $_POST["hash"]) AND $_SESSION["lot_hash"] == $_POST["hash"]){
	
		$db->Query("SELECT money_b FROM db_users_b WHERE id = '{$usid}' LIMIT 1");
		if($db->FetchRow() >= $amount_lottery){
			
			$db->Query("SELECT * FROM db_lottery WHERE user_id = '{$usid}' LIMIT 1");
			if(!$db->FetchArray())
			{
			$db->Query("UPDATE db_users_b SET money_b = money_b - '$amount_lottery' WHERE id = '{$usid}'");
			$db->Query("INSERT INTO db_lottery (user_id, user, date_add) VALUE ('$usid','$uname','".time()."')");
			$lid = $db->LastInsert();
			
			if( $lid >= $num_bil){
			
				# Розыгрываем призы
				while(true){
				
					$winner_a = rand(1, $num_bil);
					$winner_b = rand(1, $num_bil);
					$winner_c = rand(1, $num_bil);
					
					if($winner_a != $winner_b AND $winner_b != $winner_c AND $winner_c != $winner_a) break;
					
				}
				
				# Пользователь 1
				$db->Query("SELECT user FROM db_lottery WHERE id = '$winner_a'");
				$user_a = $db->FetchRow();
				
				# Пользователь 2
				$db->Query("SELECT user FROM db_lottery WHERE id = '$winner_b'");
				$user_b = $db->FetchRow();
				
				# Пользователь 3
				$db->Query("SELECT user FROM db_lottery WHERE id = '$winner_c'");
				$user_c = $db->FetchRow();
				
				# чистим таблицу
				$db->Query("TRUNCATE TABLE db_lottery");
				
				# Вставляем запись о победителях
				$all_bank = ($num_bil * $amount_lottery);
				$db->Query("INSERT INTO db_lottery_winners (user_a, bil_a, user_b, bil_b, user_c, bil_c, bank, date_add) 
				VALUES ('$user_a','$winner_a','$user_b','$winner_b','$user_c','$winner_c','$all_bank','".time()."')");
				
				# Обновляем средства пользователям
				# 1 место
				$money_a = $all_bank * 0.45;
				$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_a' WHERE user = '$user_a'");
				
				# 2 место
				$money_b = $all_bank * 0.30;
				$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_b' WHERE user = '$user_b'");
				
				# 3 место
				$money_c = $all_bank * 0.15;
				$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_c' WHERE user = '$user_c'");
				
				echo "<center><b><font color='green'>Lotereya o`ynaldi</font></b></center><BR />";
				
			}else echo "<center><b><font color='green'>Lotereya chiptasini muvaffaqiyatli sotib oldingiz!</font></b></center><BR />";
			
		}else echo "<center><b><font color='red'>Bittadan ortiq chipta olish mumkin emas!</font></b></center><BR />";
		}else echo "<center><b><font color='red'>Chipta olishga yetarli mablag' mavjud emas!</font></b></center><BR />";
		
		
	}

?>


<center>
<?PHP
$_SESSION["lot_hash"] = rand(1, 9999999);
?>
<form action="" method="post">
<input type="submit" name="set_lottery" value="Lotereya chiptasi olish" style="padding:7px;" />
<input type="hidden" name="hash" value="<?=$_SESSION["lot_hash"]; ?>" />
</form>
</center>


<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="5" align="center"><h1>Sotilgan chiptalar</h1></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">№ Chipta raqami</td>
    <td align="center" class="m-tb">Foydalanuvchi</td>
	<td align="center" class="m-tb">Sotilgan vaqti</td>
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_lottery ORDER BY id DESC");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["id"]; ?></td>
			<td align="center"><?=$ref["user"]; ?></td>
			<td align="center"><?=date("d.m.Y H:i:s",$ref["date_add"]); ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="3">Qatnashchilar mavjud emas!</td></tr>'
  ?>

  
</table><div class="clr"></div>	


</div>