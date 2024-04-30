<?php 
include "checksession.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<?php 
include "stylesheet.php";
?>

<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">
      <?php
	  include "header.php";
	  include "menu.php";
	  ?>
       
        <div class="page-wrapper">
		 
            <!-- Container fluid  -->
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0"> ໜ້າຫຼັກ </h3>
                    </div>
                </div> 
				<div class="row">
				<div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card card-inverse card-primary">
                            <div class="box text-center">
                                <h2 class="font-light text-white">  </h2>
                                <h6 class="text-white"> </h6>
                            </div>
                        </div>
						</div>
				 
                </div>
				 <!-- /row -->
            </div>
            <footer class="footer text-center">
               <?php include "footer.php";?>
            </footer>
            <!-- End footer -->
        </div>
    </div>
	<?php include "javascript.php";?>
</body>

</html>
