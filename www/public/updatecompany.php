<?php
  require_once('../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $company = $db->getCompany($id);
  $company_id = $db->updateCompany( $_POST['company_id'], $_POST['company_title'], $_POST['company_alt_title'], $_POST['company_url'], $_POST['company_email'], $_POST['company_billed'], $_POST['company_total'], $_POST['company_reference'], $_POST['company_visit_address'], $_POST['company_visit_zip_code'], $_POST['company_visit_city'], $_POST['company_mail_address'], $_POST['company_mail_zip_code'], $_POST['company_mail_city'], $_POST['company_billing_address'], $_POST['company_billing_zip_code'], $_POST['company_billing_city']);

  if($company_id) {
    set_feedback('success', 'Företaget uppdaterades');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: newcompany.php");
?>