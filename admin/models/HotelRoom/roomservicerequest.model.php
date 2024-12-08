<?php
class RoomServicerequest extends Model implements JsonSerializable{
	public $id;
	public $user_id;
	public $room_id;
	public $request_type;
	public $request_description;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$user_id,$room_id,$request_type,$request_description,$created_at,$updated_at){
		$this->id=$id;
		$this->user_id=$user_id;
		$this->room_id=$room_id;
		$this->request_type=$request_type;
		$this->request_description=$request_description;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}room_servicerequests(user_id,room_id,request_type,request_description,created_at,updated_at)values('$this->user_id','$this->room_id','$this->request_type','$this->request_description','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}room_servicerequests set user_id='$this->user_id',room_id='$this->room_id',request_type='$this->request_type',request_description='$this->request_description',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}room_servicerequests where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,user_id,room_id,request_type,request_description,created_at,updated_at from {$tx}room_servicerequests");
		$data=[];
		while($roomservicerequest=$result->fetch_object()){
			$data[]=$roomservicerequest;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,user_id,room_id,request_type,request_description,created_at,updated_at from {$tx}room_servicerequests $criteria limit $top,$perpage");
		$data=[];
		while($roomservicerequest=$result->fetch_object()){
			$data[]=$roomservicerequest;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}room_servicerequests $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,user_id,room_id,request_type,request_description,created_at,updated_at from {$tx}room_servicerequests where id='$id'");
		$roomservicerequest=$result->fetch_object();
			return $roomservicerequest;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}room_servicerequests");
		$roomservicerequest =$result->fetch_object();
		return $roomservicerequest->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		User Id:$this->user_id<br> 
		Room Id:$this->room_id<br> 
		Request Type:$this->request_type<br> 
		Request Description:$this->request_description<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbRoomServicerequest"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}room_servicerequests");
		while($roomservicerequest=$result->fetch_object()){
			$html.="<option value ='$roomservicerequest->id'>$roomservicerequest->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}room_servicerequests $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,user_id,room_id,request_type,request_description,created_at,updated_at from {$tx}room_servicerequests $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"roomservicerequest/create","text"=>"New RoomServicerequest"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>User Id</th><th>Room Id</th><th>Request Type</th><th>Request Description</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>User Id</th><th>Room Id</th><th>Request Type</th><th>Request Description</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($roomservicerequest=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"roomservicerequest/show/$roomservicerequest->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"roomservicerequest/edit/$roomservicerequest->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"roomservicerequest/confirm/$roomservicerequest->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$roomservicerequest->id</td><td>$roomservicerequest->user_id</td><td>$roomservicerequest->room_id</td><td>$roomservicerequest->request_type</td><td>$roomservicerequest->request_description</td><td>$roomservicerequest->created_at</td><td>$roomservicerequest->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,user_id,room_id,request_type,request_description,created_at,updated_at from {$tx}room_servicerequests where id={$id}");
		$roomservicerequest=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">RoomServicerequest Show</th></tr>";
		$html.="<tr><th>Id</th><td>$roomservicerequest->id</td></tr>";
		$html.="<tr><th>User Id</th><td>$roomservicerequest->user_id</td></tr>";
		$html.="<tr><th>Room Id</th><td>$roomservicerequest->room_id</td></tr>";
		$html.="<tr><th>Request Type</th><td>$roomservicerequest->request_type</td></tr>";
		$html.="<tr><th>Request Description</th><td>$roomservicerequest->request_description</td></tr>";
		$html.="<tr><th>Created At</th><td>$roomservicerequest->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$roomservicerequest->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
