<?PHP
$_OPTIMIZATION["title"] = "Реф. баннеры";
$_OPTIMIZATION["description"] = "Реф. баннеры";
$_OPTIMIZATION["keywords"] = "Реф. баннеры";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
<div class="s-bk-lf">
	<div class="acc-title">Реф. ссылки</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
Приглашайте в игру своих друзей и знакомых, Вы будете получать 1% от каждого пополнения баланса  
приглашенным Вами человеком. Доход ни чем не ограничен. Даже несколько приглашенных могут 
принести вам более 1000 рублей.<br><hr>
Ниже представлена ссылка для привлечения рефералов.<br />
<img src="/img/piar-link.png" style="vertical-align:-2px; margin-right:5px;" /><font color="#000;"><b>http://<?=$_SERVER['HTTP_HOST']; ?>/?i=<?=$_SESSION["user_id"]; ?></b></font>


</div>

<div class="clr"></div>	
