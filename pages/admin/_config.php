<div class="s-bk-lf">
	<div class="acc-title">Настройки</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP
$db->Query("SELECT * FROM db_config WHERE id = '1'");
$data_c = $db->FetchArray();

# Обновление
if(isset($_POST["admin"])){

	$admin = $func->IsLogin($_POST["admin"]);
	$pass = $func->IsLogin($_POST["pass"]);
	
	
	$ser_per_wmr = intval($_POST["ser_per_wmr"]);
	$ser_per_wmz = intval($_POST["ser_per_wmz"]);
	$ser_per_wme = intval($_POST["ser_per_wme"]);
	$percent_swap = intval($_POST["percent_swap"]);
	$percent_sell = intval($_POST["percent_sell"]);
	$items_per_coin = intval($_POST["items_per_coin"]);
	
	$tomat_in_h = intval($_POST["a_in_h"]);
	$straw_in_h = intval($_POST["b_in_h"]);
	$pump_in_h = intval($_POST["c_in_h"]);
	$peas_in_h = intval($_POST["d_in_h"]);
	$pean_in_h = intval($_POST["e_in_h"]);
	$peach_in_h = intval($_POST["f_in_h"]);
	$watermelon_in_h = intval($_POST["g_in_h"]);
	
	$amount_tomat_t = intval($_POST["amount_a_t"]);
	$amount_straw_t = intval($_POST["amount_b_t"]);
	$amount_pump_t = intval($_POST["amount_c_t"]);
	$amount_peas_t = intval($_POST["amount_d_t"]);
	$amount_pean_t = intval($_POST["amount_e_t"]);
	$amount_peach_t = intval($_POST["amount_f_t"]);
	$amount_watermelon_t = intval($_POST["amount_g_t"]);
	$amount_gardener = intval($_POST["amount_gardener"]);

	
	# Проверка на ошибки
	$errors = true;
	
	if($admin === false){
		$errors = false; echo "<center><font color = 'red'><b>Логин администратора имеет неверный формат</b></font></center><BR />"; 
	}
	
	if($pass === false){
		$errors = false; echo "<center><font color = 'red'><b>Пароль администратора имеет неверный формат</b></font></center><BR />"; 
	}
	
	if($percent_swap < 1 OR $percent_swap > 99){
		$errors = false; echo "<center><font color = 'red'><b>Прибавляемый процент при обмене должен быть от 1 до 99</b></font></center><BR />"; 
	}
	
	if($percent_sell < 1 OR $percent_sell > 99){
		$errors = false; echo "<center><font color = 'red'><b>% серебра на вывод при продаже должен быть от 1 до 99</b></font></center><BR />"; 
	}
	
	if($items_per_coin < 1 OR $items_per_coin > 50000){
		$errors = false; echo "<center><font color = 'red'><b>Сколько плодов = 1 серебра, должно быть от 1 до 50000</b></font></center><BR />"; 
	}
	
	if($tomat_in_h < 6 OR $straw_in_h < 6 OR $pump_in_h < 6 OR $peas_in_h < 6 OR $pean_in_h < 6 OR $peach_in_h < 6 OR $watermelon_in_h < 6){
		$errors = false; echo "<center><font color = 'red'><b>Неверная настройка урожайности саценцов в час! Минимум 6</b></font></center><BR />"; 
	}
	
	
	if($amount_tomat_t < 1 OR $amount_straw_t < 1 OR $amount_pump_t < 1 OR $amount_peas_t < 1 OR $amount_pean_t < 1 OR $amount_peach_t < 1 OR $amount_watermelon_t < 1){
		$errors = false; echo "<center><font color = 'red'><b>Минимальная стоимость саженца не должна быть менее 1го серебра</b></font></center><BR />"; 
	}
	
	# Обновление
	if($errors){
	
		$db->Query("UPDATE db_config SET 
		
		admin = '$admin',
		pass = '$pass',
		ser_per_wmr = '$ser_per_wmr',
		ser_per_wmz = '$ser_per_wmz',
		ser_per_wme = '$ser_per_wme',
		percent_swap = '$percent_swap',
		percent_sell = '$percent_sell',
		items_per_coin = '$items_per_coin',
		a_in_h = '$tomat_in_h',
		b_in_h = '$straw_in_h',
		c_in_h = '$pump_in_h',
		d_in_h = '$peas_in_h',
		e_in_h = '$pean_in_h',
		f_in_h = '$peach_in_h',
		g_in_h = '$watermelon_in_h',
		amount_a_t = '$amount_tomat_t',
		amount_b_t = '$amount_straw_t',
		amount_c_t = '$amount_pump_t',
		amount_d_t = '$amount_peas_t',
		amount_e_t = '$amount_pean_t',
		amount_f_t = '$amount_peach_t',
		amount_g_t = '$amount_watermelon_t',
		amount_gardener = '$amount_gardener'
		
		WHERE id = '1'");
		
		echo "<center><font color = 'green'><b>Сохранено</b></font></center><BR />";
		$db->Query("SELECT * FROM db_config WHERE id = '1'");
		$data_c = $db->FetchArray();
	}
	
}

?>
<form action="" method="post">
<table width="100%" border="0">
  
  
  <tr>
    <td><b>Стоимость 1 RUB (Серебром):</b></td>
	<td width="150" align="center"><input type="text" name="ser_per_wmr" value="<?=$data_c["ser_per_wmr"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Стоимость 1 USD (Серебром):</b></td>
	<td width="150" align="center"><input type="text" name="ser_per_wmz" value="<?=$data_c["ser_per_wmz"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Стоимость 1 EUR (Серебром):</b></td>
	<td width="150" align="center"><input type="text" name="ser_per_wme" value="<?=$data_c["ser_per_wme"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Прибавлять % при обмене (От 1 до 99):</b></td>
	<td width="150" align="center"><input type="text" name="percent_swap" value="<?=$data_c["percent_swap"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>% серебра на вывод при продаже (от 1 до 99):</b><BR /></td>
	<td width="150" align="center"><input type="text" name="percent_sell" value="<?=$data_c["percent_sell"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Сколько плодов = 1 серебра:</b></td>
	<td width="150" align="center"><input type="text" name="items_per_coin" value="<?=$data_c["items_per_coin"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Плодородность в час (морковь) (мин 6):</b></td>
	<td width="150" align="center"><input type="text" name="a_in_h" value="<?=$data_c["a_in_h"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Плодородность в час (огурец) (мин 6):</b></td>
	<td width="150" align="center"><input type="text" name="b_in_h" value="<?=$data_c["b_in_h"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Плодородность в час (капуста) (мин 6):</b></td>
	<td width="150" align="center"><input type="text" name="c_in_h" value="<?=$data_c["c_in_h"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Плодородность в час (помидор) (мин 6):</b></td>
	<td width="150" align="center"><input type="text" name="d_in_h" value="<?=$data_c["d_in_h"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Плодородность в час (картофель) (мин 6):</b></td>
	<td width="150" align="center"><input type="text" name="f_in_h" value="<?=$data_c["f_in_h"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Плодородность в час (тыква) (мин 6):</b></td>
	<td width="150" align="center"><input type="text" name="e_in_h" value="<?=$data_c["e_in_h"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Плодородность в час (баклажан) (мин 6):</b></td>
	<td width="150" align="center"><input type="text" name="g_in_h" value="<?=$data_c["g_in_h"]; ?>" /></td>
  </tr>
  
  
  <tr bgcolor="#EFEFEF">
    <td><b>Стоимость саженца серебро (морковь):</b></td>
	<td width="150" align="center"><input type="text" name="amount_a_t" value="<?=$data_c["amount_a_t"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Стоимость саженца серебро (огурец):</b></td>
	<td width="150" align="center"><input type="text" name="amount_b_t" value="<?=$data_c["amount_b_t"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Стоимость саженца серебро (капуста):</b></td>
	<td width="150" align="center"><input type="text" name="amount_c_t" value="<?=$data_c["amount_c_t"]; ?>" /></td>
  </tr>
  
  <tr>
    <td><b>Стоимость саженца серебро (помидор):</b></td>
	<td width="150" align="center"><input type="text" name="amount_d_t" value="<?=$data_c["amount_d_t"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Стоимость саженца серебро (картофеля):</b></td>
	<td width="150" align="center"><input type="text" name="amount_f_t" value="<?=$data_c["amount_f_t"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Стоимость саженца серебро (тыквы):</b></td>
	<td width="150" align="center"><input type="text" name="amount_e_t" value="<?=$data_c["amount_e_t"]; ?>" /></td>
  </tr>
  
  <tr bgcolor="#EFEFEF">
    <td><b>Стоимость саженца серебро (баклажан):</b></td>
	<td width="150" align="center"><input type="text" name="amount_g_t" value="<?=$data_c["amount_g_t"]; ?>" /></td>
  </tr>
  
    
  <tr> <td colspan="2" align="center"><input type="submit" value="Сохранить" /></td> </tr>
</table>
</form>
</div>
<div class="clr"></div>	