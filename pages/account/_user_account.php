<?PHP
$_OPTIMIZATION["title"] = "Shaxsiy hisob";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
								<div class="s-bk-lf">
									<div class="acc-title">Mening hisobim</div>
								</div>
								<div class="silver-bk">
								<p><center><font color="black"><b>Ro`yhatdan o`tgan vaqtingiz:</b></font> <font color="green"><?=date("d.m.Y в H:i:s",$prof_data["date_reg"]); ?></font></center></p>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr><td colspan="2" align="center">&nbsp;</td></tr>
  <tr>
    <td align="left" style="padding:3px;"><b>Loginingiz:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=$prof_data["user"]; ?></font></td>
  </tr>
  <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;"><b>Elektron pochtangiz:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=$prof_data["email"]; ?></font></td>
  </tr>
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;"><b>Asosiy hisob:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=sprintf("%.2f",$prof_data["money_b"]); ?><font color="blue"><b> so`m</b></font></font> [<a href="/account/insert">Hisobni to`ldirish</a>]</td>
  </tr>
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;"><b>Ikkilamchi hisob:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=sprintf("%.2f",$prof_data["money_p"]); ?><font color="blue"><b> so`m</b></font></font> [<a href="/account/payment">Pulni yechib olish</a>]</td>
  </tr>
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  <tr>
    <td align="left" style="padding:3px;"><b>Do`stlardan foyda:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=sprintf("%.2f",$prof_data["from_referals"]); ?><font color="blue"><b> so`m</b></font></font></td>
  </tr>
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
    <tr>
    <td align="left" style="padding:3px;"><b>Yechib olindi:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=sprintf("%.2f",$prof_data["payment_sum"]*150); ?><font color="blue"><b> so`m</b></font></font></td>
  </tr>
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  
  <tr>
    <td align="left" style="padding:3px;"><b>Sizni taklif qilgan do`stingiz:</b></td>
    <td align="left" style="padding:3px;"><font color="green"><?=$prof_data["referer"]; ?></font></td>
  </tr>
   <tr>
  <td colspan="2">
  <hr>
  </td>
  </tr>
  
</table>

								<div class="clr"></div>	
								</div>
