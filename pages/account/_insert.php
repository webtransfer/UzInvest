<div class="s-bk-lf">
	<div class="acc-title">Hisobni to`ldirish</div>
</div>

<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Пополнение баланса";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
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
var ser_pr = 145;
function calculate(st_q) {
    
	var sum_insert = parseFloat(st_q);
	$('#res_sum').html( (sum_insert * ser_pr).toFixed(0) );
	
	
}
	
</script>
<div class="silver-bkpay">

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
	<input type="submit" name="m_process" value="Оплатить и получить кредиты" />
</form>
</center>	
</div>
<?PHP

return;
}
?>


<div id="error3"></div>
<h2>Ilk marotaba hisobni to`ldirish uchun<font color=red>+18%</font><font color=blue>* beriladi!</font></h2>
<form method="POST" action="">
Summani kiriting [RUBL]:  
<input type="text" value="100" name="sum" size="7" id="psevdo" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)"> 

    <BR />Hisobingiz <font color="red"><b><span id="res_sum"> 13500 </span></b></font><font color="blue"> so`mga to`ldiriladi.</font>
	<BR /><BR />
    <input type="submit" id="submit" value="Пополнить баланс" >
</form>
<script type="text/javascript">
calculate(100);
</script>
<center>


</center>
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
<center>
<form method=GET action="http://www.free-kassa.ru/merchant/cash.php">
    <input type="hidden" name="m" value="<?=$merchant_id?>"/>
    <input type="hidden" name="oa" id="oa" value="<?=$sum?>"/>
    <input type="hidden" name="s" id="s" value="<?=$descript?>"/>
    <input type="hidden" name="o" value="<?=$order_id?>"/>
    <input type="submit" id="submit" value="Оплатить и получить кредиты"/>
</form>
</center>
</div>
<?


return;
}
?>

<h2>Создание запроса на пополнение баланса</h2>

<form method='POST' action="">
Введите сумму [<?=$config->VAL; ?>]: 
    <input type="text" name="sum" id="sum" onchange="calculate(this.value)" onkeyup="calculate(this.value)" onfocusout="calculate(this.value)" onactivate="calculate(this.value)" ondeactivate="calculate(this.value)" value="100"/>

    Вы получите <span id="res_sum">10000</span><font color="blue"><b>C</b></font>
	<BR /><BR />
    <input type="submit" id="submit" value="Пополнить баланс"/>
</form>

<?
break;
default:
echo '<center>
<h2 style="border-bottom: solid 1px #987; padding-bottom: 10px;"><font color="#66aa44">Hisobni to`ldirish usulini tanlang: <br><font color="red"> (ilk to`lov uchun +5% bonus)</font></font></h2>
<BR>
<table style="border-collapse: collapse; width: 100%; margin-left: 0px; margin-top: 0px; margin-right: 5px; margin-bottom: 5px;" width="" align=""><tbody><tr align="center"><td><a href="/account/insertwm"><img src="/img/insert/wm.png" alt=""></a><br></td><td><a href="/account/insert/payeer"><img src="/img/insert/yamoney.png" alt=""></a><br></td><td><a href="/account/wm_insert"><img src="/img/insert/qiwi.png" alt=""></a><br></td></tr><tr align="center"><td colspan="1"><a href="/account/insert/payeer"><img src="/img/insert/liqpay.png"></a></td><td colspan="1"><a href="/account/insert/payeer"><img src="/img/insert/pm.png" alt=""></a></td><td colspan="1"><p><a href="/account/insert/payeer"><center><img src="/img/insert/teminal.png"></center></a></p></td></tr><tr align="center"><td colspan="1"><a href="/account/insert/payeer"><img src="/img/insert/cards.png"></a></td><td colspan="1"><a href="/account/insert/payeer"><img src="/img/insert/mobile.png" alt=""></a></td><td colspan="1"><a href="/account/insert/payeer"><img src="/img/insert/payeer.png" alt=""></a></td></tr></tbody></table><br><tr>
<td><center>
</table>';
}
?>

</div>
<div class="clr"></div>
</div>


