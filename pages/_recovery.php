<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Parolni tiklash";
$_OPTIMIZATION["description"] = "Unutilgan parolni tiklash";
$_OPTIMIZATION["keywords"] = "Unutilgan parolni tiklash";

if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }

?>
<div class="s-bk-lf">
	<div class="acc-title">Parolni tiklash</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP

	if(isset($_POST["email"])){

		if(isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])){
		
		unset($_SESSION["captcha"]);
		
		$email = $func->IsMail($_POST["email"]);
		$time = time();
		$tdel = $time + 60*15;
		
			if($email !== false){
				
				$db->Query("DELETE FROM db_recovery WHERE date_del < '$time'");
				$db->Query("SELECT COUNT(*) FROM db_recovery WHERE ip = INET_ATON('".$func->UserIP."') OR email = '$email'");
				if($db->FetchRow() == 0){
				
					$db->Query("SELECT id, user, email, pass FROM db_users_a WHERE email = '$email'");
					if($db->NumRows() == 1){
					$db_q = $db->FetchArray();
					
					# Вносим запись в БД
					$db->Query("INSERT INTO db_recovery (email, ip, date_add, date_del) VALUES ('$email',INET_ATON('".$func->UserIP."'),'$time','$tdel')");
					
					# Отправляем пароль
					$sender = new isender;
					$sender -> RecoveryPassword($db_q["email"], $db_q["pass"], $db_q["email"]);
					
					echo "<center><font color = 'green'><b>Emailingizga kerakli ma'lumotlar jo'natildi!</b></font></center>";
					?>
					</div>
					<div class="clr"></div>	
					<?PHP
					return; 
					
					}else echo "<center><font color = 'red'><b>Tizimda bunday emailga ega foydalanuvchi mavjud emas</b></font></center>";
				
				}else echo "<center><font color = 'red'><b>So'nggi 15 daqiqada tiklash amalga oshirilgan.</b></font></center>";
				
			}else echo "<center><font color = 'red'><b>EMail xato kiritilgan</b></font></center>";
		
		}else echo "<center><font color = 'red'><b>Maxfiy kod xato kiritilgan</b></font></center>";
	
	}

?>

<BR />
<form action="" method="post">
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" width="250">Email (ro'yhatda o'tishda ko'rsatilgan):</td>
    <td align="left" width="250"><input name="email" type="text" size="25" maxlength="50" value="<?=(isset($_POST["email"])) ? $_POST["email"] : false; ?>"/></td>
  </tr>
  
  <tr>
    <td align="left" width="250" style="padding-top:20px;">
	<a href="#" onclick="ResetCaptcha(this);"><img src="captcha.php?rnd=<?=rand(1,10000); ?>"  border="0" style="margin:0;"/></a>
	</td>
    <td align="left" width="250" style="padding-top:20px;">Rasmdagi maxfiy kodni kiriting <input name="captcha" type="text" size="25" maxlength="50" /></td>
  </tr>
  
  <tr>
    <td colspan="2" align="center"><BR /><input type="submit" value="Parolni tiklash" style="height: 30px;"></td>
  </tr>
</table>
</form>
</div>
<div class="clr"></div>	
