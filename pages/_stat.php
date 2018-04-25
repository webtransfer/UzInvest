<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Профиль";

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

								<div class="s-bk-lf">
									<div class="acc-title">Loyiha statistikasi</div>
								</div>
								<div class="silver-bk">
								

<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr><td colspan="2" align="center">&nbsp;</td></tr>
  <tr>
    <td align="left" style="padding:3px;"><b>Sarmoyadorlar:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=$stats_data["all_users"]; ?> kishi</font></td>
  </tr>
  <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;"><b>So`nggi 48 soatda:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=($stats_data["new_users"]+0); ?> kishi</font></td>
  </tr>
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;"><b>Jami to`langan:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=sprintf("%.2f",$stats_data["all_payment"]*150); ?></a></font><font color="blue"> so`m</font></td>
  </tr>
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;"><b>Loyiha zahirasi:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=sprintf("%.2f",$stats_data["all_insert"]*150+0); ?><font color="blue"> so`m</font></font></td>
  </tr>
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  <tr>
  <?php
		$data_trees_all=intval($data_stats["a_t"])+intval($data_stats["b_t"])+intval($data_stats["c_t"])+intval($data_stats["d_t"])+intval($data_stats["e_t"])+intval($data_stats["f_t"])+intval($data_stats["g_t"]);
	?>
    <td align="left" style="padding:3px;"><b>Sotib olingan aksiyalar:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=$data_trees_all; ?> dona.</font></td>
  </tr>
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
      <tr>
    <td align="left" style="padding:3px;"><b> <font color="red">Tanga</font> kursi:</b></td>
    <td align="left" style="padding:3px;"><font color="brown">1 Tanga</font> =  <font color="green">0.1</font> <font color="blue">so`m</font></td>
  </tr>
   <tr>
  <td colspan="2">
    <hr>
  </td>
  </tr>
  
  
  
  
</table>

								<div class="clr"></div>	
								</div>
								<br><br>
								<div class="s-bk-lf">
									<div class="acc-title">Aksiyalar statistikasi</div>
								</div>
								
								
								
								<div class="silver-bk">
								

<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr><td colspan="2" align="center">&nbsp;</td></tr>
  <tr>
    <td align="left" style="padding:3px;"><b>UZHOST:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><b><?=intval($data_stats["a_t"]); ?></b> dona.</font></td>
  </tr>
  
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  
  <tr>
    <td align="left" style="padding:3px;"><b>CRYPTO:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><b><?=intval($data_stats["b_t"]); ?></b> dona.</font></td>
  </tr>
  
  <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  
  <tr>
    <td align="left" style="padding:3px;"><b>FAST:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><b><?=intval($data_stats["g_t"]); ?></b> dona.</font></td>
  </tr>
  
  <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  
  
</table>

								<div class="clr"></div>	
								</div>