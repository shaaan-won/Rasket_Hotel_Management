
<?php 

//print_r($role);

?>


<div class="container p-5">
<form action="<?php echo $base_url?>/role/update" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input value="<?php echo $role->name?>" name="name" type="text" class="form-control" id="name" aria-describedby="name">
     <input name="id" type="hidden" value="<?php echo $role->id?>">
  </div>
  
  <button name="update" type="submit" class="btn btn-primary">Update</button>
</form>
</div>