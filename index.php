<?PHP

# Счетчик
function TimerSet(){
	list($seconds, $microSeconds) = explode(' ', microtime());
	return $seconds + (float) $microSeconds;
}

$_timer_a = TimerSet();

# Старт сессии
@session_start();

# Старт буфера
@ob_start();

# Default
$_OPTIMIZATION = array();
$_OPTIMIZATION["title"] = "Денежная ферма";
$_OPTIMIZATION["description"] = "Денежная ферма";
$_OPTIMIZATION["keywords"] = "Заработок на растениях, вложения, заработать, ферма, денежная ферма, заработать на ферме";

# Константа для Include
define("CONST_RUFUS", true);

# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}

# Класс конфига 
$config = new config;

# Функции
$func = new func;

# Установка REFERER
include("inc/_set_referer.php");

# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

#данные для срока 
$life_time = new life_time($db);
$life_time->CheckTime();

# Шапка
@include("inc/_header.php");

		if(isset($_GET["menu"])){
		
			$menu = strval($_GET["menu"]);
			
			switch($menu){
			
				case "404": include("pages/_404.php"); break; // Страница ошибки
				case "rules": include("pages/_rules.php"); break; // Правила проекта
				case "about": include("pages/_about.php"); break; // О проекте
				case "contacts": include("pages/_contacts.php"); break; // Контакты
				case "news": include("pages/_news.php"); break; // Новости
				case "signup": include("pages/_signup.php"); break; // Регистрация
				case "login": include("pages/_login.php"); break; // Регистрация
				case "recovery": include("pages/_recovery.php"); break; // Восстановление пароля
				case "account": include("pages/_account.php"); break; // Аккаунт
                case "competition": include("pages/_competition.php"); break; // Конкурсы
				case "users": include("pages/_users_list.php"); break; // Пользователи
				case "payments": include("pages/_payments_list.php"); break; // Выплаты
				case "otziv": include("pages/_otziv.php"); break; // Отзывы
				case "top": include("pages/_top.php"); break; // Топ 5
				case "faq": include("pages/_faq.php"); break; // FAQ
				case "faq_faq": include("pages/_faq_faq.php"); break; // FAQ
				case "admin384": include("pages/_admin.php"); break; // Админка
				case "stat": include("pages/_stat.php"); break; // Админка
				case "chat": include("pages/_chat.php"); break; // Чат
				
			# Страница ошибки
			default: @include("pages/_404.php"); break;
			
			}
			
		}


# Подвал
@include("inc/_footer.php");


# Заносим контент в переменную
$content = ob_get_contents();

# Очищаем буфер
ob_end_clean();
	
	# Заменяем данные
	$content = str_replace("{!TITLE!}",$_OPTIMIZATION["title"],$content);
	$content = str_replace('{!DESCRIPTION!}',$_OPTIMIZATION["description"],$content);
	$content = str_replace('{!KEYWORDS!}',$_OPTIMIZATION["keywords"],$content);
	$content = str_replace('{!GEN_PAGE!}', sprintf("%.5f", (TimerSet() - $_timer_a)) ,$content);
	
	# Вывод баланса
	if(isset($_SESSION["user_id"])){
	
		$user_id = $_SESSION["user_id"];
		$db->Query("SELECT money_b, money_p FROM db_users_b WHERE id = '$user_id'");
		$balance = $db->FetchArray();
		
		$content = str_replace('{!BALANCE_B!}', sprintf("%.2f", $balance["money_b"]) ,$content);
		$content = str_replace('{!BALANCE_P!}', sprintf("%.2f", $balance["money_p"]) ,$content);
	}
	
// Выводим контент
echo $content;
?>