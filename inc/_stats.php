<?PHP
$tfstats = time() - 60*60*48;
$db->Query("SELECT 
(SELECT COUNT(*) FROM db_users_a) all_users,
(SELECT SUM(insert_sum) FROM db_users_b) all_insert, 
(SELECT SUM(payment_sum) FROM db_users_b) all_payment, 
(SELECT COUNT(*) FROM db_users_a WHERE date_reg > '$tfstats') new_users");
$stats_data = $db->FetchArray();

?>

<?PHP

$db->Query("SELECT 
	COUNT(id) all_users, 
	SUM(money_b) money_b, 
	SUM(money_p) money_p, 
	
	SUM(a_t) a_t, 
	SUM(b_t) b_t, 
	SUM(c_t) c_t, 
	SUM(d_t) d_t, 
	SUM(e_t) e_t, 
	SUM(f_t) f_t, 
	SUM(g_t) g_t, 
	
	SUM(a_b) a_b, 
	SUM(b_b) b_b, 
	SUM(c_b) c_b, 
	SUM(d_b) d_b, 
	SUM(e_b) e_b, 
	SUM(f_b) f_b, 
	SUM(g_b) g_b, 
	
	SUM(all_time_a) all_time_a, 
	SUM(all_time_b) all_time_b, 
	SUM(all_time_c) all_time_c, 
	SUM(all_time_d) all_time_d, 
	SUM(all_time_e) all_time_e,
	SUM(all_time_f) all_time_f, 
	SUM(all_time_g) all_time_g,
	
	SUM(payment_sum) payment_sum, 
	SUM(insert_sum) insert_sum
	
	
	FROM db_users_b");
$data_stats = $db->FetchArray();

?>
	
<div class="user-menu">

	 <p class="headbl">Статистика</p>
	<div class="st-lf">
	
	<div class="line">Всего участников: </div>
	<div class="line">Новых за 48 часов: </div>
	<div class="line">Выплачено всего: </div>
	<div class="line">Резерв проекта: </div>
	<div class="line">Куплено кораблей: </div>
	<div class="line">Старт проекта: </div>
	<div class="line">Сегодня посещений: </div>
	<div class="line">Время сервера: </div>
	</div>
	<div class="st-rg">
	<div class="line-st"><h1><b><?=$stats_data["all_users"]; ?></b> чел.</h1></div>
	<div class="line-st"><h1><b><?=($stats_data["new_users"]+0); ?></b> чел.</h1></div>
	<div class="line-st"><h1><font  color = "green"><b><a href="/#" style="text-decoration:none; color:green;"><?=sprintf("%.2f",$stats_data["all_payment"]); ?></a></font></b><font color="blue">руб.</font></h1></div>
	<div class="line-st"><h1><b><?=sprintf("%.2f",$stats_data["all_insert"]+0); ?></b><font color="blue">руб.</font></h1></div>
	
	<?php
		$data_trees_all=intval($data_stats["a_t"])+intval($data_stats["b_t"])+intval($data_stats["c_t"])+intval($data_stats["d_t"])+intval($data_stats["e_t"])+intval($data_stats["f_t"])+intval($data_stats["g_t"]);
	?>
	<div class="line-st"><h1><b><?=$data_trees_all; ?></b> шт.</h1></div>
    <div class="line-st"><h1><b>24.12.2013</b></h1></div>
	<div class="line-st"><h1><b><!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t26.11;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet: показано число посетителей за"+
" сегодня' "+
"border='0' width='88' height='15'><\/a>")
//--></script><!--/LiveInternet--></b></h1></div>
	<div class="line-st"><h1><b><?=date('H:i'); ?></b></h1></div>
	<br>
	
	</div>
		
	<div class="clr"></div>
</div>
<div class="user-menu">

<p class="headbl">Статистика по растениям</p>
	<div class="st-lf">
	<div class="line">Яблонь: </div>
	<div class="line">Вишень: </div>
	<div class="line">Лимонов: </div>
	<div class="line">Груш: </div>
<div class="line">Мандаринов: </div>
	<div class="line">Тыкв: </div>
<div class="line">Арбуз: </div>
	</div>
	<div class="st-rg">
	<div class="line-st"><font  color = "green"><h1><b><?=intval($data_stats["a_t"]); ?></b> шт.</h1></font></div>
	<div class="line-st"><font  color = "green"><h1><b><?=intval($data_stats["b_t"]); ?></b> шт.</h1></font></div>
	<div class="line-st"><font  color = "green"><h1><b><?=intval($data_stats["c_t"]); ?></b> шт.</h1></font></div>
	<div class="line-st"><font  color = "green"><h1><b><?=intval($data_stats["d_t"]); ?></b> шт.</h1></font></div>
<div class="line-st"><font  color = "green"><h1><b><?=intval($data_stats["f_t"]); ?></b> шт.</h1></font></div>
	<div class="line-st"><font  color = "green"><h1><b><?=intval($data_stats["e_t"]); ?></b> шт.</h1></font></div>
<div class="line-st"><font  color = "green"><h1><b><?=intval($data_stats["g_t"]); ?></b> шт.</h1></font></div>
</div>
<div class="clr"></div>
</div>



