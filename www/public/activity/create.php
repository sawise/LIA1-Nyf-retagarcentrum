<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $db = new Db();
  $branch_id = null;

  if (isset($_POST['branch_id'])) {
    $branch_id = $_POST['branch_id'];
  }

  $activity_id = $db->createActivity($_POST['title'], $_POST['date'], $_POST['branch_id']);

  if ($activity_id) {
  set_feedback('success', 'Aktiviteten skapades');
  } else {
    echo 'fel';
  set_feedback('error', 'Något blev fel, försök igen');
  }
  header("Location: new.php");
?>