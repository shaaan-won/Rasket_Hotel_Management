<?php
class PerformanceReview extends Model implements JsonSerializable{
	public $id;
	public $staff_id;
	public $review_date;
	public $review_score;
	public $review_comments;
	public $created_at;

	public function __construct(){
	}
	public function set($id,$staff_id,$review_date,$review_score,$review_comments,$created_at){
		$this->id=$id;
		$this->staff_id=$staff_id;
		$this->review_date=$review_date;
		$this->review_score=$review_score;
		$this->review_comments=$review_comments;
		$this->created_at=$created_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}performance_reviews(staff_id,review_date,review_score,review_comments,created_at)values('$this->staff_id','$this->review_date','$this->review_score','$this->review_comments','$this->created_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}performance_reviews set staff_id='$this->staff_id',review_date='$this->review_date',review_score='$this->review_score',review_comments='$this->review_comments',created_at='$this->created_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}performance_reviews where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,staff_id,review_date,review_score,review_comments,created_at from {$tx}performance_reviews");
		$data=[];
		while($performancereview=$result->fetch_object()){
			$data[]=$performancereview;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,staff_id,review_date,review_score,review_comments,created_at from {$tx}performance_reviews $criteria limit $top,$perpage");
		$data=[];
		while($performancereview=$result->fetch_object()){
			$data[]=$performancereview;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}performance_reviews $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,staff_id,review_date,review_score,review_comments,created_at from {$tx}performance_reviews where id='$id'");
		$performancereview=$result->fetch_object();
			return $performancereview;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}performance_reviews");
		$performancereview =$result->fetch_object();
		return $performancereview->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Staff Id:$this->staff_id<br> 
		Review Date:$this->review_date<br> 
		Review Score:$this->review_score<br> 
		Review Comments:$this->review_comments<br> 
		Created At:$this->created_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbPerformanceReview"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}performance_reviews");
		while($performancereview=$result->fetch_object()){
			$html.="<option value ='$performancereview->id'>$performancereview->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}performance_reviews $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,staff_id,review_date,review_score,review_comments,created_at from {$tx}performance_reviews $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"performancereview/create","text"=>"New PerformanceReview"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Staff Id</th><th>Review Date</th><th>Review Score</th><th>Review Comments</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Staff Id</th><th>Review Date</th><th>Review Score</th><th>Review Comments</th><th>Created At</th></tr>";
		}
		while($performancereview=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"performancereview/show/$performancereview->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"performancereview/edit/$performancereview->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"performancereview/confirm/$performancereview->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$performancereview->id</td><td>$performancereview->staff_id</td><td>$performancereview->review_date</td><td>$performancereview->review_score</td><td>$performancereview->review_comments</td><td>$performancereview->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,staff_id,review_date,review_score,review_comments,created_at from {$tx}performance_reviews where id={$id}");
		$performancereview=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">PerformanceReview Show</th></tr>";
		$html.="<tr><th>Id</th><td>$performancereview->id</td></tr>";
		$html.="<tr><th>Staff Id</th><td>$performancereview->staff_id</td></tr>";
		$html.="<tr><th>Review Date</th><td>$performancereview->review_date</td></tr>";
		$html.="<tr><th>Review Score</th><td>$performancereview->review_score</td></tr>";
		$html.="<tr><th>Review Comments</th><td>$performancereview->review_comments</td></tr>";
		$html.="<tr><th>Created At</th><td>$performancereview->created_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
