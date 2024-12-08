<?php
class Billing extends Model implements JsonSerializable{
	public $id;
	public $reservation_id;
	public $user_id;
	public $itemized_charges;
	public $total_amount;
	public $payment_method;
	public $payment_date;
	public $created_at;

	public function __construct(){
	}
	public function set($id,$reservation_id,$user_id,$itemized_charges,$total_amount,$payment_method,$payment_date,$created_at){
		$this->id=$id;
		$this->reservation_id=$reservation_id;
		$this->user_id=$user_id;
		$this->itemized_charges=$itemized_charges;
		$this->total_amount=$total_amount;
		$this->payment_method=$payment_method;
		$this->payment_date=$payment_date;
		$this->created_at=$created_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}billings(reservation_id,user_id,itemized_charges,total_amount,payment_method,payment_date,created_at)values('$this->reservation_id','$this->user_id','$this->itemized_charges','$this->total_amount','$this->payment_method','$this->payment_date','$this->created_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}billings set reservation_id='$this->reservation_id',user_id='$this->user_id',itemized_charges='$this->itemized_charges',total_amount='$this->total_amount',payment_method='$this->payment_method',payment_date='$this->payment_date',created_at='$this->created_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}billings where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,reservation_id,user_id,itemized_charges,total_amount,payment_method,payment_date,created_at from {$tx}billings");
		$data=[];
		while($billing=$result->fetch_object()){
			$data[]=$billing;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,reservation_id,user_id,itemized_charges,total_amount,payment_method,payment_date,created_at from {$tx}billings $criteria limit $top,$perpage");
		$data=[];
		while($billing=$result->fetch_object()){
			$data[]=$billing;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}billings $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,reservation_id,user_id,itemized_charges,total_amount,payment_method,payment_date,created_at from {$tx}billings where id='$id'");
		$billing=$result->fetch_object();
			return $billing;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}billings");
		$billing =$result->fetch_object();
		return $billing->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Reservation Id:$this->reservation_id<br> 
		User Id:$this->user_id<br> 
		Itemized Charges:$this->itemized_charges<br> 
		Total Amount:$this->total_amount<br> 
		Payment Method:$this->payment_method<br> 
		Payment Date:$this->payment_date<br> 
		Created At:$this->created_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbBilling"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}billings");
		while($billing=$result->fetch_object()){
			$html.="<option value ='$billing->id'>$billing->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}billings $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,reservation_id,user_id,itemized_charges,total_amount,payment_method,payment_date,created_at from {$tx}billings $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"billing/create","text"=>"New Billing"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Reservation Id</th><th>User Id</th><th>Itemized Charges</th><th>Total Amount</th><th>Payment Method</th><th>Payment Date</th><th>Created At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Reservation Id</th><th>User Id</th><th>Itemized Charges</th><th>Total Amount</th><th>Payment Method</th><th>Payment Date</th><th>Created At</th></tr>";
		}
		while($billing=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"billing/show/$billing->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"billing/edit/$billing->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"billing/confirm/$billing->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$billing->id</td><td>$billing->reservation_id</td><td>$billing->user_id</td><td>$billing->itemized_charges</td><td>$billing->total_amount</td><td>$billing->payment_method</td><td>$billing->payment_date</td><td>$billing->created_at</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,reservation_id,user_id,itemized_charges,total_amount,payment_method,payment_date,created_at from {$tx}billings where id={$id}");
		$billing=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Billing Show</th></tr>";
		$html.="<tr><th>Id</th><td>$billing->id</td></tr>";
		$html.="<tr><th>Reservation Id</th><td>$billing->reservation_id</td></tr>";
		$html.="<tr><th>User Id</th><td>$billing->user_id</td></tr>";
		$html.="<tr><th>Itemized Charges</th><td>$billing->itemized_charges</td></tr>";
		$html.="<tr><th>Total Amount</th><td>$billing->total_amount</td></tr>";
		$html.="<tr><th>Payment Method</th><td>$billing->payment_method</td></tr>";
		$html.="<tr><th>Payment Date</th><td>$billing->payment_date</td></tr>";
		$html.="<tr><th>Created At</th><td>$billing->created_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
