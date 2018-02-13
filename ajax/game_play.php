<?php
session_start();
define('playCom', 0.1);
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];
# Константа для Include
define("CONST_RUFUS", true);

# Автоподгрузка классов
function __autoload($name){ include($_SERVER['DOCUMENT_ROOT']."/classes/_class.".$name.".php");}

# Класс конфига 
$config = new config;

# Функции
$func = new func;

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

$db->Query('SELECT `money_b` FROM `db_users_b` WHERE id = '.$usid);
$u_balance = $db->FetchRow();
$db->Query("SELECT * FROM `db_games_knb` WHERE `id` = ".intval($_POST["id"])." AND `win`='0' ");

if($db->NumRows() == 0){
	echo "<script type='text/javascript'>
$('.play-".intval($_POST["id"])."').html('Игра не найдена');
</script>";
return;
}

$row = $db->FetchArray();

$db->Query("SELECT * FROM `db_games_knb` WHERE `id` = ".intval($_POST["id"])."  AND `win`='0' AND `login`='$uname' ");

if($db->NumRows() > 0){
	echo "<script type='text/javascript'>
$('.play-".intval($_POST["id"])."').html('Это ваша ставка');
</script>";
return;
}

$err = NULL;
if($u_balance < round($row["summa"],2))
	$err .= "На Вашем балансе недостаточно средств. ";
if($_POST["item"] > 3 OR $_POST["item"] <1)
	$err .= "Выберите предмет. ";
	
if($err != NULL){
	echo "<script type='text/javascript'>
$('.play-".intval($_POST["id"])."').html('".$err."');
</script>";
	return;
}


if($row["item"] == $_POST["item"]){
			$db->Query("UPDATE `db_users_b` SET `money_b` = `money_b` + ".$row["summa"]." WHERE `user`  = '".$row["login"]."'");			
			$db->Query("UPDATE `db_games_knb` SET `win`='2' WHERE `id` = ".intval($_POST["id"]));
			$db->Query("UPDATE `db_games_knb` SET `gamer`='$uname' WHERE `id` = ".intval($_POST["id"]));
			$db->Query("UPDATE `db_games_knb` SET `last`='1' WHERE `id` = ".intval($_POST["id"]));
			echo "<script type='text/javascript'>$('.play-".intval($_POST["id"])."').html('Ничья');</script>";
			
		}elseif(($row["item"] == 1 AND $_POST["item"] == 2) OR ($row["item"] == 2 AND $_POST["item"] == 3) OR ($row["item"] == 3 AND $_POST["item"] == 1)){
			$db->Query("UPDATE `db_users_b` SET `money_b` = `money_b` - ".$row["summa"]." WHERE `user`  = '".$uname."'");
			$db->Query("UPDATE `db_users_b` SET `money_b` = `money_b` + ".round(($row["summa"] + $row["summa"]*(1-playCom)) ,2)." WHERE `user`  = '".$row["login"]."'");		
			$db->Query("UPDATE `db_games_knb` SET `win`='3' WHERE `id` = ".intval($_POST["id"]));
			$db->Query("UPDATE `db_games_knb` SET `gamer`='$uname' WHERE `id` = ".intval($_POST["id"]));
			$db->Query("UPDATE `db_games_knb` SET `last`='1' WHERE `id` = ".intval($_POST["id"]));
			echo "<script type='text/javascript'>$('.play-".intval($_POST["id"])."').html('<font color=\"#f00\">Поражение</font>');
</script>";
		}else{
						
			$db->Query("UPDATE `db_users_b` SET `money_b` = `money_b` + ".round($row["summa"]*(1-playCom),2)." WHERE `user`  = '".$uname."'");						
			$db->Query("UPDATE `db_games_knb` SET `win`='1' WHERE `id` = ".intval($_POST["id"]));
			$db->Query("UPDATE `db_games_knb` SET `gamer`='$uname' WHERE `id` = ".intval($_POST["id"]));
			$db->Query("UPDATE `db_games_knb` SET `last`='1' WHERE `id` = ".intval($_POST["id"]));
			echo "<script type='text/javascript'>$('.play-".intval($_POST["id"])."').html('<font color=\"#0F680B\">Победа</font>');</script>";
		}
?>