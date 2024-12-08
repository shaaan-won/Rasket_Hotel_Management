<div class="container p-5">
<form action="<?php echo $base_url?>/role/save" method="post">
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input name="name" type="text" class="form-control" id="name" aria-describedby="name">
    
  </div>
  
  <button name="create" type="submit" class="btn btn-primary">Submit</button>
</form>
</div>