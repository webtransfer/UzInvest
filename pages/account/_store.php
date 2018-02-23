<div class="s-bk-lf">
	<div class="acc-title">SEYF</div>
</div>
<div class="silver-bk">Aksiyalaringizdan kelgan daromadni to`plashingiz uchun sizdan texnik bilim talab etilmaydi. Divedentlar avtomatik tarzda yig`ilib boradi. Istasangiz, har 10 daqiqada yoki 1 kunda 1 marotaba yoxud 1 oyda 1 marta daromadni olishingiz mumkin.<br /> 
<BR />
<BR />
<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Склад";
$usid = $_SESSION["user_id"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

	if(isset($_POST["sbor"])){
	
		if($user_data["last_sbor"] < (time() - 600) ){
		
			$tomat_s = $func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);
			$straw_s = $func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);
			$pump_s = $func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);
			$peas_s = $func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);
			$pean_s = $func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);
			$peach_s = $func->SumCalc($sonfig_site["f_in_h"], $user_data["f_t"], $user_data["last_sbor"]);
			$watermelon_s = $func->SumCalc($sonfig_site["g_in_h"], $user_data["g_t"], $user_data["last_sbor"]);
			
			$db->Query("UPDATE db_users_b SET 
			a_b = a_b + '$tomat_s', 
			b_b = b_b + '$straw_s', 
			c_b = c_b + '$pump_s', 
			d_b = d_b + '$peas_s', 
			e_b = e_b + '$pean_s', 
			f_b = f_b + '$peach_s', 
			g_b = g_b + '$watermelon_s', 
			all_time_a = all_time_a + '$tomat_s',
			all_time_b = all_time_b + '$straw_s',
			all_time_c = all_time_c + '$pump_s',
			all_time_d = all_time_d + '$peas_s',
			all_time_e = all_time_e + '$pean_s',
			all_time_f = all_time_f + '$peach_s',
			all_time_g = all_time_g + '$watermelon_s',
			last_sbor = '".time()."' 
			WHERE id = '$usid' LIMIT 1");
			
			echo "<center><font color = 'green'><b>Divedentlarni muvaffaqiyatli yig`ib oldingiz!</b></font></center><BR />";
			
			$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
			$user_data = $db->FetchArray();
			
		}else echo "<center><font color = 'red'><b>So`nggi to`lovdan 10 daqiqa o`tmadi</b></font></center><BR />";
	
	}



?>
<form action="" method="post">
<div class="clr"></div>	
<div class="sm-line"><img src="/img/share/shares100mini.png" /><b>Sizning <font color="green"><?=$user_data["a_t"]; ?></font> ta "UZHOST" aksiyangiz</b> <font color="green"> <?=$func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);?> tanga </font> daromad keltirdi.</div>
<div class="sm-line"><img src="/img/share/shares100mini.png" /><b>Sizning <font color="green"><?=$user_data["b_t"]; ?></font> ta "CRYPTO" aksiyangiz</b> <font color="green"> <?=$func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);?> tanga </font> daromad keltirdi.</div>
<div class="sm-line"><img src="/img/share/shares100mini.png" /><b>Sizning <font color="green"><?=$user_data["c_t"]; ?></font> ta aksiyangiz</b> <font color="green"> <?=$func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);?> tanga </font> daromad keltirdi.</div>
<div class="sm-line"><img src="/img/share/shares100mini.png" /><b>Sizning <font color="green"><?=$user_data["d_t"]; ?></font> ta aksiyangiz</b> <font color="green"> <?=$func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);?> tanga </font> daromad keltirdi.</div>
<div class="sm-line"><img src="/img/share/shares100mini.png" /><b>Sizning <font color="green"><?=$user_data["f_t"]; ?></font> ta aksiyangiz</b> <font color="green"> <?=$func->SumCalc($sonfig_site["f_in_h"], $user_data["f_t"], $user_data["last_sbor"]);?> tanga </font> daromad keltirdi.</div>
<div class="sm-line"><img src="/img/share/shares100mini.png" /><b>Sizning <font color="green"><?=$user_data["e_t"]; ?></font> ta aksiyangiz</b> <font color="green"> <?=$func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);?> tanga </font> daromad keltirdi.</div>
<div class="sm-line"><img src="/img/share/shares100mini.png" /><b>Sizning <font color="green"><?=$user_data["g_t"]; ?></font> ta "FAST" aksiyangiz </b> <font color="green"> <?=$func->SumCalc($sonfig_site["g_in_h"], $user_data["g_t"], $user_data["last_sbor"]);?> tanga </font> daromad keltirdi.</div>
<div class="clr"></div>
<center><input type="submit" name="sbor" value="Divedentlarni olish" style="height:30px;"/></center>
</form>
<td colspan="5" align="center" style="padding:5px;">Hurmatli investorlar! Loyihani reklama qilib, ommalashishiga ko'maklashing! Do'stlaringizni taklif eting! Maxsus havolani va reklama bannerlarini <a href="/account/ref_ban">reklama materiallari</a> sahifasidan olishingiz mumkin!</td>
                   
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="7" align="center" style="padding:5px;"><b>Seyfdagi tangalaringiz:</b></td>
    </tr>
  <tr>
    <td align="center"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>
    <td align="center"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>
	<td align="center"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>
    <td align="center"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>
	<td align="center"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>
    <td align="center"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>
	<td align="center"><div class="sm-line-nt"><img src="/img/share/shares100mini.png" /></div></td>    
  </tr>
  <tr>
    <td align="center"><b><font color="green"><?=$user_data["a_b"]; ?></font></b></td>
    <td align="center"><b><font color="green"><?=$user_data["b_b"]; ?></font></b></td>
    <td align="center"><b><font color="green"><?=$user_data["c_b"]; ?></font></b></td>
    <td align="center"><b><font color="green"><?=$user_data["d_b"]; ?></font></b></td>
	<td align="center"><b><font color="green"><?=$user_data["f_b"]; ?></font></b></td>
    <td align="center"><b><font color="green"><?=$user_data["e_b"]; ?></font></b></td>
	<td align="center"><b><font color="green"><?=$user_data["g_b"]; ?></font></b></td>
  </tr>
</table>

<br><hr>
<td colspan="5" align="center" style="padding:5px;">Tangalarni So'mga almashtirish uchun <a href="/account/market">BANK</a> sahifasidan foydalaning!</td>
<br>
<div class="clr"></div>
</div>
