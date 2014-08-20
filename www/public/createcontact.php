<?php
  require_once('../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $db = new Db();
  $activities = $db->getActivities();
  $contacttypes = $db->getContacttypes();
  $contracts = $db->getContracts();
  $branches = $db->getBranches();
  $mailshots = $db->getMailshots();
  $contacts_mailshots_branches = $db->getContactsMailshotsBranches();

  $contactperson = 0;
  $partner = 0;
  $written = 0;
  $insert_activities = null;
  $insert_contacttypes_branch = null;
  $insert_contacttypes_date = null;
  $insert_contacttypes = null;

  foreach($activities as $activity) {
    if (isset($_POST['activity_'.$activity->id])) {
      $insert_activities[] = $activity->id;
    }
  }

  $mail_address = $_POST['company_mail_address'];
  $mail_zip_code = $_POST['company_mail_zip_code'];
  $mail_city = $_POST['company_mail_city'];
  $billing_address = $_POST['company_billing_address'];
  $billing_zip_code = $_POST['company_billing_zip_code'];
  $billing_city = $_POST['company_billing_city'];

  if (isset($_POST['contract_written'])) {
    $written = 1;
  }
  if (isset($_POST['contact_partner'])) {
    $partner = 1;
  }
  if (isset($_POST['contact_contactperson'])) {
    $contactperson = 1;
  }

  if (!isset($_POST['$company_mail_address'])) {
    $mail_address = $_POST['company_visit_address'];
    $mail_zip_code = $_POST['company_visit_zip_code'];
    $mail_city = $_POST['company_visit_city'];
  } else {
    
  }
  if (!isset($_POST['$company_billing_address'])) {
    $billing_address = $_POST['company_visit_address'];
    $billing_zip_code = $_POST['company_visit_zip_code'];
    $billing_city = $_POST['company_visit_city'];
  }

  $contact_id = $db->createContact($_POST['contact_firstname'], $_POST['contact_lastname'], $_POST['contact_email'], $_POST['contact_cellphone'], $_POST['contact_workphone'],  $contactperson, $_POST['notes'] );

  if (strlen($_POST['company_title']) > 0) {
    $company_id = $db->createCompany($_POST['company_title'], $_POST['company_alt_title'], $_POST['company_url'], $_POST['company_email'], $_POST['company_billed'], $_POST['company_total'], $_POST['company_reference'], $_POST['company_visit_address'], $_POST['company_visit_zip_code'], $_POST['company_visit_city'], $mail_address, $mail_zip_code, $mail_city, $billing_address, $billing_zip_code, $billing_city, $contact_id);
    $insertidToContact = $db->insertIdtoContact($company_id, $contact_id);

    foreach($contracts as $contract) {
      if(isset($_POST['contractid_'.$contract->id])) {
        $contract_branch = null;
        $contract_date = null;
        $contract_id = null;
        $contract_written = 0;
        if(isset($_POST['contractid_'.$contract->id.'_branch'])) {
          $contract_branch = $_POST['contractid_'.$contract->id.'_branch'];
          if (isset($_POST['contractid_'.$contract->id.'_date'])) {
            $contract_date = $_POST['contractid_'.$contract->id.'_date'];
          }
        }
        if(isset($_POST['contractid_'.$contract->id.'_written'])) {
          $contract_written = 1;
        }
          $contract_id = $contract->id;
          $createCompaniesContractsBranches = $db->createCompaniesContractsBranches($company_id, $contract_id, $contract_branch, $contract_date, $contract_written);
      }
    }
  }
  if (isset($insert_activities)) {
    foreach ($activities as $activity){
      if (isset($_POST['activity_'.$activity->id]) && in_array($activity->id, $insert_activities)) {
        $createContactActivity = $db->createContactActivity($contact_id, $activity->id);
      }
    }
  }

  foreach ($contacttypes as $contacttype){
    if(isset($_POST['contacttypeid_'.$contacttype->id])) {
      $contacttype_branch = null;
      $contacttype_date = null;
      $contacttype_id = null;
      if(isset($_POST['contacttypeid_'.$contacttype->id.'_branch'])) {
        $contacttype_branch = $_POST['contacttypeid_'.$contacttype->id.'_branch'];
        if (isset($_POST['contacttypeid_'.$contacttype->id.'_date'])) {
          $contacttype_date = $_POST['contacttypeid_'.$contacttype->id.'_date'];
        }
      }
    $contacttype_id = $contacttype->id;
    $createContactsBranchesContacttypes = $db->createContactsBranchesContacttypes($contact_id, $contacttype_branch, $contacttype_id, $contacttype_date);
    }
  }

  foreach($mailshots as $mailshot) {
    foreach($branches as $branch) {
      if (isset($_POST['mailshot_'.$mailshot->id.'_branch_'.$branch->id])) {
        if ($_POST['mailshot_'.$mailshot->id.'_branch_'.$branch->id] == 'on') {
          $mailshot_contact_branch_id = $db->createContactsMailshotsBranches($contact_id, $mailshot->id, $branch->id);
        }
      }
    }
  }

  if ($contact_id || $contract_id) {
    set_feedback('success', 'Kontakten skapades');
  } else {
    echo 'fel';
  set_feedback('error', 'Något blev galet, försök igen');
  }

  header("Location: newcontact.php");
?>