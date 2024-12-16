<?php
// echo Page::title(["title"=>"Create Invoice"]);
// echo Page::body_open();
// echo Html::link(["class"=>"btn btn-success", "route"=>"invoice", "text"=>"Manage Invoice"]);
// echo Page::context_open();
// echo Form::open(["route"=>"invoice/save"]);
// 	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
// 	echo Form::input(["label"=>"Customer Detail","name"=>"customer_detail_id","table"=>"customer_details"]);
// 	echo Form::input(["label"=>"Customer Detail Name","type"=>"text","name"=>"customer_detail_name"]);
// 	echo Form::input(["label"=>"Reservation","name"=>"reservation_id","table"=>"reservations"]);
// 	echo Form::input(["label"=>"Total Amount","type"=>"text","name"=>"total_amount"]);
// 	echo Form::input(["label"=>"Tax Amount","type"=>"text","name"=>"tax_amount"]);
// 	echo Form::input(["label"=>"Payment Status","type"=>"text","name"=>"payment_status"]);

// echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
// echo Form::close();
// echo Page::context_close();
// echo Page::body_close();
// global $db;
// $result = $db->query("SELECT * FROM reservations");
// $result = $result->fetch_all(MYSQLI_ASSOC);

// function getCheckInDate($id) {
// 	global $db;
// 	$result = $db->query("SELECT check_in FROM reservations WHERE id = $id");
// 	$result = $result->fetch_all(MYSQLI_ASSOC);
// 	return $result[0]["check_in"];
// }

?>

<style>
	.invoice-container {
		max-width: 850px;
		margin: auto;
		padding: 20px;
		border: 1px solid #ddd;
		border-radius: 5px;
		background-color: #f9f9f9;
		box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

	}

	.header,
	.footer {
		text-align: center;
		margin-bottom: 20px;
	}

	.header h1 {
		margin: 0;
	}

	.details,
	.items,
	.summary {
		width: 100%;
		margin-bottom: 20px;
	}

	.details table,
	.items table,
	.summary table {
		width: 100%;
		border-collapse: collapse;
	}

	.details td,
	.items th,
	.items td,
	.summary td {
		border: 1px solid #ddd;
		padding: 8px;
		text-align: left;
	}

	.items th {
		background-color: #f2f2f2;
	}

	/* General styling for input fields */
	.input-field {
		width: 100%;
		/* Makes the input field responsive */
		padding: 10px 15px;
		/* Adds inner padding for better spacing */
		font-size: 16px;
		/* Sets the font size for readability */
		border: 1px solid #ccc;
		/* Adds a light border */
		border-radius: 5px;
		/* Rounds the corners */
		background-color: #f9f9f9;
		/* Light background color */
		color: #333;
		/* Text color */
		outline: none;
		/* Removes the default blue outline */
		transition: border-color 0.3s ease, box-shadow 0.3s ease;
		/* Smooth transitions for hover/focus effects */
	}

	/* Style when the input is focused */
	.input-field:focus {
		border-color: #007BFF;
		/* Highlight border on focus */
		box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
		/* Adds a subtle shadow effect */
	}

	/* Placeholder styling (optional) */
	.input-field::placeholder {
		color: #aaa;
		/* Light gray for placeholder text */
	}

	/* Optional: Input hover styling */
	.input-field:hover {
		border-color: #888;
		/* Slightly darkens the border on hover */
	}


	#discount {
		width: 100px;
		margin-left: 10px;
		margin-right: 10px;
		font-size: 14px;
		border: 1px solid #ccc;
		border-radius: 4px;
		text-align: center;
		box-shadow: inset 1px 1px 3px rgba(0, 0, 0, 0.1);
	}

	#adds-item {
		margin-left: 10px;
		align-items: center;
	}

	.dlt-item {
		margin-left: 10px;
		align-items: center;
	}

	.invoice-container div {

		/* Style for the select element */
		select {
			width: 100%;
			/* Makes it responsive */
			padding: 8px;
			/* Adds some padding */
			font-size: 16px;
			/* Adjusts font size */
			border: 1px solid #ccc;
			/* Adds a light border */
			border-radius: 5px;
			/* Rounds the corners */
			background-color: #f9f9f9;
			/* Light background */
			color: #333;
			/* Text color */
			appearance: none;
			/* Hides default dropdown arrow for custom styling */
			outline: none;
			/* Removes the outline when focused */
			cursor: pointer;
			/* Makes it clear it's clickable */
			transition: border-color 0.3s ease;
			/* Smooth transition for hover/focus effects */
		}

		/* Style for the select element when focused */
		select:focus {
			border-color: #007BFF;
			/* Highlight border on focus */
			box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
			/* Add a subtle shadow effect */
		}

		/* Style for the option elements */
		option {
			padding: 8px;
			/* Adds padding inside the dropdown options */
			font-size: 14px;
			/* Adjusts font size */
			color: #333;
			/* Text color */
			background-color: #fff;
			/* Background color */
		}

		/* Optional: Custom styling for hover or selection states (some browsers might not support this) */
		option:hover {
			background-color: #f1f1f1;
			/* Light background on hover */
		}

	}

	#items-body {
		align-items: center;
	}
