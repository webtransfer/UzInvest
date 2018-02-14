<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Игровой раздел";
$_OPTIMIZATION["description"] = "Игры, развлечения";
$_OPTIMIZATION["keywords"] = "Игры, развлечения";
$user_id = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
<div class="s-bk-lf">
	<div class="acc-title1">Игровой раздел</div>
</div>

<div class="silver-bk1"><div class="clr"></div><font color=black>Приветствуем вас в игровом разделе нашего проекта, тут вам на выбор доступны некоторые игры в которых вам можно играть с другими игроками проекта, а именно Лотерея и Камень-Ножницы-Бумага. Так же ведется разработка новой игры!</font><br>
<table style="border-collapse:collapse;width:100%;"><tbody><tr align="center"><td><a href="/account/lottery"><img src="/img/lotto.jpg" alt="" style="border-top-width: medium; border-top-style: ridge; border-bottom-width: medium; border-bottom-style: ridge; border-left-width: medium; border-left-style: ridge; border-right-width: medium; border-right-style: ridge; border-top-color: rgb(221, 160, 221); border-bottom-color: rgb(221, 160, 221); border-left-color: rgb(221, 160, 221); border-right-color: rgb(221, 160, 221);"></a><p>

<center><a href="/account/lottery">Лотерея</a></center>

</p></td><td><a href="/account/knb"><img src="/img/knb.gif" alt="" style="border-top-color: rgb(221, 160, 221); border-top-width: medium; border-top-style: ridge; border-bottom-color: rgb(221, 160, 221); border-bottom-width: medium; border-bottom-style: ridge; border-left-color: rgb(221, 160, 221); border-left-width: medium; border-left-style: ridge; border-right-color: rgb(221, 160, 221); border-right-width: medium; border-right-style: ridge;"></a><p><center><a href="/account/knb">Камень-Ножницы-Бумага</a></center>

</p></td></tr></tbody></table><table style="border-collapse:collapse;width:100%;"><tbody><tr align="center"><td> <a href="/account/rul"> <img src="/img/new.jpg" alt="" style="border-top-color: rgb(221, 160, 221); border-top-width: medium; border-top-style: ridge; border-bottom-color: rgb(221, 160, 221); border-bottom-width: medium; border-bottom-style: ridge; border-left-color: rgb(221, 160, 221); border-left-width: medium; border-left-style: ridge; border-right-color: rgb(221, 160, 221); border-right-width: medium; border-right-style: ridge;"></a><p><center><a href="/account/rul">Игра наперстки</a></center>

</td></tr></tbody></table><br></div><br>


