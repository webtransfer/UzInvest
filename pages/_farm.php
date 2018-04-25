<div class="section_w500">
<div class="s-bk-lf">
	<div class="acc-title1">Ферма</div>
</div>
<div class="silver-bk0"><div class="clr"></div>
<p><font color="black">В этом магазине Вы можете приобрести саженцы различных растений. Каждое растение приносит особые плоды которые можно потом продать на рынке и обменять на реальные деньги. Каждое растение даёт разное количество плодов, чем дороже оно тем больше плодоносит. Вы можете покупать любое их количество, растения не засыхают, не исчезают и будут плодоносить всегда. </font></p><p><font color="green">Перед тем как докупить саженцы следует собрать урожай на складе!</font></p>
                               </div>
                               </div>
<br>
<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Ферма";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();

# Покупка нового дерева
if(isset($_POST["item"])){

$array_items = array(1 => "a_t", 2 => "b_t", 3 => "c_t", 4 => "d_t", 5 => "e_t", 6 => "f_t", 7 => "g_t");
$array_name = array(1 => "Яблоня", 2 => "Вишня", 3 => "Лимон", 4 => "Груша", 5 => "Мандарин", 6 => "Тыква", 7 => "Арбуз");
$item = intval($_POST["item"]);
$citem = $array_items[$item];
$amount = intval($_POST['amount']);

	if(strlen($citem) >= 3){
		
		# Проверяем средства пользователя
		if($amount > 0 && $amount <= 1000) {
		$need_money = $sonfig_site["amount_".$citem]*$amount;
		if($need_money <= $user_data["money_b"]){
		
			if($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > ( time() - 60*10) ){
				
				$to_referer = $need_money * 0.1;
				# Добавляем дерево и списываем деньги
				$db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + $amount,  
				last_sbor = IF(last_sbor > 0, last_sbor, '".time()."') WHERE id = '$usid'");
				
				# Вносим запись о покупке
				$db->Query("INSERT INTO db_stats_btree (user_id, user, tree_name, amount, date_add, date_del) 
				VALUES ('$usid','$usname','".$array_name[$item]."','$need_money','".time()."','".(time()+60*60*24*15)."')");
				
				echo "<center><font color = 'green'><b>Вы успешно посадили $amount саженец(ов)</b></font></center><BR />";
				
				$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
				$user_data = $db->FetchArray();
				
			}else echo "<center><font color = 'red'><b>Перед тем как докупить саженцы следует собрать урожай на складе!</b></font></center><BR />";
		
		}else echo "<center><font color = 'red'><b>Недостаточно кредитов для покупки</b></font></center><BR />";
	    }else echo "<center><font color = 'red'><b>Вы можете купить за 1 раз от 1 до 1000 саженцов!</b></font></center><BR />";
	}

}

?>


<div class="fr-block">
	<form action="" method="post">
	<div class="cl-fr-lf">
		<img src="/img/fruit/lime.jpg" />
	</div>
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<div class="fr-te-gr-title"><font color="green"><b>Яблоня</b></font></div>
		<div class="fr-te-gr"><font color="green">Плодовитость:</font> <font color="#000000"><?=$sonfig_site["a_in_h"]; ?> в час</font></div>
		<div class="fr-te-gr"><font color="green">Стоимость:</font> <font color="#000000"><?=$sonfig_site["amount_a_t"]; ?><font color="blue"><b>C</b></font>  [1руб.]</font></div>
		<div class="fr-te-gr"><font color="green">Куплено:</font> <font color="#000000"><?=$user_data["a_t"]; ?> шт.</font></div>
		<input type="hidden" name="item" value="1" />
		<input type="text" name="amount" value="1" style="height: 30px; width: 40px; margin-top:10px;" /> <input type="submit" value="Посадить" style="height: 30px; margin-top:10px;" />
	</div>
	</form>
</div>

<div class="fr-block">
	<form action="" method="post">
	<div class="cl-fr-lf">
		<img src="/img/fruit/cherry.jpg" />
	</div>
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<div class="fr-te-gr-title"><font color="green"><b>Вишня</b></font></div>
		<div class="fr-te-gr"><font color="green">Плодовитость:</font> <font color="#000000"><?=$sonfig_site["b_in_h"]; ?> в час</font></div>
		<div class="fr-te-gr"><font color="green">Стоимость:</font> <font color="#000000"><?=$sonfig_site["amount_b_t"]; ?><font color="blue"><b>C</b></font>  [10руб.]</font></div>
		<div class="fr-te-gr"><font color="green">Куплено:</font> <font color="#000000"><?=$user_data["b_t"]; ?> шт.</font></div>
		<input type="hidden" name="item" value="2" />
		<input type="text" name="amount" value="1" style="height: 30px; width: 40px; margin-top:10px;" /> <input type="submit" value="Посадить" style="height: 30px; margin-top:10px;">
	</div>
	</form>
</div>

<div class="fr-block">
	<form action="" method="post">
	<div class="cl-fr-lf">
		<img src="/img/fruit/strawberries.jpg" />
	</div>
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<div class="fr-te-gr-title"><font color="green"><b>Лимон</b></font></div>
		<div class="fr-te-gr"><font color="green">Плодовитость:</font> <font color="#000000"><?=$sonfig_site["c_in_h"]; ?> в час</font></div>
		<div class="fr-te-gr"><font color="green">Стоимость:</font> <font color="#000000"><?=$sonfig_site["amount_c_t"]; ?><font color="blue"><b>C</b></font>  [50руб.]</font></div>
		<div class="fr-te-gr"><font color="green">Куплено:</font> <font color="#000000"><?=$user_data["c_t"]; ?> шт.</font></div>
		<input type="hidden" name="item" value="3" />
		<input type="text" name="amount" value="1" style="height: 30px; width: 40px; margin-top:10px;" /> <input type="submit" value="Посадить" style="height: 30px; margin-top:10px;">
	</div>
	</form>
</div>

<div class="fr-block">
	<form action="" method="post">
	<div class="cl-fr-lf">
		<img src="/img/fruit/kiwi.jpg" />
	</div>
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<div class="fr-te-gr-title"><font color="green"><b>Груша</b></font></div>
		<div class="fr-te-gr"><font color="green">Плодовитость:</font> <font color="#000000"><?=$sonfig_site["d_in_h"]; ?> в час</font></div>
		<div class="fr-te-gr"><font color="green">Стоимость:</font> <font color="#000000"><?=$sonfig_site["amount_d_t"]; ?><font color="blue"><b>C</b></font>  [250руб.]</font></div>
		<div class="fr-te-gr"><font color="green">Куплено:</font> <font color="#000000"><?=$user_data["d_t"]; ?> шт.</font></div>
		<input type="hidden" name="item" value="4" />
		<input type="text" name="amount" value="1" style="height: 30px; width: 40px; margin-top:10px;" /> <input type="submit" value="Посадить" style="height: 30px; margin-top:10px;">
	</div>
	</form>
</div>

<div class="fr-block">
	<form action="" method="post">
	<div class="cl-fr-lf">
		<img src="/img/fruit/peach.jpg" />
	</div>
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<div class="fr-te-gr-title"><font color="green"><b>Мандарин</b></font></div>
		<div class="fr-te-gr"><font color="green">Плодовитость:</font> <font color="#000000"><?=$sonfig_site["f_in_h"]; ?> в час</font></div>
		<div class="fr-te-gr"><font color="green">Стоимость:</font> <font color="#000000"><b><s>75000</s></b><font color="red"><?=$sonfig_site["amount_f_t"]; ?></font><font color="blue"><b>C</b></font>  [ <font color=red>675руб.</font>]</font></div>
		<div class="fr-te-gr"><font color="green">Куплено:</font> <font color="#000000"><?=$user_data["f_t"]; ?> шт.</font></div>
		<input type="hidden" name="item" value="6" />
		<input type="text" name="amount" value="1" style="height: 30px; width: 40px; margin-top:10px;" /> <input type="submit" value="Посадить" style="height: 30px; margin-top:10px;">
	</div>
	</form>
</div>

<div class="fr-block">
	<form action="" method="post">
	<div class="cl-fr-lf">
		<img src="/img/fruit/orange.jpg" />
	</div>
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<div class="fr-te-gr-title"><font color="green"><b>Тыква</b></font></div>
		<div class="fr-te-gr"><font color="green">Плодовитость:</font> <font color="#000000"><?=$sonfig_site["e_in_h"]; ?> в час</font></div>
		<div class="fr-te-gr"><font color="green">Стоимость:</font> <font color="#000000"><?=$sonfig_site["amount_e_t"]; ?><font color="blue"><b>C</b></font>  [1000руб.]</font></div>
		<div class="fr-te-gr"><font color="green">Куплено:</font> <font color="#000000"><?=$user_data["e_t"]; ?> шт.</font></div>
		<input type="hidden" name="item" value="5" />
		<input type="text" name="amount" value="1" style="height: 30px; width: 40px; margin-top:10px;" /> <input type="submit" value="Посадить" style="height: 30px; margin-top:10px;">
	</div>
	</form>
</div>

<div class="fr-block">
	<form action="" method="post">
	<div class="cl-fr-lf">
		<img src="/img/fruit/watermelon.jpg" />
	</div>
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<div class="fr-te-gr-title"><font color="green"><b>Арбуз</b></font></div>
		<div class="fr-te-gr"><font color="green">Плодовитость:</font> <font color="#000000"><?=$sonfig_site["g_in_h"]; ?> в час</font></div>
		<div class="fr-te-gr"><font color="green">Стоимость:</font> <font color="#000000"><?=$sonfig_site["amount_g_t"]; ?><font color="blue"><b>C</b></font>  [1500руб.]</font></div>
		<div class="fr-te-gr"><font color="green">Куплено:</font> <font color="#000000"><?=$user_data["g_t"]; ?> шт.</font></div>
		<input type="hidden" name="item" value="7" />
		<input type="text" name="amount" value="1" style="height: 30px; width: 40px; margin-top:10px;" /> <input type="submit" value="Посадить" style="height: 30px; margin-top:10px;">
	</div>
	</form>
</div>
<div class="clr"></div>