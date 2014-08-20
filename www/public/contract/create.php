<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $db = new Db();
  $contract_id = $db->createContract($_POST['title'], '1', '1');

  if ($contract_id) {
  set_feedback('success', 'Kontraktet skapades');
  } else {
    echo 'fel';
  set_feedback('error', 'Något blev galet, försök igen');
  }

  header("Location: new.php");
?>