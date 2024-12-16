<?php
// echo Page::title(["title"=>"Create Booking"]);
// echo Page::body_open();
// echo Html::link(["class"=>"btn btn-success", "route"=>"booking", "text"=>"Manage Booking"]);
// echo Page::context_open();
// echo Form::open(["route"=>"booking/save"]);
// 	echo Form::input(["label"=>"Order Total","type"=>"text","name"=>"order_total"]);
// 	echo Form::input(["label"=>"Paid Total","type"=>"text","name"=>"paid_total"]);
// 	echo Form::input(["label"=>"Remark","type"=>"textarea","name"=>"remark"]);
// 	echo Form::input(["label"=>"Customer Detail","name"=>"customer_detail_id","table"=>"customer_details"]);

// echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
// echo Form::close();
// echo Page::context_close();
// echo Page::body_close();
?>

<div class="container my-5">
	<div class="row">
		<div class="col-md-12 text-center">
			<h1>Invoice</h1>
			<p class="text-muted">Thank you for booking with us!</p>
		</div>
	</div>

	<!-- Booking Information -->
	<div class="row mt-4">
		<div class="col-md-6">
			<h5>Booking Details</h5>
			<p><strong>Booking ID:</strong> INV-<?php echo date("Ymd", strtotime(date('Y-m-d'))) ?>-<?php echo Booking::get_last_id() + 1 ?></p>
			<p><strong>Booking Date:</strong> <?php echo date("F d, Y", strtotime(date('Y-m-d'))) ?></p>
			<p><strong>Customer Name:</strong> <?php echo CustomerDetail::html_select("customer_detail_id") ?> </p>
			<p><strong>Customer Address : <span id="customer_address"></span></strong></strong></p>
			<p><strong>Mobile : <span id="customer_mobile"></span></strong></p>

			<!-- <p><strong>Room ID:</strong> <?php //echo Room::html_select("cmbRoom") 
												?></p>
				 -->
			<p><strong>Remark:</strong> Please prepare an extra bed.</p>
		</div>

		<div class="col-md-6 text-end">
			<h5>Payment Details</h5>
			<p><strong>Order Total:</strong> $500.00</p>
			<p><strong>Paid Total:</strong> $500.00</p>
			<p><strong>Status:</strong> Paid</p>
		</div>
	</div>

	<!-- Booking Details Table -->
	<div class="row mt-4">
		<div class="col-md-12">
			<h5>Booking Items</h5>
			<table class="table table-bordered">
				<thead class="table-light">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Room ID</th>
						<th scope="col">From Date</th>
						<th scope="col">To Date</th>
						<th scope="col">Price</th>
					</tr>
				</thead>
				<tbody>
					<!-- Example row -->
					<tr>
						<th scope="row">1</th>
						<td>101</td>
						<td>2024-12-20</td>
						<td>2024-12-25</td>
						<td>$250.00</td>
					</tr>
					<tr>
						<th scope="row">2</th>
						<td>102</td>
						<td>2024-12-20</td>
						<td>2024-12-23</td>
						<td>$250.00</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Footer -->
	<div class="row mt-5">
		<div class="col-md-12 text-center">
			<p class="text-muted">&copy; 2024 Your Hotel Name. All rights reserved.</p>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		// Get selected customer details
		$("#customer_detail_id").change(function() {
			var customerDetailId = $(this).val();
			$.ajax({
				url: "<?php echo $base_url ?>/api/customerdetail/find",
				type: "GET",
				data: {
					id: customerDetailId
				},
				success: function(res) {
					var data = JSON.parse(res);
					var customer = data.customerdetail;
					console.log(res);
					$("#customer_address").text(customer.address);
					$("#customer_mobile").text(customer.phone);
				},
				error: function(res) {
					console.log(res);
				}
			});
		});
	});
</script>