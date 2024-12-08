<?php
// echo Page::title(["title"=>"Edit Division"]);
// echo Page::body_open();
// echo Html::link(["class"=>"btn btn-success", "route"=>"division", "text"=>"Manage Division"]);
// echo Page::context_open();
// echo Form::open(["route"=>"division/update"]);
// 	echo Form::input(["label"=>"Id","type"=>"hidden","name"=>"id","value"=>"$division->id"]);
// 	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name","value"=>"$division->name"]);
// 	echo Form::input(["label"=>"Population","type"=>"text","name"=>"Population","value"=>"$division->Population"]);
// 	echo Form::input(["label"=>"Areakm2","type"=>"text","name"=>"AreaKm2","value"=>"$division->AreaKm2"]);
// 	echo Form::input(["label"=>"Capitalcity","type"=>"text","name"=>"CapitalCity","value"=>"$division->CapitalCity"]);

// echo Form::input(["name"=>"update","class"=>"btn btn-success offset-2" , "value"=>"Save Chanage", "type"=>"submit"]);
// echo Form::close();
// echo Page::context_close();
// echo Page::body_close();
?>

<?php

// $id =  isset($_GET['id']) ? $_GET['id'] : 0;
$id = $_GET['id'];
//  print_r($id);

?>

<div class="container p-3" id="edit_division">
	<form action="" method="post" id="updateForm">
		<div class="mb-3" hidden>
			<label for="Id" class="form-label">Id</label>
			<input type="text" class="form-control" id="id" placeholder="Id" value="sc">
		</div>
		<div class="mb-3">
			<label for="Name" class="form-label">Name</label>
			<input type="text" class="form-control" id="name" placeholder="Name" value="">
		</div>
		<div class="mb-3">
			<label for="Area" class="form-label">Area</label>
			<input type="text" class="form-control" id="area" placeholder="Area" value="">
		</div>
		<div class="mb-3">
			<label for="Population" class="form-label">Population</label>
			<input type="text" class="form-control" id="population" placeholder="Population" value="">
		</div>

		<div class="mb-3">
			<label for="CapitalCity" class="form-label">CapitalCity</label>
			<input type="text" class="form-control" id="capitalcity" placeholder="CapitalCity" value="">
		</div>
		<div class="mb-6">
			<button type="submit" class="btn btn-primary">Update</button>
		</div>
	</form>
</div>
<script>
	$(document).ready(function() {

		$.ajax({
			url: "<?php echo $base_url ?>/api/division/find",
			type: "get",
			data: {
				id: <?php echo $id ?>
			},
			success: function(res) {
				// 	let data = JSON.parse(res);
				// 	$("#id").val(data.division.id)
				// 	$("#name").val(data.division.name)
				// 	$("#area").val(data.division.AreaKm2)
				// 	$("#population").val(data.division.Population)
				// 	$("#capitalcity").val(data.division.CapitalCity)
				// },
				try {
					let data = JSON.parse(res); // Ensure valid JSON
					if (data.division) {
						$("#id").val(data.division.id);
						$("#name").val(data.division.name);
						$("#area").val(data.division.AreaKm2);
						$("#population").val(data.division.Population);
						$("#capitalcity").val(data.division.CapitalCity);
					} else {
						console.error("Division data not found.");
					}
				} catch (e) {
					console.error("Failed to parse response:", e);
				}
			},
			error: function(err) {
				console.log(err)
			}
		});


		$("#updateForm").submit(function(e) {
			e.preventDefault(); 

			let formData = {
				id: $("#id").val(),
				name: $("#name").val(),
				AreaKm2: $("#area").val(),
				Population: $("#population").val(),
				CapitalCity: $("#capitalcity").val()
			};

			$.ajax({
				url: "<?php echo $base_url; ?>/api/division/update",
				type: "post",
				data: formData,
				success: function(res) {
					let data = JSON.parse(res);
					if (data.success) {
						// alert("Division updated successfully!");
						window.location.href = "<?php echo $base_url; ?>division";
					}
					else {
						
						alert("An error occurred while updating the division." + data.message);
					}
				},
				error: function(err) {
					console.error("AJAX request failed:", err);
					alert("An error occurred while updating the division.");
				}
			});
		});
	});
</script>