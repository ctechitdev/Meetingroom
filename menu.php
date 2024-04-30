<aside class="left-sidebar">
<!-- Sidebar scroll-->
<div class="scroll-sidebar">
<!-- User profile -->
<!-- End User profile text-->

<!-- Sidebar navigation-->
<nav class="sidebar-nav">
<ul id="sidebarnav">
					
 
	
	<li>
	
	 <a class="has-arrow " href="#" aria-expanded="false">
	<i class="mdi mdi-file-document-box"></i>
	<span class="hide-menu"> ຫ້ອງປະຊຸມ </span>
	</a>
  
	
	<ul aria-expanded="false" class="collapse">
	 
	<li><a href="request_meeting_room.php"><i class="fa fa-external-link"></i> ຂໍນຳໃຊ້ຫ້ອງປະຊຸມ </a></li>
	
	<?php
	if($staff_depart == 12 || $user_ids == 0){
		
	?>
	<li><a href="list_calendar.php"><i class="fa fa-check-square-o"></i> ກວດສອບຄຳຂໍ </a></li> 
	<?php
	
	}
	?>
	<li><a href="request_history.php"><i class="fa fa-bar-chart fa-fw"></i> ລາຍການນຳໃຊ້ຫ້ອງປະຊູມ </a></li>
	
	
	
 
    </ul>
    </li>
  
		<?php
		 
		 
		?>
 
 		
                        
                   
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a href="Logout.php" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->
        </aside>