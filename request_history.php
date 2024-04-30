<?php 
include "checksession.php";
 
include 'request_item.php';
$requestItem = new requestItem();
 
 
$tb_request = $requestItem->tableRoomReuqested($user_ids);
 
 
 
?>
<!DOCTYPE html>
<html lang="en">
<?php  
include "stylesheet.php";  
?>
<script src="search.js"></script>
<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">
      <?php
	  include "header.php";
	  include "menu.php";
?>
 
        <div class="page-wrapper">
            <!-- Container fluid  -->
            <div class="container-fluid">
              <div class="row" id="row">
			      <div class="col-12">
                        <div class="card"> 
						<div class="card-block">
					 
					 
						<h2 class="card-title text-center">ປະຫວັດ ນຳໃຊ້ຫ້ອງປະຊຸມ </h2>
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
				 <!-- /row -->
            </div>
           <?php include "footer.php";?>
            <!-- End footer -->
        </div>
    </div>
	<?php include "javascript.php";?>
</body>

</html>
