<?php
class Checkincheckout extends Model implements JsonSerializable{
	public $id;
	public $reservation_id;
	public $check_in_time;
	public $check_out_time;
	public $comments;
	public $created_at;

	public function __construct(){
	}
	public function set($id,$reservation_id,$check_in_time,$check_out_time,$comments,$created_at){
		$this->id=$id;
		$this->reservation_id=$reservation_id;
		$this->check_in_time=$check_in_time;
		$this->check_out_time=$check_out_time;
		$this->comments=$comments;
		$this->created_at=$created_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}checkincheckout(reservation_id,check_in_time,check_out_time,comments,created_at)values('$this->reservation_id','$this->check_in_time','$this->check_out_time','$this->comments','$this->created_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}checkincheckout set reservation_id='$this->reservation_id',check_in_time='$this->check_in_time',check_out_time='$this->check_out_time',comments='$this->comments',created_at='$this->created_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}checkincheckout where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,reservation_id,check_in_time,check_out_time,comments,created_at from {$tx}checkincheckout");
		$data=[];
		while($checkincheckout=$result->fetch_object()){
			$data[]=$checkincheckout;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,reservation_id,check_in_time,check_out_time,comments,created_at from {$tx}checkincheckout $criteria limit $top,$perpage");
		$data=[];
		while($checkincheckout=$result->fetch_object()){
			$data[]=$checkincheckout;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}checkincheckout $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,reservation_id,check_in_time,check_out_time,comments,created_at from {$tx}checkincheckout where id='$id'");
		$checkincheckout=$result->fetch_object();
			return $checkincheckout;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}checkincheckout");
		$checkincheckout =$result->fetch_object();
		return $checkincheckout->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Reservation Id:$this->reservation_id<br> 
		Check In Time:$this->check_in_time<br> 
		Check Out Time:$this->check_out_time<br> 
		Comments:$this->comments<br> 
		Created At:$this->created_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbCheckincheckout"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}checkincheckout");
		while($checkincheckout=$result->fetch_object()){
			$html.="<option value ='$checkincheckout->id'>$checkincheckout->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}checkincheckout $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,reservation_id,check_in_time,check_out_time,comments,created_at from {$tx}checkincheckout $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"checkincheckout/create","text"=>"New Checkincheckout"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Reservation Id</th><th>Check In Time</th><th>Check Out Time</th><th>Comments</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Reservation Id</th><th>Check In Time</th><th>Check Out Time</th><th>Comments</th><th>Created At</th></tr>";
		}
		while($checkincheckout=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"checkincheckout/show/$checkincheckout->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"checkincheckout/edit/$checkincheckout->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"checkincheckout/confirm/$checkincheckout->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$checkincheckout->id</td><td>$checkincheckout->reservation_id</td><td>$checkincheckout->check_in_time</td><td>$checkincheckout->check_out_time</td><td>$checkincheckout->comments</td><td>$checkincheckout->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,reservation_id,check_in_time,check_out_time,comments,created_at from {$tx}checkincheckout where id={$id}");
		$checkincheckout=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Checkincheckout Show</th></tr>";
		$html.="<tr><th>Id</th><td>$checkincheckout->id</td></tr>";
		$html.="<tr><th>Reservation Id</th><td>$checkincheckout->reservation_id</td></tr>";
		$html.="<tr><th>Check In Time</th><td>$checkincheckout->check_in_time</td></tr>";
		$html.="<tr><th>Check Out Time</th><td>$checkincheckout->check_out_time</td></tr>";
		$html.="<tr><th>Comments</th><td>$checkincheckout->comments</td></tr>";
		$html.="<tr><th>Created At</th><td>$checkincheckout->created_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
