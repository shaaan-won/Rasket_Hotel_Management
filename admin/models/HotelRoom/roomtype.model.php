<?php
class RoomType extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $description;
	public $max_occupancy;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$name,$description,$max_occupancy,$created_at,$updated_at){
		$this->id=$id;
		$this->name=$name;
		$this->description=$description;
		$this->max_occupancy=$max_occupancy;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}room_types(name,description,max_occupancy,created_at,updated_at)values('$this->name','$this->description','$this->max_occupancy','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}room_types set name='$this->name',description='$this->description',max_occupancy='$this->max_occupancy',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}room_types where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,description,max_occupancy,created_at,updated_at from {$tx}room_types");
		$data=[];
		while($roomtype=$result->fetch_object()){
			$data[]=$roomtype;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,description,max_occupancy,created_at,updated_at from {$tx}room_types $criteria limit $top,$perpage");
		$data=[];
		while($roomtype=$result->fetch_object()){
			$data[]=$roomtype;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}room_types $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,description,max_occupancy,created_at,updated_at from {$tx}room_types where id='$id'");
		$roomtype=$result->fetch_object();
			return $roomtype;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}room_types");
		$roomtype =$result->fetch_object();
		return $roomtype->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Description:$this->description<br> 
		Max Occupancy:$this->max_occupancy<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbRoomType"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}room_types");
		while($roomtype=$result->fetch_object()){
			$html.="<option value ='$roomtype->id'>$roomtype->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}room_types $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,description,max_occupancy,created_at,updated_at from {$tx}room_types $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"roomtype/create","text"=>"New RoomType"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Description</th><th>Max Occupancy</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Description</th><th>Max Occupancy</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($roomtype=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"roomtype/show/$roomtype->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"roomtype/edit/$roomtype->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"roomtype/confirm/$roomtype->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$roomtype->id</td><td>$roomtype->name</td><td>$roomtype->description</td><td>$roomtype->max_occupancy</td><td>$roomtype->created_at</td><td>$roomtype->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,name,description,max_occupancy,created_at,updated_at from {$tx}room_types where id={$id}");
		$roomtype=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">RoomType Show</th></tr>";
		$html.="<tr><th>Id</th><td>$roomtype->id</td></tr>";
		$html.="<tr><th>Name</th><td>$roomtype->name</td></tr>";
		$html.="<tr><th>Description</th><td>$roomtype->description</td></tr>";
		$html.="<tr><th>Max Occupancy</th><td>$roomtype->max_occupancy</td></tr>";
		$html.="<tr><th>Created At</th><td>$roomtype->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$roomtype->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
