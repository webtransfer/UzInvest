<?PHP
######################################
# Скрипт Fruit Farm
# Автор Rufus
# ICQ: 819-374
# Skype: Rufus272
######################################
$_OPTIMIZATION["title"] = "Аккаунт";
$_OPTIMIZATION["description"] = "Аккаунт пользователя";
$_OPTIMIZATION["keywords"] = "Аккаунт, личный кабинет, пользователь";

# Блокировка сессии
if(!isset($_SESSION["user_id"])){ Header("Location: /"); return; }

if(isset($_GET["sel"])){
		
	$smenu = strval($_GET["sel"]);
			
	switch($smenu){
		
		case "404": include("pages/_404.php"); break; // Страница ошибки
		case "stats": include("pages/account/_story.php"); break; // Статистика
		case "referals": include("pages/account/_referals.php"); break; // Рефералы
		case "farm": include("pages/account/_farm.php"); break; // Моя ферма
		case "store": include("pages/account/_store.php"); break; // Склад
		case "swap": include("pages/account/_swap.php"); break; // Обменный пункт
		case "market": include("pages/account/_market.php"); break; // Рынок
		case "payment": include("pages/account/_payment.php"); break; // Выплата WM
		case "payment_yandex": include("pages/account/_payment_yandex.php"); break; // Выплата yandex
		case "payment_qiwi": include("pages/account/_payment_qiwi.php"); break; // Выплата qiwi
		case "payment_pm": include("pages/account/_payment_pm.php"); break; // Выплата PerfectMoney
		case "payment_payeer": include("pages/account/_payment_payeer.php"); break; // Выплата payeer
		case "insert": include("pages/account/_insert.php"); break; // Пополнение баланса
		case "insertwm": include("pages/account/_insertwm.php"); break; // Пополнение баланса
		case "config": include("pages/account/_config.php"); break; // Настройки
		case "bonus": include("pages/account/_bonus.php"); break; // Ежедневный бонус
        case "set": include("pages/account/_set.php"); break; // Сэты 
		case "lottery": include("pages/account/_lottery.php"); break; // Лотерея
		case "paymentwm": include("pages/account/_paymentwm.php"); break; // Выплата WM
		case "otziv": include("pages/_otziv.php"); break; // Отзывы
		case "book": include("pages/_book.php"); break; // FAQ
		case "ref_ban": include("pages/account/_ref_ban.php"); break; // Отзывы
        case "chat": include("pages/account/_chat.php"); break; // ЧАТ
        case "actions": include("pages/account/_actions.php"); break; // Акции
        case "faq": include("pages/_faq.php"); break; // FAQ
		case "faq_faq": include("pages/_faq_faq.php"); break; // FAQ_FAQ
		case "knb": include("pages/account/_knb.php"); break; // КНБ
		case "donations": include("pages/account/_donations.php"); break; // Пожертвования
		case "rul": include("pages/account/_rul.php"); break; // Наперстки
		case "games": include("pages/account/_games.php"); break; // Игровой раздел
        case "jobs": include("pages/account/_jobs.php"); break; // Задания
		case "info": include("pages/account/_info.php"); break; // Отзывы
        case "wm_insert": include("pages/account/_wm_insert.php"); break; // ВМ пополнение
		case "paymentz": include("pages/account/_paymentz.php"); break; // paymentz
		case "other": include("pages/account/_others.php"); break; // Другое
		case "pm": include("pages/account/_pm.php"); break; // Почта
		case "life": include("pages/account/_life.php"); break; // Почта
		case "exit": @session_destroy(); Header("Location: /"); return; break; // Выход
				
	# Страница ошибки
	default: @include("pages/_404.php"); break;
			
	}
			
}else @include("pages/account/_user_account.php");

?>