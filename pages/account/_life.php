<div class="section_w500">
<div class="s-bk-lf">
	<div class="acc-title1">Aksiyalar muddati</div>
</div>
<div class="silver-bk0"><div class="clr"></div>
<p><font color="black">Har bir aksiya amal qilish muddati tugaguncha daromad keltiradi. </font></p><br>

                               </div>
                               </div>
<br>
<?PHP
$_OPTIMIZATION["title"] = "Hisobim - Aksiyalar muddati";
$usid = $_SESSION["user_id"];
$refid = $_SESSION["referer_id"];
$usname = $_SESSION["user"];

$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();

$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
?>
				
			




	
	
	<div class="cl-fr-rg" style="padding-left:20px;">
		<?php $life_time->GetTable($usid); ?>
	</div>
	




<div class="clr"></div>