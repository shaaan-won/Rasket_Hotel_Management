<?php
class Room extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $room_number;
	public $room_type_id;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$room_number,$room_type_id,$created_at,$updated_at){
		$this->id=$id;
		$this->room_number=$room_number;
		$this->room_type_id=$room_type_id;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}rooms(room_number,room_type_id,created_at,updated_at)values('$this->room_number','$this->room_type_id','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}rooms set room_number='$this->room_number',room_type_id='$this->room_type_id',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}rooms where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,room_number,room_type_id,created_at,updated_at from {$tx}rooms");
		$data=[];
		while($room=$result->fetch_object()){
			$data[]=$room;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,room_number,room_type_id,created_at,updated_at from {$tx}rooms $criteria limit $top,$perpage");
		$data=[];
		while($room=$result->fetch_object()){
			$data[]=$room;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}rooms $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,room_number,room_type_id,created_at,updated_at from {$tx}rooms where id='$id'");
		$room=$result->fetch_object();
			return $room;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}rooms");
		$room =$result->fetch_object();
		return $room->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Room Number:$this->room_number<br> 
		Room Type Id:$this->room_type_id<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($room_number="cmbRoom"){
		global $db,$tx;
		$html="<select id='$room_number' name='$room_number'> ";
		$result =$db->query("select id,room_number from {$tx}rooms");
		while($room=$result->fetch_object()){
			$html.="<option value ='$room->id'>$room->room_number</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}rooms $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,room_number,room_type_id,created_at,updated_at from {$tx}rooms $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"room/create","text"=>"New Room"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Room Number</th><th>Room Type Id</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Room Number</th><th>Room Type Id</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($room=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"room/show/$room->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"room/edit/$room->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"room/confirm/$room->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$room->id</td><td>$room->room_number</td><td>$room->room_type_id</td><td>$room->created_at</td><td>$room->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,room_number,room_type_id,created_at,updated_at from {$tx}rooms where id={$id}");
		$room=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Room Show</th></tr>";
		$html.="<tr><th>Id</th><td>$room->id</td></tr>";
		$html.="<tr><th>Room Number</th><td>$room->room_number</td></tr>";
		$html.="<tr><th>Room Type Id</th><td>$room->room_type_id</td></tr>";
		$html.="<tr><th>Created At</th><td>$room->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$room->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
