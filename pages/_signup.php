<?PHP
$_OPTIMIZATION["title"] = "Регистрация";
$_OPTIMIZATION["description"] = "Регистрация пользователя в системе";
$_OPTIMIZATION["keywords"] = "Регистрация нового участника в системе";

if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }
?>
<div class="content-wrap row-fluid">

  <div class="noright">
    <div class="text-article">

<?PHP
	
	# Ro`yhatdan o`tish

	if(isset($_POST["login"])){
	
	

	$login = $func->IsLogin($_POST["login"]);
	$pass = $func->IsPassword($_POST["pass"]);
	$rules = isset($_POST["rules"]) ? true : false;
	$time = time();
	$ip = $func->UserIP;
	$ipregs = $db->Query("SELECT * FROM `db_users_a` WHERE INET_NTOA(db_users_a.ip) = '$ip' ");
	$ipregs = $db->NumRows();

	$email = $func->IsMail($_POST["email"]);
	$referer_id = (isset($_COOKIE["i"]) AND intval($_COOKIE["i"]) > 0 AND intval($_COOKIE["i"]) < 1000000) ? intval($_COOKIE["i"]) : 1;
	$referer_name = "";
	if($referer_id != 1){
		$db->Query("SELECT user FROM db_users_a WHERE id = '$referer_id' LIMIT 1");
		if($db->NumRows() > 0){$referer_name = $db->FetchRow();}
		else{ $referer_id = 1; $referer_name = "Admin"; }
	}else{ $referer_id = 1; $referer_name = "Admin"; }
	
		if($rules){
			if($ipregs == 0) {

			if($email !== false){
		
			if($login !== false){
			
				if($pass !== false){
			
					if($pass == $_POST["repass"]){
						
						$db->Query("SELECT COUNT(*) FROM db_users_a WHERE user = '$login'");
						if($db->FetchRow() == 0){
						
						# Foydalanuvchini ro`yhatga olamiz
						$db->Query("INSERT INTO db_users_a (user, email, pass, referer, referer_id, date_reg, ip) 
						VALUES ('$login','{$email}','$pass','$referer_name','$referer_id','$time',INET_ATON('$ip'))");
						
						$lid = $db->LastInsert();
						# BONUS belgilaymiz
						$db->Query("INSERT INTO db_users_b (id, user, money_b, money_p, last_sbor) VALUES ('$lid','$login','1009', '1009', '".time()."')");
						
						# Statistikani yangilaymiz
						$db->Query("UPDATE db_stats SET all_users = all_users +1 WHERE id = '1'");
						
						echo "<center><b><font color = 'green'>Siz muvaffaqiyatli ro`yhatdan o`tdingiz. Tizimga kirish uchun o`ng tomondagi formadan foydalaning</font></b></center><BR />";
						?></div>
						<div class="clr"></div>	
						<?PHP
						return;
						}else echo "<center><b><font color = 'red'>Bunday login bazamizda mavjud</font></b></center><BR />";
						
					}else echo "<center><b><font color = 'red'>Kiritilgan parol mos emas</font></b></center><BR />";
			
				}else echo "<center><b><font color = 'red'>Parol xato to`ldirildi</font></b></center><BR />";
			
			}else echo "<center><b><font color = 'red'>Login xato to`ldirildi</font></b></center><BR />";

		}else echo "<center><font color = 'red'><b>Email formatida xatolik</b></font></center>";
		
		}else echo "<center><font color = 'red'><b>Bu IPdan ro`yhatdan o`tishgan</b></font></center>";

		}else echo "<center><b><font color = 'red'>Qoidalarga roziligizni tasdiqlamadingiz</font></b></center><BR />";
	
		

	}
	
	
?>


<BR />





<div class="signup-box">
  <div class="presentation">
  

    <div class="i-can">invest.webtransfer.uz</div>

    <div class="arrow">
      <span class="date">Aksiya sotib oling!</span>
      <span class="date">Divedentlarga ega bo`ling!</span>
      <span class="date">Daromadingizni yechib oling!</span>
    </div>
  </div>
  <div class="signup-form">
    <div class="user_form">
      <form action="" method="post" id="signupForm">
  <input type="hidden" name="subid" id="subid">
  <input type="hidden" name="partner_key" id="partner_key">
  <input type="hidden" name="group" id="group">
  <input type="hidden" name="source" id="source">
  <input type="hidden" name="reg_group" value="signup">

      <div class="signup-choice">
     
      <ul class="items">
        <li class="choice-1"><label>

           
          </label></li>
        <li class="choice-2"><label>

           
          </label></li>
        <li class="choice-3"><label>

            
          </label></li>
      </ul>
    </div>
  
  
  <label for="first_name">Login tanlang:</label>
  <input type="text" name="login" type="text" size="25" maxlength="10" value="<?=(isset($_POST["login"])) ? $_POST["login"] : false; ?>"/>

  <label for="email">Parol:</label>
  <input type="password" name="pass" />
  
  <label for="email">Parolni takror kiriting:</label>
  <input type="password" name="repass" />
  
  <label for="email">Elektron pochtangiz:</label>
  <input type="text" name="email" type="text" size="25" maxlength="50" value="<?=(isset($_POST["email"])) ? $_POST["email"] : false; ?>"/>
  
   
  <label class="checkbox terms">
    <input name="rules" value="check" checked="checked" type="checkbox">
    Men <a href="/rules" target="_blank" class="service-page-link">foydalanish&nbsp;qoidalarini</a>&nbsp;qabul qilaman&nbsp;.
  </label>

  <div class="controls actions">
    <button type="submit" class="btn btn-primary" id="btnContinue">Ro`yhatdan o`tish</button>
  </div>


</form>    </div>
  </div>
</div>
  </div>
</div>

</div>

<style>
 



  .signup-box .signup-form {
    float: right;
    width: 270px;
  }

  .signup-box .signup-form form {
    margin-bottom: 0;
  }

  .signup-box .signup-form .user_form {
    float: none;
    padding: 20px;
  }

  .signup-box .signup-form .actions {
    text-align: center;
  }

  .signup-box .signup-promo h2 {
    font-size: 1.5em !important;
    line-height: 1em;
    margin-top: 0;
  }

  .content-wrap {
    background-image: url(/img/blocks/signup-page/bg.jpg);
    background-repeat: no-repeat;
    background-position: center;
  }
  


  .i-can {
    color: #514b40;
    font-size: 42px;
    margin: 10px 0 0 0;
    line-height: 44px;
    padding: 0;
    left: 0;
    letter-spacing: -1px;
  }

  .arrow {
    background: url(/img/blocks/signup-page/arrow.png) no-repeat top;
	left:-25px;
    color: #fff;
    font-size: 32px;
    height: 205px;
    line-height: 46px;
    margin:50px 0 0 -64px;
    padding: 24px 0 0 140px;
    position: absolute;
    width: 440px;
  }

  .arrow span {
    display: block;
	margin-left:60px;
  }

  .arrow .weight {
    font-size: 1em;
    font-weight: bold;
  }

  .presentation {
    float: left;
    margin-left: 10px;
  }

  .presentation .author {
    overflow: hidden;
    width: 333px;
    text-align: right;
    zoom: 1;
  }

  .presentation .author img {
    float: left;
  }

  .presentation .author .name {
    font-size: 14px;
    color: #5d4824;
    line-height: 18px;
  }

  .presentation .author .old {
    font-size: 14px;
    color: #88847e;
    line-height: 13px;
    font-style: italic;
  }

  .presentation .author .city {
    font-size: 20px;
    color: #000;
    font-weight: bold;
  }
</style>
<div class="clr"></div>	