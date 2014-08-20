<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $branch = $db->getBranch($id);

  if (!$branch) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  if ($db->deleteBranch($branch->id)) {
    set_feedback('success', 'Filialen togs bort');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>