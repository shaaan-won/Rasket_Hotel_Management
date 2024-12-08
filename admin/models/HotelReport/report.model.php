<?php
class Report extends Model implements JsonSerializable{
	public $id;
	public $report_type;
	public $report_data;
	public $created_at;

	public function __construct(){
	}
	public function set($id,$report_type,$report_data,$created_at){
		$this->id=$id;
		$this->report_type=$report_type;
		$this->report_data=$report_data;
		$this->created_at=$created_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}reports(report_type,report_data,created_at)values('$this->report_type','$this->report_data','$this->created_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}reports set report_type='$this->report_type',report_data='$this->report_data',created_at='$this->created_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}reports where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,report_type,report_data,created_at from {$tx}reports");
		$data=[];
		while($report=$result->fetch_object()){
			$data[]=$report;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,report_type,report_data,created_at from {$tx}reports $criteria limit $top,$perpage");
		$data=[];
		while($report=$result->fetch_object()){
			$data[]=$report;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}reports $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,report_type,report_data,created_at from {$tx}reports where id='$id'");
		$report=$result->fetch_object();
			return $report;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}reports");
		$report =$result->fetch_object();
		return $report->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Report Type:$this->report_type<br> 
		Report Data:$this->report_data<br> 
		Created At:$this->created_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbReport"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}reports");
		while($report=$result->fetch_object()){
			$html.="<option value ='$report->id'>$report->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}reports $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,report_type,report_data,created_at from {$tx}reports $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"report/create","text"=>"New Report"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Report Type</th><th>Report Data</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Report Type</th><th>Report Data</th><th>Created At</th></tr>";
		}
		while($report=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"report/show/$report->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"report/edit/$report->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"report/confirm/$report->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$report->id</td><td>$report->report_type</td><td>$report->report_data</td><td>$report->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,report_type,report_data,created_at from {$tx}reports where id={$id}");
		$report=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Report Show</th></tr>";
		$html.="<tr><th>Id</th><td>$report->id</td></tr>";
		$html.="<tr><th>Report Type</th><td>$report->report_type</td></tr>";
		$html.="<tr><th>Report Data</th><td>$report->report_data</td></tr>";
		$html.="<tr><th>Created At</th><td>$report->created_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
