<div class="s-bk-lf">
	<div class="acc-title">Hisobdan yechib olish</div>
</div>
<div class="silver-bk">
<BR />
<?PHP
$_OPTIMIZATION["title"] = "Hisobdan yechib olish";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();


$min_ser = $sonfig_site["min_pay"] * $sonfig_site["ser_per_wmr"];

$status_array = array( 0 => "Tekshiruvda", 1 => "To`landi", 2 => "Bekor qilindi");




# Список платежек
if(!isset($_GET["pay_id"])){

	if(isset($_POST["sys_pay"])){ Header("Location: /account/payment/".$_POST["sys_pay"]); return; }
	
	$db->Query("SELECT * FROM db_pay_systems ORDER BY id DESC");

	if($db->NumRows() == 0){ echo "<center>Нет платежных систем :(</center><BR /><div class='clr'></div></div>	"; return; }
	
	?>
	
	<form action="" method="POST">
	<center>O`zingizga mos to`lov tizimini tanlang. <BR />
	<font color="red">Hisobdan mablag`larni yechib olishda 2% xizmat haqi undiriladi!</font><BR /><BR />
		<select name="sys_pay">
		<?PHP
			
			while($data = $db->FetchArray()){
			
				?><option value="<?=$data["id"]; ?>"><?=$data["title"]; ?></option><?PHP
			
			}
			
		?>
		</select>
		<BR /><BR />
		<input type="submit" value="Tanlash" />
	</center>		
	</form>
	<div class="clr"></div>		
</div>	
	<?PHP
	
return;
}else{ 

	$pay_id = intval($_GET["pay_id"]);
	
	$db->Query("SELECT * FROM db_pay_systems WHERE id = '$pay_id'");
	
	if($db->NumRows() == 0){ echo "<center>Такой платежной системы нет в нашем проекте :(</center><BR /><div class='clr'></div></div>"; return; }
	
	$pdata = $db->FetchArray();
	$min_ser = $pdata["min_pay"] * $sonfig_site["ser_per_wme"];
	$ps = $pdata["title"];
	
	
	# Создание заявки на выплату
	if(isset($_POST["pp"])){
	
		$purse = strval(trim($func->TextClean($_POST["pp"])));
		$sum = intval($_POST["sum"]);
		
		if( strlen($purse) > 5){
		
			if( substr($purse, 0, 1) == $pdata["first_char"] ){
			
				if($min_ser <= $sum){
				



if($sum <= $user_data["money_p"]){




					
							# Проверяем на существующие заявки
							$db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$usid' AND status = 0");
							if($db->FetchRow() == 0){


						
							# Снимаем с пользователя
							$db->Query("UPDATE db_users_b SET money_p = money_p - '$sum' WHERE id = '$usid'");
							
							# Вставляем запись в выплаты
							$da = time();
							$dd = $da + 60*60*24*15;
							$sum_r = round($sum / $sonfig_site["ser_per_wme"], 2);
							$db->Query("INSERT INTO db_payment (user, user_id, purse, sum, serebro, pay_sys, date_add, date_del) 
							VALUES ('$usname','$usid','$purse','$sum_r','$sum','$ps','$da','$dd')");
							
							echo "<center><font color = 'green'><b>Ваша заявка отправлена в очередь на выполнение</b></font></center><BR />";
							
							}else echo "<center><font color = 'red'><b>У вас имеются необработанные заявки. Дождитесь их выполнения.</b></font></center><BR />";
						
					
					}else echo "<center><font color = 'red'><b>Вы указали больше, чем имеется на вашем счету</b></font></center><BR />";
				
				}else echo "<center><font color = 'red'><b>Минимальная сумма для вывода {$min_ser} серебра</b></font></center><BR />";
			
			}else echo "<center><font color = 'red'><b>Кошелек должен начинаться с ".$pdata["first_char"]."</b></font></center><BR />";
		
		}else echo "<center><font color = 'red'><b>Кошелек заполнен неверно</b></font></center><BR />";
		
	}
		
	
	
?>




<form action="" method="post">
<table width="99%" border="0" align="center">
  <tr>
    <td><font color="#000;">Hisob raqamingiz</font> [<?=$pdata["first_char"]; ?> bilan boshlanadi]<font color="#000;">:</font> </td>
	<td><input type="text" name="pp" size="15"/></td>
  </tr>
  <tr>
    <td><font color="#000;">Qancha yechmoqchisiz</font> [Eng kam summa: <?=$min_ser; ?>]<font color="#000;">:</font> </td>
	<td><input type="text" name="sum" id="sum" value="<?=$min_ser; ?>" size="15" onkeyup="PaymentSum();" /></td>
  </tr>
  <tr>
    <td><font color="#000;">Qabul qilasiz <?=$config->VAL; ?></font> [2% xizmat haqisiz]<font color="#000;">:</font> </td>
	<td>
	<input type="text" name="res" id="res_sum" value="0" size="15" disabled="disabled"/>
	<input type="hidden" name="per" id="ser_per" value="<?=$sonfig_site["ser_per_wme"]; ?>" disabled="disabled"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="swap" value="Hisobdan yechish" style="height: 30px; margin-top:10px;" /></td>
  </tr>
</table>
</form>
<script language="javascript">PaymentSum();</script>

<?PHP } ?>

<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="5" align="center"><h4>So`nggi qabul qilgan to`lovlaringiz tarixi</h4></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">So`m</td>
    <td align="center" class="m-tb">Rubl</td>
	<td align="center" class="m-tb">Hamyon</td>
	<td align="center" class="m-tb">Sana</td>
	<td align="center" class="m-tb">Holati</td>
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' ORDER BY id DESC LIMIT 10");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["serebro"]; ?></td>
    		<td align="center"><?=sprintf("%.2f",$ref["sum"]*0.97); ?> RUBL</td>
    		<td align="center"><?=$ref["purse"]; ?></td>
			<td align="center"><?=date("d.m.Y",$ref["date_add"]); ?></td>
    		<td align="center"><?=$status_array[$ref["status"]]; ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">Ma`lumotlar mavjud emas</td></tr>'
  ?>

  
</table><div class="clr"></div>		
</div>	
