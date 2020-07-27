<?php require APPROOT.'/views/inc/header.php';?>

<div class="row">
  <div class="col-md-5 mx-auto">
    <div class="card card-body bg-light mt-5">
      <h2 class="text-center">Ulogujte se</h2>
      <form action="<?php echo URLROOT;?>/users/login" method="POST" class="mt-5"> 
        <div class="form-group">
          <label for="username">Username: <sup>*</sup></label>
          <input type="text" name="username" class="form-control <?php echo (!empty($data['username_err']))?'is-invalid': '';?>" value="<?php echo $data['username'];?>">
          <span class="invalid-feedback"></span>
        </div>
        <div class="form-group">
          <label for="password">Password: <sup>*</sup></label>
          <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err']))?'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
          <span class="invalid-feedback"><?php echo $data['password_err'];?></span>
        </div>
        <div class="row">
          <div class="col">
            <input type="submit" value="Login" class="btn btn-success btn-block">
          </div>
          <div class="col">
            <a href="<?php echo URLROOT;?>/users/register" class="btn btn-light btn-block">Nemate nalog? Regustrujte se</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require APPROOT.'/views/inc/footer.php';?>