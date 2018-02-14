<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Новости";
$_OPTIMIZATION["description"] = "Новости проекта";
$_OPTIMIZATION["keywords"] = "Новости нашего проекта";
?>
<div class="s-bk-lf">
	<div class="acc-title">Новости</div>
</div>
<div class="silver-bk0"><div class="clr"></div>	
<font  color = "#000"><?PHP

$usid = $_SESSION["user_id"];
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


		$db->Query("SELECT * FROM db_vote_news WHERE user_id = '$usid' AND id_news = '$id_ans'");
		if ($db->NumRows() >= 1) {
			echo "<font color=\"red\"><center>Вы уже оценивали данный отзыв!</center></font>";
		} else {
$db->Query("INSERT INTO db_vote_news (user_id, dislike, oklike, id_news) VALUES ($usid, $dislike, $oklike, $id_ans) ");
 $db->Query("UPDATE db_news SET `like` = `like` $like 1 WHERE id = '$id_ans'");
	echo "<font color=\"green\"><center>Ваша оценка принята!</center></font>";
	
		}
	
	
	
}




$db->Query("SELECT * FROM db_news ORDER BY id DESC");

if($db->NumRows() > 0){

	while($news = $db->FetchArray()){
	
	?>

            
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><h3><font  color = "#802B0F"><?=$news["title"]; ?></font></h3></td>
    <td align="right"><strong><div class="line-st1"><font  color = "#802B0F"><?=date("d.m.Y",$news["date_add"]); ?></font></div></strong></td>
  </tr>

  <tr>
    <td colspan="2"><?=$news["news"]; ?></td>
  </tr>
  <tr>
  <?php
if ($news['like'] > 0) {
$like = '<font color="green">'.$news['like'].'</font>';
} elseif($news['like'] < 0) {
$like = '<font color="red">'.$news['like'].'</font>';
} elseif ($news['like'] == 0) {
$like = $news['like'];
}
if (!$usid) {
echo "<td><a href=\"#\" onClick=\"alert('Вам требуется авторизоваться, чтобы оценить запись')\"><img src=\"/images/dislike.gif\"></a> &nbsp;&nbsp;".$like;
echo " &nbsp;&nbsp;<a href=\"#\" onClick=\"alert('Вам требуется авторизоваться, чтобы оценить запись')\"><img src=\"/images/oklike.gif\"></a></td>";

} else {
echo '<td><a href="/?menu=news&id_ans='.$news['id'].'&rating=dislike"><img src="/images/dislike.gif"></a> &nbsp;&nbsp;'.$like;
echo ' &nbsp;&nbsp;<a href="/?menu=news&id_ans='.$news['id'].'&rating=oklike"><img src="/images/oklike.gif"></a></td>';
  }
  ?>
  </tr>
</table> 
<BR />
<center><img src="/img/tretwer.png" alt=""></center>
	<?PHP
	
	}

}else echo "<center>Новостей нет :(</center>";

?>
</div><font>
<div class="clr"></div>	