<div class="s-bk-lf">
	<div class="acc-title">Заказ выплаты</div>
</div>
<div class="silver-bk">
<BR />
<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Заказ выплаты";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

$status_array = array( 0 => "Проверяется", 1 => "Выплачивается", 2 => "Отменена", 3 => "Выплачен");


# Список платежек
if(!isset($_GET["pay_id"])){

	if(isset($_POST["sys_pay"])){ Header("Location: /account/payment/".$_POST["sys_pay"]); return; }
	
	
	$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
	if (!$payeer->isAuth())
	{
		echo '<center><font color = "red">Выплаты временно недоступны! Обратитесь к администратору!</font></center><div class="clr"></div></div>'; return;
	}
	
	# Платежные системы
	$arPs = $payeer->getPaySystems();
	$systems_array = $arPs["list"];
	?>
	<form action="" method="POST">
	<center>Укажите более подходящую для Вас платежную систему из списка имеющихся. <BR /><BR />
		<select name="sys_pay" style="padding:3px;">
		<?PHP
			
			
			foreach($systems_array as $key => $value){
			
				?><option value="<?=$value["id"]; ?>"><?=iconv('utf-8', 'windows-1251',$value["name"]); ?> [Валюты: <?=implode(", ",$value["currencies"])?>]</option><?PHP
			
			}
			
		?>
		</select>
		<BR /><BR />
		<input type="submit" value="Выбрать" />
	</center>		
	</form>
	<div class="clr"></div></div>	
	<?PHP
	
return;
}else{ 

	$pay_id = intval($_GET["pay_id"]);
	
	$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
	if (!$payeer->isAuth())
	{
		echo '<center><font color = "red">Выплаты временно недоступны! Обратитесь к администратору!</font></center><div class="clr"></div></div>'; return;
	}
	
	$currentSystem = $payeer->PaySystemData($pay_id);
	
	if(!$currentSystem) {echo '<center><font color = "red">Внутренняя ошибка! Платежная система не найдена, обратитесь к администратору</font></center><div class="clr"></div></div>'; return;}
	
	$current_sys_name = iconv('utf-8', 'windows-1251',$currentSystem["name"]);
?>

<center><b><font color = "green"><?=$current_sys_name; ?></font></b></center><BR />
<?PHP

if(count($currentSystem["gate_commission"]) > 0){
	
	if($currentSystem["gate_commission_min"]["RUB"] > 1 OR $currentSystem["gate_commission_min"]["USD"] > 1 OR $currentSystem["gate_commission_min"]["EUR"] > 1){
		
		echo '<center><font color = "red">Выплаты временно недоступны на указанную платежную систему</font></center><div class="clr"></div></div>';
		
		return;
	
	}
	
	echo "Комиссия ".iconv('utf-8', 'windows-1251',$currentSystem["name"])." составляет: <BR />";
	
	$rub_min_str = "<BR />";
	if(isset($currentSystem["gate_commission"]["RUB"])) echo "RUB - ".$currentSystem["gate_commission"]["RUB"].$rub_min_str; 
	
	$usd_min_str = "<BR />";
	if(isset($currentSystem["gate_commission"]["USD"])) echo "USD - ".$currentSystem["gate_commission"]["USD"].$usd_min_str; 
	
	$eur_min_str = "<BR />";
	if(isset($currentSystem["gate_commission"]["EUR"])) echo "EUR - ".$currentSystem["gate_commission"]["EUR"].$eur_min_str; 
	
	
}
	
	# Заглушки на минимальные выплаты
	function MinPaySystemRet($pay_id){
	
		switch($pay_id){
			
			case "184": return array("RUB" => "60", "USD" => "2", "EUR" => "2"); break; // WebMoney
			
			default: return array("RUB" => "2", "USD" => "0.2", "EUR" => "0.2"); break;
		
		}
	
	}
	
	echo "Комиссия фермы за выплату на данную платежную систему ".$currentSystem["commission_site_percent"]."%<BR />";

	$config_insert = $currentSystem["r_fields"]["ACCOUNT_NUMBER"];

	$array = array("RUB" => $sonfig_site["ser_per_wmr"], "USD" => $sonfig_site["ser_per_wmz"], "EUR" => $sonfig_site["ser_per_wme"]);
	
	foreach($currentSystem["currencies"] as $key => $value) echo "<font color='red'>{$array[$value]} серебра = 1{$value}</font><BR />";
	
	
	function ComissionWm($sum, $com_payee, $com_payysys){
		
		$a = round( ($com_payee/100)*$sum ,2);
		$b = round( (str_replace("%","",$com_payysys)/100)*$sum ,2);
		return $a+$b;
		
	}
	
	
	function ComissionWmReverce($sum, $com_payee, $com_payysys){
		
		$ret = round($sum/(1+($com_payee/100)+($com_payysys/100)),2);
		return $sum-$ret;
	}
	
	$mp_ar_f = MinPaySystemRet($pay_id);
	# Минималка для WMR
	$min_p_wmr = $mp_ar_f["RUB"] + ComissionWm($mp_ar_f["RUB"], $currentSystem["commission_site_percent"], $currentSystem["gate_commission"]["RUB"]);
	$min_p_wmz = $mp_ar_f["USD"] + ComissionWm($mp_ar_f["USD"], $currentSystem["commission_site_percent"], $currentSystem["gate_commission"]["USD"]);
	$min_p_wme = $mp_ar_f["EUR"] + ComissionWm($mp_ar_f["EUR"], $currentSystem["commission_site_percent"], $currentSystem["gate_commission"]["EUR"]);
	
	$min_ser_array = array( 
							"RUB" => ($min_p_wmr * $sonfig_site["ser_per_wmr"]),
							"USD" => ($min_p_wmz * $sonfig_site["ser_per_wmz"]),
							"EUR" => ($min_p_wme * $sonfig_site["ser_per_wme"]));
	
	function ExistVal($data, $current){
		
		$current = strtoupper($current);
		
		if($current == "RUB" OR $current == "USD" OR $current == "EUR"){
		
			return (in_array($current, $data)) ? $current : false;
		
		}else return false;
	
	}
	
	function SumPaymentSet($data, $current_val, $summa){
		
		$current = strtoupper($current_val);
		$sum = intval($summa);
		
		if($current == "RUB") return round( ($summa / $data["ser_per_wmr"]), 2);
		if($current == "USD") return round( ($summa / $data["ser_per_wmz"]), 2);
		if($current == "EUR") return round( ($summa / $data["ser_per_wme"]), 2);
		
	
	}
	
?>
<BR />

<?PHP

	# Заносим выплату
	if(isset($_POST["purse"])){
		
		
		
		$purse = (ereg(substr( substr($config_insert["reg_expr"], 1),0,-1), $_POST["purse"])) ? $_POST["purse"] : false;
		$sum = intval($_POST["sum"]);
		$val = ExistVal($currentSystem["currencies"], strval($_POST["val_type"]) );
		$min_serebra = $min_ser_array[$val];
		
		if($purse !== false){
		
			if($val !== false){
			
				if($sum >= $min_serebra){
				
					if($sum <= $user_data["money_p"]){
						
								# Проверяем на существующие заявки
								$db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$usid' AND (status = '0' OR status = '1')");
								if($db->FetchRow() == 0){
							
								# Снимаем с пользователя
								$db->Query("UPDATE db_users_b SET money_p = money_p - '$sum' WHERE id = '$usid'");
								
								# Вставляем запись в выплаты
								$da = time();
								$dd = $da + 60*60*24*15;
								
								$sum_money = SumPaymentSet($sonfig_site, $val, $sum);
								$comission = ComissionWmReverce($sum_money, $currentSystem["commission_site_percent"], $currentSystem["gate_commission"][$val]);
								
								$db->Query("INSERT INTO db_payment (user, user_id, purse, sum, comission, valuta, serebro, pay_sys, pay_sys_id, date_add) 
								VALUES ('$usname','$usid','$purse','$sum_money','$comission','$val', '$sum','$current_sys_name','$pay_id','".time()."')");
								
								
								echo "<center><font color = 'green'><b>Ваша заявка отправлена в очередь на выполнение</b></font></center><BR />";
								
								}else echo "<center><font color = 'red'><b>У вас имеются необработанные заявки. Дождитесь их выполнения.</b></font></center><BR />";
							
						
						}else echo "<center><font color = 'red'><b>Вы указали больше, чем имеется на вашем счету</b></font></center><BR />";
				
				}else echo "<center><b><font color = 'red'>Минимальная сумма для выплаты в этой платежной системе {$min_serebra} серебра!</font></b></center><BR />";
			
			}else echo "<center><b><font color = 'red'>Неверно указана валюта, у этой платежной системы нет такой валюты на вывод!</font></b></center><BR />";
		
		}else echo "<center><b><font color = 'red'>Платежный реквизит указан неверно! Смотрите образец!</font></b></center><BR />";
		
	}
?>

<form action="" method="post">
<table width="99%" border="0" align="center">
  <tr>
    <td><font color="#000;"><?=iconv('utf-8', 'windows-1251', $config_insert["name"]); ?> [Пример: <?=iconv('utf-8', 'windows-1251', $config_insert["example"]);?>]</font>: </td>
	<td><input type="text" name="purse" size="15"/></td>
  </tr>
  <tr>
    <td><font color="#000;">Валюта</font><font color="#000;">:</font> </td>
	<td>
		<select name="val_type" id="val_type" style="padding:3px;" onchange="SetVal();">
		<?PHP
			
			foreach($currentSystem["currencies"] as $key => $value) echo "<option value='{$value}'>$value</option>";
		
		?>
		</select>
	</td>
  </tr>
  <tr>
    <td><font color="#000;">Отдаете серебро для вывода</font> [Мин. <span id="res_min"></span>]<font color="#000;">:</font> </td>
	<td><input type="text" name="sum" id="sum" value="10000" size="15" onkeyup="PaymentSum();" /></td>
  </tr>
  <tr>
    <td><font color="#000;">Получаете <span id="res_val"></span></font> [Без учета комиссий]<font color="#000;">:</font> </td>
	<td>
	<input type="text" name="res" id="res_sum" value="0" size="15" disabled="disabled"/>
	<input type="hidden" name="per" id="RUB" value="<?=$sonfig_site["ser_per_wmr"]; ?>" disabled="disabled"/>
	<input type="hidden" name="per" id="USD" value="<?=$sonfig_site["ser_per_wmz"]; ?>" disabled="disabled"/>
	<input type="hidden" name="per" id="EUR" value="<?=$sonfig_site["ser_per_wme"]; ?>" disabled="disabled"/>
	<input type="hidden" name="per" id="min_sum_RUB" value="<?=$min_p_wmr; ?>" disabled="disabled"/>
	<input type="hidden" name="per" id="min_sum_USD" value="<?=$min_p_wmz; ?>" disabled="disabled"/>
	<input type="hidden" name="per" id="min_sum_EUR" value="<?=$min_p_wme; ?>" disabled="disabled"/>
	</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="swap" value="Заказать выплату" style="height: 30px; margin-top:10px;" /></td>
  </tr>
</table>
</form>
<script language="javascript">PaymentSum(); SetVal();</script>

<?PHP } ?>

<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="5" align="center"><h4>Последние 10 выплат</h4></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">Серебро</td>
    <td align="center" class="m-tb">Получаете</td>
	<td align="center" class="m-tb">Кошелек</td>
	<td align="center" class="m-tb">Дата</td>
	<td align="center" class="m-tb">Статус</td>
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' ORDER BY id DESC LIMIT 20");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["serebro"]; ?></td>
    		<td align="center"><?=sprintf("%.2f",$ref["sum"] - $ref["comission"]); ?> <?=$ref["valuta"]; ?></td>
    		<td align="center"><?=$ref["purse"]; ?></td>
			<td align="center"><?=date("d.m.Y",$ref["date_add"]); ?></td>
    		<td align="center"><?=$status_array[$ref["status"]]; ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">Нет записей</td></tr>'
  ?>

  
</table><div class="clr"></div>		
</div>	
