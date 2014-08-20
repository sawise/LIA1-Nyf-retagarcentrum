<?php

  require_once('../config.php');
 // require_once(ROOT_PATH.'/classes/item.php');

  if (isset($_POST) && isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == USER && $password == PASS) {
      $_SESSION['is_logged_in'] = true;

      if (isset($_SESSION['return_to'])) {
        $return_to = $_SESSION['return_to'];
        $_SESSION['return_to'] = null;
        header('location: '.$return_to);
      } else {
        header('location: index.php');
      }
    }
  }

  $page_title = "Logga in";

?>
<?php require_once(ROOT_PATH.'/header.php'); ?>

<section>
<div class="row-fluid marketing">
	<div class="span12">
    	<form method="post" action="login.php">
    		<?php echo form_input('text', 'control-label', 'username', 'Användarnamn:', 'Användarnamn') ?>
      		<?php echo form_input('password', 'control-label', 'password', 'Lösenord:', 'Lösenord'); ?>
      		<button class="btn btn-medium btn-primary btn-Action" type="submit">Logga in</button>
    	</form>
  	</div>
</div>
</section>

<style type="text/css">
	.nav {
		display:none;
	}
	.span12 {
		padding-left:10px;
	}
</style>
<?php require_once(ROOT_PATH.'/footer.php'); ?>