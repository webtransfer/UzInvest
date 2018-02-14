<div class="s-bk-lf">
	<div class="acc-title">Заказ выплаты</div>
</div>
<div class="silver-bk">

<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Заказ выплаты";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_users_a WHERE id = '$usid' LIMIT 1");
$user_dataa = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

$status_array = array( 0 => "Проверяется", 1 => "Выплачивается", 2 => "Отменена", 3 => "Выплачено");

# Минималка серебром!
$minPay = 0; 

?>
<center><a href="/account/paymentz">Вернутся на страницу Вывода средств</a></center>
<center><h1><span style="font-size: 17pt;"><b>Выплата на PAYEER.COM</b></span></h1></center> <BR />
<b>Выплаты на PAYEER.COM осуществляются без комисии.<br/>
Минималка для выплаты на Payeer.COM 0<font color="blue"><b>C</b></font>.<br/>
<font color=red>Выплаты производятся автоматически</font>.</b><BR />
<b>Ссылки на учебные материалы:</b><BR />
 - <a href="http://wm-payeer.ru/" target="_blank">О системе PAYEER</a> <BR />
 - <a href="http://wm-payeer.ru/index/sozdanie_scheta/0-5" target="_blank">Создание счета в PAYEER</a> <BR />
 - <a href="http://wm-payeer.ru/index/vyvod_sredstv/0-6" target="_blank">Вывод средств из PAYEER</a> <BR /><BR />

<center><b>Заказ выплаты:</b></center><BR />

<?PHP
	
	function ViewPurse($purse){
		
		if( substr($purse,0,1) != "P" ) return false;
		if( !ereg("^[0-9]{7}$", substr($purse,1)) ) return false;	
		return $purse;
	}
	
	
	# Заносим выплату
	if(isset($_POST["purse"])){
		
		$purse = ViewPurse($_POST["purse"]);
		$sum = intval($_POST["sum"]);
		$plat_passs = intval($_POST["plat_pass"]);
		$plat_pass = md5($plat_passs);
		$val = "RUB";
		
		if($plat_pass == $user_dataa['plat_pass']) {
		
			if($purse !== false){
				
					if($sum >= $minPay){
					
						if($sum <= $user_data["money_p"]){
							
							# Проверяем на существующие заявки
							$db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$usid' AND (status = '0' OR status = '1')");
							if($db->FetchRow() == 0){
									
									
								### Делаем выплату ###	
								$payeer = new rfs_payeer($config->AccountNumber, $config->apiId, $config->apiKey);
								if ($payeer->isAuth())
								{
									
									$arBalance = $payeer->getBalance();
									if($arBalance["auth_error"] == 0)
									{
										
										$sum_pay = round( ($sum / $sonfig_site["ser_per_wmr"]), 2);
										
										$balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];
										if( ($balance) >= ($sum_pay+0)){
										
										
										
										$arTransfer = $payeer->transfer(array(
										'curIn' => 'RUB', // счет списания
										'sum' => $sum_pay, // сумма получения
										'curOut' => 'RUB', // валюта получения
										'to' => $purse, // получатель (email)
										//'to' => '+71112223344',  // получатель (телефон)
										//'to' => 'P1000000',  // получатель (номер счета)
										'comment' => iconv('windows-1251', 'utf-8', "Выплата пользователю {$usname} с проекта Money-Ferma.RU")
										//'anonim' => 'Y', // анонимный перевод
										//'protect' => 'Y', // протекция сделки
										//'protectPeriod' => '3', // период протекции (от 1 до 30 дней)
										//'protectCode' => '12345', // код протекции
										));
										
											if (!empty($arTransfer["historyId"]))
											{	
											
											
												# Снимаем с пользователя
												$db->Query("UPDATE db_users_b SET money_p = money_p - '$sum' WHERE id = '$usid'");
												
												# Вставляем запись в выплаты
												$da = time();
												$dd = $da + 60*60*24*15;
												
												$ppid = $arTransfer["historyId"];
												
												$db->Query("INSERT INTO db_payment (user, user_id, purse, sum, valuta, serebro, payment_id, date_add, status) 
												VALUES ('$usname','$usid','$purse','$sum_pay','RUB', '$sum','$ppid','".time()."', '3')");
												
												$db->Query("UPDATE db_users_b SET payment_sum = payment_sum + '$sum_pay' WHERE id = '$usid'");
												$db->Query("UPDATE db_stats SET all_payments = all_payments + '$sum_pay' WHERE id = '1'");
												
												echo "<center><font color = 'green'><b>Выплачено! Пожалуйста загрузите скрин выплаты на форум MMGP <a href=http://mmgp.ru/showthread.php?t=236605>http://mmgp.ru/showthread.php?t=236605</a>.</b></font></center><BR />";
												
											}
											else
											{
											
												echo "<center><font color = 'red'><b>Внутреняя ошибка - сообщите о ней администратору!</b></font></center><BR />";	
											
											}
										
										
										}else echo "<center><font color = 'red'><b>Внутреняя ошибка - пожалуйста повторите!</b></font></center><BR />";
										
									}else echo "<center><font color = 'red'><b>Не удалось выплатить! Попробуйте позже</b></font></center><BR />";
									
								}else echo "<center><font color = 'red'><b>Не удалось выплатить! Попробуйте позже</b></font></center><BR />";
								
									
							}else echo "<center><font color = 'red'><b>У вас имеются необработанные заявки. Дождитесь их выполнения.</b></font></center><BR />";
								
							
						}else echo "<center><font color = 'red'><b>Вы указали больше, чем имеется на вашем счету</b></font></center><BR />";
					
					}else echo "<center><b><font color = 'red'>Минимальная сумма для выплаты составляет {$minPay} кредитов!</font></b></center><BR />";
			
			}else echo "<center><b><font color = 'red'>Кошелек указан неверно! Смотрите образец!</font></b></center><BR />";
		}else echo "<center><b><font color = 'red'>Платежный пароль указан не верно!</font></b></center><BR />";
	}
