create table tbl_user (
user_ids int not null auto_increment primary key,
User_names varchar(50),
user_password varchar(25),
staff_id int,
user_status int, 
user_create_date date,
line_token text
);
 

create table tbl_staff (
staff_id int not null auto_increment primary key,
staff_code int,
staff_first_name varchar(30),
staff_last_name varchar(30),
staff_gender int,
staff_position int,
staff_depart int,
staff_unit int, 
regis_date date
);
 
 

create table tbl_depend (
sd_id int not null auto_increment primary key,
staff_id int,
depend_id int,
regis_date date
);
 


create table tbl_company (
cp_id int not null auto_increment primary key,
company_name varchar(100)
)

create table tbl_depart (
depart_id int not null auto_increment primary key,
company_id int,
depart_name varchar(50),
depart_email varchar(50)
);

 

create table tbl_depart_unit (
unit_id int not null auto_increment primary key,
depart_id int,
unit_name varchar(50)
);



insert into tbl_depart_unit values ('','1','ທີມພັດທະນາ');


create table tbl_position (
ps_id int not null auto_increment primary key, 
depart_id int,
unit_id int,
position_name varchar(50)
);

insert into tbl_position values ('','1','1','ຜູ້ຈັດການ');

create table tbl_role_level (
rlv_id int not null auto_increment primary key, 
ps_id int,
role_level int,
date_register date
)


create table tbl_leave_type (
lt_id int not null auto_increment primary key,
leave_name varchar(50)
);

insert into tbl_leave_type values ('','ລາປ່ວຍ');
insert into tbl_leave_type values ('','ລາພັກປະຈຳປີ');
insert into tbl_leave_type values ('','ລາເກີດລູກ');
insert into tbl_leave_type values ('','ລາກິດ');
insert into tbl_leave_type values ('','ຂາດການ');
insert into tbl_leave_type values ('','ລາບໍ່ໄດ້ຮັບຄ່າຈ້າງ');
insert into tbl_leave_type values ('','ອື່ນໆ');

create table tbl_leave_request (
lr_id int not null auto_increment primary key,
user_ids int,
depart_id int, 
leave_type int,
date_leave int,
hours_leave int,
minus_leave int,
date_from date,
time_from time,
date_to date,
time_to time,
reason text,
attatch_file varchar(100),
date_request date
);



create table tbl_approval (
la_id int not null auto_increment primary key,
lr_id int,
approve_status int,
approve_reason varchar(150),
approve_by int,
approve_level int,
approve_date date
);

create table tbl_ceo_approval (
ca_id int not null auto_increment primary key,
lr_id int,
approve_status int,
approve_reason varchar(150),
approve_by int,
approve_level int,
approve_date date
);

 
create table tbl_leave_request_document (
lrd_id int not null auto_increment primary key, 
staff_id int,  
approver_manager int,
approver_director int,
approver_hr int,
leave_type int,
date_leave int,
hours_leave int,
minus_leave int,
date_from date,
time_from time,
date_to date,
time_to time,
reason text,
attatch_file varchar(50),
date_request date
);


create table tbl_holiday(
hd_id int not null auto_increment primary key, 
hd_date date,
hd_year year,
add_by int
);

create table tbl_all_sunday (
sun_date date,
sun_year year
);




create table tbl_total_leave(
tl_id int not null auto_increment primary key, 
lt_id int,
max_minus int,
year_effect year 
);

-- 1day   8*60 480sc

insert into tbl_total_leave values ('','1','14400','2020');
insert into tbl_total_leave values ('','2','7200','2020');
insert into tbl_total_leave values ('','3','57600','2020');
insert into tbl_total_leave values ('','4','1440','2020');
insert into tbl_total_leave values ('','5','1440','2020');
insert into tbl_total_leave values ('','6','3360','2020');  


create table tbl_set_approval (
sa_id int not null auto_increment primary key, 
rq_by int,
ap_by int,
level_ap int
);



----- create view ------

create or replace view profile_leave_view as (
select  user_ids,a.staff_id as staff_id,staff_code ,staff_first_name ,staff_last_name ,
					(case when b.staff_gender = '1' then 'ທ້າວ' else 'ນາງ' end)as staff_gender,
                    position_name as staff_position ,staff_depart as depart_id,depart_name as staff_depart,unit_name as staff_unit
from tbl_user a
left join tbl_staff b on a.staff_id = b.staff_id
left join tbl_depart c on b.staff_depart = c.depart_id
left join tbl_depart_unit d on b.staff_unit = d.unit_id
left join tbl_position e on b.staff_position = e.ps_id 
);





