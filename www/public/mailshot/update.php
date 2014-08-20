<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $mailshot = $db->getMailshot($id);
  $mailshot_id = $db->updateMailshot($_POST['id'], $_POST['title']);

  if($mailshot_id) {
    set_feedback('success', 'Utskicket uppdaterades');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>