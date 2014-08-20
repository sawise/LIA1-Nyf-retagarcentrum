<?php
  require_once('../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $company = $db->getCompany($id);
  $contracts = $db->getContracts();

  if (!$company) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  if ($db->deleteCompany($company->id)) {
    $db->deleteCompanyContractBranch($company->id);
    set_feedback('success', 'Företaget togs bort');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: newcompany.php");
?>