<?PHP
$_OPTIMIZATION["title"] = "Пополнение через WM";
$_OPTIMIZATION["description"] = "Пополнение через WM";
$_OPTIMIZATION["keywords"] = "Пополнение через WM";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
<div class="s-bk-lf">
	<div class="acc-title">Пополнение через WM</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
Д1ля того чтобы пополнить игровой баланс через WebMoney выполните простые указания:</p><p>1. Зайдите на свой WebMoney кошелек.</p><p>2. Переведите нужную вам сумму на рублевый счет: <font color="#ff0000">R421350229089</font> а в примечании к платежу укажите "<b>Пополнение от <?=$prof_data["user"]; ?></b>".</p><p>3.<font color="#ff0000"> </font>Ожидайте пополнения баланса.
				</div>
Пополнение баланса в ручном режиме займет от 1 минуты до 12 часов.						
</div>
<div class="clr"></div>	