<?PHP

class life_time
{


	function __construct($db)
	{
		$this->db = $db;
	}


	private function GetTimeLife($name)
	{
		switch ($name) 
		{
			case 'a_t':
				return 60*60*24*365; // 365 дней
			break;

			case 'b_t':
				return 60*60*24*120; // 125 дней
			break;
			
			case 'c_t':
				return 60*60*24*150; // 131 дней
			break;

			case 'd_t':
				return 60*60*24*131; // 131 дней
			break;

			case 'e_t':
				return 60*60*24*130; // 130 дней
			break;
			
			case 'f_t':
				return 60*60*24*129; // 129 дней
			break;

			case 'g_t':
				return 60*60*24*125; // 125 дней
			break;
			
			default:
				return 60*60*24; // время по умолчанию для всех фруктов 24 часа
			break;
		}
	}


	private function GetNameItem($name)
	{
		switch ($name) 
		{
			case 'a_t':
				return "SHNET-25";
			break;

			case 'b_t':
				return "SPRING 17";
			break;

			case 'c_t':
				return "UZCHANGE";
			break;
			
			case 'd_t':
				return "Помидор";
			break;

			case 'e_t':
				return "Картофель";
			break;
				
			case 'f_t':
				return "Тыква";
			break;
			
			case 'g_t':
				return "Баклажаны";
			break;

			default:
				return $name;
			break;
		}
	}


	public function AddItem($user_id, $name, $time=0)
	{
		$db = $this->db;
		$now = time();
		if ($time==0) $del = $now + $this->GetTimeLife($name);
		else
			$del = $now + $time;
		$sql = "insert into `db_product_time` 
				(`id_user`, `name`, `date_add`, `date_del`, `status`)
				values
				($user_id, '$name', $now, $del, 1)";
		$db->Query($sql);
		return ($db->LastInsert()>0);
	}


	public function CheckTime()
	{
		$db = $this->db;
		$now = time();
		$sql = "select * from `db_product_time` where `status`=1 and `date_del`<=$now";
		$db->Query($sql);
		$arr = array();
		if ($db->NumRows()>0)
		{
			while($row = $db->FetchArray()) 
			{
				$arr[] = $row;
			}
		}
		if (count($arr)>0)
		{
			foreach ($arr as $row) 
			{
				$id = $row['id'];
				$par = $row['name'];
				$user = $row['id_user'];
				$sql = "update `db_users_b` set `$par`=`$par`-1 where `id`=$user";
				$db->Query($sql);
				$sql = "update `db_product_time` set  `status`=0 where `id`=$id";
				$db->Query($sql);
			}
		}
	}

	private function ConvertTime($val)
	{
		$time = (int)$val;
		$m = floor($time / 60);
		$h = floor($m / 60);
		$d = floor($h / 24);
		$h = $h - $d*24;
		$m = $m - $d*24*60 - $h*60;
		$s = $time - $m*60 - $h*60*60 - $d*24*60*60;
	if($d != 0) return "$d дней $h ч $m мин $s сек";
	   if($h != 0) return "$h ч $m мин $s сек";
	   if($m != 0) return "$m мин $s сек";
	   if($s != 0) return "$s сек";
	}


	public function GetTable($user_id)
	{
		$style = "<style>.info_block{height: 50px;float: left;margin: 0px 20px 20px 80px;width: 450px;background: rgb(241, 241, 241);border-radius: 20px;} .info_block div{padding: 15px;}</style>";
		$db = $this->db;
		echo $style;
		$sql = "select * from `db_product_time` where `status`=1 and `id_user`=$user_id";
		$db->Query($sql);
		while($row = $db->FetchArray()) 
		{
			$tim = (int)$row['date_del']-time();
			$tim = $this->ConvertTime($tim);
			echo "<div class='info_block'>";
				echo "<div>";
				echo $this->GetNameItem($row['name'])." - осталось: ".$tim;
				echo "</div>";
			echo "</div>";
		}
	}

}