</style>

<div class="invoice-container">
	<div class="header">
		<h1>Shaan's Hotel Invoice</h1>
		<p>Address: Shonargaon, Narayangonj,Dhaka</p>
		<p>Phone: +123 456 7890 | Email: shaans_hotel@gmail.com</p>
	</div>
	<div class="details">
		<table>
			<tr>
				<td><strong>Invoice No:</strong> <input type="text" class="input-field" value="<?php echo Invoice::get_last_id() + 1000 + 1; ?>"></td>
				<td><strong>Date:</strong> <input type="date" class="input-field" value="<?php echo date("Y-m-d"); ?>"></td>
			</tr>
			<tr>
				<!-- <td class="guest-name">
					<strong>Guest Name:</strong>
					<input type="text" class="input-field" placeholder="Enter Guest Name">
					<?php //echo CustomerDetail::html_select("cmbCustomerDetail"); 
					?>
				</td> -->
				<td class="guest-name" style="padding: 10px; font-family: Arial, sans-serif; font-size: 14px;">
					<strong style="margin-right: 10px;">Guest Name:</strong>
					<input type="text" class="input-field" placeholder="Enter Guest Name"
						style="padding: 5px; width: 200px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px;">

					<?php echo CustomerDetail::html_select("cmbCustomerDetail", [
						'style' => 'padding: 5px; width: 210px; border: 1px solid #ccc; border-radius: 4px;'
					]); ?>
				</td>

				<!-- <td class="room-name>
					<strong>Room Number:</strong> <input type="text" class="input-field" placeholder="Enter Room Number">
					<?php //echo Room::html_select("cmbRoom"); 
					?>
				</td> -->
				<td class="room-name" style="padding: 10px; font-family: Arial, sans-serif; font-size: 14px;">
					<strong style="margin-right: 10px;">Room Number:</strong>
					<input type="text" class="input-field" placeholder="Enter Room Number"
						style="padding: 5px; width: 200px; margin-right: 10px; border: 1px solid #ccc; border-radius: 4px;">
					<?php echo Room::html_select("cmbRoom", [
						'style' => 'padding: 5px; width: 210px; border: 1px solid #ccc; border-radius: 4px;'
					]); ?>
				</td>

			</tr>
			<tr class="check-in-out" style="font-family: Arial, sans-serif; font-size: 14px; background-color: #f9f9f9;">
				<td class="check-in" style="padding: 10px; vertical-align: middle;">
					<strong style="margin-right: 10px;">Check-In:</strong>
					<input type="date" id="check-in-date" class="input-field"
						value="<?php echo date('Y-m-d'); ?>"
						style="padding: 5px; width: 160px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-shadow: inset 1px 1px 3px rgba(0, 0, 0, 0.1);">
				</td>
				<td class="check-out" style="padding: 10px; vertical-align: middle;">
					<strong style="margin-right: 10px;">Check-Out:</strong>
					<input type="date" id="check-out-date" class="input-field"
						value="<?php echo date('Y-m-d'); ?>"
						style="padding: 5px; width: 160px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; box-shadow: inset 1px 1px 3px rgba(0, 0, 0, 0.1);">
				</td>
			</tr>

		</table>
	</div>
	<div class="items table-responsive">
		<table class="table table-hover table-nowrap table-centered m-0">
			<thead>
				<tr>
					<th>Rooms & Other Services</th>
					<th>#Off Nights/Qty</th>
					<th>Price Per Night/Qty</th>
					<th>Total per section($)</th>
					<th><Button class="btn btn-danger" id="clear-all">Clear All</Button></th>
				</tr>
			</thead>
			<!--<tbody id="items-body" class="items-body">
				 <tr class="item-row">
					<td><input type="text" class="input-field item-name" placeholder="Room Charges" value="Room Charges"></td>
					<td><input type="number" class="input-field quantity" placeholder="3" oninput="updateTotals()"></td>
					<td><input type="number" class="input-field unit-price" placeholder="100.00" step="0.01" oninput="updateTotals()"></td>
					<td class="total">300.00</td>
					<td style="align-items: center;"><Button class="btn btn-info ">Delete</Button></td>
				</tr> 
			</tbody>-->
			<thead>
				<tr>
					<th id="item-name">
						<input type="text" class="input-field" placeholder="Room Charges& Other Services"><br>
						<?php echo RoomType::html_select("cmbRoomType");
						?>
					</th>
					<th id="qty_night"><input type="number" class="input-field" value="1"></th>
					<th id="price_night">
						<input type="number" class="input-field " step="10" placeholder="100.00" id="unit-price"><br>
						<span id="roomprice"><?php echo RoomType::html_select1("cmbroomprice"); ?></span>
					</th>
					<th><span id="total">0.00</span></th>
					<th><button type="button" class="btn btn-primary" id="adds-item">Add +</button></th>
				</tr>
			</thead>
			<tbody id="items-body">

			</tbody>
		</table>

	</div>
	<div class="summary table-responsive">
		<table>
			<tr>
				<td><strong>Subtotal</strong></td>
				<td id="subtotal">00.00</td>
			</tr>
			<tr>
				<td>
					<strong>Discount</strong>
					<input type="text" placeholder="Enter Discount" id="discount" value="10">
				</td>
				<td><span id="discount-amount">00.00</span></td>
			</tr>
			<tr>
				<td><strong>Tax (05%)</strong></td>
				<td id="tax">00.00</td>
			</tr>
			<tr>
				<td><strong>Amount Paid</strong></td>
				<td id="amount-paid-td"><input type="number" class="input-field" id="amount-paid" placeholder="Enter Amount Paid" step="100"></td>
			</tr>
			<tr>
				<td><strong>Amount Due</strong></td>
				<td id="amount-due">00.00</td>
			</tr>
			<tr>
				<td><strong>Total</strong></td>
				<td id="grand-total">000.00</td>
			</tr>
		</table>
		<div class="center" style="margin-top: 20px; text-align: center; font-size: 14px;font-family: Arial, sans-serif; font-weight: bold;">
			<p>Thank you for staying with us!</p>
			<p>For any inquiries, please contact our customer support team.</p>
		</div>
	</div>
	<div class="row no-print">
		<div class="col-12 mt-6">
			<a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-success float-left"><i class="fas fa-print"></i> Print</a>
			<button type="button" id="btnProcessinvoice" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Process Invoice </button>
			<button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
				<i class="fas fa-download"></i> Generate PDF
			</button>
		</div>
	</div>


