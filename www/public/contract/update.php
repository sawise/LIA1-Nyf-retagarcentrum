<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $contract = $db->getContract($id);

  $contract_id = $db->updateContract($_POST['id'], $_POST['title']);

  if($contract_id) {
    set_feedback('success', 'Avtalet uppdaterades');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>