<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $db = new Db();
  $branch_id = $db->createBranch($_POST['title']);

  if ($branch_id) {
  set_feedback('success', 'Filialen skapades');
  } else {
    echo 'fel';
  set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>