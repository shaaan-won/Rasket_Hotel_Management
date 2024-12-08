<?php
class StaffRole extends Model implements JsonSerializable{
	public $id;
	public $role_name;
	public $permissions;

	public function __construct(){
	}
	public function set($id,$role_name,$permissions){
		$this->id=$id;
		$this->role_name=$role_name;
		$this->permissions=$permissions;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}staff_roles(role_name,permissions)values('$this->role_name','$this->permissions')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}staff_roles set role_name='$this->role_name',permissions='$this->permissions' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}staff_roles where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,role_name,permissions from {$tx}staff_roles");
		$data=[];
		while($staffrole=$result->fetch_object()){
			$data[]=$staffrole;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,role_name,permissions from {$tx}staff_roles $criteria limit $top,$perpage");
		$data=[];
		while($staffrole=$result->fetch_object()){
			$data[]=$staffrole;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}staff_roles $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,role_name,permissions from {$tx}staff_roles where id='$id'");
		$staffrole=$result->fetch_object();
			return $staffrole;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}staff_roles");
		$staffrole =$result->fetch_object();
		return $staffrole->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Role Name:$this->role_name<br> 
		Permissions:$this->permissions<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbStaffRole"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}staff_roles");
		while($staffrole=$result->fetch_object()){
			$html.="<option value ='$staffrole->id'>$staffrole->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}staff_roles $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,role_name,permissions from {$tx}staff_roles $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"staffrole/create","text"=>"New StaffRole"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Role Name</th><th>Permissions</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Role Name</th><th>Permissions</th></tr>";
		}
		while($staffrole=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"staffrole/show/$staffrole->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"staffrole/edit/$staffrole->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"staffrole/confirm/$staffrole->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$staffrole->id</td><td>$staffrole->role_name</td><td>$staffrole->permissions</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,role_name,permissions from {$tx}staff_roles where id={$id}");
		$staffrole=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">StaffRole Show</th></tr>";
		$html.="<tr><th>Id</th><td>$staffrole->id</td></tr>";
		$html.="<tr><th>Role Name</th><td>$staffrole->role_name</td></tr>";
		$html.="<tr><th>Permissions</th><td>$staffrole->permissions</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
