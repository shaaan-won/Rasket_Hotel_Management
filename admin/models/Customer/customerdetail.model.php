<?php
class CustomerDetail extends Model implements JsonSerializable{
	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $phone;
	public $id_card_type_name;
	public $id_card_number;
	public $address;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$first_name,$last_name,$email,$phone,$id_card_type_name,$id_card_number,$address,$created_at,$updated_at){
		$this->id=$id;
		$this->first_name=$first_name;
		$this->last_name=$last_name;
		$this->email=$email;
		$this->phone=$phone;
		$this->id_card_type_name=$id_card_type_name;
		$this->id_card_number=$id_card_number;
		$this->address=$address;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}customer_details(first_name,last_name,email,phone,id_card_type_name,id_card_number,address,created_at,updated_at)values('$this->first_name','$this->last_name','$this->email','$this->phone','$this->id_card_type_name','$this->id_card_number','$this->address','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}customer_details set first_name='$this->first_name',last_name='$this->last_name',email='$this->email',phone='$this->phone',id_card_type_name='$this->id_card_type_name',id_card_number='$this->id_card_number',address='$this->address',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}customer_details where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,first_name,last_name,email,phone,id_card_type_name,id_card_number,address,created_at,updated_at from {$tx}customer_details");
		$data=[];
		while($customerdetail=$result->fetch_object()){
			$data[]=$customerdetail;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,first_name,last_name,email,phone,id_card_type_name,id_card_number,address,created_at,updated_at from {$tx}customer_details $criteria limit $top,$perpage");
		$data=[];
		while($customerdetail=$result->fetch_object()){
			$data[]=$customerdetail;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}customer_details $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,first_name,last_name,email,phone,id_card_type_name,id_card_number,address,created_at,updated_at from {$tx}customer_details where id='$id'");
		$customerdetail=$result->fetch_object();
			return $customerdetail;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}customer_details");
		$customerdetail =$result->fetch_object();
		return $customerdetail->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		First Name:$this->first_name<br> 
		Last Name:$this->last_name<br> 
		Email:$this->email<br> 
		Phone:$this->phone<br> 
		Id Card Type Name:$this->id_card_type_name<br> 
		Id Card Number:$this->id_card_number<br> 
		Address:$this->address<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbCustomerDetail"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}customer_details");
		while($customerdetail=$result->fetch_object()){
			$html.="<option value ='$customerdetail->id'>$customerdetail->name</option>";
		}
		$html.="</select>";
		return $html;
		// return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}customer_details $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,first_name,last_name,email,phone,id_card_type_name,id_card_number,address,created_at,updated_at from {$tx}customer_details $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"customerdetail/create","text"=>"New CustomerDetail"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Id Card Type Name</th><th>Id Card Number</th><th>Address</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Id Card Type Name</th><th>Id Card Number</th><th>Address</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($customerdetail=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"customerdetail/show/$customerdetail->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"customerdetail/edit/$customerdetail->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"customerdetail/confirm/$customerdetail->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$customerdetail->id</td><td>$customerdetail->first_name</td><td>$customerdetail->last_name</td><td>$customerdetail->email</td><td>$customerdetail->phone</td><td>$customerdetail->id_card_type_name</td><td>$customerdetail->id_card_number</td><td>$customerdetail->address</td><td>$customerdetail->created_at</td><td>$customerdetail->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,first_name,last_name,email,phone,id_card_type_name,id_card_number,address,created_at,updated_at from {$tx}customer_details where id={$id}");
		$customerdetail=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">CustomerDetail Show</th></tr>";
		$html.="<tr><th>Id</th><td>$customerdetail->id</td></tr>";
		$html.="<tr><th>First Name</th><td>$customerdetail->first_name</td></tr>";
		$html.="<tr><th>Last Name</th><td>$customerdetail->last_name</td></tr>";
		$html.="<tr><th>Email</th><td>$customerdetail->email</td></tr>";
		$html.="<tr><th>Phone</th><td>$customerdetail->phone</td></tr>";
		$html.="<tr><th>Id Card Type Name</th><td>$customerdetail->id_card_type_name</td></tr>";
		$html.="<tr><th>Id Card Number</th><td>$customerdetail->id_card_number</td></tr>";
		$html.="<tr><th>Address</th><td>$customerdetail->address</td></tr>";
		$html.="<tr><th>Created At</th><td>$customerdetail->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$customerdetail->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
