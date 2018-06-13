<div class="s-bk-lf">
	<div class="acc-title1">Aksiyalar birjasi</div>
</div>

<div class="silver-bk"><div class="clr"></div>
<p><font color="black">WEBTRANSFER XK aksiyalari real biznesga yo`naltirilgan sarmoya hisoblanadi.
Aksiyalarni sotib olish uchun kamida 10'000 so`m sarmoya kiritishingiz kerak.
Bizda qiyin grafiklar va tushunarsiz shartnomalar yo`q.
O'zingiz egalik qilayotgan aksiyalardan daromad olishga shoshiling.
<br>Birjada turli loyihalarning aksiyalari qo'yiladi. Har bir aksiya sizga real daromad keltiradi va siz bemalol daromadni yechib olishingiz mumkin.  Birjada mavjud bo'lsa, istalgan miqdorda aksiya sotib olishingiz mumkin hamda ular muddati tugagach (har bir aksiya uchun alohida muddat belgilangan) daromad keltirishni to`xtatadi .

</font></p><br>

                               </div>
                               
                               
<br>
<?PHP
$_OPTIMIZATION["title"] = "Hisobim - Birja";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT money_b, a_t, b_t, g_t, last_sbor FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

# Покупка нового дерева
if(isset($_POST["item"])){

$array_items = array(1 => "a_t", 2 => "b_t", 3 => "c_t", 4 => "d_t", 5 => "e_t", 6 => "f_t", 7 => "g_t");
$array_name = array(1 => "UZHOST", 2 => "CRYPTO", 3 => "UZCHANGE", 4 => "Помидор", 5 => "Картофель", 6 => "Тыква", 7 => "FAST");
$item = intval($_POST["item"]);
$citem = $array_items[$item];
$amount = intval($_POST['amount']);

	if(strlen($citem) >= 3){
		
		# Проверяем средства пользователя
		if($amount > 0 && $amount <= 1) {
		$need_money = $sonfig_site["amount_".$citem]*$amount;
		if($need_money <= $user_data["money_b"]){
		
			if($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > ( time() - 60*60*24*1) ){
				
				$to_referer = $need_money * 0.1;
				# Добавляем дерево и списываем деньги
				$db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + $amount,  
				last_sbor = IF(last_sbor > 0, last_sbor, '".time()."') WHERE id = '$usid'");
				$titem = "s_".substr($citem,0,1);
				$ttime = time()+60*60*24*1;
				
				# Вносим запись о покупке
				$db->Query("INSERT INTO db_stats_btree (user_id, user, tree_name, amount, date_add, date_del) 
				VALUES ('$usid','$usname','".$array_name[$item]."','$need_money','".time()."','".(time()+60*60*24*15)."')");
				
				$life_time->AddItem($usid,$citem);
				echo "<center><font color = 'green'><b>Siz $amount dona aksiyani muvaffaqiyatli sotib oldingiz</b></font></center><BR />";
				
				$db->Query("SELECT money_b, a_t, b_t, g_t FROM db_users_b WHERE id = '$usid' LIMIT 1");
				$user_data = $db->FetchArray();
				
			}else echo "<center><font color = 'red'><b>Aksiya sotib olishdan avval, seyfdan daromadni olish talab etiladi!</b></font></center><BR />";
		
		}else echo "<center><font color = 'red'><b>Aksiya sotib olish uchun yetarlicha mablag` mavjud emas!</b></font></center><BR />";
	    }else echo "<center><font color = 'red'><b>Siz 1 martada 1 dona aksiya sotib olishingiz mumkin!</b></font></center><BR />";
	}

}

?>


<div class="fr-block">
	<form action="" method="post">
	<div class="cl-fr-lf">
		<img src="/img/share/share100.jpg" width="190" higth="230" />
	</div>
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<div class="fr-te-gr-title"><font color="red"><b>"UZHOST" aksiyasi </font><font color="green"><sup>+1.49%/kun</sup></b></font></div>
		<div class="fr-te-gr"><font color="green">Daromad:</font> <font color="#000000"><?=$sonfig_site["a_in_h"]*24/10; ?> so'm / kun</font></div>
		<div class="fr-te-gr"><font color="green">Narxi:</font> <font color="#000000"><?=$sonfig_site["amount_a_t"]; ?><font color="blue"><b> so`m</b></font></div>
		<div class="fr-te-gr"><font color="green">Muddati:</font> <font color="black">100 kun</font></div>
		<div class="fr-te-gr"><font color="green">Sizda:</font> <font color="#000000"><?=$user_data["a_t"]; ?> dona</font> aksiya bor</div>
		<input type="hidden" name="item" value="1" />
		<?php
		if($user_data["money_b"] < 10000) {
		print '<div class="fr-te-gr"><font color="red">Ushbu aksiyani olishingiz uchun<br>hisobingizda yetarli mablag\'<br>mavjud emas!</font></div>';
		} else {
		?>
		
		
		<input type="hidden" name="amount" value="1" style="height: 25px; width: 40px; margin-top:10px;" /> 
		<input type="submit" value="Sotib olish" style="height: 25px; margin-top:10px;" />
		<?php } ?>
	</div>
	</form>
</div>

<div class="fr-block">
	<form action="" method="post">
	<div class="cl-fr-lf">
		<img src="/img/share/share100.jpg" width="190" higth="230" />
	</div>
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<div class="fr-te-gr-title"><font color="red"><b>"CRYPTO" aksiyasi </font><font color="green"><sup>+1.60%/kun</sup></b></font></div>
		<div class="fr-te-gr"><font color="green">Daromad:</font> <font color="#000000"><?=$sonfig_site["b_in_h"]*24/10; ?> so'm / kun</font></div>
		<div class="fr-te-gr"><font color="green">Narxi:</font> <font color="#000000"><?=$sonfig_site["amount_b_t"]; ?><font color="blue"><b> so`m</b></font></div>
		<div class="fr-te-gr"><font color="green">Muddati:</font> <font color="black">90 kun</font></div>
		<div class="fr-te-gr"><font color="green">Sizda:</font> <font color="#000000"><?=$user_data["b_t"]; ?> dona</font> aksiya bor</div>
		<input type="hidden" name="item" value="2" />
		<?php
		if($user_data["a_t"] < 5) {
		print '<div class="fr-te-gr"><font color="red">Ushbu aksiyani olishingiz uchun<br> kamida 5 dona "Uzhost"<br> aksiyasi bo\'lishi kerak!</font></div>';
		} else {
		?>
		<input type="hidden" name="amount" value="1" style="height: 25px; width: 40px; margin-top:10px;" /> 
		<input type="submit" value="Sotib olish" style="height: 25px; margin-top:10px;" />
		<?php } ?>
	</div>
	</form>
</div>

<div class="fr-block">
	<form action="" method="post">
	<div class="cl-fr-lf">
		<img src="/img/share/share100.jpg" width="190" higth="230" />
	</div>
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<div class="fr-te-gr-title"><font color="red"><b>"FAST" aksiyasi </font><font color="green"><sup>+2.00%/kun</sup></b></font></div>
		<div class="fr-te-gr"><font color="green">Daromad:</font> <font color="#000000"><?=$sonfig_site["g_in_h"]*24/10; ?> so'm / kun</font></div>
		<div class="fr-te-gr"><font color="green">Narxi:</font> <font color="#000000"><?=$sonfig_site["amount_g_t"]; ?><font color="blue"><b> so`m</b></font></div>
		<div class="fr-te-gr"><font color="green">Muddati:</font> <font color="black">60 kun</font></div>
		<div class="fr-te-gr"><font color="green">Sizda:</font> <font color="#000000"><?=$user_data["g_t"]; ?> dona</font> aksiya bor</div>
		<input type="hidden" name="item" value="7" />
		<?php
		if($user_data["b_t"] < 5) {
		print '<div class="fr-te-gr"><font color="red">Ushbu aksiyani olishingiz uchun<br> kamida 5 dona "CRYPTO"<br>aksiyasi bo\'lishi kerak!</font></div>';
		} else {
		?>
		<input type="hidden" name="amount" value="1" style="height: 25px; width: 40px; margin-top:10px;" /> 
		<input type="submit" value="Sotib olish" style="height: 25px; margin-top:10px;" />
		<?php } ?>
	</div>
	</form>
</div>

<br>                               
<div class="clr"></div>
<div class="s-bk-lf">
	<div class="acc-title1">"UZHOST" aksiyasi haqida</div>
</div>
<div class="silver-bk0"><div class="clr"></div>
<p><font color="black">
<br>Jami chiqarilgan aksiyalar miqdori: 100 dona
<br> Birjadagi narxi: 10'000 so`m (1 dona aksiya)
<br> Daromad: Uzhost.net sof foydasining 25% miqdorida.

</font></p><br>

                               </div>
                                 
                               
                               <br>                               

<div class="s-bk-lf">
	<div class="acc-title1">"CRYPTO" aksiyasi haqida</div>
</div>
<div class="silver-bk0"><div class="clr"></div>
<p><font color="black">
<br>Jami chiqarilgan aksiyalar miqdori: 100 dona
<br> Birjadagi narxi: 25'000 so`m (1 dona aksiya)
<br> Daromad: Kripto savdolar sof foydasining 20% miqdorida.

</font></p><br>

                               </div>
                               
                               
                               <br>                               

<div class="s-bk-lf">
	<div class="acc-title1">"FAST" aksiyasi haqida</div>
</div>
<div class="silver-bk0"><div class="clr"></div>
<p><font color="black">
<br>Jami chiqarilgan aksiyalar miqdori: 100 dona
<br> Birjadagi narxi: 50'000 so`m (1 dona aksiya)
<br> Daromad: UzChange.Ru sof foydasining 20% miqdorida.

</font></p><br>

                               </div>

<div class="clr"></div>
