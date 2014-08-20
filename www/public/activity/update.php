<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $activity = $db->getActivity($id);

  $activity_id = $db->updateActivity($_POST['id'], $_POST['title']);

  if($contract_id) {
    set_feedback('success', 'Aktiviteten uppdaterades');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>