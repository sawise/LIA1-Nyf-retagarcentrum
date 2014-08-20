<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $contacttype = $db->getContacttype($id);

  $contacttype_id = $db->updateContacttype($_POST['id'], $_POST['title']);

  if($contacttype_id) {
    set_feedback('success', 'Kontakttypen uppdaterades');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>