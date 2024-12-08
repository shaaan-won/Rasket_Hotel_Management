<?php
class District extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $Population;
	public $AreaKm2;
	public $DivisionID;

	public function __construct(){
	}
	public function set($id,$name,$Population,$AreaKm2,$DivisionID){
		$this->id=$id;
		$this->name=$name;
		$this->Population=$Population;
		$this->AreaKm2=$AreaKm2;
		$this->DivisionID=$DivisionID;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}districts(name,Population,AreaKm2,DivisionID)values('$this->name','$this->Population','$this->AreaKm2','$this->DivisionID')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}districts set name='$this->name',Population='$this->Population',AreaKm2='$this->AreaKm2',DivisionID='$this->DivisionID' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}districts where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,Population,AreaKm2,DivisionID from {$tx}districts");
		$data=[];
		while($district=$result->fetch_object()){
			$data[]=$district;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,Population,AreaKm2,DivisionID from {$tx}districts $criteria limit $top,$perpage");
		$data=[];
		while($district=$result->fetch_object()){
			$data[]=$district;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}districts $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,Population,AreaKm2,DivisionID from {$tx}districts where id='$id'");
		$district=$result->fetch_object();
			return $district;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}districts");
		$district =$result->fetch_object();
		return $district->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Population:$this->Population<br> 
		Areakm2:$this->AreaKm2<br> 
		Divisionid:$this->DivisionID<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbDistrict"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}districts");
		while($district=$result->fetch_object()){
			$html.="<option value ='$district->id'>$district->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}districts $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,Population,AreaKm2,DivisionID from {$tx}districts $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"district/create","text"=>"New District"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Population</th><th>Areakm2</th><th>Divisionid</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Population</th><th>Areakm2</th><th>Divisionid</th></tr>";
		}
		while($district=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"district/show/$district->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"district/edit/$district->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"district/confirm/$district->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$district->id</td><td>$district->name</td><td>$district->Population</td><td>$district->AreaKm2</td><td>$district->DivisionID</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,name,Population,AreaKm2,DivisionID from {$tx}districts where id={$id}");
		$district=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">District Show</th></tr>";
		$html.="<tr><th>Id</th><td>$district->id</td></tr>";
		$html.="<tr><th>Name</th><td>$district->name</td></tr>";
		$html.="<tr><th>Population</th><td>$district->Population</td></tr>";
		$html.="<tr><th>Areakm2</th><td>$district->AreaKm2</td></tr>";
		$html.="<tr><th>Divisionid</th><td>$district->DivisionID</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
