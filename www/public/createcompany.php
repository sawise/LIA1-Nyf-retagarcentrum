<?php
  require_once('../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $db = new Db();
  $mail_address = $_POST['company_mail_address'];
  $mail_zip_code = $_POST['company_mail_zip_code'];
  $mail_city = $_POST['company_mail_city'];
  $billing_address = $_POST['company_billing_address'];
  $billing_zip_code = $_POST['company_billing_zip_code'];
  $billing_city = $_POST['company_billing_city'];

  if (!isset($_POST['$company_mail_address'])) {
    $mail_address = $_POST['company_visit_address'];
    $mail_zip_code = $_POST['company_visit_zip_code'];
    $mail_city = $_POST['company_visit_city'];
  }
  if (!isset($_POST['$company_billing_address'])) {
    $billing_address = $_POST['company_visit_address'];
    $billing_zip_code = $_POST['company_visit_zip_code'];
    $billing_city = $_POST['company_visit_city'];
  }

  $company_id = $db->createCompany($_POST['company_title'], $_POST['company_alt_title'], $_POST['company_url'], $_POST['company_email'], $_POST['company_billed'], $_POST['company_total'], $_POST['company_reference'], $_POST['company_visit_address'], $_POST['company_visit_zip_code'], $_POST['company_visit_city'], $mail_address, $mail_zip_code, $mail_city, $billing_address, $billing_zip_code, $billing_city, 0);

  if(isset($_POST['contact_id'])) {
    $contact_company = $db->insertContacttoCompany($_POST['contact_id'], $company_id);
    $company_contact = $db->insertIdtoContact($company_id, $_POST['contact_id']);
  }

  if ($company_id) {
    set_feedback('success', 'Företaget skapades');
  } else {
    echo 'fel';
    set_feedback('error', 'Något blev galet, försök igen');
  }

  header("Location: index.php");
?>