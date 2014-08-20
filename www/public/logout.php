<?php
  require_once('../config.php');

  if (isset($_SESSION['is_logged_in'])) {
    unset($_SESSION['is_logged_in']);
    set_feedback("success", "Du är nu utloggad.");
  }

  header('location: login.php');
?>