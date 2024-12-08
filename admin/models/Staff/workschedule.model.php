<?php
class WorkSchedule extends Model implements JsonSerializable{
	public $id;
	public $staff_id;
	public $day_of_week;
	public $start_time;
	public $end_time;
	public $created_at;

	public function __construct(){
	}
	public function set($id,$staff_id,$day_of_week,$start_time,$end_time,$created_at){
		$this->id=$id;
		$this->staff_id=$staff_id;
		$this->day_of_week=$day_of_week;
		$this->start_time=$start_time;
		$this->end_time=$end_time;
		$this->created_at=$created_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}work_schedule(staff_id,day_of_week,start_time,end_time,created_at)values('$this->staff_id','$this->day_of_week','$this->start_time','$this->end_time','$this->created_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}work_schedule set staff_id='$this->staff_id',day_of_week='$this->day_of_week',start_time='$this->start_time',end_time='$this->end_time',created_at='$this->created_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}work_schedule where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,staff_id,day_of_week,start_time,end_time,created_at from {$tx}work_schedule");
		$data=[];
		while($workschedule=$result->fetch_object()){
			$data[]=$workschedule;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,staff_id,day_of_week,start_time,end_time,created_at from {$tx}work_schedule $criteria limit $top,$perpage");
		$data=[];
		while($workschedule=$result->fetch_object()){
			$data[]=$workschedule;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}work_schedule $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,staff_id,day_of_week,start_time,end_time,created_at from {$tx}work_schedule where id='$id'");
		$workschedule=$result->fetch_object();
			return $workschedule;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}work_schedule");
		$workschedule =$result->fetch_object();
		return $workschedule->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Staff Id:$this->staff_id<br> 
		Day Of Week:$this->day_of_week<br> 
		Start Time:$this->start_time<br> 
		End Time:$this->end_time<br> 
		Created At:$this->created_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbWorkSchedule"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}work_schedule");
		while($workschedule=$result->fetch_object()){
			$html.="<option value ='$workschedule->id'>$workschedule->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}work_schedule $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,staff_id,day_of_week,start_time,end_time,created_at from {$tx}work_schedule $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"workschedule/create","text"=>"New WorkSchedule"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Staff Id</th><th>Day Of Week</th><th>Start Time</th><th>End Time</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Staff Id</th><th>Day Of Week</th><th>Start Time</th><th>End Time</th><th>Created At</th></tr>";
		}
		while($workschedule=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"workschedule/show/$workschedule->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"workschedule/edit/$workschedule->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"workschedule/confirm/$workschedule->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$workschedule->id</td><td>$workschedule->staff_id</td><td>$workschedule->day_of_week</td><td>$workschedule->start_time</td><td>$workschedule->end_time</td><td>$workschedule->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,staff_id,day_of_week,start_time,end_time,created_at from {$tx}work_schedule where id={$id}");
		$workschedule=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">WorkSchedule Show</th></tr>";
		$html.="<tr><th>Id</th><td>$workschedule->id</td></tr>";
		$html.="<tr><th>Staff Id</th><td>$workschedule->staff_id</td></tr>";
		$html.="<tr><th>Day Of Week</th><td>$workschedule->day_of_week</td></tr>";
		$html.="<tr><th>Start Time</th><td>$workschedule->start_time</td></tr>";
		$html.="<tr><th>End Time</th><td>$workschedule->end_time</td></tr>";
		$html.="<tr><th>Created At</th><td>$workschedule->created_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
