<?PHP
$_OPTIMIZATION["title"] = "Shaxsiy hisob - Sozlamalar";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid'");
$user_data = $db->FetchArray();
?>
<div class="s-bk-lf">
	<div class="acc-title">Sozlamalar</div>
</div>
<div class="silver-bk">
<div class="clr"></div>	

<center><b>Parolni o`zgartirish</b></center>
<BR />
<?PHP
	if(isset($_POST["old"])){
	
		$oldpass = $func->IsPassword($_POST["old"]);
		$old = md5(md5($oldpass));
		$newpass = $func->IsPassword($_POST["new"]);
		$new = md5(md5($newpass));
		$renewpass = $func->IsPassword($_POST["re_new"]);
		$renew = md5(md5($renewpass));
			if($old !== false AND strtolower($old) == strtolower($user_data["pass"])){
			
				if($new !== false){
				
					if( strtolower($new) == strtolower($renew)){
					
						$db->Query("UPDATE db_users_a SET pass = '$new' WHERE id = '$usid'");
						
						echo "<center><font color = 'green'><b>Новый пароль успешно установлен</b></font></center><BR />";
					
					}else echo "<center><font color = 'red'><b>Пароль и повтор пароля не совпадают</b></font></center><BR />";
				
				}else echo "<center><font color = 'red'><b>Новый пароль имеет неверный формат</b></font></center><BR />";
			
			}else echo "<center><font color = 'red'><b>Старый паполь заполнен неверно</b></font></center><BR />";
		
	}
	
	if(isset($_POST["plat_pass"])){
	
		function plat_passs($plat_passs){
		if(!preg_match("/^[0-9]{4}$/", $plat_passs)) return false;
		     return $plat_passs;
		}
		$plat_passs = plat_passs($_POST["plat_pass"]);
		$plat_pass = md5($plat_passs);
		
			
			
				if($plat_passs !== false){
				
					
					
						$db->Query("UPDATE db_users_a SET plat_pass = '$plat_pass' WHERE id = '$usid'");
						
						echo "<center><font color = 'green'><b>Новый платежный пароль успешно установлен</b></font></center><BR />";
					
					
				
				}else echo "<center><font color = 'red'><b>Платежный пароль имеет неверный формат!</b></font></center><BR />";
			
			
		
	}
?>


<form action="" method="post">
<table width="330" border="0" align="center">
  <tr>
    <td><b>Eski parolingiz:</b></td>
    <td align="center"><input type="password" name="old" /></td>
  </tr>
  <tr>
    <td><b>Yangi parolingiz:</b></td>
    <td align="center"><input type="password" name="new" /></td>
  </tr>
  <tr>
    <td><b>Yangi parolingiz (takroran):</b></td>
    <td align="center"><input type="password" name="re_new" /></td>
  </tr>
  

  <tr>
    <td align="center" colspan="2"><BR /><input type="submit" value="Parolni o`zgartirish" /></td>
  </tr>
</table>
</form>
<BR />
<?php
if($user_data['plat_pass'] != 0) {
echo '<font color="green">Вы уже установили платежный пароль! Для его смены обратитесь в службу поддержки!</font><br><br>';
} else {
?>
<form action="" method="post">
<table width="330" border="0" align="center">
 
  
  <tr>
    <td><b>To`lov uchun parol(обязательно):</b></td>
    <td align="center"><input type="password" name="plat_pass" /></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><BR /><input type="submit" value="Сменить пароль" /></td>
  </tr>
</table>
</form>
<?php } ?>
<font color="blue">Parol uzunligi 6 belgidan 20 belgigacha va faqat lotin alifbosida kerak<br></font>
<font color="red">Платежный пароль должен состоять только из цифр и не длиннее 4-х символов!</font>
<div class="clr"></div>		
</div>




