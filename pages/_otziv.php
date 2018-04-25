<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Отзывы о проекте";
$_OPTIMIZATION["description"] = "Список последних отзывов";
$_OPTIMIZATION["keywords"] = "Отзывы о investfor.net";
?>
<div class="s-bk-lf">
	<div class="acc-title">Отзывы</div>
</div>
<div class="silver-bk0"><div class="clr"></div>Теперь здесь можно оставить свой отзыв о нашем проекте! Что бы оставить отзыв сумма пополнений на вашем балансе должна быть 50 рублей или более. Бонусом за любой отзыв является случайное <b>вознаграждение от 100 до 500 кредитов</b> для покупок. Если в отзыве есть скриншот выплаты начисляется <b>вознаграждение от 500 до 1000 кредитов</b> для покупок. Максимум можно оставить только 1 отзыв.<hr>
<font color="black">

<?php
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
	$user_data = $db->FetchArray();
	$user_name=$user_data["user"];
	$user_insert=intval($user_data["insert_sum"]);
	
$db->Query("SELECT * FROM db_otziv WHERE user_id = '$usid'");
$col = $db->NumRows();

//Add otziv
if(isset($_POST['asd'])) {

$text = $db->RealEscape($_POST['content']);//Фильтрация
$neg = intval($_POST['neg']);//Фильтрация
$img = $db->RealEscape($_POST['img']);//Фильтрация

$date = time();
	if($col >= 1) {
		echo '<font color="red"><center>Вы уже добавляли отзыв! Спасибо!</center></font>';
	} elseif (!isset($_SESSION["user"])) {
		echo '<font color="red"><center>Для добавления отзыва необходимо пройти авторизацию!</center></font>';
	} elseif(strlen($text) < 100 or $text == "") {
		echo '<font color="red"><center>Минимальная длинна отзыва 10 символов!</center></font>';
	} else {
$as = $db->Query("INSERT INTO db_otziv (login, user_id, date, text, neg, img) VALUES ('$usname', '$usid', '$date', '$text', '$neg', '$img')"); //Добавляем отзыв
			if (strlen($text) > 100 and $img == "") {
				$present=rand(100,500);
			}
			if ($img != "" and strlen($text) > 100) {
				$present=rand(500,1000);
			}


		if(strlen($text) > 100) {
			//$present=rand(100,1000);
			$db->Query("UPDATE db_users_b SET money_b = money_b + $present WHERE id = '$usid'"); // + Кредиты за отзыв
		}
	}
		if($as) echo "<font color=\"green\"><center>Ваш отзыв успешно добавлен и вам начисленно $present кредитов!</center></font>";
}

//Delete Otziv
if(isset($_POST["delotz"]) AND isset($_POST["del_id"]))
{
	$id=intval($_POST["del_id"]);
	if(isset($_SESSION["admin"]))
	{
		$db->Query("DELETE FROM db_otziv WHERE user_id = {$id};");
		echo('<tr><td align="center" colspan="6">Отзыв успешно удалён!</td></tr>');
	}
}




//Vote news
if(isset($_GET['id_ans'])) {   //Dis Like
	if($_GET['rating'] == "dislike") {
		$dislike = 1;
		$oklike = 0;
		$like = "-";
		//$db->Query("UPDATE db_otziv SET like = like + 1 WHERE id = '$id_ans'");
	} elseif ($_GET['rating'] == "oklike") {
		$dislike = 0;
		$oklike = 1;
		$like = "+";
		//$db->Query("UPDATE db_otziv SET like = like + 1 WHERE id = '$id_ans'");
	} else {
		echo "<font color=\"red\"><center>Неизвестная ошибка! Обратитесь к администрации!</center></font>";
	}
$id_ans = intval($_GET['id_ans']);


		$db->Query("SELECT * FROM db_vote_otziv WHERE user_id = '$usid' AND id_news = '$id_ans'");
		if ($db->NumRows() >= 1) {
			echo "<font color=\"red\"><center>Вы уже оценивали данный отзыв!</center></font>";
		} else {
$db->Query("INSERT INTO db_vote_otziv (user_id, dislike, oklike, id_news) VALUES ($usid, $dislike, $oklike, $id_ans) ");
 $db->Query("UPDATE db_otziv SET `like` = `like` $like 1 WHERE id = '$id_ans'");
	echo "<font color=\"green\"><center>Ваша оценка принята!</center></font>";
	
		}
	
	
	
}