create or replace view list_leave_view as (

select a.lr_id as lr_id,  c.user_ids  ,(case when staff_gender  = 1 then 'ທ້າວ' else 'ນາງ' end ) as staff_gender,depart_id,
concat( staff_first_name,' ',staff_last_name) as full_name,
leave_name ,date_leave,hours_leave,minus_leave,
date_from,time_from,date_to,time_to, reason,
(case when attatch_file is null then 'ບໍ່ມີ' else 'ມີເອກະສານແນບ' end) as attatch_file , approve_by ,e.staff_id,approve_status
 from tbl_approval a
left join tbl_staff b on a.approve_by = b.staff_code
left join tbl_leave_request c on a.lr_id = c.lr_id
left join tbl_leave_type d on c.leave_type = d.lt_id 
left join tbl_user e on c.user_ids = e.user_ids

);

 
create or replace view detail_leave_request as (
  select a.lr_id as lr_id,leave_name,date_leave,hours_leave,minus_leave,date_from,time_from,date_to,time_to,reason,
(case when attatch_file is null then 'ບໍ່ມີເອກະສານແນບ' else 'ສະແດງເອກະສານ' end ) as attatch_status,attatch_file,date_request,
  c.staff_id,staff_code,  staff_first_name, staff_last_name as staff_last_name,
(case when  staff_gender = '1' then 'ທ້າວ' else 'ນາງ' end) as staff_gender,
position_name as staff_position,
depart_name as staff_depart, unit_name as staff_unit,approve_status,
(case when approve_level is null then '0' else approve_level end ) as approve_level,approve_date,approve_reason,approve_by 
from tbl_approval a
left join tbl_leave_request b on a.lr_id = b.lr_id
left join tbl_user c on b.user_ids = c.user_ids
left join tbl_staff d on c.staff_id = d.staff_id
left join tbl_depart e on d.staff_depart = e.depart_id
left join tbl_depart_unit f on d.staff_unit = f.unit_id
left join tbl_position g on d.staff_position = g.ps_id
left join tbl_leave_type h on b.leave_type = h.lt_id
);



create or replace view pre_email_leave_id as (
select  a.user_ids as user_ids, (a.lr_id) AS lr_id  ,  
			concat((case when d.staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end),' ',d.staff_first_name,' ',d.staff_last_name) as Full_name,
			reason,leave_name,c.user_names as staff_email,h.depart_name as depart_name,position_name, 
			concat( DATE_FORMAT(date_from, "%e-%m-%Y") ,' ',time_from) as start_date,concat( DATE_FORMAT(date_to, "%e-%m-%Y") ,' ',time_to) as to_date,
            approve_by,g.user_names as app_email,g.line_token as line_token,
            concat((case when f.staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end),' ',f.staff_first_name,' ',f.staff_last_name) as approval_name,j.depart_email as depart_email
			from tbl_leave_request a
			left join tbl_leave_type b on a.leave_type = b.lt_id
			left join tbl_user c on a.user_ids = c.user_ids 
			left join tbl_staff d on c.staff_id = d.staff_id
            left join tbl_approval e on a.lr_id = e.lr_id
            left join tbl_staff f on e.approve_by = f.staff_id
            left join tbl_user g on f.staff_id = g.staff_id
            left join tbl_depart h on d.staff_depart = h.depart_id
            left join tbl_position i on d.staff_position = i.ps_id
            left join tbl_depart j on f.staff_depart = j.depart_id
);


create or replace view staff_email_leave as (
select  a.user_ids as user_ids, (a.lr_id) AS lr_id  , 
			concat((case when d.staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end),' ',d.staff_first_name,' ',d.staff_last_name) as Full_name,
            depart_name,position_name,
			reason,leave_name, user_names as staff_email,line_token,
			concat(date_from,' ',time_from) as start_date,concat(date_to,' ',time_to) as to_date,depart_email
            from tbl_leave_request a
			left join tbl_leave_type b on a.leave_type = b.lt_id
			left join tbl_user c on a.user_ids = c.user_ids 
			left join tbl_staff d on c.staff_id = d.staff_id 
            left join tbl_depart e on d.staff_depart = e.depart_id
            left join tbl_position f on d.staff_position = f.ps_id
)


create or replace view leave_history_view as (
select a.user_ids as user_ids,lr_id,depart_id,reason,date_from,date_to,
concat((case when staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end), ' ',staff_first_name,' ',staff_last_name) as requester_full_name
from tbl_leave_request a
left join tbl_user b on a.user_ids = b.user_ids
left join tbl_staff c on b.staff_id = c.staff_id
)

create or replace view staff_info_view as (
select staff_id,staff_code,staff_first_name,staff_last_name,
staff_gender,(case when staff_gender = 1 then 'ທ້າວ ' when staff_gender = 2 then 'ນາງ ' else 'ທ່ານ ' end ) as gender_name,depart_name,staff_unit,unit_name,staff_position,position_name
 from tbl_staff a
left join tbl_position b on a.staff_position = b.ps_id
left join tbl_depart c on a.staff_depart = c.depart_id
left join tbl_depart_unit d on a.staff_unit = d.unit_id
);


