<?PHP
$_OPTIMIZATION["title"] = "TOP 10 : Sarmoyadorlar/Daromad/Referal";
$_OPTIMIZATION["description"] = "Топ 10 по вводам/выводам";
$_OPTIMIZATION["keywords"] = "Топ 10, по вводам, по выводам";

# Настройки лотерея
$usd_to_sum = 7871; // Стоимость лотерейного билета
$rubl_to_sum = 125; // Количество билетов
$wrubl_to_sum = 130; // Количество билетов
?>
<div class="s-bk-lf">
	<div class="acc-title">TOP 10: Yangilar</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb"><b>Login</b></td>
    
    <td align="center" class="m-tb"><b>Ro'yhatdan o'tgan vaqti</b></td>
  </tr>
<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY `date_reg` DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
	<tr class="htt" >
		<td align="center" width="75"><?=$data['user']; ?></td>

		<td align="center"><b><font color="green"><?=date("d.m.Y H:i:s",$data["date_reg"]); ?> </font></b></td>
	</tr>
	<?php
	}
?>
</table>
</div>
<br/>

<div class="s-bk-lf">
	<div class="acc-title">So'nggi hisobni to'ldirishlar</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb"><b>Login</b></td>
    
    <td align="center" class="m-tb"><b>Miqdori</b></td>
    <td align="center" class="m-tb"><b>Vaqti</b></td>
  </tr>
<?php
  $db->Query("SELECT * FROM db_insert_money, db_users_a  WHERE  db_users_a.user = db_insert_money.user ORDER BY db_insert_money.date_add DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
	<tr class="htt" >
		<td align="center" width="75"><?=$data['user']; ?></td>
        <td align="center"><b><font color="green"><?=sprintf("%.2f",$data["serebro"]); ?> so'm </font></b></td>
		<td align="center"><b><?=date("d.m.Y H:i",$data["date_add"]); ?> </b></td>
	</tr>
	<?php
	}
?>
</table>
</div>
<br/>

<div class="s-bk-lf">
	<div class="acc-title">TOP 10 Sarmoyadorlar</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb"><b>Login</b></td>
    
    <td align="center" class="m-tb"><b>Sarmoyasi</b></td>
  </tr>
<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY `insert_sum` DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
	<tr class="htt" >
		<td align="center" width="75"><?=$data['user']; ?></td>

		<td align="center"><b><font color="green"><?=$data["insert_sum"] * $rubl_to_sum; ?> So`m ~ <?=sprintf("%.2f",$data["insert_sum"]*$rubl_to_sum/$usd_to_sum); ?> $</font></b></td>
	</tr>
	<?php
	}
?>
</table>
</div>
<br/>
<div class="s-bk-lf">
	<div class="acc-title">TOP 10: Hisobdan yechib olganlar</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb"><b>Login</b></td>
    <td align="center" class="m-tb"><b>So`nggi kirishi</b></td>
    <td align="center" class="m-tb"><b>Yechilgan mablag`</b></td>
  </tr>
<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY `payment_sum` DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
	<tr class="htt" >
		<td align="center" width="75"><?=$data['user']; ?></td>
		<td align="center"><b><?=date("d.m.Y , H:i",$data["date_login"]); ?></b></td>
		<td align="center"><b><font color="green"><?=$data["payment_sum"]*150; ?> So`m ~ <?=sprintf("%.2f",$data["payment_sum"]*150/8188); ?> $</font></b></td>
	</tr>
	<?php
	}
?>
</table>
</div>
<br/>

<div class="s-bk-lf">
	<div class="acc-title">TOP 10: Boyvachchalar</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb"><b>Login</b></td>
    <td align="center" class="m-tb"><b>Hisobidagi mablag`[So`m]</b></td>
    <td align="center" class="m-tb"><b>Aqsh dollarida</b></td>
  </tr>
