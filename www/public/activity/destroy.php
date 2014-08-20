<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $activity = $db->getActivity($id);

  if (!$activity) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  if ($db->deleteActivity($activity->id)) {
    $db->deleteContactActivity($activity->id);
    set_feedback('success', 'Aktiviteten togs bort');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>