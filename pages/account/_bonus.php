<?PHP
$_OPTIMIZATION["title"] = "Kunlik bonus";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];

# Настройки бонусов
$bonus_min = 10; //Minimal bonus
$bonus_max = 100; //Maksimal bonus

?>
	<div class="s-bk-lf">
	<div class="acc-title">Kunlik bonus</div>
</div>
<div class="silver-bk">
<div class="clr"></div> <br><center>
Bonus har 24 soatda bir marta beriladi.  <BR />
Bonus miqdori <font color="#2A8758"><b><?=$bonus_min;?> </b></font> so'mdan <font color="#2A8758"><b><?=$bonus_max;?></b></font> so'mgacha tasodifiy tarzda aniqlanadi.
<br>Reklama banneri ustiga bosganingizdan so'ng "BONUS OLISH" tugmasi chiqadi.</center>



	
<?PHP
$ddel = time() + 60*60*24; //Keyingi bonus vaqti
$dadd = time();
$dabc = $dadd - 2592000;
	
$db->Query("SELECT COUNT(*) FROM db_bonus_list WHERE user_id = '$usid' AND date_del > '$dadd'");

$hide_form = false;

	if($db->FetchRow() == 0){
	
		# Выдача бонуса
		if(isset($_POST["bonus"])){
		
			$sumrand = rand($bonus_min, rand($bonus_min, $bonus_max) );
			$sumbonus = $sumrand - 1;
			
			
			# Зачилсяем юзверю
			$db->Query("UPDATE db_users_b SET money_p = money_p + '$sumrand' WHERE id = '$usid'");
			
			# Вносим запись в список бонусов
			$db->Query("INSERT INTO db_bonus_list (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sumrand','$dadd','$ddel')");
			
			# Случайная очистка устаревших записей
			$db->Query("DELETE FROM db_bonus_list WHERE date_del < '$dadd'");
			
			echo "<div align='center' class='alert alert-success'>Sizga {$sumbonus} so'm miqdorida bonus berildi</div>";
			
			$hide_form = true;
			
		}
			
			# Показывать или нет форму
			if(!$hide_form){
?>

<center><br/>

<div class="column_3" id="hidden_link" onclick="document.all.hidden_link1.style.display='block';" style="width: 468px;display:yes">

<?php
include "_banlink.php";
?>
<br/>
</div>
<div class="column_3" id="hidden_link1" onclick="document.all.hidden_link2.style.display='block';" style="display:none"><br/>
<form action="" method="post"><input type="submit" name="bonus" value="Bonus Olish" class="btn btn-success"></form></div>
</center>


<?PHP 

			}

	}else {
	   $db->Query("SELECT * FROM db_bonus_list WHERE user_id = '$usid' AND date_del > '$dadd'");
$u_data = $db->FetchArray();
$time = $u_data['date_del'] - $dadd;
$hours = floor($time/3600);
floor($minutes =($time/3600 - $hours)*60);
$seconds = ceil(($minutes - floor($minutes))*60);
$min=ceil($minutes)-1;
	   ?>

<center style="margin: 5px 0;font-size: 18px;color: #f33;"><b id="bonus">Navbatdagi bonusni <?=json_encode($hours);echo ' soat  ';echo json_encode($min);echo ' daqiqa  '; echo json_encode($seconds);echo ' soniyadan  ';?> so'ng olishingiz mumkin</b><script>setInterval(function(){
$("#bonus").load("# #bonus"); }, 1000); </script></center>
        <?php
	}
?>

<h3 style="text-align:center">
So'nggi 20 ta bonus:
</h3>
<table class="table table-bordered" cellpadding='3' cellspacing='0' align="center" width="97%">  
<thead><tr>
	<td align="center" class="m-tb"><b>ID</b></td>
	<td align="center" class="m-tb"><b>Foydalanuvchi</b></td>
	<td align="center" class="m-tb"><b>Miqdori</b></td>
	<td align="center" class="m-tb"><b>Vaqti</b></td>
</tr></thead>
  <?PHP
  
  $db->Query("SELECT id, user, sum, date_add FROM db_bonus_list ORDER BY id DESC LIMIT 20");
  
	if($db->NumRows() > 0){
  
  		while($bon = $db->FetchArray()){
		
		?>
		
	<tr>
    <td align="center"><?=$bon["id"]; ?></td>
    <td align="center"><a href="/wall/<?=$bon["user"]; ?>"><?=$bon["user"]; ?></a></td>
    <td align="center"><?=$bon["sum"]; ?></td>
	<td align="center"><?=date("d.m.Y - H:i:s",$bon["date_add"]); ?></td>
  	</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">Qayd mavjud emas!</td></tr>'
  ?>

</table>
<div class="clr"></div>
</div>
