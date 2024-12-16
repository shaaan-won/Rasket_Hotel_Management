<style>
	.invoice-box {
		max-width: 1200px;
		margin: auto;
		padding: 30px;
		border: 1px solid #eee;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
		font-size: 16px;
		line-height: 24px;
		font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
		color: #555;
		background-color: #fff;
	}

	.invoice-box table {
		width: 100%;
		line-height: inherit;
		text-align: left;
		border-collapse: collapse;
	}

	.invoice-box table td {
		padding: 5px;
		vertical-align: top;
	}

	.invoice-box table tr td:nth-child(2) {
		text-align: right;
	}

	.invoice-box table tr.top table td {
		padding-bottom: 20px;
	}

	.invoice-box table tr.top table td.title {
		font-size: 45px;
		line-height: 45px;
		color: #333;
	}

	.invoice-box table tr.information table td {
		padding-bottom: 40px;
	}

	.invoice-box table tr.heading td {
		background: #eee;
		border-bottom: 1px solid #ddd;
		font-weight: bold;
	}

	.invoice-box table tr.details td {
		padding-bottom: 20px;
	}

	.invoice-box table tr.item td {
		border-bottom: 1px solid #eee;
	}

	.invoice-box table tr.item td.number,
	.invoice-box table tr.heading td.number {
		text-align: right;
	}

	.invoice-box table tr.item.last td {
		border-bottom: none;
	}

	.invoice-box table tr.total td:nth-child(2) {
		border-top: 2px solid #eee;
		font-weight: bold;
	}

	@media only screen and (max-width: 600px) {
		.invoice-box table tr.top table td {
			width: 100%;
			display: block;
			text-align: center;
		}

		.invoice-box table tr.information table td {
			width: 100%;
			display: block;
			text-align: center;
		}
	}
</style>


<div class="invoice-box">
	<table>
		<tr class="top">
			<td colspan="2">
				<table>
					<tr>
						<td class="title">
							<img src="<?php echo $base_url ?>/img/logo.png" alt="Company logo" style="width: 100%; max-width: 100px" />
						</td>

						<td>
							Invoice #: <br />
							Created: <input type="date" style="width:140px;text-align:right" id="created_at" /><br />

						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr class="information">
			<td colspan="2">
				<table>
					<tr>
						<td>
							Sparksuite, Inc.<br />
							12345 Sunny Road<br />
							Sunnyville, TX 12345
						</td>

						<td>
							<?php echo Form::input(["label" => "", "name" => "customer_id", "table" => "customers"]); ?><br />
							<div id="customer-info">
								John Doe<br />
								john@example.com
							</div>

						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr class="heading">
			<td>Payment Method</td>

			<td>Check #</td>
		</tr>

		<tr class="details">
			<td>Check</td>
			<td>1000</td>
		</tr>
	</table>
	<div>
		<table>


			<tr class="heading">
				<td>Item</td>
				<td>From</td>
				<td>To</td>
				<td>Days</td>
				<td class="number">Price</td>
				<td class="number">Total</td>
				<td>&nbsp;</td>
			</tr>
			<tr class="heading">
				<td>

					<?php echo Form::input(["label" => "", "name" => "room_id", "table" => "rooms"]); ?><br />


				</td>
				<td><input class="form-control" type="date" id="from_date" size="4" /></td>
				<td><input class="form-control" type="date" id="to_date" size="4" /></td>
				<td><input class="form-control" type="text" id="days" size="3" /></td>
				<td class="number"><input class="form-control" type="text" id="price" size="3" /></td>
				<td> <input class="form-control" type="text" id="total" size="3" /> </td>
				<td> <input class="form-control" type="button" id="add" value="+" /></td>
			</tr>

			<tbody class="items">

			</tbody>

			<tr>
				<td colspan="4"></td>
				<td style="text-align:right;font-weight:bold">Order Total</td>
				<td style="text-align:right;"><input type="text" id="order_total" value="0" /></td>
			</tr>
			<tr>
				<td colspan="4"></td>
				<td style="text-align:right;font-weight:bold">Paid Total</td>
				<td style="text-align:right;"><input type="text" id="paid_total" value="0" /></td>
			</tr>

			<tr>
				<td colspan="4"></td>
				<td style="text-align:right;font-weight:bold">Remark</td>
				<td style="text-align:right;"><textarea id="remark"></textarea></td>
			</tr>
			<tr>
				<td colspan="4"></td>
				<td style="text-align:right;font-weight:bold">&nbsp;</td>
				<td style="text-align:right;"><input type="button" id="save" class="btn btn-primary" value="Create Order" /></td>
			</tr>

			<tr>
				<td colspan="6"></td>
				<td style="text-align:right;font-weight:bold">&nbsp;</td>

			</tr>
		</table>

	</div>
