<?php
class Reservation extends Model implements JsonSerializable{
	public $id;
	public $user_id;
	public $customer_id;
	public $booking_date;
	public $room_id;
	public $check_in_date;
	public $check_out_date;
	public $special_requests;
	public $total_amount;
	public $remaining_amount;
	public $payment_status;
	public $created_at;
	public $updated_at;

	public function __construct(){
	}
	public function set($id,$user_id,$customer_id,$booking_date,$room_id,$check_in_date,$check_out_date,$special_requests,$total_amount,$remaining_amount,$payment_status,$created_at,$updated_at){
		$this->id=$id;
		$this->user_id=$user_id;
		$this->customer_id=$customer_id;
		$this->booking_date=$booking_date;
		$this->room_id=$room_id;
		$this->check_in_date=$check_in_date;
		$this->check_out_date=$check_out_date;
		$this->special_requests=$special_requests;
		$this->total_amount=$total_amount;
		$this->remaining_amount=$remaining_amount;
		$this->payment_status=$payment_status;
		$this->created_at=$created_at;
		$this->updated_at=$updated_at;

	}
	public function save(){
		global $db,$tx;
		$db->query("insert into {$tx}reservations(user_id,customer_id,booking_date,room_id,check_in_date,check_out_date,special_requests,total_amount,remaining_amount,payment_status,created_at,updated_at)values('$this->user_id','$this->customer_id','$this->booking_date','$this->room_id','$this->check_in_date','$this->check_out_date','$this->special_requests','$this->total_amount','$this->remaining_amount','$this->payment_status','$this->created_at','$this->updated_at')");
		return $db->insert_id;
	}
	public function update(){
		global $db,$tx;
		$db->query("update {$tx}reservations set user_id='$this->user_id',customer_id='$this->customer_id',booking_date='$this->booking_date',room_id='$this->room_id',check_in_date='$this->check_in_date',check_out_date='$this->check_out_date',special_requests='$this->special_requests',total_amount='$this->total_amount',remaining_amount='$this->remaining_amount',payment_status='$this->payment_status',created_at='$this->created_at',updated_at='$this->updated_at' where id='$this->id'");
	}
	public static function delete($id){
		global $db,$tx;
		$db->query("delete from {$tx}reservations where id={$id}");
	}
	public function jsonSerialize():mixed{
		return get_object_vars($this);
	}
	public static function all(){
		global $db,$tx;
		$result=$db->query("select id,user_id,customer_id,booking_date,room_id,check_in_date,check_out_date,special_requests,total_amount,remaining_amount,payment_status,created_at,updated_at from {$tx}reservations");
		$data=[];
		while($reservation=$result->fetch_object()){
			$data[]=$reservation;
		}
			return $data;
	}
	public static function pagination($page=1,$perpage=10,$criteria=""){
		global $db,$tx;
		$top=($page-1)*$perpage;
		$result=$db->query("select id,user_id,customer_id,booking_date,room_id,check_in_date,check_out_date,special_requests,total_amount,remaining_amount,payment_status,created_at,updated_at from {$tx}reservations $criteria limit $top,$perpage");
		$data=[];
		while($reservation=$result->fetch_object()){
			$data[]=$reservation;
		}
			return $data;
	}
	public static function count($criteria=""){
		global $db,$tx;
		$result =$db->query("select count(*) from {$tx}reservations $criteria");
		list($count)=$result->fetch_row();
			return $count;
	}
	public static function find($id){
		global $db,$tx;
		$result =$db->query("select id,user_id,customer_id,booking_date,room_id,check_in_date,check_out_date,special_requests,total_amount,remaining_amount,payment_status,created_at,updated_at from {$tx}reservations where id='$id'");
		$reservation=$result->fetch_object();
			return $reservation;
	}
	static function get_last_id(){
		global $db,$tx;
		$result =$db->query("select max(id) last_id from {$tx}reservations");
		$reservation =$result->fetch_object();
		return $reservation->last_id;
	}
	public function json(){
		return json_encode($this);
	}
	public function __toString(){
		return "		Id:$this->id<br> 
		User Id:$this->user_id<br> 
		Customer Id:$this->customer_id<br> 
		Booking Date:$this->booking_date<br> 
		Room Id:$this->room_id<br> 
		Check In Date:$this->check_in_date<br> 
		Check Out Date:$this->check_out_date<br> 
		Special Requests:$this->special_requests<br> 
		Total Amount:$this->total_amount<br> 
		Remaining Amount:$this->remaining_amount<br> 
		Payment Status:$this->payment_status<br> 
		Created At:$this->created_at<br> 
		Updated At:$this->updated_at<br> 
";
	}

	//-------------HTML----------//

