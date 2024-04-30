<?php
include "checksession.php"; 
 


?>

<!DOCTYPE html>
<html lang="en">
 
 
<head>


</head>



<?php 

 
include "stylesheet.php"; 

	
	  
	  ?>
 

 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="css/30calendar.css">
<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">
      <?php
	  include "header.php";
	  include "menu.php";
?>
 
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid ">
              <div class="row" id="row">
			      <div class="col-12">
                        <div class="card"> 
						<div class="card-block">  
						<div class="container ">	
	<h2 class="text-center" > ລາຍການຄຳຂໍ </h2>	
	<div class="page-header">
		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="font btn btn-primary" data-calendar-nav="prev"><< ກັບຄືນ</button>
				<button class="font btn btn-default" data-calendar-nav="today">ປະຈຸບັນ</button>
				<button class="font btn btn-primary" data-calendar-nav="next">ຕໍ່ໄປ >></button>
			</div>
			<div class="btn-group">
				<button class="font btn btn-warning" data-calendar-view="year">ປີ</button>
				<button class="font btn btn-warning active" data-calendar-view="month">ເດືອນ</button>
				<button class="font btn btn-warning" data-calendar-view="week">ອາທິດ</button> 
				<!-- <button class="font btn btn-warning" data-calendar-view="day">ມື້</button> !-->
			</div>
		</div>
		<h3></h3>
		<br><br>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="font" id="showEventCalendar"></div>
		</div>
		 
	</div>	
 
</div>
						
						
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="js/35calendar.js"></script>
<script type="text/javascript" src="js/23events.js"></script>
						
						 
						 
                                            
                        </div>  
						</div>   
								
                               
								
                            </div>
                            
                            
                            
                            </div>
                            
                            
                        </div>
					  
							
							
							
							
                </div>
				 <!-- /row -->
            </div>
           <?php include "footer.php";?>
            <!-- End footer -->
        </div>
    </div>
	<?php
	if($show_modal != ""){
		
	
	
	?>
<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
<?php

}

?>

	<div id="myModal" class="modal fade ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
			<?php
			if ($show_modal == 1){
				?>
				 <h3 class="modal-title" style="color: green" > ການລົງທະບຽນ ຂໍລາພັກ ສຳເລັດ  </h3>
				<?php
			}else {
				?>
				 <h3 class="modal-title" style="color: red" > ຂໍ້ມູນບໍ່ຄົບຖ້ວນ   </h3>
				<?php
			}
			
$show_modal = "";
$message_request ="";
$_SESSION['message_request'] = "";

			?>
               
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
             
        </div>
    </div>
	

 





	<?php include "javascript.php";?>
	
	

	
	
</body>

</html>
