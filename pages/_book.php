<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "О проекте";
$_OPTIMIZATION["description"] = "О нашем проекте";
$_OPTIMIZATION["keywords"] = "Немного о нас и о нашем проекте";
?>
<div class="s-bk-lf">
	<div class="acc-title">О проекте</div>
</div>
<div class="silver-bk0"><div class="clr"></div>	
<font color="black"><?PHP

$db->Query("SELECT about FROM db_conabrul WHERE id = '1'");
$xt = $db->FetchRow();
echo $xt;
?></font>
</div>
<div class="clr"></div>	