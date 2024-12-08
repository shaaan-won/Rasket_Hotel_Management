<?php
class IdCardType extends Model implements JsonSerializable{
	public $id;
	public $id_card_type_name;
	public $created_at;

	public function __construct(){
	}
	public function set($id,$id_card_type_name,$created_at){
		$this->id=$id;
		$this->id_card_type_name=$id_card_type_name;
		$this->created_at=$created_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}id_card_types(id_card_type_name,created_at)values('$this->id_card_type_name','$this->created_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}id_card_types set id_card_type_name='$this->id_card_type_name',created_at='$this->created_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}id_card_types where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,id_card_type_name,created_at from {$tx}id_card_types");
		$data=[];
		while($idcardtype=$result->fetch_object()){
			$data[]=$idcardtype;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,id_card_type_name,created_at from {$tx}id_card_types $criteria limit $top,$perpage");
		$data=[];
		while($idcardtype=$result->fetch_object()){
			$data[]=$idcardtype;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}id_card_types $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,id_card_type_name,created_at from {$tx}id_card_types where id='$id'");
		$idcardtype=$result->fetch_object();
			return $idcardtype;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}id_card_types");
		$idcardtype =$result->fetch_object();
		return $idcardtype->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Id Card Type Name:$this->id_card_type_name<br> 
		Created At:$this->created_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbIdCardType"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}id_card_types");
		while($idcardtype=$result->fetch_object()){
			$html.="<option value ='$idcardtype->id'>$idcardtype->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}id_card_types $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,id_card_type_name,created_at from {$tx}id_card_types $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"idcardtype/create","text"=>"New IdCardType"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Id Card Type Name</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Id Card Type Name</th><th>Created At</th></tr>";
		}
		while($idcardtype=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"idcardtype/show/$idcardtype->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"idcardtype/edit/$idcardtype->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"idcardtype/confirm/$idcardtype->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$idcardtype->id</td><td>$idcardtype->id_card_type_name</td><td>$idcardtype->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,id_card_type_name,created_at from {$tx}id_card_types where id={$id}");
		$idcardtype=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">IdCardType Show</th></tr>";
		$html.="<tr><th>Id</th><td>$idcardtype->id</td></tr>";
		$html.="<tr><th>Id Card Type Name</th><td>$idcardtype->id_card_type_name</td></tr>";
		$html.="<tr><th>Created At</th><td>$idcardtype->created_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
