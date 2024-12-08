<?php
class Division extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $Population;
	public $AreaKm2;
	public $CapitalCity;

	public function __construct(){
	}
	public function set($id,$name,$Population,$AreaKm2,$CapitalCity){
		$this->id=$id;
		$this->name=$name;
		$this->Population=$Population;
		$this->AreaKm2=$AreaKm2;
		$this->CapitalCity=$CapitalCity;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}divisions(name,Population,AreaKm2,CapitalCity)values('$this->name','$this->Population','$this->AreaKm2','$this->CapitalCity')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}divisions set name='$this->name',Population='$this->Population',AreaKm2='$this->AreaKm2',CapitalCity='$this->CapitalCity' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}divisions where id={$id}");
	}
	public function jsonSerialize(){
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,Population,AreaKm2,CapitalCity from {$tx}divisions");
		$data=[];
		while($division=$result->fetch_object()){
			$data[]=$division;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,Population,AreaKm2,CapitalCity from {$tx}divisions $criteria limit $top,$perpage");
		$data=[];
		while($division=$result->fetch_object()){
			$data[]=$division;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}divisions $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,Population,AreaKm2,CapitalCity from {$tx}divisions where id='$id'");
		$division=$result->fetch_object();
			return $division;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}divisions");
		$division =$result->fetch_object();
		return $division->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Population:$this->Population<br> 
		Areakm2:$this->AreaKm2<br> 
		Capitalcity:$this->CapitalCity<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbDivision"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}divisions");
		while($division=$result->fetch_object()){
			$html.="<option value ='$division->id'>$division->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}divisions $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,Population,AreaKm2,CapitalCity from {$tx}divisions $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"division/create","text"=>"New Division"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Population</th><th>Areakm2</th><th>Capitalcity</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Population</th><th>Areakm2</th><th>Capitalcity</th></tr>";
		}
		while($division=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"division/show/$division->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"division/edit/$division->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"division/confirm/$division->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$division->id</td><td>$division->name</td><td>$division->Population</td><td>$division->AreaKm2</td><td>$division->CapitalCity</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,name,Population,AreaKm2,CapitalCity from {$tx}divisions where id={$id}");
		$division=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Division Show</th></tr>";
		$html.="<tr><th>Id</th><td>$division->id</td></tr>";
		$html.="<tr><th>Name</th><td>$division->name</td></tr>";
		$html.="<tr><th>Population</th><td>$division->Population</td></tr>";
		$html.="<tr><th>Areakm2</th><td>$division->AreaKm2</td></tr>";
		$html.="<tr><th>Capitalcity</th><td>$division->CapitalCity</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
