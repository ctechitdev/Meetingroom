<?php
 
 
class requestItem{
	
	private $host  = 'localhost';
    private $user  = 'kplaocom';
    private $password   = "*1QzaNEeXD";
    private $database  = "kplaocom_KPleave";         
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
        $conn -> set_charset("utf8");
    }
	
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	
	
	public function loginUsers($email, $password){
		$sqlQuery = "
		select   user_ids,user_status,concat((case when staff_gender = 1 then 'ທ້າວ ' else 'ນາງ ' end),staff_first_name,' ',staff_last_name) as full_name,staff_depart ,staff_code,a.staff_id as staff_id,role_level
				FROM tbl_user a
				left join tbl_staff b on a.staff_id = b.staff_id
                left join tbl_role_level c on b.staff_position = c.ps_id    
				WHERE User_names = '".$email."' AND user_password = '".$password."' 
				";
        return  $this->getData($sqlQuery);
	}	
	public function checkLoggedIn(){
		if(!$_SESSION['userid']) {
			header("Location:request_meeting_room.php");
		}
	}	
	 	
	public function ItemRequest($POST) {
		 
		$sqlInsert = "
			INSERT INTO tbl_meeting (mtroom_id,meeting_title,join_people,date_meeting,time_start,time_end,Remark,date_register,request_by,depart_id) 
			VALUES ('".$POST['room_id']."', '".$POST['meeting_title']."', '".$POST['join_people']."', '".$POST['meeting_date']."','".$POST['hour_from']."','".$POST['hour_to']."','".$POST['remark_text']."', now(),'".$POST['user_id']."','".$POST['dp_id']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
	 
		for ($i = 0; $i < count($POST['quantity']); $i++) {
			$sqlInsertItem = " insert into tbl_request_item_meeting (mt_id,item_id,item_values) values ('".$lastInsertId."','".$POST['itemtype'][$i]."','".$POST['quantity'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}
		return 1;
	}
	
 
	
	public function getMeetingInfo($meetingid){
		$sqlQuery = " 
SELECT   unit_name,depart_name,position_name,staff_code,concat((case when staff_gender = 1 then 'ທ້າວ ' else 'ນາງ ' end ),staff_first_name,' ',staff_last_name) as full_name,mt_id,mtroom_id,(case when mtroom_id = 1 then 'ຊັ້ນ1' 
		when mtroom_id = 2 then 'ຊັ້ນ2 ຫ້ອງນ້ອຍ'
		when mtroom_id = 3 then 'ຊັ້ນ2 ຫ້ອງໃຫຍ່'
		when mtroom_id = 4 then 'ຊັ້ນ3'
		else '' end ) as room_name,
		meeting_title,join_people,
		DATE_FORMAT(date_meeting, '%d-%m-%Y') as date_meeting,
		time_start,time_end,Remark  
		FROM tbl_meeting a
        left join tbl_user b on a.request_by =b.user_ids
        left join tbl_staff c on b.staff_id =c.staff_id
        left join tbl_position d on c.staff_position = d.ps_id
        left join tbl_depart e on c.staff_depart = e.depart_id
        left join tbl_depart_unit f on c.staff_unit = f.unit_id
		WHERE   mt_id = '".$meetingid."'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result);
		return $row;
	}
	
	public function GetItemRequest($meetingid){
		$sqlQuery = "
				SELECT rim_id,mt_id,item_id,
				(case when item_id = 1 then 'ນ້ຳດື່ມ' 
				when item_id = 2 then 'ສະແນັກ' 
				when item_id = 3 then 'ຄອມພິວເຕີ' 
				when item_id = 4 then 'ພອຍເຕີ້' 
				end) as item_name,
				item_values FROM tbl_request_item_meeting 
			WHERE mt_id = '".$meetingid."'";
		return  $this->getData($sqlQuery);	
	}
	
	public function GetStaffInfo($userid){
		$sqlQuery = "
		select * from profile_leave_view WHERE user_ids =  '".$userid."'";
		return  $this->getData($sqlQuery);	
	}
	
	public function GetDetailForMail($userid){
		$sqlQuery = " select * from view_show_meeting_detail where request_by = '".$userid."'  order by mt_id desc limit 1   ";
		return  $this->getData($sqlQuery);	
	}
	
	public function GetDetailForMailByid($mtid){
		$sqlQuery = " select * from view_show_meeting_approve where mt_id = '".$mtid."' ";
		return  $this->getData($sqlQuery);	
	}
	
	public function tableRoomReuqested(){
		$sqlQuery = "
		SELECT  mt_id,mtroom_id, room_name,
		meeting_title, date_meeting,time_start,time_end,join_people
		FROM tbl_meeting a
        left join tbl_meeting_room b on a.mtroom_id = b.room_id ";
		return  $this->getData($sqlQuery);	
	}
	
	
	public function UpdateRequest($POST) {
		if($POST['meeting_id']) {	
			$sqlInsert = "
				UPDATE  tbl_meeting
				SET  mtroom_id = ".$POST['edit_room_id'].", meeting_title = '".$POST['meeting_title']."' , join_people = ".$POST['join_people'].", date_meeting = '".$POST['meeting_date']."',
				time_start = '".$POST['hour_from']."' , time_end = '".$POST['hour_to']."' , Remark = '".isset($_POST["remark_text"])."'
				WHERE mt_id = '".$POST['meeting_id']."'  ";		
			mysqli_query($this->dbConnect, $sqlInsert);	
		}
		
		$this->deleteItemRequest($POST['meeting_id']);
		for ($i = 0; $i < count($POST['itemtype']); $i++) {			
			$sqlInsertItem = "
				INSERT INTO  tbl_request_item_meeting ( mt_id,item_id,item_values) 
				VALUES (".$POST['meeting_id'].", ".$POST['itemtype'][$i].", ".$POST['quantity'][$i]." )";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		}           	
	}
	
	
	public function ApprovalMetting($POST) {
		if($POST['meeting_id']) {	
			$sqlInsert = "
				UPDATE  tbl_meeting
				SET  mtroom_id = ".$POST['edit_room_id'].", meeting_title = '".$POST['meeting_title']."' , join_people = ".$POST['join_people'].", date_meeting = '".$POST['meeting_date']."',
				time_start = '".$POST['hour_from']."' , time_end = '".$POST['hour_to']."' , Remark = '".$POST['remark_text']."' , update_by = '".$POST['user_id']."'
				WHERE mt_id = '".$POST['meeting_id']."'  ";		
			mysqli_query($this->dbConnect, $sqlInsert);	
			
			
			
		}
		$this->deleteRquestApprove($POST['meeting_id']);
			$sqlInsert = " insert into tbl_meeting_approval (mt_id,rq_status,date_update,update_by) values (".$POST['meeting_id'].", '".$POST['app_status']."', now(),'".$POST['user_id']."') ";		
			mysqli_query($this->dbConnect, $sqlInsert);	
		
		$this->deleteItemRequest($POST['meeting_id']);
		for ($i = 0; $i < count($POST['itemtype']); $i++) {			
			$sqlInsertItem = "
				INSERT INTO  tbl_request_item_meeting ( mt_id,item_id,item_values) 
				VALUES (".$POST['meeting_id'].", ".$POST['itemtype'][$i].", ".$POST['quantity'][$i]." )";			
			mysqli_query($this->dbConnect, $sqlInsertItem);			
		}   
		if($POST['app_status'] == 1){
			return 1;
		}else{
			return 2;
		}
		
	}
	
	public function deleteItemRequest($idmeeting){
		$sqlQuery = "
			DELETE FROM tbl_request_item_meeting
			WHERE mt_id = '".$idmeeting."'";
		mysqli_query($this->dbConnect, $sqlQuery);				
	}
	
	public function deleteRquestApprove($meetingid){
		$sqlQuery2 = "
			DELETE FROM tbl_meeting_approval
			WHERE mt_id = '".$meetingid."' ";
		mysqli_query($this->dbConnect, $sqlQuery2);				
	}
	
	public function GetRoomMeeting(){
		$sqlQuery = " select * from tbl_meeting_room ";
		return  $this->getData($sqlQuery);	
	}
	public function GetItemDropdowwn(){
		$sqlQuery = " select * from tbl_item_type ";
		return  $this->getData($sqlQuery);	
	}
 
	public function checkStatusApprove($rqid){
		$sqlQuery = " select  (CASE WHEN rq_status = 1 then 'ອານຸຍາດ'   WHEN rq_status = 2 then 'ຍົກເລີກ'  else 'ລໍຖ້າ' end ) as rq_status
        from tbl_meeting_approval
		where mt_id = '".$rqid."'  ";
		return  $this->getData($sqlQuery);	
	}
	 
	 public function calendarRequest(){
		$sqlQuery = "  
SELECT a.mt_id,(case when rq_status is null then 0 else rq_status end) as rq_status,
concat('ຄຳຂໍເລກທີ ',a.mt_id,' ຫົວຂໍ້ ',meeting_title, ' ເວລາ',time_start,'ໂມງ ຫາ ',time_end,  'ໂມງ ',(case when staff_gender = 1 then 'ທ້າວ ' else 'ນາງ ' end),staff_first_name,' ',staff_last_name,' ພະແນກ ',depart_name, (case when rq_status is null then ' (ລໍຖ້າ)'
 	  when rq_status = 1 then ' (ອານຸຍາດ)'
 	  when rq_status = 2 then ' (ຍົກເລີກ)'
 else '' end)) as meeting_title ,  
DATE_FORMAT(date_meeting, '%Y-%m-%d') as date_meeting
  FROM tbl_meeting a
  left join tbl_meeting_approval b on a.mt_id = b.mt_id 
  left join tbl_depart c on a.depart_id = c.depart_id
  left join tbl_user d on a.request_by = d.user_ids  
  left join tbl_staff e on d.staff_id = e.staff_id
  LIMIT 100   ";
		return  $this->getData($sqlQuery);	
	}
	 
}
?>