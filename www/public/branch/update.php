<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $branch = $db->getBranch($id);

  $branch_id = $db->updateBranch($_POST['id'], $_POST['title']);

  if($branch_id) {
    set_feedback('success', 'Filialen uppdaterades');
  } else {
    set_feedback('error', 'Ojdå, det gick inte');
  }

  header("Location: new.php");
?>