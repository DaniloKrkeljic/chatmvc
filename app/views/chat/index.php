<?php require APPROOT.'/views/inc/header.php';?>

  <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
      <img src="<?php echo URLROOT;?>/public/img/logo.png" alt="logo">
      <h1 class="display-3 mt-3">Chat soba</h1>
      <p class="lead">Chat aplikacija</p>
    </div>
  </div>

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <?php foreach ($data['messages'] as $message) : ?>
        <p><?php echo '<b>'.ucwords($message->username).'</b> ['.$message->created_at.']:'.$message->text; ?></p>
      <?php endforeach; ?>
    </div>
  </div>

<?php require APPROOT.'/views/inc/footer.php';?>