<?php
class InvoicesView extends Model implements JsonSerializable{
	public $id;
	public $name;
	public $customer_detail_id;
	public $customer_detail_name;
	public $reservation_id;
	public $total_amount;
	public $tax_amount;
	public $payment_status;
	public $created_at;
	public $updated_at;
	public $reservation_name;
	public $room_name;
	public $room_number;
	public $room_type_name;
	public $check_in;
	public $check_out;
	public $reservation_total_amount;

	public function __construct(){
	}
	public function set($id,$name,$customer_detail_id,$customer_detail_name,$reservation_id,$total_amount,$tax_amount,$payment_status,$created_at,$updated_at,$reservation_name,$room_name,$room_number,$room_type_name,$check_in,$check_out,$reservation_total_amount){
		$this->id=$id;
		$this->name=$name;
		$this->customer_detail_id=$customer_detail_id;
		$this->customer_detail_name=$customer_detail_name;
		$this->reservation_id=$reservation_id;
		$this->total_amount=$total_amount;
		$this->tax_amount=$tax_amount;
		$this->payment_status=$payment_status;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;
		$this->reservation_name=$reservation_name;
		$this->room_name=$room_name;
		$this->room_number=$room_number;
		$this->room_type_name=$room_type_name;
		$this->check_in=$check_in;
		$this->check_out=$check_out;
		$this->reservation_total_amount=$reservation_total_amount;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}invoices_view(name,customer_detail_id,customer_detail_name,reservation_id,total_amount,tax_amount,payment_status,created_at,updated_at,reservation_name,room_name,room_number,room_type_name,check_in,check_out,reservation_total_amount)values('$this->name','$this->customer_detail_id','$this->customer_detail_name','$this->reservation_id','$this->total_amount','$this->tax_amount','$this->payment_status','$this->created_at','$this->updated_at','$this->reservation_name','$this->room_name','$this->room_number','$this->room_type_name','$this->check_in','$this->check_out','$this->reservation_total_amount')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}invoices_view set name='$this->name',customer_detail_id='$this->customer_detail_id',customer_detail_name='$this->customer_detail_name',reservation_id='$this->reservation_id',total_amount='$this->total_amount',tax_amount='$this->tax_amount',payment_status='$this->payment_status',created_at='$this->created_at',updated_at='$this->updated_at',reservation_name='$this->reservation_name',room_name='$this->room_name',room_number='$this->room_number',room_type_name='$this->room_type_name',check_in='$this->check_in',check_out='$this->check_out',reservation_total_amount='$this->reservation_total_amount' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}invoices_view where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,name,customer_detail_id,customer_detail_name,reservation_id,total_amount,tax_amount,payment_status,created_at,updated_at,reservation_name,room_name,room_number,room_type_name,check_in,check_out,reservation_total_amount from {$tx}invoices_view");
		$data=[];
		while($invoicesview=$result->fetch_object()){
			$data[]=$invoicesview;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,name,customer_detail_id,customer_detail_name,reservation_id,total_amount,tax_amount,payment_status,created_at,updated_at,reservation_name,room_name,room_number,room_type_name,check_in,check_out,reservation_total_amount from {$tx}invoices_view $criteria limit $top,$perpage");
		$data=[];
		while($invoicesview=$result->fetch_object()){
			$data[]=$invoicesview;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}invoices_view $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,name,customer_detail_id,customer_detail_name,reservation_id,total_amount,tax_amount,payment_status,created_at,updated_at,reservation_name,room_name,room_number,room_type_name,check_in,check_out,reservation_total_amount from {$tx}invoices_view where id='$id'");
		$invoicesview=$result->fetch_object();
			return $invoicesview;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}invoices_view");
		$invoicesview =$result->fetch_object();
		return $invoicesview->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		Name:$this->name<br> 
		Customer Detail Id:$this->customer_detail_id<br> 
		Customer Detail Name:$this->customer_detail_name<br> 
		Reservation Id:$this->reservation_id<br> 
		Total Amount:$this->total_amount<br> 
		Tax Amount:$this->tax_amount<br> 
		Payment Status:$this->payment_status<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
		Reservation Name:$this->reservation_name<br> 
		Room Name:$this->room_name<br> 
		Room Number:$this->room_number<br> 
		Room Type Name:$this->room_type_name<br> 
		Check In:$this->check_in<br> 
		Check Out:$this->check_out<br> 
		Reservation Total Amount:$this->reservation_total_amount<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbInvoicesView"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}invoices_view");
		while($invoicesview=$result->fetch_object()){
			$html.="<option value ='$invoicesview->id'>$invoicesview->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}invoices_view $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,name,customer_detail_id,customer_detail_name,reservation_id,total_amount,tax_amount,payment_status,created_at,updated_at,reservation_name,room_name,room_number,room_type_name,check_in,check_out,reservation_total_amount from {$tx}invoices_view $criteria limit $top,$perpage");
		$html="<table class='table'>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"invoicesview/create","text"=>"New InvoicesView"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>Name</th><th>Customer Detail Id</th><th>Customer Detail Name</th><th>Reservation Id</th><th>Total Amount</th><th>Tax Amount</th><th>Payment Status</th><th>Created At</th><th>Updated At</th><th>Reservation Name</th><th>Room Name</th><th>Room Number</th><th>Room Type Name</th><th>Check In</th><th>Check Out</th><th>Reservation Total Amount</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>Name</th><th>Customer Detail Id</th><th>Customer Detail Name</th><th>Reservation Id</th><th>Total Amount</th><th>Tax Amount</th><th>Payment Status</th><th>Created At</th><th>Updated At</th><th>Reservation Name</th><th>Room Name</th><th>Room Number</th><th>Room Type Name</th><th>Check In</th><th>Check Out</th><th>Reservation Total Amount</th></tr>";
		}
		while($invoicesview=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"invoicesview/show/$invoicesview->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"invoicesview/edit/$invoicesview->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"invoicesview/confirm/$invoicesview->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$invoicesview->id</td><td>$invoicesview->name</td><td>$invoicesview->customer_detail_id</td><td>$invoicesview->customer_detail_name</td><td>$invoicesview->reservation_id</td><td>$invoicesview->total_amount</td><td>$invoicesview->tax_amount</td><td>$invoicesview->payment_status</td><td>$invoicesview->created_at</td><td>$invoicesview->updated_at</td><td>$invoicesview->reservation_name</td><td>$invoicesview->room_name</td><td>$invoicesview->room_number</td><td>$invoicesview->room_type_name</td><td>$invoicesview->check_in</td><td>$invoicesview->check_out</td><td>$invoicesview->reservation_total_amount</td> $action_buttons</tr>";
		}
		$html.="</table>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,name,customer_detail_id,customer_detail_name,reservation_id,total_amount,tax_amount,payment_status,created_at,updated_at,reservation_name,room_name,room_number,room_type_name,check_in,check_out,reservation_total_amount from {$tx}invoices_view where id={$id}");
		$invoicesview=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">InvoicesView Show</th></tr>";
		$html.="<tr><th>Id</th><td>$invoicesview->id</td></tr>";
		$html.="<tr><th>Name</th><td>$invoicesview->name</td></tr>";
		$html.="<tr><th>Customer Detail Id</th><td>$invoicesview->customer_detail_id</td></tr>";
		$html.="<tr><th>Customer Detail Name</th><td>$invoicesview->customer_detail_name</td></tr>";
		$html.="<tr><th>Reservation Id</th><td>$invoicesview->reservation_id</td></tr>";
		$html.="<tr><th>Total Amount</th><td>$invoicesview->total_amount</td></tr>";
		$html.="<tr><th>Tax Amount</th><td>$invoicesview->tax_amount</td></tr>";
		$html.="<tr><th>Payment Status</th><td>$invoicesview->payment_status</td></tr>";
		$html.="<tr><th>Created At</th><td>$invoicesview->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$invoicesview->updated_at</td></tr>";
		$html.="<tr><th>Reservation Name</th><td>$invoicesview->reservation_name</td></tr>";
		$html.="<tr><th>Room Name</th><td>$invoicesview->room_name</td></tr>";
		$html.="<tr><th>Room Number</th><td>$invoicesview->room_number</td></tr>";
		$html.="<tr><th>Room Type Name</th><td>$invoicesview->room_type_name</td></tr>";
		$html.="<tr><th>Check In</th><td>$invoicesview->check_in</td></tr>";
		$html.="<tr><th>Check Out</th><td>$invoicesview->check_out</td></tr>";
		$html.="<tr><th>Reservation Total Amount</th><td>$invoicesview->reservation_total_amount</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