</div>

<script>
	$(document).ready(function() {
		//check in and check out
		// Ensure check-out date is always after check-in date
		$('#check-in-date, #check-out-date').on('change', function() {
			const checkInDate = new Date($('#check-in-date').val());
			const checkOutDate = new Date($('#check-out-date').val());

			if (checkInDate && checkOutDate && checkOutDate <= checkInDate) {
				// alert("Check-Out date must be after the Check-In date.");
				$('#check-out-date').val('');
			}
		});

		// Highlight the field when it is empty or invalid
		$('input[type="date"]').on('change', function() {
			if (!$(this).val()) {
				$(this).css('background-color', 'red');
			} else {
				$(this).css('background-color', '#f2f2f2');
			}
		});


		// guest and room 

		$('.guest-name').on('change', function() {
			$(this).find('.input-field').val($(this).find('option:selected').text());
		});
		$('.room-name').on('change', function() {
			$(this).find('.input-field').val($(this).find('option:selected').text());
		});
		$('#item-name').on('click', function() {
			$(this).find('.input-field').val($(this).find('option:selected').text());
		})

		$('#price_night').on('click', function() {
			$(this).find('.input-field').val($(this).find('option:selected').text());
			let qty = $('#qty_night').find('.input-field').val();
			let price = $('#price_night').find('.input-field').val();
			let total = qty * price;
			$('#total').text(total);
		})


		// $('#unit-price').on('change', function() {
		// 	$('#roomprice').on('click', function() {
		// 		$('#price_night').val($(this).find('option:selected').text());
		// 	})
		// 	let qty = $('#qty_night').find('.input-field').val();
		// 	let price = $('#unit-price').val();
		// 	let total = qty * price;
		// 	$('#total').text(total);
		// })

		
		$('#clear-all').on('click', function() {
			$('.item-row').empty();
		})

		// add item delete all delete
		$('#adds-item').on('click', function() {

			let item = $('#item-name').find('.input-field').val();
			let qty = $('#qty_night').find('.input-field').val();
			let price = $('#price_night').find('.input-field').val();
			let total = $('#total').text();
			$('#items-body').append(`
							<tr class="item-row">
						<td>${item}</td>
						<td>${qty}</td>
						<td>${price}</td>
						<td class="total-by-section">${total}</td>
						<td style="align-items: center;"><Button class="btn btn-info dlt-item">Delete</Button></td>	
								</tr>
							`);
			// Delete item row
			$('.item-row').on('click', '.dlt-item', function() {
				$(this).closest('tr').remove();
			});
			// subtotal 
			let subtotal = 0;
			$('.item-row').each(function() {
				let total = parseFloat($(this).find('.total-by-section').text());
				subtotal += total;
			});
			$('#subtotal').text(subtotal);
			//discount amount
			let discount = $('#discount').val();
			let discountAmount = (discount / 100) * subtotal;
			$('#discount-amount').text(discountAmount);

			// tax
			let tax = subtotal * 0.05;
			$('#tax').text(tax);

			// grand total
			var grandTotal = subtotal - discountAmount + tax;
			$('#grand-total').text(grandTotal);

			//amount paid
			$('#amount-paid').on('change', function() {
				let amountPaid = $(this).val();
				let balanceDue = grandTotal - amountPaid;
				$('#amount-due').text(balanceDue);
			})
		});
		// $("select").select2();

	});
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?= $base_url ?>/js/cart.js"></script>