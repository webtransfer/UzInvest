<div class="s-bk-lf">
	<div class="acc-title">Пополнение баланса</div>
</div>

<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Пополнение баланса";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

/*
if($_SESSION["user_id"] != 1){
echo "<center><b><font color = red>Технические работы</font></b></center>";
return;
}
*/
?>
<script type="text/javascript">
var min = 0.01;
var ser_pr = 100;
function calculate(st_q) {
    
	var sum_insert = parseFloat(st_q);
	$('#res_sum').html( (sum_insert * ser_pr).toFixed(0) );
	
	
}
	
</script>
<div class="silver-bk">
Курс игровой валюты: 1 рубль (<?=$config->VAL; ?>) = <?=$sonfig_site["ser_per_wmr"]; ?> серебра.
<p>Ввод средств позволяет автоматически приобрести игровое серебро с помощью различных платежных 
систем: Yandex Деньги, Payeer, Qiwi банковских карт, SMS, терминалов, денежных переводов и т.д.</p>
<p>Оплата и зачисление серебра на баланс производится в автоматическом режиме.</p> 
<p>Введите сумму в РУБЛЯХ, которую вы хотите пополнить на баланс. <BR />
После пополнения вам будет зачислено серебро.<br /></p>
<BR />
<BR />
<?
switch($_GET['action']){
    case 'payeer':
/// db_payeer_insert
if(isset($_POST["sum"])){

$sum = round(floatval($_POST["sum"]),2);


# Заносим в БД
$db->Query("INSERT INTO db_payeer_insert (user_id, user, sum, date_add) VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$sum','".time()."')");

$desc = base64_encode($_SERVER["HTTP_HOST"]." - USER ".$_SESSION["user"]);
$m_shop = $config->shopID;
$m_orderid = $db->LastInsert();
$m_amount = number_format($sum, 2, ".", "");
$m_curr = "RUB";
$m_desc = $desc;
$m_key = $config->secretW;

$arHash = array(
 $m_shop,
 $m_orderid,
 $m_amount,
 $m_curr,
 $m_desc,
 $m_key
);
$sign = strtoupper(hash('sha256', implode(":", $arHash)));

?>
<center>
<form method="GET" action="//payeer.com/api/merchant/m.php">
	<input type="hidden" name="m_shop" value="<?=$config->shopID; ?>">
	<input type="hidden" name="m_orderid" value="<?=$m_orderid; ?>">
	<input type="hidden" name="m_amount" value="<?=number_format($sum, 2, ".", "")?>">
	<input type="hidden" name="m_curr" value="RUB">
	<input type="hidden" name="m_desc" value="<?=$desc; ?>">
	<input type="hidden" name="m_sign" value="<?=$sign; ?>">
	<input type="submit" name="m_process" value="Оплатить и получить серебро" />
</form>
</center>
<div class="clr"></div>		
</div>
<?PHP

return;
}
?>


<div id="error3"></div>
<form method="POST" action="">
Введите сумму [<?=$config->VAL; ?>]:  
<input type="text" value="100" name="sum" size="7" id="psevdo" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)"> 

    Вы получите <span id="res_sum">10000</span> серебра
	<BR /><BR />
    <input type="submit" id="submit" value="Пополнить баланс" >
</form>
<script type="text/javascript">
calculate(100);
</script>
<center>

<BR />

</center>
<BR /><BR />
<?
break;
case 'free':
if(isset($_POST["sum"])){

$sum = intval($_POST["sum"]);

# Заносим в БД
$db->Query("INSERT INTO db_free_insert (user_id, user, sum, date_add) VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$sum','".time()."')");

$merchant_id = $config->fk_merchant_id;
$order_id = $db->LastInsert();
$out_amount=$sum;
$merchant_key= $config->fk_merchant_key;
$descript=md5($merchant_id.":".$out_amount.":".$merchant_key.":".$order_id);
?>
<form method=GET action="http://www.free-kassa.ru/merchant/cash.php">
    <input type="hidden" name="m" value="<?=$merchant_id?>"/>
    <input type="hidden" name="oa" id="oa" value="<?=$sum?>"/>
    <input type="hidden" name="s" id="s" value="<?=$descript?>"/>
    <input type="hidden" name="o" value="<?=$order_id?>"/>
    <input type="submit" id="submit" value="Оплатить и получить серебро"/>
</form>
</div>
<?


return;
}
?>

<h2>Оплата через free-kassa.ru</h2>

<form method='POST' action="">
Введите сумму [<?=$config->VAL; ?>]: 
    <input type="text" name="sum" id="sum" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)" value="100"/>

    Вы получите <span id="res_sum">10000</span> серебра
	<BR /><BR />
    <input type="submit" id="submit" value="Пополнить баланс"/>
</form>
<?
break;
default:
echo '<center><h2 style="border-bottom: solid 1px #987; padding-bottom: 10px;"><font color="#66aa44">Выберите способ Пополнения баланса.</font></h2>
<table>
<tr>
<td>
 <div style="width:250px;" class="silver-bk"><h3><img src="/img/logo_payeer.png" /><br><small><font color="#333333">Payeer, <font color=red>Яндекс.Деньги</font>, Perfect Money, <font color=red>Liqpay</font>, <font color=red>Сбербанк</font>, Альфа-Банк, ВТБ24, Русский Стандарт, Связной Банк, Промсвязьбанк, Банк24.ру, ТКС Банк, ПримСоцБанк, Росбанк, Газпромбанк и т.д</small>...
<br><a href="/account/insert/payeer">Перейти к оплате</a></font></h3></div>
</td>

<td>
 <div style="width:250px;" class="silver-bk"><h3><img src="/img/llogo_free.png" /><br><small><font color="#333333">QIWI, Яндекс.Деньги, Мтс, Билайн, Мегафон, Cash4wm, liqpay, Perfect Money, OKpay, Единый кошелек, <font color=red>Visa, MasterCard,</font> Сбербанк Онл@йн, ВТБ24, Связной банк, <font color=red>Терминалы RUR</font></small>...
<br><a href="/account/insert/free-kassa">Перейти к оплате</a></font></h3></div>
</td>
</tr>
</table></center>';
}
?>
<div class="clr"></div>		
</div>