	static function html_select($name="cmbReservation"){
		global $db,$tx;
		$html="<select id='$name' name='$name'> ";
		$result =$db->query("select id,name from {$tx}reservations");
		while($reservation=$result->fetch_object()){
			$html.="<option value ='$reservation->id'>$reservation->name</option>";
		}
		$html.="</select>";
		return $html;
	}
	static function html_table($page = 1,$perpage = 10,$criteria="",$action=true){
		global $db,$tx,$base_url;
		$count_result =$db->query("select count(*) total from {$tx}reservations $criteria ");
		list($total_rows)=$count_result->fetch_row();
		$total_pages = ceil($total_rows /$perpage);
		$top = ($page - 1)*$perpage;
		$result=$db->query("select id,user_id,customer_id,booking_date,room_id,check_in_date,check_out_date,special_requests,total_amount,remaining_amount,payment_status,created_at,updated_at from {$tx}reservations $criteria limit $top,$perpage");
		$html="<div class='table-responsive'><table class='table table-hover table-nowrap table-centered m-0 '>";
			$html.="<tr><th colspan='3'>".Html::link(["class"=>"btn btn-success","route"=>"reservation/create","text"=>"New Reservation"])."</th></tr>";
		if($action){
			$html.="<tr><th>Id</th><th>User Id</th><th>Customer Id</th><th>Booking Date</th><th>Room Id</th><th>Check In Date</th><th>Check Out Date</th><th>Special Requests</th><th>Total Amount</th><th>Remaining Amount</th><th>Payment Status</th><th>Created At</th><th>Updated At</th><th>Action</th></tr>";
		}else{
			$html.="<tr><th>Id</th><th>User Id</th><th>Customer Id</th><th>Booking Date</th><th>Room Id</th><th>Check In Date</th><th>Check Out Date</th><th>Special Requests</th><th>Total Amount</th><th>Remaining Amount</th><th>Payment Status</th><th>Created At</th><th>Updated At</th></tr>";
		}
		while($reservation=$result->fetch_object()){
			$action_buttons = "";
			if($action){
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons.= Event::button(["name"=>"show", "value"=>"Show", "class"=>"btn btn-info", "route"=>"reservation/show/$reservation->id"]);
				$action_buttons.= Event::button(["name"=>"edit", "value"=>"Edit", "class"=>"btn btn-primary", "route"=>"reservation/edit/$reservation->id"]);
				$action_buttons.= Event::button(["name"=>"delete", "value"=>"Delete", "class"=>"btn btn-danger", "route"=>"reservation/confirm/$reservation->id"]);
				$action_buttons.= "</div></td>";
			}
			$html.="<tr><td>$reservation->id</td><td>$reservation->user_id</td><td>$reservation->customer_id</td><td>$reservation->booking_date</td><td>$reservation->room_id</td><td>$reservation->check_in_date</td><td>$reservation->check_out_date</td><td>$reservation->special_requests</td><td>$reservation->total_amount</td><td>$reservation->remaining_amount</td><td>$reservation->payment_status</td><td>$reservation->created_at</td><td>$reservation->updated_at</td> $action_buttons</tr>";
		}
		$html.="</table></div>";
		$html.= pagination($page,$total_pages);
		return $html;
	}
	static function html_row_details($id){
		global $db,$tx,$base_url;
		$result =$db->query("select id,user_id,customer_id,booking_date,room_id,check_in_date,check_out_date,special_requests,total_amount,remaining_amount,payment_status,created_at,updated_at from {$tx}reservations where id={$id}");
		$reservation=$result->fetch_object();
		$html="<table class='table'>";
		$html.="<tr><th colspan=\"2\">Reservation Show</th></tr>";
		$html.="<tr><th>Id</th><td>$reservation->id</td></tr>";
		$html.="<tr><th>User Id</th><td>$reservation->user_id</td></tr>";
		$html.="<tr><th>Customer Id</th><td>$reservation->customer_id</td></tr>";
		$html.="<tr><th>Booking Date</th><td>$reservation->booking_date</td></tr>";
		$html.="<tr><th>Room Id</th><td>$reservation->room_id</td></tr>";
		$html.="<tr><th>Check In Date</th><td>$reservation->check_in_date</td></tr>";
		$html.="<tr><th>Check Out Date</th><td>$reservation->check_out_date</td></tr>";
		$html.="<tr><th>Special Requests</th><td>$reservation->special_requests</td></tr>";
		$html.="<tr><th>Total Amount</th><td>$reservation->total_amount</td></tr>";
		$html.="<tr><th>Remaining Amount</th><td>$reservation->remaining_amount</td></tr>";
		$html.="<tr><th>Payment Status</th><td>$reservation->payment_status</td></tr>";
		$html.="<tr><th>Created At</th><td>$reservation->created_at</td></tr>";
		$html.="<tr><th>Updated At</th><td>$reservation->updated_at</td></tr>";

		$html.="</table>";
		return $html;
	}
}
?>
