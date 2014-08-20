<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $mailshot = $db->getMailshot($id);

  if (!$mailshot) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  if ($db->deleteMailshot($mailshot->id)) {
    $db->deleteMailshotContactBranch($mailshot->id);
    set_feedback('success', 'Utskicket togs bort');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>