<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $db = new Db();
  $branch = 0;
  $date = 0;
  if(isset($_POST['branch'])) {
    $branch = 1;
  }
  if(isset($_POST['date'])) {
    $date = 1;
  }

  $contacttype_id = $db->createContacttype($_POST['title'], $branch, $date);

  if ($contacttype_id) {
  set_feedback('success', 'Kontakttypen skapades');
  } else {
    echo 'fel';
  set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: new.php");
?>