create or replace  view users_info as (
SELECT user_ids,staff_code,a.staff_id as staff_id,user_names,
 concat((case when staff_gender = 1 then 'ທ້າວ ' when staff_gender = 2 then 'ນາງ ' else 'ທ່ານ ' end ),
staff_first_name,' ',staff_last_name) as full_name
 ,depart_name,unit_name,position_name, 
 (case when user_status = 1 then 'ເປີດນຳໃຊ້' when user_status = 2 then 'ຢຸດນຳໃຊ້' when user_status = 0 then 'ກຽມນຳໃຊ້' when user_status = 3 then 'ປິດນຳໃຊ້' else 'ບໍ່ລົງທະບຽນ' end ) as user_status
FROM  tbl_staff a
left join tbl_user b on a.staff_id = b.staff_id
left join tbl_depart c on a.staff_depart = c.depart_id
left join tbl_depart_unit d on a.staff_unit = d.unit_id
left join tbl_position e on a.staff_position = e.ps_id
);


create or replace view full_view_doc as (
select a.user_ids as user_ids,lr_id,a.depart_id as depart_id,
DATE_FORMAT(date_from, "%e-%m-%Y") as date_from,DATE_FORMAT(date_to, "%e-%m-%Y") as date_to,time_from,time_to,
date_leave,hours_leave,minus_leave,reason,
concat((case when staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end), ' ',staff_first_name,' ',staff_last_name) as requester_full_name,
staff_code,depart_name,position_name,unit_name,leave_name,(case when attatch_file is null then 'ບໍ່ມີເອກະສານແນບ' else 'ມີເອກະສານແນບ' end) as attatch_file
from tbl_leave_request a
left join tbl_user b on a.user_ids = b.user_ids
left join tbl_staff c on b.staff_id = c.staff_id
left join tbl_depart d on c.staff_depart = d.depart_id
left join tbl_position e on c.staff_position = e.ps_id
left join tbl_depart_unit f on c.staff_unit = f.unit_id
left join tbl_leave_type g on a.leave_type = g.lt_id
);

create or replace view calculator_leave_used  as (
SELECT user_ids,leave_type,
(((date_leave*8)*60)+(hours_leave*60)+minus_leave) as cal_leave, date_request
FROM tbl_approval a
left join tbl_leave_request b on a.lr_id = b.lr_id
where approve_level = 3 and approve_status = 1
);

create or replace view calculator_total_leave as (
select  a.lt_id as lt_id ,leave_name, max_minus
from tbl_total_leave a
left join tbl_leave_type b on a.lt_id = b.lt_id 
);


create or replace view line_group_single as (
SELECT line_token ,staff_depart,role_level
FROM tbl_user a
left join tbl_staff b on a.staff_id = b.staff_id
left join tbl_role_level c on b.staff_position = c.ps_id 
);

 
 
ALTER TABLE tbl_activity_type CONVERT TO CHARACTER SET utf8 COLLATE utf8mb4_general_ci;

create table tbl_activity_type(
at_id int not null auto_increment primary key,
act_name  nvarchar(150)
);



insert into tbl_activity_type values ('1','ໄປເຮັດວຽກ');
insert into tbl_activity_type values ('2','ໄປຕະຫຼາດ');
insert into tbl_activity_type values ('3','ໄປໂຮງໝໍ');
insert into tbl_activity_type values ('4','ໄປພົວພັນວຽກ');
insert into tbl_activity_type values ('5','ບໍ່ສະບາຍ');
insert into tbl_activity_type values ('6','ອື່ນໆ');

create table tbl_district (
dt_id  int not null auto_increment primary key,
dt_name varchar(300)
);

insert into tbl_district values ('','ຈັນທະບູລີ');
insert into tbl_district values ('','ຫາດຊາຍຟອງ');
insert into tbl_district values ('','ປາກງື່ມ');
insert into tbl_district values ('','ນາຊາຍທອງ');
insert into tbl_district values ('','ສັງທອງ');
insert into tbl_district values ('','ສີໂຄດຕະບອງ');
insert into tbl_district values ('','ສີສັດຕະນາກ');
insert into tbl_district values ('','ໄຊເສດຖາ');
insert into tbl_district values ('','ໄຊທະນີ');


create table tbl_time_line (
tl_id int not null auto_increment primary key,
staff_id int,
atv_id int,
location_name varchar(300),
district_id int,
village_name varchar(300),
date_atv date,
start_atv time,
stop_atv time,
detail_atv text,
detail_partnert text,
date_register date,
add_by int
);
alter table tbl_time_line add partner_symptom text;
alter table tbl_time_line add own_symptom text;
alter table tbl_time_line add partner_act text;


