<?php
include "checksession.php"; 
 
 
include 'request_item.php';
$requestItem = new requestItem();
 
$staffinfo = $requestItem->GetStaffInfo($user_ids);
$tb_request = $requestItem->tableRoomReuqested($user_ids);
$itemdropdown = $requestItem->GetItemDropdowwn();
$roomdropdown = $requestItem->GetRoomMeeting();
 
if(isset($_POST['btninsert']))
{ 

$get_date_meeting = $_POST['date_meeting']; 
$meeting_date = str_replace('/', '-', $get_date_meeting);
$date_meeting = date('Y-m-d', strtotime($meeting_date));


 $_POST['meeting_date'] = $date_meeting;

$rq_result = $requestItem->ItemRequest($_POST);
$staffinfo = $requestItem->GetStaffInfo($user_ids);
$tb_request = $requestItem->tableRoomReuqested($user_ids);

 if($rq_result == 1){
	 
	 $meetinginfo = $requestItem->GetDetailForMail($user_ids);
	 
	 
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
 
	
									
	 
	include "request_send.php";
	$show_modal = 1;
 }
 
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
											<h1 class="card-title text-center"> ຂໍໃຊ້ຫ້ອງປະຊຸມ <?php echo "$staff_first_name"; ?> </h2>
											</div>
                                         
											<div class="form-group col-md-6">
											<input type="hidden" name="user_id" class="form-control font" value="<?php echo "$user_ids";?>" required > 
											<input type="hidden" name="dp_id" class="form-control font" value="<?php echo "$staff_depart";?>" required > 
											<label for="inputEmail"> ຊື່ພະນັກງານ :  </label> <label for="inputEmail"> <?php echo "$staff_gender $staff_first_name $staff_last_name";?> </label>
											</div>	  
											
											<div class="form-group col-md-6">
											<label for="inputEmail"> ລະຫັດພະນັກງານ :  </label> <label for="inputEmail"> <?php echo "$staff_code  ";?> </label>
											</div>

											<div class="form-group col-md-4">
											<label for="inputEmail"> ຕຳແໜ່ງ :  </label> <label for="inputEmail"> <?php echo "$staff_position  ";?> </label>
											</div>
											<div class="form-group col-md-4">
											<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ :  </label> <label for="inputEmail"> <?php echo "$select_staff_depart  ";?> </label>
											</div>
											<div class="form-group col-md-4">
											<label for="inputEmail"> ຝ່າຍ :  </label> <label for="inputEmail"> <?php echo "$staff_unit  ";?> </label>
											</div>
											
									 
											
											<div class="form-group col-md-4">
											<label for="inputEmail"> ຫ້ອງປະຊຸມ  </label> 
											<select class="form-control font" name="room_id" id ="room_id" required>
											<option value=""> ເລືອກ ຫ້ອງປະຊຸມ </option>  
											
											<?php
													 		
											foreach($roomdropdown as $mrdd_row){ 
		
											$roomid = $mrdd_row["room_id"];
											$roomname = $mrdd_row["room_name"];  
											echo "<option value='$roomid'>$roomname</option>";
											 
											
											}
																	
											?>
											
											
											
											</select>
											</div>
											
											
											<div class="col-md-4">
											<div class="form-group">
											<label class="control-label"> ຫົວຂໍ້ </label>
											<div class="controls">
											<input type="text" name="meeting_title" class="form-control font" value="" required > 
											</div> 
											</div> 
											</div>
											
											
											
											<div class="col-md-4">
											<div class="form-group">
											<label class="control-label"> ຈຳນວນຄົນ </label>
											<div class="controls">
											<input type="number" name="join_people" class="form-control font" value="" required > 
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
																<th width="70%">ອຸປະກອນ</th>
																<th width="28%">ຈຳນວນ</th> 
															</tr>							
															<tr>
																<td><input class="itemRow" type="checkbox"></td>
																
																<td><select class="form-control font" name="itemtype[]" id ="itemtype_1" required>
																	<option value=""> ເລືອກ ອຸປະກອນ </option> 
																	
															 
																	<?php
																	
																	foreach($itemdropdown as $idd_row){ 
								
																	$itemid = $idd_row["itype_id"];
																	$itemname = $idd_row["room_name"];  
																	echo "<option value='$itemid'>$itemname</option>";
																	 
																	
																	}
																	
																	?>
																	
																	
																	
																	</select>
																</td>											
																<td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td> 
															</tr>						
														</table>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
														<button class="btn btn-danger delete" id="removeRows" type="button">- ລົບ</button>
														<button class="btn btn-success" id="addRows" type="button">+ ເພີ່ມ</button>
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
												<input class="input-sm form-control font text-center" type="text" id="start-date" name="date_meeting" placeholder=" ກົດເລືອກວັນທີ "  />

												</div>
											 
												</div>  
												
												</div> 
												</div>


												<div class="col-md-4">
												<div class="form-group"><br><br>
												<label class="control-label"> ແຕ່ເວລາ  </label>
												<div class="controls input-group clockpicker pull-center"  data-autoclose="true">
												<input type='text' name='hour_from' class='form-control  '   >
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
												<input type='text' name='hour_to' class='form-control  '   >
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
											<textarea type="text" name="remark_text" class="form-control font" value=""  ></textarea>
											</div> 
											</div> 
											</div> 
											
                                            </div>
											
											<div class=" text-center">
											<button type="submit"  name="btninsert"  class="btn btn-success font"> <i class="fa fa-check"></i> ສົ່ງຄຳຂໍ </button> 
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
                            
                            <div class="container-fluid">
              <div class="row" id="row">
			      <div class="col-12">
				  
				  
							<div class="card">
							<div class="card-block">
							 
								<h4 class="card-title text-center"> ຂໍ້ມູນ ຂໍນຳໃຊ້ຫ້ອງປະຊຸມ </h4>
								<div class="table-responsive">
							<table id='demo-foo-addrow2' class='table table-bordered table-sm table-hover toggle-circle' >
                                    
								<thead class="btn-info">
									<tr> 
									<th scope="col"  >ເລກທີ</th>
									<th scope="col"  > ຫ້ອງປະຊຸຸມ </th> 
									<th scope="col"  > ຫົວຂໍ້ </th> 
									<th scope="col"  > ວັນທີ່ໃນໃຊ້ </th>  
									<th scope="col"  > ເວລາເລີ່ມ </th> 
									<th scope="col"  > ເວລາສິ້ນສຸດ </th>
									<th scope="col"  > ຜູ້ເຂົ້າຮ່ວມ </th>
									<th scope="col"  > ສະແດງ/ແກ້ໄຂ </th>
									</tr>
								</thead>
										<div class='m-t-40'>
										<?php
										 
									//  echo "$user_ids";		
									
										?>
                                        <div class='d-flex'>
                                            <div class='mr-auto'>  
											<div class='form-group'>
                                             
                                            </div>
											</div>
                                            <div class='ml-auto'>
                                                <div class='form-group'>
												
                                                    <input id='demo-input-search2' type='text' placeholder='ຊອກຫານຂໍ້ມູນ' class='form-control font' autocomplete='off'>
                                                </div>
                                            </div>
										</div>
										</div>
                                    <tbody>
									 <?PHP
										
										
										foreach($tb_request as $tb_row){  
										$mt_id = $tb_row['mt_id']; 
										$mtroom_id = $tb_row['mtroom_id'];  
										$room_name = $tb_row['room_name']; 
										$meeting_title = $tb_row['meeting_title'];
										$date_meeting = $tb_row['date_meeting']; 
										$time_start = $tb_row['time_start']; 
										$time_end = $tb_row['time_end'];
										$join_people = $tb_row['join_people'];  
										?>

										<tr>
										<td><?php echo "$mt_id";?></td> 
										<td><?php echo "$room_name";?></td>
										<td><?php echo "$meeting_title";?></td> 
										<td><?php echo "$date_meeting";?></td> 
										<td><?php echo "$time_start";?></td>   
										<td><?php echo "$time_end";?></td>
										<td><?php echo "$join_people";?></td>
										<td><a href="edit_reqeust_meeting.php?request_id=<?php echo "$mt_id"; ?>"  class="btn btn-outline-info btn-rounded"  class="btn btn-outline-info btn-rounded"><i class="fa fa-eye"></i> ສະແດງ </a></td>
							


										</td>

										</tr>

										<?php
									 
											 
											}

							?>
                                    </tbody>
									 <tfoot>
                                        <tr>
                                            <td colspan="8">
                                                <div class="text-right">
                                                    <ul class="pagination">
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
								</div>
								
 
								
								
								
								</div>
							</div>
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
				 <h3 class="modal-title" style="color: green" > ການລົງທະບຽນ ສຳເລັດ  </h3>
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
