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

<div class="silver-bk">
<center><h3><font color = "red">АКЦИЯ:</font> При первом пополнении баланса +50% в подарок.</h3> </center> 
Курс игровой валюты: 1 рубль (<?=$config->VAL; ?>) = <?=$sonfig_site["ser_per_wmr"]; ?> серебра.
<p>Ввод средств позволяет автоматически приобрести игровое серебро с помощью различных платежных 
систем: Yandex Деньги, банковских карт, SMS, терминалов, денежных переводов и т.д.</p>
<p>Оплата и зачисление серебра на баланс производится в автоматическом режиме.</p> 
<p>Введите сумму в РУБЛЯХ, которую вы хотите пополнить на баланс. <BR />
После пополнения вам будет зачислено серебро.<br /></p>
<b><font color = "red">Нет необходимой валюты?</font> Обменяй валюту <a href="http://5-kop.com/" target="_BLANK">ТУТ</a></b>
<BR />
<BR />
<?
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
	<input type="submit" name="m_process" value="Hisobingiz to`ldirish uchun to`lang!" />
</form>
</center>
<div class="clr"></div>		
</div>
<?PHP

return;
}
?>
<script type="text/javascript">
var min = 0.01;
var ser_pr = 100;
function calculate(st_q) {
    
	var sum_insert = parseFloat(st_q);
	$('#res_sum').html( (sum_insert * ser_pr).toFixed(0) );
	
	
}
	
</script>

<div id="error3"></div>
<form method="POST" action="">
    <input type="hidden" name="m" value="<?=$fk_merchant_id?>">
Summani kiriting [RUBL]:  
<input type="text" value="100" name="sum" size="7" id="psevdo" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)"> 

    Hisobingizga <span id="res_sum">13500</span> so`m tuh 
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

<div class="clr"></div>		
</div>

