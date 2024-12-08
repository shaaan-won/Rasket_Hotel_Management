<?php
class CustomerFeedback extends Model implements JsonSerializable{
	public $id;
	public $user_id;
	public $comments;
	public $rating;
	public $created_at;

	public function __construct(){
	}
	public function set($id,$user_id,$comments,$rating,$created_at){
		$this->id=$id;
		$this->user_id=$user_id;
		$this->comments=$comments;
		$this->rating=$rating;
		$this->created_at=$created_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}customer_feedback(user_id,comments,rating,created_at)values('$this->user_id','$this->comments','$this->rating','$this->created_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}customer_feedback set user_id='$this->user_id',comments='$this->comments',rating='$this->rating',created_at='$this->created_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}customer_feedback where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,user_id,comments,rating,created_at from {$tx}customer_feedback");
		$data=[];
		while($customerfeedback=$result->fetch_object()){
			$data[]=$customerfeedback;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,user_id,comments,rating,created_at from {$tx}customer_feedback $criteria limit $top,$perpage");
		$data=[];
		while($customerfeedback=$result->fetch_object()){
			$data[]=$customerfeedback;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}customer_feedback $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,user_id,comments,rating,created_at from {$tx}customer_feedback where id='$id'");
		$customerfeedback=$result->fetch_object();
			return $customerfeedback;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}customer_feedback");
		$customerfeedback =$result->fetch_object();
		return $customerfeedback->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		User Id:$this->user_id<br> 
		Comments:$this->comments<br> 
		Rating:$this->rating<br> 
		Created At:$this->created_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbCustomerFeedback"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}customer_feedback");
		while($customerfeedback=$result->fetch_object()){
			$html.="<option value ='$customerfeedback->id'>$customerfeedback->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}customer_feedback $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,user_id,comments,rating,created_at from {$tx}customer_feedback $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"customerfeedback/create","text"=>"New CustomerFeedback"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>User Id</th><th>Comments</th><th>Rating</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>User Id</th><th>Comments</th><th>Rating</th><th>Created At</th></tr>";
		}
		while($customerfeedback=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"customerfeedback/show/$customerfeedback->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"customerfeedback/edit/$customerfeedback->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"customerfeedback/confirm/$customerfeedback->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$customerfeedback->id</td><td>$customerfeedback->user_id</td><td>$customerfeedback->comments</td><td>$customerfeedback->rating</td><td>$customerfeedback->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,user_id,comments,rating,created_at from {$tx}customer_feedback where id={$id}");
		$customerfeedback=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">CustomerFeedback Show</th></tr>";
		$html.="<tr><th>Id</th><td>$customerfeedback->id</td></tr>";
		$html.="<tr><th>User Id</th><td>$customerfeedback->user_id</td></tr>";
		$html.="<tr><th>Comments</th><td>$customerfeedback->comments</td></tr>";
		$html.="<tr><th>Rating</th><td>$customerfeedback->rating</td></tr>";
		$html.="<tr><th>Created At</th><td>$customerfeedback->created_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
