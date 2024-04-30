<?php
 include "checksession.php";
 
 
include 'request_item.php';
$requestItem = new requestItem();

$staffinfo = $requestItem->GetStaffInfo($user_ids);
$tb_request = $requestItem->tableRoomReuqested($user_ids);


	  if(isset($_POST['btninsert']))
{
	
$get_date_meeting = $_POST['date_meeting']; 
$meeting_date = str_replace('/', '-', $get_date_meeting);
$date_meeting = date('Y-m-d', strtotime($meeting_date));
$_POST['meeting_date']  = $date_meeting; 
 
$requestItem->UpdateRequest($_POST);
}

if(!empty($_GET['request_id']) && $_GET['request_id']) {
	$meeting = $requestItem->getMeetingInfo($_GET['request_id']);		
	$irequest = $requestItem->GetItemRequest($_GET['request_id']);		
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
											<input type="hidden" name="user_id" class="form-control font" value="<?php echo "$user_ids";?>" required > 
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
										$it_id = $it_row["room_id"];
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
												<input class="input-sm form-control font text-center" type="text" id="start-date" id="date_meeting" name="date_meeting" placeholder=" ກົດເລືອກວັນທີ " value="<?php echo $meeting['date_meeting']; ?>" />

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
											
											<div class=" text-center">
											<button type="submit"  name="btninsert"  class="btn btn-success font"> <i class="fa fa-check"></i> ແກ້ໄຂ </button> 
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
