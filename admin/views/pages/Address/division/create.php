<?php
// echo Page::title(["title"=>"Create Division"]);
// echo Page::body_open();
// echo Html::link(["class"=>"btn btn-success", "route"=>"division", "text"=>"Manage Division"]);
// echo Page::context_open();
// echo Form::open(["route"=>"division/save"]);
// 	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
// 	echo Form::input(["label"=>"Population","type"=>"text","name"=>"Population"]);
// 	echo Form::input(["label"=>"Areakm2","type"=>"text","name"=>"AreaKm2"]);
// 	echo Form::input(["label"=>"Capitalcity","type"=>"text","name"=>"CapitalCity"]);

// echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
// echo Form::close();
// echo Page::context_close();
// echo Page::body_close();
?>

<div class="container p-3" id="edit_division">
	<form action="" method="post" id="createForm">
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
			<button type="submit" class="btn btn-primary">Create</button>
		</div>
	</form>
</div>

<script>
	$(document).ready(function() {
		$("#createForm").submit(function(e) {
			e.preventDefault();
			let formData = {
				id: $("#id").val(),
				name: $("#name").val(),
				AreaKm2: $("#area").val(),
				Population: $("#population").val(),
				CapitalCity: $("#capitalcity").val()
			};
			$.ajax({
				url: "<?= $base_url?>api/division/save",
				type: "POST",
				data: formData,
				success: function(res) {
					let data = JSON.parse(res);
					if (data.success) {
						// alert("Division created successfully!");
						window.location.href = "<?= $base_url?>division";
					}
					else {
						alert("An error occurred while creating the division." + data.message);
					}
				},
				error: function(err) {
					console.log(err);
					alert("An error occurred while creating the division.");
				}
			});
		});
	});
				
</script>