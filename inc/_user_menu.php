<div class="user-menu">
	
	<?
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM wmrush_pm WHERE user_id_in = '$usid' AND status = 0 AND inbox = 1");
	$sk = $db->NumRows();
	if ($sk > 0) {$pmm = '<font color="red">('.$sk.')</font>';} else {$pmm = '<font color="green">(0)</font>';}
?>
	
	 <p class="headbl">Bo'limlar</p>
      <ul>
                
                <li><a href="/account">Mening hisobim</a></li>
                <li><a href="/account/pm">Pochta</a> <sup><?=$pmm; ?></sup></li>
                <li><a href="/account/bonus">Kunlik bonus <sup><font color="red"><b> new</b></font></sup></a></li>
                <li><a href="/account/farm">Aksiyalar birjasi</a></li>
                <li><a href="/account/life">Aksiyalarim</a></li>
                <li><a href="/account/store">Seyf</a></li>
                <li><a href="/account/market">Bank</a></li>
                <li><a href="/competition"><font color="red">Referallar musobaqasi</font></a></li>
                
                <li><a href="/account/chat">Online Chat<sup><font color="red"><b> new</b></font></sup></a></li>
                <li><a href="/account/donations">Proyektga ko`mak<sup><font color="red"><b> new</b></font></sup></a></li>
                <li><a href="/account/config">Sozlamalar</a></li>
               
              </ul>
			  </div>
		
			  	<div class="user-menu">
 <p class="headbl">O`yinlar bo`limi</p>
      <ul>
                
                <li><a href="/account/lottery">Lotereya</a></li>
                <li><a href="/account/knb">Tosh-Qaychi-Qog`oz</a></li>
                <li><a href="/account/rul">Sharchani top</a></li>
                
               
              </ul>
	</div>
	
	
	<div class="user-menu">
 <p class="headbl">Referallar</p>
      <ul>
                
                <li><a href="/account/referals">Referallaringiz</a></li>
                <li><a href="/account/ref_ban">Reklama materiallari</a></li>
                
               
              </ul>
	</div>
	
	
	<div class="user-menu">
 <p class="headbl">Hisobingiz holati</p>
      <ul>
                
                <li><font color="blue">Asosiy: </font> <font color="green">{!BALANCE_B!} So'm</font></li>
                <li><a href="/account/insert"><font color="red">Hisobni to`ldirish</font></a></li>
                <li><font color="blue">Ikkilamchi: </font> <font color="green">{!BALANCE_P!} So'm</font></li>
                <li><a href="/account/payment"><font color="red">Hisobdan yechib olish</font></a></li>
                <li><a href="/account/swap"><font color="blue">Ikkilamchi hisobdan asosiy hisobga o'tkazish</a></li></font>
                
               
              </ul>
	</div>
	
	
	
	

		<a href="/account/exit"><div class="field-rd"></div></a>
	

