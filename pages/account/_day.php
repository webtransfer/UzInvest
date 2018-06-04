<?PHP
$_OPTIMIZATION["title"] = "Mening hisobim - Divedent";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

# Bonus sozlamasi
$uzhost = 20; //Uzhost aksiya
$crypto = 100; //Crypto aksiyasi

$db->Query("SELECT a_t FROM db_users_b WHERE id = '$usid' LIMIT 1");
$aksiya = $db->FetchArray();

?>
<div class="s-bk-lf">
	<div class="acc-title">Kunlik divedentlar</div>
</div>
<div class="silver-bk">
<div class="clr"></div>	

<BR />

Kunlik divedentlarni har 24 soatda bir marta olishingiz mumkin. <BR />
Divedent ikkilamchi balansga <font color="blue"> so`m </font> miqdorida beriladi. <BR />
Bonus miqdori <font color="green"><b><?=$bonus_min;?> so`mdan</b></font> <font color="green"><b><?=$bonus_max;?> so`mgacha</b></font> <font color="blue"> tasodifiy</font> tarzda beriladi.
<BR /><BR />
<?PHP
$ddel = time() + 1*1*1; // Oraliq vaqt
$dadd = time(); // Hozirgi vaqt
$dabc = $dadd - 2592000; // Oxirgi 30 kun
$db->Query("SELECT COUNT(*) FROM db_bonus_list WHERE user_id = '$usid' AND date_del > '$dadd'");

$hide_form = false;

	if($db->FetchRow() == 0){
	
		# Bonus berish
		if(isset($_POST["bonus"])){
		
			$sum = $aksiya["at"] * $uzhost;
			
			# Updating user balance and stat
			$db->Query("UPDATE db_users_b SET money_b = money_b + '$sum' WHERE id = '$usid'");
			$db->Query("UPDATE db_users_b SET dailybonus = dailybonus + '$sum' WHERE id = '$usid'");
			# Updating bonus list
			
			
			$db->Query("INSERT INTO db_bonus_list (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");
			
			# Случайная очистка устаревших записей
			$db->Query("DELETE FROM db_bonus_list WHERE date_del < '$dabc'");
			
			echo "<center><font color = 'green'><b>Hisobingizga {$sum} so`m bonus qo`shildi.</b></font></center><BR />";
			
			$hide_form = true;
			
		}
			
			# Показывать или нет форму
			if(!$hide_form){
?>

<form action="" method="post">
<table width="330" border="0" align="center">
  <tr>
    <td align="center"></td>
  </tr>
  <tr>
    <td align="center"><input type="submit" name="bonus" value="Divedent olish" style="height: 30px; margin-top:10px;"></td>
  </tr>

</table>
</form>

<?PHP 

			}

	}else echo "<center><font color = 'red'><b>Siz so`nggi 24 soat ichida bonusni olgansiz</b></font></center><BR />"; ?>




<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="5" align="center"><h1>So`nggi 20ta bonus olganlar</h1></td>
    </tr>
  <tr>
    <td align="center" class="m-tb"><b>ID</b></td>
    <td align="center" class="m-tb"><b>Foydalanuvchi</b></td>
	<td align="center" class="m-tb"><b>Miqdori</b></td>
	<td align="center" class="m-tb"><b>Vaqt</b></td>
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_bonus_list ORDER BY id DESC LIMIT 20");
  
	if($db->NumRows() > 0){
  
  		while($bon = $db->FetchArray()){
		
		?>
		<tr class="htt">
    		<td align="center"><?=$bon["id"]; ?></td>
    		<td align="center"><b><?=$bon["user"]; ?></b></td>
    		<td align="center"><font color = 'green'><b><?=$bon["sum"]; ?></b></font></td>
			<td align="center"><?=date("d.m.Y",$bon["date_add"]); ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">Ro`yhat bo`sh</td></tr>'
  ?>

  
</table>

<div class="clr"></div>		
</div>
