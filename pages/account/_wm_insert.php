<?PHP
$_OPTIMIZATION["title"] = "Пополнение через WM";
$_OPTIMIZATION["description"] = "Пополнение через WM";
$_OPTIMIZATION["keywords"] = "Пополнение через WM";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
<div class="s-bk-lf">
	<div class="acc-title">Пополнение через QIWI</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
Что бы пополнить баланс через систему киви, нужно сделать перевод на счет проекта +998977992025  в комментариях указать логин в игре!						
</div>
<div class="clr"></div>	