
<?php 

//print_r($role);

?>


<div class="container p-5">
<form action="<?php echo $base_url?>/role/confirm_delete" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input disabled  value="<?php echo $role->name?>" name="name" type="text" class="form-control" id="name" aria-describedby="name">
     <input name="id" type="hidden" value="<?php echo $role->id?>">
  </div>
  
  <button name="delete" type="submit" class="btn btn-primary">Delete</button>
</form>
</div>