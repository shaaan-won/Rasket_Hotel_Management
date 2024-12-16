<?php
class StaffDetail extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $first_name;
	public $last_name;
	public $role_id;
	public $email;
	public $phone;
	public $address;
	public $work_schedule;
	public $hired_date;
	public $performance_score;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$name,$first_name,$last_name,$role_id,$email,$phone,$address,$work_schedule,$hired_date,$performance_score,$created_at,$updated_at){
		$this->id=$id;
		$this->name=$name;
		$this->first_name=$first_name;
		$this->last_name=$last_name;
		$this->role_id=$role_id;
		$this->email=$email;
		$this->phone=$phone;
		$this->address=$address;
		$this->work_schedule=$work_schedule;
		$this->hired_date=$hired_date;
		$this->performance_score=$performance_score;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}staff_details(name,first_name,last_name,role_id,email,phone,address,work_schedule,hired_date,performance_score,created_at,updated_at)values('$this->name','$this->first_name','$this->last_name','$this->role_id','$this->email','$this->phone','$this->address','$this->work_schedule','$this->hired_date','$this->performance_score','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}staff_details set name='$this->name',first_name='$this->first_name',last_name='$this->last_name',role_id='$this->role_id',email='$this->email',phone='$this->phone',address='$this->address',work_schedule='$this->work_schedule',hired_date='$this->hired_date',performance_score='$this->performance_score',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}staff_details where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,first_name,last_name,role_id,email,phone,address,work_schedule,hired_date,performance_score,created_at,updated_at from {$tx}staff_details");
		$data=[];
		while($staffdetail=$result->fetch_object()){
			$data[]=$staffdetail;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,first_name,last_name,role_id,email,phone,address,work_schedule,hired_date,performance_score,created_at,updated_at from {$tx}staff_details $criteria limit $top,$perpage");
		$data=[];
		while($staffdetail=$result->fetch_object()){
			$data[]=$staffdetail;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}staff_details $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,first_name,last_name,role_id,email,phone,address,work_schedule,hired_date,performance_score,created_at,updated_at from {$tx}staff_details where id='$id'");
		$staffdetail=$result->fetch_object();
			return $staffdetail;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}staff_details");
		$staffdetail =$result->fetch_object();
		return $staffdetail->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		First Name:$this->first_name<br> 
		Last Name:$this->last_name<br> 
		Role Id:$this->role_id<br> 
		Email:$this->email<br> 
		Phone:$this->phone<br> 
		Address:$this->address<br> 
		Work Schedule:$this->work_schedule<br> 
		Hired Date:$this->hired_date<br> 
		Performance Score:$this->performance_score<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbStaffDetail"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}staff_details");
		while($staffdetail=$result->fetch_object()){
			$html.="<option value ='$staffdetail->id'>$staffdetail->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}staff_details $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,first_name,last_name,role_id,email,phone,address,work_schedule,hired_date,performance_score,created_at,updated_at from {$tx}staff_details $criteria limit $top,$perpage");
		$html="<div class='table-responsive'><table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"staffdetail/create","text"=>"New StaffDetail"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>First Name</th><th>Last Name</th><th>Role Id</th><th>Email</th><th>Phone</th><th>Address</th><th>Work Schedule</th><th>Hired Date</th><th>Performance Score</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>First Name</th><th>Last Name</th><th>Role Id</th><th>Email</th><th>Phone</th><th>Address</th><th>Work Schedule</th><th>Hired Date</th><th>Performance Score</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($staffdetail=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"staffdetail/show/$staffdetail->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"staffdetail/edit/$staffdetail->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"staffdetail/confirm/$staffdetail->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$staffdetail->id</td><td>$staffdetail->name</td><td>$staffdetail->first_name</td><td>$staffdetail->last_name</td><td>$staffdetail->role_id</td><td>$staffdetail->email</td><td>$staffdetail->phone</td><td>$staffdetail->address</td><td>$staffdetail->work_schedule</td><td>$staffdetail->hired_date</td><td>$staffdetail->performance_score</td><td>$staffdetail->created_at</td><td>$staffdetail->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table></div>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,name,first_name,last_name,role_id,email,phone,address,work_schedule,hired_date,performance_score,created_at,updated_at from {$tx}staff_details where id={$id}");
		$staffdetail=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">StaffDetail Show</th></tr>";
		$html.="<tr><th>Id</th><td>$staffdetail->id</td></tr>";
		$html.="<tr><th>Name</th><td>$staffdetail->name</td></tr>";
		$html.="<tr><th>First Name</th><td>$staffdetail->first_name</td></tr>";
		$html.="<tr><th>Last Name</th><td>$staffdetail->last_name</td></tr>";
		$html.="<tr><th>Role Id</th><td>$staffdetail->role_id</td></tr>";
		$html.="<tr><th>Email</th><td>$staffdetail->email</td></tr>";
		$html.="<tr><th>Phone</th><td>$staffdetail->phone</td></tr>";
		$html.="<tr><th>Address</th><td>$staffdetail->address</td></tr>";
		$html.="<tr><th>Work Schedule</th><td>$staffdetail->work_schedule</td></tr>";
		$html.="<tr><th>Hired Date</th><td>$staffdetail->hired_date</td></tr>";
		$html.="<tr><th>Performance Score</th><td>$staffdetail->performance_score</td></tr>";
		$html.="<tr><th>Created At</th><td>$staffdetail->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$staffdetail->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
