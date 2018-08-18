<?PHP
class config{

	public $HostDB = "localhost";
	 public $UserDB = "dbuser";
 public $PassDB = "dbpass";
 public $BaseDB = "dbname";
	
	public $SYSTEM_START_TIME = "1507285200";
	public $VAL = "ÐÓÁ";
	
	# PAYEER sozlamasi
	public $AccountNumber = 'P1234567'; //Payeer hamyon
	public $apiId = 'ApiID'; // API ID raqami
	public $apiKey = 'ApiKey'; // API paroli
	
	public $shopID = 'ShopID';
	public $secretW = "SecretWord";
	   # FREE-KASSA sozlamasi
    public $fk_merchant_id = '5306'; //merchant_id ID мазагина в free-kassa.ru (http://free-kassa.ru/merchant/cabinet/help/)
    public $fk_merchant_key = 'oil1'; //Секретное слово http://free-kassa.ru/merchant/cabinet/profile/tech.php
    public $fk_merchant_key2 = 'oil2'; //Секретное слово2 (result) http://free-kassa.ru/merchant/cabinet/profile/tech.php
}
?>
