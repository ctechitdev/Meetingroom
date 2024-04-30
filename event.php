<?php

include 'request_item.php';
$requestItem = new requestItem();
 
 
$rq_calendar = $requestItem->calendarRequest();


foreach($rq_calendar as $rqcrow){  
							 
										
	$mt_id =  $rqcrow['mt_id'];
	$rq_status =  $rqcrow['rq_status'];
	
	
	if($rq_status == '1'){
		$status_color = 'event-important-green';
		}
		else if ($rq_status == '2'){
		$status_color = 'event-important-red';
		}else{
		$status_color = 'event-important-blue';
		}
	
	
	
	$start = strtotime($rqcrow['date_meeting']) * 1000;
	$end = strtotime($rqcrow['date_meeting']) * 1000;	
	$calendar[] = array(
        'id' =>$rqcrow['mt_id'],
        'title' => $rqcrow['meeting_title'],
        'url' => "check_aproval.php?request_id=$mt_id",
		"class" => 
		
		
		$status_color
		,
        'start' => "$start",
        'end' => "$end"
    );
}

 
$calendarData = array(
	"success" => 1,	
    "result"=>$calendar);
echo json_encode($calendarData);
exit;
?>