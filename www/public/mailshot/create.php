<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $db = new Db();

  $mailshot_id = $db->createMailshot($_POST['title']);

  if ($mailshot_id) {
  set_feedback('success', 'Utskicket skapades');
  } else {
    echo 'fel';
  set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>