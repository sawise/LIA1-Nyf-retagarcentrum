<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $contract = $db->getContract($id);

  if (!$contract) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  if ($db->deleteContract($contract->id)) {
    $db->deleteCompanyContractBranch($contract->id);
    set_feedback('success', 'Avtalet togs bort');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>