<?php require APPROOT.'/views/inc/header.php';?>

  <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
      <img src="<?php echo URLROOT;?>/public/img/logo.png" alt="logo">
      <h1 class="display-3 mt-3">Chat soba</h1>
      <p class="lead">Chat aplikacija</p>
    </div>
  </div>

  <div class="container">
    <div class="border mb-3">
    <?php foreach ($data['messages'] as $message) : ?>
      <p><?php echo '<b>'.ucwords($message->username).'</b> ['.$message->created_at.']: '.$message->text; ?></p>
    <?php endforeach; ?>
    </div>
    
  
    <form action="<?php echo URLROOT;?>/chats/addMessage" method="POST">
      <div class="form-group">
        <input type="text" name="message" class="form-control">
      </div>
      <input type="hidden" value="<?php echo $_SESSION['username'];?>" name="username">
      <input type="submit" value="Posalji" class="btn btn-light btn-inline">
    </form>
  </div>


<?php require APPROOT.'/views/inc/footer.php';?>