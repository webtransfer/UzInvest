<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Контакты";
$_OPTIMIZATION["description"] = "Связь с администрацией";
$_OPTIMIZATION["keywords"] = "Связь с администрацией проекта";
?>
<div class="s-bk-lf">
	<div class="acc-title">Контакты</div>
</div>
<div class="silver-bk0"><div class="clr"></div>	
<font color="black">
<b>По всем вопросам связаным с проектом:</b><br>
<div id="liveTexButton_57303"></div>
<?PHP

$db->Query("SELECT contacts FROM db_conabrul WHERE id = '1'");
$xt = $db->FetchRow();
echo $xt;
?>
</font>
</div>
<div class="clr"></div>	