?>
<?php
if($user_dataa['plat_pass'] == 0) {
echo "<center><b><font color = 'red'>Укажите платежный пароль в профиле!</font></b></center><BR />";
} else {

?>
<form action="" method="post">
<table width="99%" border="0" align="center">
  <tr>
    <td><font color="#000;">Введите кошелек [Пример: P1112457]</font>: </td>
	<td><input type="text" name="purse" size="15"/></td>
  </tr>
  <tr>
    <td><font color="#000;">Отдаете кредиты для вывода</font> [Мин. 0]<font color="#000;">:</font> </td>
	<td><input type="text" name="sum" id="sum" value="0" size="15" onkeyup="PaymentSum();" /></td>
  </tr>
  <tr>
    <td><font color="#000;">Получаете [RUR]<span id="res_val"></span></font><font color="#000;">:</font> </td>
	<td>
	<input type="text" name="res" id="res_sum" value="0" size="15" disabled="disabled"/>
	<input type="hidden" name="per" id="RUB" value="<?=$sonfig_site["ser_per_wmr"]; ?>" disabled="disabled"/>
	<input type="hidden" name="per" id="min_sum_RUB" value="0.5" disabled="disabled"/>
	<input type="hidden" name="val_type" id="val_type" value="RUB" />
	</td>
  </tr>
  
  <tr>
    <td><font color="#000;">Платежный пароль[указывается в профиле]</font>: </td>
	<td><input type="text" name="plat_pass" size="15"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="swap" value="Заказать выплату" style="height: 30px; margin-top:10px;" /></td>
  </tr>
</table>
</form>
<?php } ?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="5" align="center"><h1>Ваши последние выплаты</h1></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">Сумма</td>
	<td align="center" class="m-tb">Игрок</td>
	<td align="center" class="m-tb">Кошелек</td>
	<td align="center" class="m-tb">Статус</td>
  </tr>
  <?PHP
  
  $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' ORDER BY id DESC LIMIT 20");
  
	if($db->NumRows() > 0){
  
  		while($ref = $db->FetchArray()){
		
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["sum"]; ?> RUB</td>
			<td align="center"><?=$ref["user"]; ?></td>
			<td align="center"><?=$ref["purse"]; ?></td>
    		<td align="center"><?=$status_array[$ref["status"]]; ?></td>
  		</tr>
		<?PHP
		
		}
  
	}else echo '<tr><td align="center" colspan="5">Нет записей</td></tr>'
  
  ?>

  
  
</table>

<div class="clr"></div>		
</div>