$db->Query("SELECT * FROM db_otziv");
if($db->NumRows() > 0) {

//вывод отзывов в цикле)

$num = 20;
$page = $_GET['page'];
$result00 = $db->Query("SELECT COUNT(*) FROM db_otziv");
$temp = $db->FetchArray($result00);
$posts = $temp[0];
$total = (($posts - 1) / $num) + 1;
$total =  intval($total);
$page = intval($page);
if(empty($page) or $page < 0) $page = 1;
if($page > $total) $page = $total;
$start = $page * $num - $num;		
		


$db->Query("SELECT * FROM db_otziv ORDER BY id DESC LIMIT $start, $num");

while($otziv = $db->FetchArray()) {

$id_otziv = $otziv['id'];

//$lik = $db->Query("SELECT * FROM db_vote_otziv WHERE id_news = '$id_otziv' AND dislike = 1");
//$like = $db->NumRows($lik);

$by_user_id = $otziv['user_id'];
if($otziv['neg'] == 1) {
$otziv['neg'] = 'Положительный отзыв от ';
$collor = "green";
} elseif ($otziv['neg'] == 2) {
$otziv['neg'] = 'Негативный отзыв от ';
$collor = "red";
} else {
$otziv['neg'] = 'Нейтральный отзыв от ';
$collor = "black";
}
if(isset($_SESSION["admin"]))
		{
			$admlink="<form action=\"\" method=\"post\">
			<input type=\"hidden\" name=\"del_id\" value=\"$by_user_id\">
			<input type=\"submit\" name=\"delotz\" value=\"Удалить\" />
			</form>";
		}
$date = date("d.m.Y",intval($otziv["date"]));
echo '<hr><font color='.$collor.'><b>'.$otziv['neg'].'- '.$otziv['login'].'</b></font>  '.$date.' '.$admlink.'<br>'.$otziv['text'].'<br>';
if ($otziv['img'] != '') {
echo '<center><hr><a href="'.$otziv['img'].'" target="_blank"><img src="'.$otziv['img'].'" width="500px"/></a></center><br>';
}
if ($otziv['like'] > 0) {
$like = '<font color="green">'.$otziv['like'].'</font>';
} elseif($otziv['like'] < 0) {
$like = '<font color="red">'.$otziv['like'].'</font>';
} elseif ($otziv['like'] == 0) {
$like = $otziv['like'];
}
if (!$usid) {
echo "<td><a href=\"#\" onClick=\"alert('Вам требуется авторизоваться, чтобы оценить запись')\"><img src=\"http://s17.rimg.info/95958c121924bc27780adcb3d382cb2e.gif\"></a> &nbsp;&nbsp;".$like;
echo " &nbsp;&nbsp;<a href=\"#\" onClick=\"alert('Вам требуется авторизоваться, чтобы оценить запись')\"><img src=\"http://s20.rimg.info/fc15db41ec50ab9dd0dd06be83d545c4.gif\"></a></td>";

} else {
echo '<a href="/?menu=otziv&id_ans='.$otziv['id'].'&rating=dislike"><img src="/img/dislike.png"></a> &nbsp;&nbsp;'.$like;
echo ' &nbsp;&nbsp;<a href="/?menu=otziv&id_ans='.$otziv['id'].'&rating=oklike"><img src="/img/like.png"></a>';
}
echo '<hr><center><img src="/img/tretwer.png"></center><br>';
}


// Проверяем нужны ли стрелки назад
if ($page != 1) $pervpage = '<a href=/news/1>Первая</a> | <a href='. ($page - 1) .'>Предыдущая</a> | ';
// Проверяем нужны ли стрелки вперед
if ($page != $total) $nextpage = ' | <a href='. ($page + 1) .'>Следующая</a> | <a href=' .$total. '>Последняя</a>';

// Находим две ближайшие станицы с обоих краев, если они есть
if($page - 5 > 0) $page5left = ' <a href='. ($page - 5) .'>'. ($page - 5) .'</a> | ';
if($page - 4 > 0) $page4left = ' <a href='. ($page - 4) .'>'. ($page - 4) .'</a> | ';
if($page - 3 > 0) $page3left = ' <a href='. ($page - 3) .'>'. ($page - 3) .'</a> | ';
if($page - 2 > 0) $page2left = ' <a href='. ($page - 2) .'>'. ($page - 2) .'</a> | ';
if($page - 1 > 0) $page1left = '<a href='. ($page - 1) .'>'. ($page - 1) .'</a> | ';

if($page + 5 <= $total) $page5right = ' | <a href='. ($page + 5) .'>'. ($page + 5) .'</a>';
if($page + 4 <= $total) $page4right = ' | <a href='. ($page + 4) .'>'. ($page + 4) .'</a>';
if($page + 3 <= $total) $page3right = ' | <a href='. ($page + 3) .'>'. ($page + 3) .'</a>';
if($page + 2 <= $total) $page2right = ' | <a href='. ($page + 2) .'>'. ($page + 2) .'</a>';
if($page + 1 <= $total) $page1right = ' | <a href='. ($page + 1) .'>'. ($page + 1) .'</a>';

// Вывод меню если страниц больше одной

if ($total > 1)
{
Error_Reporting(E_ALL & ~E_NOTICE);
echo "<div class=\"pstrnav\">";
echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;
echo "</div>";
}
} else {
echo '<tr><td align="center" colspan="6"><font color="green"><center>Отзывов еще не было!</center></font></td></tr>';
}
?>
<?php
if(!isset($_SESSION["user"])) {
	echo '<tr><td align="center" colspan="6"><font color="red"><center>Для оставления отзыва необходимо войти в систему!</center></font></td></tr>';
} elseif ($user_insert < 10 or $col >= 1){
echo('<tr><td align="center" colspan="6"><font color="red"><center>Вы уже оставляли отзыв, либо сумма пополнений игрового счёта меньше 10 рублей!</center></font></td></tr>');
} else {


?>
	<form method="post" action="">
	<div align="center" style="margin:5px;clear:both">Оставьте отзыв! Для нас это очень важно!<br>
	<textarea name="content" rows="8" style="resize:none;width:95%;"></textarea>
	</div>
	<div align="center" style="margin:5px">
	<input type="radio" name="neg" value="1" checked title="Положителный отзыв"><img src="/img/07.gif" title="Положителный отзыв">
	<input type="radio" name="neg" value="2" title="Негативный отзыв"><img src="/img/13.gif" title="Негативный отзыв">
	<input type="radio" name="neg" value="3" title="Нейтральный отзыв"><img src="/img/02.gif" title="Нейтральный отзыв"><br>
  	<input type="hidden" name="asd" >
	Скрин выплаты(не обязательно): <input type="text" name="img" value=""><br>
  	<input type="submit" value="Написать отзыв">
	</div>
	</form>
	<? } ?>
</div>
</font>