<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY `money_b` + `money_p` DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
	<tr class="htt" >
		<td align="center" width="75"><?=$data['user']; ?></td>
		<td align="center"><b><?=sprintf("%.2f",($data["money_b"]+$data["money_p"])); ?> So`m</b></td>
		<td align="center"><b><font color="green"><?=sprintf("%.2f",(($data["money_b"]+$data["money_p"])/8188)); ?> $</font></b></td>
	</tr>
	<?php
	}
?>
</table>
</div>
<br/>

<div class="s-bk-lf">
	<div class="acc-title">TOP 10: Aksiyalar soni bo`yicha</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb"><b>Login</b></td>
    <td align="center" class="m-tb"><b>Aksiyalari soni</b></td>
    <td align="center" class="m-tb"><b>Olgan daromadi</b></td>
  </tr>
<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY `a_t` + `b_t` + `c_t` + `d_t` + `e_t` + `f_t` + `g_t` DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
	<tr class="htt" >
		<td align="center" width="75"><?=$data['user']; ?></td>
		<td align="center"><b><?=$data["a_t"]+$data["b_t"]+$data["c_t"]+$data["d_t"]+$data["e_t"]+$data["f_t"]+$data["g_t"]; ?> dona </b></td>
		<td align="center"><b><font color="green"><?=($data["all_time_a"]+$data["all_time_b"]+$data["all_time_c"]+$data["all_time_d"]+$data["all_time_e"]+$data["all_time_f"]+$data["all_time_g"])/10; ?> So`m ~ <?=sprintf("%.2f",(($data["all_time_a"]+$data["all_time_b"]+$data["all_time_c"]+$data["all_time_d"]+$data["all_time_e"]+$data["all_time_f"]+$data["all_time_g"])/81750)); ?> $</font></b></td>
	</tr>
	<?php
	}
?>
</table>
</div>
<br/>

<div class="s-bk-lf">
	<div class="acc-title">TOP 10 : Referallar soni bo`yicha</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb"><b>Login</b></td>
    <td align="center" class="m-tb"><b>Referaldan daromad</b></td>
    <td align="center" class="m-tb"><b>Referallar soni</b></td>
  </tr>
<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY `referals` DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
	<tr class="htt" >
		<td align="center" width="75"><?=$data['user']; ?></td>
		<td align="center"><b><?=sprintf("%.2f",$data["from_referals"]); ?> So`m ~ <?=sprintf("%.2f",$data["from_referals"]/8175); ?> $</b></td>
		<td align="center"><b><font color="green"><?=$data["referals"]; ?> nafar</font></b></td>
	</tr>
	<?php
	}
?>
</table>
</div>
<br/>
<div class="s-bk-lf">
	<div class="acc-title">TOP 10: Kunlik bonus</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb"><b>Login</b></td>
    <td align="center" class="m-tb"><b>Jami kunlik bonus miqdori</b></td>
    
  </tr>
<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY `dailybonus` DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
	<tr class="htt" >
		<td align="center" width="75"><?=$data['user']; ?></td>
		<td align="center"><b><font color="green"><?=$data["dailybonus"]; ?> So`m </font>~ <font color="blue"><?=sprintf("%.2f",$data["dailybonus"]/8180); ?> $</font></b></td>
		
		
	</tr>
	
	
	<?php
	}
?>
</table>
</div>

<br/>
<div class="s-bk-lf">
	<div class="acc-title">TOP 10: Sahovatpeshalar</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" class="m-tb"><b>Login</b></td>
    <td align="center" class="m-tb"><b>Loyihaga qilgan yordami</b></td>
    <td align="center" class="m-tb"><b>Izoh</b></td>
  </tr>
<?php
	$db->Query("SELECT * FROM `db_users_b`,`db_users_a` WHERE db_users_b.id = db_users_a.id ORDER BY `donations` DESC LIMIT 10 ");
	while($data = $db->FetchArray()){
	?>
	<tr class="htt" >
		<td align="center" width="75"><?=$data['user']; ?></td>
		<td align="center"><b><font color="magenta"><?=$data["donations"]; ?> So`m ~ <?=sprintf("%.2f",$data["donations"]/8180); ?> $</font></b></td>
		<td align="center"><b><font color="blue">Tashakkur!!!</font></b></td>
		
	</tr>
	
	
	<?php
	}
?>
</table>
</div>
<br/>


<div class="clr"></div>	
