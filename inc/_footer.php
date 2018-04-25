<?php
if ((!isset($_GET["menu"]) or strtolower($_GET["menu"]) == "index") or (isset($_GET["menu"]) and strtolower($_GET["menu"]) == "signup")) { 
echo "";

} else {
?>

</div>	
						
							  <div class="span4">
    
     <?php
	 if(isset($_SESSION["admin"]) or isset($_GET["menu"]) AND $_GET["menu"] == "admin4ik"){
	
		include("inc/_admin_menu.php");
	
	}elseif(isset($_SESSION["user"])){ 
	 include("inc/_user_menu.php");
	 }
	 if (isset($_GET["menu"]) and strtolower($_GET["menu"]) == "news" or isset($_GET["menu"]) and strtolower($_GET["menu"]) == "otziv" or isset($_GET["menu"]) and strtolower($_GET["menu"]) == "contacts" or isset($_GET["menu"]) and strtolower($_GET["menu"]) == "rules" or isset($_GET["menu"]) and strtolower($_GET["menu"]) == "top" or isset($_GET["menu"]) and strtolower($_GET["menu"]) == "stat" or isset($_GET["menu"]) and strtolower($_GET["menu"]) == "login") {
	 echo "



	 </div>";
	 } else {
	 // include("inc/_stats.php");
	  }
	 ?>

	 
	

              
    
  </div>


						<div class="clr"></div>
						</div>

</article>

</section>
<? } ?>



<center><img src="/img/garant.png"></center><br>

  

<!--Footer-->
<footer class="main-footer">

  <ul class="nav nav-pills">
                                                                                                              <li>
          <a href="/">Bosh sahifa</a>
          </li>
                                                <li>
          <a href="/news">Yangiliklar</a>
          </li>
                                                <li>
          <a href="/top">Top 10</a>
          </li>
		  <li>
		            <a href="/rules">Qoidalar</a>
          </li>
                                                <li>
          <a href="/contacts">Aloqa</a>
          </li>
                   
                                                                                                                                            
  </ul>
    <div class="site-info">
      <div class="row-fluid">
        <div class="logo span2">


        </div>

        <div class="span8">
          <center><p>«UzChange.Ru» - Iqtisodiy mustaqil kelajak uchun sarmoya.         
          </p></center>
          <center><p>Moliyaviy yo'qotish xavfidan ogohlantiramiz! Noto'g'ri harakatlar sizga iqtisodiy zarar keltirishi mumkin!</p></center>
          <center><p>Barcha huquqlar muhofazalangan! © 2017-2018</p></center>

          <p></p>
        </div>
      </div>
    </div>
</footer>
<!--/Footer-->

</div>
<center></center>


</body>
</html>