create table tbl_symptoms_type (
st_id int not null auto_increment primary key,
st_name nvarchar(250)
);
insert into tbl_symptoms_type values ('1','ມີໄຂ');
insert into tbl_symptoms_type values ('2','ເຈັບຄໍ');
insert into tbl_symptoms_type values ('3','ມີນ້ຳມູກ');
insert into tbl_symptoms_type values ('4','ເມື່ອຍ');
insert into tbl_symptoms_type values ('5','ຫາຍໃຈຝືດ');
insert into tbl_symptoms_type values ('6','ບໍ່ມີອາການ');
insert into tbl_symptoms_type values ('7','ອື່ນໆ');

create table tbl_symptoms_follow (
stf_id int not null auto_increment primary key,
staff_id int,
stf_type int,
st_id int,
partner_name nvarchar(250),
partner_relation nvarchar(250),
date_follow date,
dt_owner text,
dt_join text,
date_register date,
add_by int
);

ALTER TABLE tbl_symptoms_follow CONVERT TO CHARACTER SET utf8 COLLATE utf8mb4_general_ci;

create or replace view show_time_line as (
select staff_id,act_name,location_name,village_name,dt_name,date_atv,start_atv,stop_atv, 
(case when detail_atv = '' then 'ບໍ່ມີ' else detail_atv end) as detail_atv,
										(case when detail_partnert = '' then 'ບໍ່ມີ' else detail_partnert end) as detail_partnert, 1 as type_time_line,add_by
												from tbl_time_line a
												left join tbl_activity_type b on a.atv_id = b.at_id  
                                                left join tbl_district c on a.district_id = c.dt_id 
union all
SELECT staff_id,(case when stf_type = 2 then 'ຕິດຕາມອາການໂຕເອງ' else 'ຕິດຕາມອາການຄົນໄກ້ໂຕ' end) as stf_type ,st_name,partner_name,partner_relation,date_follow,'','', 
(case when dt_owner = '' then 'ບໍ່ມີ' else dt_owner end) as dt_owner,
(case when dt_join = '' then 'ບໍ່ມີ' else dt_join end) as dt_join,
 stf_type as type_time_line,add_by
FROM tbl_symptoms_follow a 
left join tbl_symptoms_type b on a.st_id = b.st_id
);


create or replace view show_date_time_line as (
select distinct staff_id,date_atv from tbl_time_line
union all
select distinct staff_id,date_follow from tbl_symptoms_follow
);

create table tbl_meeting (
mt_id int not null auto_increment primary key,
mtroom_id int,
meeting_title varchar(300),
join_people int,
date_meeting date,
time_start time,
time_end time,
Remark text,
date_register date,
request_by int,
update_by int,
depart_id int
);

create table tbl_request_item_meeting (
rim_id int not null auto_increment primary key,
mt_id int,
item_id int,
item_values int
);

create table tbl_meeting_room (
room_id int not null auto_increment primary key,
room_name varchar(300)
);

create table tbl_item_type (
itype_id int not null auto_increment primary key,
room_name varchar(300)
);

create table tbl_meeting_approval (
mtap_id int not null auto_increment primary key,
mt_id int,
rq_status int,
date_update date,
update_by int
);
 
create view view_show_meeting_detail as (
SELECT concat ((case when staff_gender = 1 then 'ທ້າວ ' else 'ນາງ ' end),staff_first_name,' ',staff_last_name ) as full_name ,
User_names as mail_user,mt_id,mtroom_id,room_name,meeting_title,join_people,date_meeting as mdate,time_start,time_end,Remark,date_register,request_by,a.depart_id,depart_name 
FROM tbl_meeting a 
left join tbl_meeting_room b on a.mtroom_id = b.room_id left join tbl_user c on a.request_by = c.user_ids left join tbl_staff d on c.staff_id = d.staff_id left join tbl_depart e on a.depart_id = e.depart_id
);




create view view_show_meeting_approve as (
SELECT concat ((case when staff_gender = 1 then 'ທ້າວ ' else 'ນາງ ' end),staff_first_name,' ',staff_last_name ) as full_name ,
User_names as mail_user,a.mt_id,mtroom_id,room_name,meeting_title,join_people,date_meeting as mdate,time_start,time_end,Remark,date_register,request_by,a.depart_id,depart_name,rq_status,
(case when rq_status = 1 then 'ອານຸຍາດ' else 'ຍົກເລີກ' end) as status_name
FROM tbl_meeting a 
left join tbl_meeting_room b on a.mtroom_id = b.room_id 
left join tbl_user c on a.request_by = c.user_ids 
left join tbl_staff d on c.staff_id = d.staff_id 
left join tbl_depart e on a.depart_id = e.depart_id
left join tbl_meeting_approval f on a.mt_id = f.mt_id
);