</div>
<script>
	let cart = [];
	let base_url = 'http://localhost/app4.0.0/api';

	$(function() {

		//---Customer Details---
		$("#customer_id").on("change", function() {

			$.ajax({
				url: `${base_url}/Customer/find`,
				type: 'GET',
				data: {
					"id": $(this).val()
				},
				success: function(res) {
					let data = JSON.parse(res);
					// console.log(data.customer);
					let customer = data.customer;

					$("#customer-info").html(customer.mobile + "<br>" + customer.email + "<br>" + customer.address);
				}
			});


		});





		//------------Date Cal-------------
		$("#from_date").on("change", function() {
			calDays();
		});

		$("#to_date").on("change", function() {
			calDays();
		});

		//------------Price Api-------------
		$("#room_id").on("change", function() {

			$.ajax({
				url: `${base_url}/Room/find`,
				type: 'GET',
				data: {
					"id": $(this).val()
				},
				success: function(res) {
					let data = JSON.parse(res);
					// console.log(data.customer);
					let room = data.room;
					console.log(room);
					$("#price").val(room.price)
					//$("#days").val(1)
					calDays();
				}
			});


		});


		//----Add to Bill-----
		$("#add").on("click", function() {

			let room_id = $("#room_id").val();
			let name = $("#room_id option:selected").text();

			let from_date = $("#from_date").val();
			let to_date = $("#to_date").val();
			let price = $("#price").val();

			var ms = Math.abs(new Date(to_date) - new Date(from_date));
			const days = Math.floor(ms / (24 * 60 * 60 * 1000));

			let json = {
				"name": name,
				"room_id": room_id,
				"from_date": from_date,
				"to_date": to_date,
				"days": days + 1,
				"price": price
			}

			cart.push(json);
			console.log(cart);
			printToList();


		});

		//----------------------

		//----Save Bill
		$("#save").on("click", function() {


			$.ajax({
				url: `${base_url}/Booking/save`,
				type: 'POST',
				data: {
					"customer_id": $("#customer_id").val(),
					"order_total": $("#order_total").val(),
					"paid_total": $("#paid_total").val(),
					"remark": $("#remark").val(),
					"created_at": $("#created_at").val(),
					"rooms": cart
				},
				success: function(res) {
					let data = JSON.parse(res);
					console.log(data);
					alert('Success')

					cart = [];
					printToList();
				}
			});





		}); //end save


		//------Helper Functions------


		function printToList() {
			let html = "";
			let total = 0;
			$.each(cart, function(index, item) {
				html += `<tr>`;
				html += `<td>${item.name}</td>`;
				html += `<td>${item.from_date}</td>`;
				html += `<td>${item.to_date}</td>`;
				html += `<td>${item.days}</td>`;
				html += `<td>${item.price}</td>`;
				html += `<td>${item.price*item.days}</td>`;
				html += `</tr>`;
				total += item.price * item.days;
			});

			$(".items").html(html);
			$("#order_total").val(total);
		}


		function calDays() {
			let item_id = $("#room").val();
			let from_date = $("#from_date").val();
			let to_date = $("#to_date").val();
			let price = $("#price").val();

			var ms = Math.abs(new Date(to_date) - new Date(from_date));
			const days = Math.floor(ms / (24 * 60 * 60 * 1000));
			//console.log(days+1);
			$("#days").val(days + 1);


			$("#total").val(price * (days + 1));


		}



	});
</script>