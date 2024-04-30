<?php
 include "checksession.php";
 
 
include 'request_item.php';
$requestItem = new requestItem();

$staffinfo = $requestItem->GetStaffInfo($user_ids);
 


	  if(isset($_POST['btnapprove']))
{
	
$get_date_meeting = $_POST['date_meeting']; 
$meeting_date = str_replace('/', '-', $get_date_meeting);
$date_meeting = date('Y-m-d', strtotime($meeting_date));
$_POST['meeting_date']  = $date_meeting; 
$_POST['app_status']  = 1; 
 
$show_modal = $requestItem->ApprovalMetting($_POST);

$meetinginfo = $requestItem->GetDetailForMailByid($_GET['request_id']);	

foreach($meetinginfo as $mt_row){ 
								 
	$full_name = $mt_row['full_name'];
	$mailuser = $mt_row['mail_user'];
	$meeting_id = $mt_row['mt_id'];
	$room_name = $mt_row['room_name'];
	$meeting_title = $mt_row['meeting_title'];
	$join_people = $mt_row['join_people'];
	$mdate = $mt_row['mdate'];  
	$depart_name = $mt_row['depart_name'];  
	$rid = $mt_row['mtroom_id'];  
	$status_name = $mt_row['status_name'];  
	
	}

$_SESSION["full_name"] = $full_name ;
$_SESSION["user_mail"] = $mailuser;
$_SESSION["meeting_id"] = $meeting_id;
$_SESSION["room_name"] = $room_name;
$_SESSION["meeting_title"] = $meeting_title ;
$_SESSION["join_people"] = $join_people;
$_SESSION["mdate"] = $mdate ;
$_SESSION["depart_name"] = $depart_name ;
$_SESSION["rid"] = $rid ;
$_SESSION["status_name"] = $status_name ;

	include "approve_send.php";

}


	  if(isset($_POST['btncancel']))
{
	
$get_date_meeting = $_POST['date_meeting']; 
$meeting_date = str_replace('/', '-', $get_date_meeting);
$date_meeting = date('Y-m-d', strtotime($meeting_date));
$_POST['meeting_date']  = $date_meeting; 
$_POST['app_status']  = 2; 


$show_modal = $requestItem->ApprovalMetting($_POST);

$meetinginfo = $requestItem->GetDetailForMailByid($_GET['request_id']);	

foreach($meetinginfo as $mt_row){ 
								 
	$full_name = $mt_row['full_name'];
	$mailuser = $mt_row['mail_user'];
	$meeting_id = $mt_row['mt_id'];
	$room_name = $mt_row['room_name'];
	$meeting_title = $mt_row['meeting_title'];
	$join_people = $mt_row['join_people'];
	$mdate = $mt_row['mdate'];  
	$depart_name = $mt_row['depart_name'];  
	$rid = $mt_row['mtroom_id'];  
	$status_name = $mt_row['status_name'];  
	
	}

$_SESSION["full_name"] = $full_name ;
$_SESSION["user_mail"] = $mailuser;
$_SESSION["meeting_id"] = $meeting_id;
$_SESSION["room_name"] = $room_name;
$_SESSION["meeting_title"] = $meeting_title ;
$_SESSION["join_people"] = $join_people;
$_SESSION["mdate"] = $mdate ;
$_SESSION["depart_name"] = $depart_name ;
$_SESSION["rid"] = $rid ;
$_SESSION["status_name"] = $status_name ;

	include "approve_send.php";


}



if(!empty($_GET['request_id']) && $_GET['request_id']) {
	$meeting = $requestItem->getMeetingInfo($_GET['request_id']);		
	$irequest = $requestItem->GetItemRequest($_GET['request_id']);
	$status_approve = $requestItem->checkStatusApprove($_GET['request_id']);	
	$id_room = $requestItem->GetRoomMeeting();
	$item_type = $requestItem->GetItemDropdowwn();
}


?>

<!DOCTYPE html>
<html lang="en">

 
 
 
<head>
 

   
 

</head>



<?php 

 
include "stylesheet.php"; 

	
	  
	  ?>
 
<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">
      <?php
	  include "header.php";
	  include "menu.php";
