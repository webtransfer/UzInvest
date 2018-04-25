<div class="s-bk-lf">
	<div class="acc-title">Статистика проекта</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP

$db->Query("SELECT 
	COUNT(id) all_users, 
	SUM(money_b) money_b, 
	SUM(money_p) money_p, 
	
	SUM(a_t) a_t, 

	
 



	SUM(payment_sum) payment_sum, 
	SUM(insert_sum) insert_sum
	
	
	FROM db_users_b");
$data_stats = $db->FetchArray();

?>

<table width="450" border="0" align="center">
  <tr class="htt">
    <td><b>Зарегистрировано пользователей:</b></td>
	<td width="100" align="center"><?=$data_stats["all_users"]; ?> чел.</td>
  </tr>
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  <tr class="htt">
    <td><b>Серебра на счетах (Для покупок):</b></td>
	<td width="100" align="center"><?=sprintf("%.0f",$data_stats["money_b"]); ?></td>
  </tr>
  
  <tr class="htt">
    <td><b>Серебра на счетах (На вывод):</b></td>
	<td width="100" align="center"><?=sprintf("%.0f",$data_stats["money_p"]); ?></td>
  </tr>
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  <tr class="htt">
    <td><b>Куплено Share-100:</b></td>
	<td width="100" align="center"><?=intval($data_stats["a_t"]); ?> шт.</td>
  </tr>
  
  
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  <tr class="htt">
    <td><b>На складах (моркови):</b></td>
	<td width="100" align="center"><?=intval($data_stats["a_b"]); ?> шт.</td>
  </tr>
  
  
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  <tr class="htt">
    <td><b>Собрано за все время (моркови):</b></td>
	<td width="100" align="center"><?=intval($data_stats["all_time_a"]); ?> шт.</td>
  </tr>
  
  
  
  <tr> <td colspan="2" align="center"><b>- - - - -</b></td> </tr>
  
  <tr class="htt">
    <td><b>Введено пользователями:</b></td>
	<td width="100" align="center"><?=sprintf("%.2f",$data_stats["insert_sum"]); ?> <?=$config->VAL; ?></td>
  </tr>
  
  <tr class="htt">
    <td><b>Выплачено пользователям:</b></td>
	<td width="100" align="center"><?=sprintf("%.2f",$data_stats["payment_sum"]); ?> <?=$config->VAL; ?></td>
  </tr>
  
</table>

</div>
<div class="clr"></div>	