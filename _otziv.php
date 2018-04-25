<?PHP
$_OPTIMIZATION["title"] = "Отзывы о проекте";
$_OPTIMIZATION["description"] = "Список последних отзывов";
$_OPTIMIZATION["keywords"] = "Отзывы о money-ferma.ru";
?>
<div class="s-bk-lf">
	<div class="acc-title">Отзывы</div>
</div>
<div class="silver-bk0"><div class="clr"></div>	
<font color="black">
Полезные ссылки: <a href=/payments target="_blank">Последние выплаты</a> / <a href=http://i48.fastpic.ru/big/2013/0718/20/40b2a8661f075af388a31f79793eab20.png target="_blank">Скрин выплат</a>.<br>
Ешё отзывы: <a href=http://mmgp.ru/showthread.php?t=203357 target="_blank">mmgp.ru</a> / <a href=http://ruseo.net/ferma-igra-s-vivodom-denejnih-sredstv-t12390.html target="_blank">ruseo.net</a> / <a href=http://www.mywot.com/ru/scorecard/money-ferma.ru?src=addon-rw-viewsc target="_blank">mywot.com</a>.<br>
<hr>
<?PHP
$user_id=-1;
$user_name = "";
if(isset($_SESSION["user_id"]))
{
	$user_id = $_SESSION["user_id"];
	$db->Query("SELECT * FROM db_users_b WHERE id = '$user_id' LIMIT 1");
	$user_data = $db->FetchArray();
	$user_name=$user_data["user"];
}

if(isset($_POST["delotz"]) AND isset($_POST["del_id"]))
{
	$id=intval($_POST["del_id"]);
	if(isset($_SESSION["admin"]))
	{
		$db->Query("DELETE FROM db_otziv WHERE user_id = {$id};");
		echo('<tr><td align="center" colspan="6">Отзыв успешно удалён!</td></tr>');
	}
}

$db->Query("SELECT * FROM db_otziv ORDER BY date DESC");
$allow_post=true;
if($user_id==0 OR $user_id==-1){$allow_post=false;}
if($db->NumRows() > 0)
{
  	while($otz = $db->FetchArray())
  	{
  		$by_user=$otz["user"];
  		$by_user_id=$otz["user_id"];
  		$date=date("d.m.Y",intval($otz["date"]));
  		$content=$otz["content"];
  		$admlink="";
  		if($user_id==$by_user_id){$allow_post=false;}
		if(isset($_SESSION["admin"]))
		{
			$admlink="<form action=\"\" method=\"post\"><input type=\"hidden\" name=\"del_id\" value=\"$by_user_id\"><input type=\"submit\" name=\"delotz\" value=\"Удалить\" /></form>";
		}
		echo("<font color=\"green\"><b>{$by_user} - ({$date}) {$admlink}</b></font><br>{$content}<br><center><img src=\"/img/tretwer.png\"></center>");
	}
}else{echo('<tr><td align="center" colspan="6">Разробатываетя скрипт</td></tr>');}
if($allow_post)
{
?>
	<form method=POST action="">
	<div align="center" style="margin:5px;clear:both">Оставьте отзыв и получите от 1 до 10 лаймов в подарок!<br>
	<textarea name="content" required rows=8 style="resize:none;width:95%;"></textarea>
	</div>
	<div align="center" style="margin:5px">
  	<input type=submit value="Написать отзыв">
	</div>
	</form>
<?PHP
	if(isset($_POST["content"]))
	{
		$time=$db->get_time();
		$body=$db->RealEscape($_POST["content"]);
		$db->Query("INSERT INTO db_otziv (user,user_id,date,content) VALUES($user_name,$user_id,$time,$body);"); // пишем отзыв
		$present=rand(1,10);
		$db->Query("UPDATE db_users_b SET a_t = a_t + $present WHERE id = '$user_id'"); // + дерево
	}
}else{
	if($user_id!=-1 OR $user_id!=0){echo('<tr><td align="center" colspan="6">Вы уже оставляли отзыв!</td></tr>');}
	else{echo('<tr><td align="center" colspan="6">Для оставления отзыва необходимо войти в систему!</td></tr>');}
}
?>
</div>
</font>