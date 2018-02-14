<?PHP
$_OPTIMIZATION["title"] = "Информация";
$_OPTIMIZATION["description"] = "Инфо о money-ferma";
$_OPTIMIZATION["keywords"] = "Инфо, акции, конкурсы, будущее проекта.";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>

	<div class="acc-title">Информация</div>

<div class="silver-bk"><div class="clr"></div>	
Привет <?=$prof_data["user"]; ?>! На этой странице показаны будущие конкурсы, акции и нововведения проекта. Снизу размещено описание для каждой акции.
</div>	
<br>
<div class="s-bk-lf">
	<div class="acc-title">Конкурсы:</div>
</div>
<div class="silver-bk"><div class="clr"></div>
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" width="75" class="m-tb"><b>Название</b></td>
    <td align="center" width="75" class="m-tb"><b>Дата</b></td>
	    <td align="center" width="75" class="m-tb"><b>Фонд</b></td>
  </tr>
  			<tr class="htt" >
				<td align="center"><b><font color="green">Конкурс рефералов</font></b></td>
				<td align="center"><font color="red">10.08.2013 - 01.09.2013</font></td>
								<td align="center"><font color="red"><b>1500</b></font></td>
		 	</tr>
			  			<tr class="htt" >
				<td align="center"><b><font color="green">Конкурс рефералов</font></b></td>
				<td align="center"><font color="red">10.09.2013 - 01.10.2013</font></td>
								<td align="center"><font color="red"><b>1500</b></font></td>
		 	</tr>
						  			<tr class="htt" >
				<td align="center"><b><font color="green">Конкурс рефералов</font></b></td>
				<td align="center"><font color="red">10.10.2013 - 01.11.2013</font></td>
								<td align="center"><font color="red"><b>1500</b></font></td>
		 	</tr>
									  			<tr class="htt" >
				<td align="center"><b><font color="green">Конкурс рефералов</font></b></td>
				<td align="center"><font color="red">10.11.2013 - 01.01.2014</font></td>
								<td align="center"><font color="red"><b>5000</b></font></td>
		 	</tr>
  </table>
  
				</div>
<br>
<div class="s-bk-lf">
	<div class="acc-title">Акции:</div>
</div>
<div class="silver-bk"><div class="clr"></div>
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" width="75" class="m-tb"><b>Название</b></td>
    <td align="center" width="75" class="m-tb"><b>Дата</b></td>
	    <td align="center" width="75" class="m-tb"><b>Локация</b></td>
  </tr>
  			<tr class="htt" >
				<td align="center"><b><font color="green">Акция в ЧАТе</font><font color="red">*</font></b></td>
				<td align="center"><font color="red">Ежедневно</font></td>
								<td align="center"><font color="red">ЧАТ</font></td>
		 	</tr>
			  			<tr class="htt" >
				<td align="center"><b><font color="green">Unlim реклама на САР при пополнении 1500+</font><font color="red">*</font></b></td>
				<td align="center"><font color="red">Еженедельно (До 10.08)</font></td>
								<td align="center"><font color="red">NO</font></td>
		 	</tr>
						  			<tr class="htt" >
				<td align="center"><b><font color="green">Самый актиный ЧАТовец</font><font color="red">*</font></b></td>
				<td align="center"><font color="red">Еженедельно</font></td>
								<td align="center"><font color="red">ЧАТ</font></td>
		 	</tr>
  </table>
  
				</div>						
<br>
<div class="s-bk-lf">
	<div class="acc-title">Нововведения:</div>
</div>
<div class="silver-bk"><div class="clr"></div>
<table width="99%" border="0" align="center">
  <tr bgcolor="#efefef">
    <td align="center" width="75" class="m-tb"><b>Название</b></td>
    <td align="center" width="75" class="m-tb"><b>Реализация</b></td>
  </tr>
			
  			<tr class="htt" >
				<td align="center"><b><font color="green">Автоввод WebMoney</font></b></td>
				<td align="center"><font color="red">10.08.2013 - 01.09.2013</font></td>
		 	</tr>

			    			<tr class="htt" >
				<td align="center"><b><font color="green">Новые растения</font></b></td>
				<td align="center"><font color="red">10.08.2013 - 15.08.2013</font></td>
		 	</tr>
  </table>
  
				</div>	<br>

	<div class="acc-title">Сноски</div>

<div class="silver-bk"><div class="clr"></div>
<table width="99%" border="0" align="center"><td align="center" width="75" class="m-tb"><b>Акция в ЧАТе</b></td>  </table>
 Ежедневная акция которая проводится в ЧАТе как Администраторами так и Модераторами суть которой поле объявления акции получить бонусные 10% от платежа на баланс для вывода в серебре. Ограничений пользователям нету.<br>
<table width="99%" border="0" align="center"><td align="center" width="75" class="m-tb"><b>Unlim реклама на САР при пополнении 1500+</b></td>  </table>
 Еженедельная акция суть которой награждение первого кто положит на свой счет 1500 рублей и более <b>безлимитной</b> динамической рассылкой на проекте <a href=http://seo-fast.ru?r=184792>seo-fast</a> сроком на неделю. Ограничений пользователям нету.<br>
<table width="99%" border="0" align="center"><td align="center" width="75" class="m-tb"><b>Самый актиный ЧАТовец</b></td>  </table>
 Еженедельная акция суть которой вознаграждение самого активного пользователя в чате статусом Модератора. Спам в чате не приветствуется. Сумма пополнений на аккаунте должна быть не менее 250 рублей.<br>
				</div>	
								</div>	
	

<div class="clr"></div>	
