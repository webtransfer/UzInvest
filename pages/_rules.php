<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Правила";
$_OPTIMIZATION["description"] = "Общие правила проекта";
$_OPTIMIZATION["keywords"] = "Правила, помятка пользователя, правила проекта";
?>
<div class="s-bk-lf">
	<div class="acc-title">Qoidalar</div>
</div>
<div class="silver-bk0"><div class="clr"></div>	
<font color="black">
<?PHP

$db->Query("SELECT rules FROM db_conabrul WHERE id = '1'");
$xt = $db->FetchRow();
echo $xt;
?>
</div>
</font>
<div class="clr"></div>	