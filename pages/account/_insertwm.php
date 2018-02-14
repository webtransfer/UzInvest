<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Пополнение через WebMoney";
$_OPTIMIZATION["description"] = "Пополнение через WebMoney";
$_OPTIMIZATION["keywords"] = "Пополнение через WebMoney";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
<div class="s-bk-lf">
	<div class="acc-title1">Пополнение WebMoney</div>
</div>

<div class="silver-bk1"><div class="clr"></div>
<center><img src="data:image/jpeg;base64,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" alt="" style="border-top-color: currentColor; border-top-width: medium; border-top-style: solid; border-bottom-color: currentColor; border-bottom-width: medium; border-bottom-style: solid; border-left-color: currentColor; border-left-width: medium; border-left-style: solid; border-right-color: currentColor; border-right-width: medium; border-right-style: solid;"></center><br>
<table style="border-collapse:collapse;width:100%;"><tbody><tr><td><br></td><td>Для того что бы пополнить баланс через ВМ нужно сделать перевод на сумму пополнения на кошелек R263499659155  в комментариях указать свой логин!<br>Пример: "Investup.Biz: tester" </strong>.<br><br><strong></strong><br></td></tr></tbody></table>
</center></div><br>



