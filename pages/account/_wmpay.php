<?PHP
$_OPTIMIZATION["title"] = "Shaxsiy hisob";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
								<div class="s-bk-lf">
									<div class="acc-title">Webmoney</div>
								</div>
								
								<div class="silver-bk0" align="center"><div class="clr"></div>
<p><font color="black"><form id=pay name=pay method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp"> </p>
<p>Hisobni Webmoney orqali to`ldirish</p> <p>Hisob miqdorini WMRda kiriting...</p> 
<p>
  <input type="text" name="LMI_PAYMENT_AMOUNT" value="100"> WMR
  <input type="hidden" name="LMI_PAYMENT_DESC" value="UzChange.Ru: <?=$prof_data["user"]; ?> hisobini to'ldirish uchun">
  <input type="hidden" name="LMI_PAYMENT_NO" value="1">
  <input type="hidden" name="LMI_PAYEE_PURSE" value="R733371842395">
  <input type="hidden" name="LMI_SIM_MODE" value="0"> 
</p> 
<p>
 <input type="submit" value="Hisobni to'ldirish">
 </p> 
 <br>
 <p>Hisobingizga mablag' to'lov tekshirilgandan so'ng qo'shiladi. Odatda bu 15 daqiqadan 12 soatgacha vaqt oladi...</p>
</form>
</font></div>

								<div class="clr"></div>	
								</div>
								
