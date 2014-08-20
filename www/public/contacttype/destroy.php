<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $contact_type = $db->getContacttype($id);

  if (!$contact_type) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  if ($db->deleteContacttype($contact_type->id)) {
    $db->deleteContactBranchContacttype($contact_type->id);
    set_feedback('success', 'Kontakttypen togs bort');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>