<?php
  require_once('../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
  }

  $db = new Db();
  $contact = $db->getContact($id);
  $company = $db->getCompany($contact->company_id);
  $mailshots_contacts = $db->editContacts_mailshots_branches($contact->id);
  $contacts_contacttypes = $db->showContacts_branches_contacttypes($contact->id);
  $activities_contact = $db->showActivities_contacts($contact->id);

  if (!$contact) {
    header('HTTP/1.0 404 not found');
    exit();
  }

  if ($db->deleteOnlyContact($contact->id)) {
    if(isset($_GET['delete_company'])) {
      $deleteCompany = $db->deleteCompany($company->id);
    }

    if(isset($mailshots_contacts)) {
      $deleteContactMailshots = $db->deleteContactMailshots($contact->id);
      echo $deleteContactMailshots;
    }

    if(isset($contacts_contacttypes)) {
      $deleteContacts_contacttypes = $db->deleteContactsBranchesContacttypes($contact->id);
      echo $deleteContacts_contacttypes;
    }
    if(isset($activities_contact)) {
      $deleteActivities_contact = $db->deleteContactsActivities($contact->id);
    }
    set_feedback('success', 'Kontakten togs bort');
  } else {
    set_feedback('error', 'Något blev fel, försök igen');
  }

  header("Location: index.php");
?>