?>
 <script src="js/3request_item.js"></script>
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">
              <div class="row" id="row">
			      <div class="col-12">
                        <div class="card"> 
						<div class="card-block"> 
				  
							<form class="m-t-40" novalidate action="" method="post" enctype="multipart/form-data" autocomplete="off">
								  
									<?php
									   // echo " $user_ids";

									foreach($staffinfo as $st_row){ 
								 
									$staff_gender = $st_row['staff_gender'];
									$staff_first_name = $st_row['staff_first_name'];
									$staff_last_name = $st_row['staff_last_name'];
									$staff_code = $st_row['staff_code'];
									$staff_position = $st_row['staff_position'];
									$select_staff_depart = $st_row['staff_depart'];
									$staff_unit = $st_row['staff_unit'];  
											
									}

									?>
								
                                    <div class="form-body">
									 <div class="row p-t-20" id="result">
                                             
											<div class="form-group col-md-3">
										 
											 
											</div>
											
											 <div class="form-group col-md-6">
											<h1 class="card-title text-center"> ແກ້ໄຂຄຳຂໍໃຊ້ຫ້ອງປະຊຸມ </h2>
											</div>
                                         
											<div class="form-group col-md-6">
											 
											<label for="inputEmail"> ຊື່ພະນັກງານ :  </label> <label for="inputEmail"> <?php echo $meeting['full_name'];?> </label>
											</div>	  
											
											<div class="form-group col-md-6">
											<label for="inputEmail"> ລະຫັດພະນັກງານ :  </label> <label for="inputEmail"> <?php echo $meeting['staff_code'];?> </label>
											</div>

											<div class="form-group col-md-4">
											<label for="inputEmail"> ຕຳແໜ່ງ :  </label> <label for="inputEmail"> <?php echo $meeting['position_name']; ?> </label>
											</div>
											<div class="form-group col-md-4">
											<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ :  </label> <label for="inputEmail"> <?php echo $meeting['depart_name']; ?> </label>
											</div>
											<div class="form-group col-md-4">
											<label for="inputEmail"> ຝ່າຍ :  </label> <label for="inputEmail"><?php echo $meeting['unit_name']; ?> </label>
											</div>
											
											<input type="hidden" name="meeting_id" class="form-control font" value="<?php echo $meeting['mt_id']; ?>" required > 
											<?php 
											
											$options1 = array('ຊັ້ນ1', 'ຊັ້ນ2 ຫ້ອງນ້ອຍ', 'ຊັ້ນ2 ຫ້ອງໃຫຍ່', 'ຊັ້ນ3' ); 
											$values1 = array('1', '2', '3','4' ); 
											?>
										 
											
											
											
											
											<div class="form-group col-md-4">
											<label for="inputEmail"> ຫ້ອງປະຊຸມ  </label> 
											<select class="form-control font" name="edit_room_id" id ="edit_room_id" required>
											<option value=""> ເລືອກ ຫ້ອງປະຊຸມ </option> 
											
											<?php
											
											$dbselected1 = $meeting["mtroom_id"];
											
											foreach($id_room as $rm_row){ 
								
											$rm_id = $rm_row["room_id"];
											$rm_name = $rm_row["room_name"];
											
											
											
											
										 
													if($dbselected1 == $rm_id) {
														echo "<option selected='selected' value='$rm_id'>$rm_name</option>";
													}
													else {
														echo "<option value='$rm_id'>$rm_name</option>";
													}
												 
											}
											
											?> 
											</select>
											</div>
											
											
											<div class="col-md-4">
											<div class="form-group">
											<label class="control-label"> ຫົວຂໍ້ </label>
											<div class="controls">
											<input type="text" name="meeting_title" class="form-control font" value="<?php echo $meeting['meeting_title']; ?>" required > 
											</div> 
											</div> 
											</div>
											
											
											
											<div class="col-md-4">
											<div class="form-group">
											<label class="control-label"> ຈຳນວນຄົນ </label>
											<div class="controls">
											<input type="number" name="join_people"  id="join_people" class="form-control font" value="<?php echo $meeting['join_people']; ?>" required > 
											</div> 
											</div> 
											</div>
											<div class="col-md-3">
											</div>
										 
											
											<div class="col-md-6 text-center">
											
											<div class="load-animate animated fadeInUp">
		    	 
		       
		      	<div class="row">
		      		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		      			<table class="table table-bordered table-hover" id="invoiceItem">	
							<tr>
							<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
							<th width="10%">ອຸປະກອນ</th>
							<th width="18%">ຈຳນວນ</th>  
							</tr>
							<?php 
							$count = 0;
							$options = array('ນ້ຳດື່ມ', 'ສະແນັກ', 'ຄອມພິວເຕີ', 'ພອຍເຕີ້' );
							
							
							
							foreach($irequest as $rqDetail){
								$count++;
								
								$dbselected = $rqDetail["item_id"];
						 
							?>								
							<tr>
								<td><input class="itemRow" type="checkbox"></td>
								<td>
								
							 
								<div class="form-group col-md-12"> 
								<select class="form-control font" name="itemtype[]" id ="itemtype_<?php echo $count; ?>" required>
								<option value=""> ເລືອກ ອຸປະກອນ </option> 
								
								<?php
								
							 
								 
								 
								 
									foreach($item_type as $it_row){
										$it_id = $it_row["itype_id"];
										$it_name = $it_row["room_name"];
										
										if($dbselected == $it_id) {
											echo "<option selected='selected' value='$it_id'>$it_name</option>";
										}
										else {
											echo "<option value='$it_id'>$it_name</option>";
										}
									}
									 
								
								
								?>
								
								</select>
								</div>
								
								
								</td>
								
								
								<td><input type="text" value="<?php echo $rqDetail["item_values"]; ?>" name="quantity[]" id="quantity_<?php echo $count; ?>" class="form-control" autocomplete="off"></td>
							 <input type="hidden" value="<?php echo $rqDetail['mt_id']; ?>" class="form-control" name="itemId[]">
								
							 
								
							</tr>	
							<?php } ?>		
						</table>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		      			<button class="btn btn-danger delete" id="removeRows" type="button">- ລຶບ</button>
		      			<button class="btn btn-success" id="addRows" type="button">+ ເພິ່ມ</button>
		      		</div>
		      	</div>
		       
		      	 
	      	</div>
											
											
											</div>

  
											
										 
											
											<div class="col-md-9" id="result2">
											<div class="form-group">
											<div class="card"> 
											<div class="card-block"> 

											<div class="form-body">
											<div class="row p-t-20">
											
												
											
												<div class="col-md-4">
												<div class="form-group">
												
												<div class="input-daterange input-group" id="flight-datepicker">
												<div class="form-item text-center">
												<span  > ນຳໃຊ້ວັນທີ </span>
												<input class="input-sm form-control font text-center" type="text" id="start-date" id="date_meeting" name="date_meeting" placeholder=" ກົດເລືອກວັນທີ " value="<?php echo $meeting['date_meeting']; ?>" readonly />

												</div>
											 
												</div>  
												
												</div> 
												</div>


												<div class="col-md-4">
												<div class="form-group"><br><br>
												<label class="control-label"> ແຕ່ເວລາ  </label>
												<div class="controls input-group clockpicker pull-center"  data-autoclose="true">
												<input type='text' name='hour_from' class='form-control' value="<?php echo $meeting['time_start']; ?>">
												<span class='input-group-addon'>
												<span class='fa fa-clock-o'></span>
												</span>
												</div> 
												</div> 
												</div>

												<div class="col-md-4">
												<div class="form-group"><br><br>
												<label class="control-label"> ຫາເວລາ  </label>
												<div class="controls input-group clockpicker pull-center"  data-autoclose="true">
												<input type='text' name='hour_to' class='form-control' value="<?php echo $meeting['time_end']; ?>">
												<span class='input-group-addon'>
												<span class='fa fa-clock-o'></span>
												</span>
												</div> 
												</div> 
												</div>
											



											</div> 
											</div>
											</div> 
		
											</div> 
											 
											</div>
											</div>
 							  
										
											
											<div class="col-md-12">
											<div class="form-group">
											<label class="control-label"> ໝາຍເຫດ </label>
											<div class="controls">
											<textarea type="text" name="remark_text" class="form-control font" value="" required ><?php echo $meeting['Remark']; ?></textarea>
											</div> 
											</div> 
											</div> 
											
                                            </div>
											<div class=" text-center"><h1>
											<?php
											
											foreach($status_approve as $st_row){
											$status_name = $st_row["rq_status"];
											
											echo "$status_name";
											} 
											?>
											</div>
											</h1>
											<br>
											<div class=" text-center">
											<button type="submit"  name="btnapprove"  class="btn btn-success font"> <i class="fa fa-check"></i> ອານຸມັດ </button> 
											<button type="submit"  name="btncancel"  class="btn btn-danger font"> <i class="fa fa-check"></i> ຍົກເລີກ </button> 
											</div>
											
                                            </div>
                                        </div>
									   </div>   
									
                                </form>
						
						 
						 
                                            
                                        </div>
											<div class="text-center" align = "center">
											
											
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
				 <h3 class="modal-title" style="color: green" > ອານຸຍາດສຳເລັດ  </h3>
				<?php
			}else {
				?>
				 <h3 class="modal-title" style="color: red" > ຍົກເລີກສຳເລັດ   </h3>
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
