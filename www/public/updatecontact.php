<?php

	require_once('../config.php');
	require_once(ROOT_PATH.'/classes/authorization.php');

	$db = new Db();

	$id = null;
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
  }

	$contact = $db->getContact($id);
	$company = $db->getCompany($contact->company_id);
	$contracts = $db->getContracts();
	$companies_contracts = null;
	$contacttypes = $db->getContacttypes();
	$contacts_contacttypes = $db->showContacts_branches_contacttypes($contact->id);
	$contact_ctid = null;
	$activities = $db->getActivities();
	$activities_contact = $db->showActivities_contacts($contact->id);
	$insert_activities = null;
	$contact_aid = null;
	 $mailshots = $db->getMailshots();
	$mailshots_contacts = $db->editContacts_mailshots_branches($contact->id);
	$contact_msid = null;
	$branches = $db->getBranches();

	if($company != null){
      if($db->showCompanies_contracts_branches($company->id) != null){
          $companies_contracts = $db->showCompanies_contracts_branches($company->id);
      }
  }

  $companies_cid = null;

	if(isset($companies_contracts)) {
		foreach ($companies_contracts as $company_contract) {
			$companies_cid['contract_'.$company_contract->id] = $company_contract->id;
			$companies_cid['contract_'.$company_contract->id.'_branch'] = $company_contract->companies_contracts_branches_branch_id;
			$companies_cid['contract_'.$company_contract->id.'_date'] = $company_contract->start_date;
			$companies_cid['contract_'.$company_contract->id.'_written'] = $company_contract->written;
		}
	}

	if(isset($activities_contact)) {
		foreach($activities_contact as $activity_contact) {
			$insert_activities[] = $activity_contact->id;
		}
	}

  foreach ($contacts_contacttypes as $contact_contacttype) {
    $contact_ctid['contacttype_'.$contact_contacttype->contact_type_id] = $contact_contacttype->contact_type_id;
    $contact_ctid['contacttype_'.$contact_contacttype->contact_type_id.'_branch'] = $contact_contacttype->branch_id;
    $contact_ctid['contacttype_'.$contact_contacttype->contact_type_id.'_date'] = $contact_contacttype->date;
    $deletContact_ctid[] = 'contacttype_'.$contact_contacttype->contact_type_id.'branch_'.$contact_contacttype->branch_id;
   }

   for($i = 0; $i <= count($mailshots_contacts); $i++) {
     if(isset($mailshots_contacts[$i]->id)) {
       /*$contact_msid['mailshot_'.$i] = $mailshots_contacts[$i]->id;
       $contact_msid['mailshot_'.$i.'_branch'] = $mailshots_contacts[$i]->branch_id;*/
       $contact_msid[] = 'mailshot_'.$mailshots_contacts[$i]->id.'_branch_'.$mailshots_contacts[$i]->branch_id;
     }
   }
	$contactperson = 0;

	if (isset($_POST['contact_contactperson'])) {
		$contactperson = 1;
	}

	$contact_id = $db->updateContact($_POST['contact_id'], $_POST['contact_firstname'], $_POST['contact_lastname'], $_POST['contact_email'], $_POST['contact_cellphone'], $_POST['contact_workphone'],  $contactperson, $_POST['notes']);

	if (isset($_POST['company_title'])) {
		$company_id = $db->updateCompanyContact( $_POST['company_id'], $_POST['company_title'], $_POST['company_alt_title'], $_POST['company_url'], $_POST['company_email'], $_POST['company_billed'], $_POST['company_total'], $_POST['company_reference'], $_POST['company_visit_address'], $_POST['company_visit_zip_code'], $_POST['company_visit_city'], $_POST['company_mail_address'], $_POST['company_mail_zip_code'], $_POST['company_mail_city'], $_POST['company_billing_address'], $_POST['company_billing_zip_code'], $_POST['company_billing_city'], $_POST['contact_id']);
		$insertidToContact = $db->insertIdtoContact($_POST['company_id'], $_POST['contact_id']);

		foreach($contracts as $contract) {
			if(isset($_POST['contractid_'.$contract->id]) && $contract->id != $companies_cid['contract_'.$contract->id]) {
				$contract_written = 0;
				if(isset($_POST['contractid_'.$contract->id.'_written'])) {
					$contract_written = 1;
				}
				$createCompaniesContractsBranches = $db->createCompaniesContractsBranches($_POST['company_id'], $contract->id, $_POST['contractid_'.$contract->id.'_branch'], $_POST['contractid_'.$contract->id.'_date'], $contract_written);
			} if(!isset($_POST['contractid_'.$contract->id]) && isset($companies_cid['contract_'.$contract->id]) && $contract->id = $companies_cid['contract_'.$contract->id]) {
					$deleteCompaniesContractsBranches = $db->deleteCompaniesContractsBranches($_POST['company_id'], $contract->id);
			}
		}
	}


	foreach($activities as $activity) {
		if (isset($insert_activities) && isset($_POST['activity_'.$activity->id]) && !in_array($activity->id, $insert_activities) && isset($_POST['activity_'.$activity->id]) || !isset($insert_activities) && isset($_POST['activity_'.$activity->id])) {
				$createContactActivity =	 $db->createContactActivity($_POST['contact_id'], $activity->id);
		} if(!isset($_POST['activity_'.$activity->id]) && in_array($activity->id, $insert_activities)) {
				$deleteContactsActivities =	 $db->deleteContactsActivities	($_POST['contact_id'], $activity->id);
		}
	}

	foreach ($contacttypes as $contacttype){
		if(isset($_POST['contacttypeid_'.$contacttype->id]) && $contacttype->id != $contact_ctid['contacttype_'.$contacttype->id]) {
			$contacttype_branch = null;
			$contacttype_date = null;
			if(isset($_POST['contacttypeid_'.$contacttype->id.'_branch'])) {
				$contacttype_branch = $_POST['contacttypeid_'.$contacttype->id.'_branch'];
				if (isset($_POST['contacttypeid_'.$contacttype->id.'_date'])) {
					$contacttype_date = $_POST['contacttypeid_'.$contacttype->id.'_date'];
				}
			}
			$createContactsBranchesContacttypes = $db->createContactsBranchesContacttypes($_POST['contact_id'], $contacttype_branch, $contacttype->id, $contacttype_date);
		} if(!isset($_POST['contacttypeid_'.$contacttype->id]) && isset($contact_ctid['contacttype_'.$contacttype->id]) && $contacttype->id == $contact_ctid['contacttype_'.$contacttype->id]) {
				$deleteContactsBranchesContacttypes = $db->deleteContactsBranchesContacttypes($_POST['contact_id'], $contacttype->id);
		}
	}

	foreach($mailshots as $mailshot) {
		foreach($branches as $branch) {
			if (isset($_POST['mailshot_'.$mailshot->id.'_branch_'.$branch->id]) && isset($contact_msid) && !in_array('mailshot_'.$mailshot->id.'_branch_'.$branch->id, $contact_msid) || !isset($contact_msid) ) {
							$mailshot_contact_branch_id = $db->createContactsMailshotsBranches($_POST['contact_id'], $mailshot->id, $branch->id);
				if(!in_array('mailshot_'.$mailshot->id.'_branch_'.$branch->id, $contact_msid)) {
					$contact_msid[] = 'mailshot_'.$mailshot->id.'_branch_'.$branch->id;
				}
			} if (!isset($_POST['mailshot_'.$mailshot->id.'_branch_'.$branch->id]) && in_array('mailshot_'.$mailshot->id.'_branch_'.$branch->id, $contact_msid)) {
					$deleteMailshotscontactsbranches = $db->deleteMailshotsContactsBranches($mailshot->id, $_POST['contact_id'], $branch->id);
			}
		}
	}

	if ($contact_id || $company_id) {
		set_feedback('success', 'Kontakten uppdaterades');
	} else {
	  echo 'fel';
	set_feedback('error', 'Något blev fel, försök igen');
	}
	header("Location: showcontact.php?id=".$_POST['contact_id']);

?>