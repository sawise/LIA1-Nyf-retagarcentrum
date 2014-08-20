<?php
    require_once('../config.php');
    require_once(ROOT_PATH.'/classes/authorization.php');
    $page_title = "Redigera kontakt";

    $db = new Db();

    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $contact = $db->getContact($id);
    $contracts = $db->getContracts();
    $contractstest = $db->getCompanies_contracts_branches();
    $company = $db->getCompany($contact->company_id);
    $companies = $db->getCompanies();
    $branches = $db->getBranches();
    $contacttypes = $db->getContacttypes();
    $mailshots = $db->getMailshots();
    $mailshots_contacts = $db->editContacts_mailshots_branches($contact->id);
    $contacts_contacttypes = $db->showContacts_branches_contacttypes($contact->id);
    $companies_contracts = null;
    if($company != null){
        if($db->showCompanies_contracts_branches($company->id) != null){
            $companies_contracts = $db->showCompanies_contracts_branches($company->id);
        }
    }
    $activities = $db->getActivities();
    //$activities = $db->getActivities_branches();
    $activities_contact = $db->showActivities_contacts($contact->id);
    $contact_aid = null;
    $contact_ctid = null;
    $contact_msid = null;
    $companies_cid = null;


    foreach ($activities_contact as $activity_contact) {
        $contact_aid[] = $activity_contact->id;

    }

    foreach ($contacts_contacttypes as $contact_contacttype) {
        $contact_ctid['contacttype_'.$contact_contacttype->contact_type_id] = $contact_contacttype->contact_type_id;
        $contact_ctid['contacttype_'.$contact_contacttype->contact_type_id.'_branch'] = $contact_contacttype->branch_id;
        $contact_ctid['contacttype_'.$contact_contacttype->contact_type_id.'_date'] = $contact_contacttype->date;

    }

    if(isset($companies_contracts)) {
       foreach ($companies_contracts as $company_contract) {
         $companies_cid['contract_'.$company_contract->id] = $company_contract->id;
         $companies_cid['contract_'.$company_contract->id.'_branch'] = $company_contract->companies_contracts_branches_branch_id;
         $companies_cid['contract_'.$company_contract->id.'_date'] = $company_contract->start_date;
         $companies_cid['contract_'.$company_contract->id.'_written'] = $company_contract->written;
       }
    }

    if (isset($mailshots_contacts)) {
      for($i = 0; $i <= count($mailshots_contacts); $i++) {
        if(isset($mailshots_contacts[$i]->id)) {
         $contact_msid['mailshot_'.$i] = $mailshots_contacts[$i]->id;
         $contact_msid['mailshot_'.$i.'_branch'] = $mailshots_contacts[$i]->branch_id;
        }
      }
    }


?>
<?php require_once(ROOT_PATH.'/header.php');?>

<form class="form-horizontal"  method="post" action="updatecontact.php?id=<?php echo $contact->id ?>">
    <section class="contact">
        <fieldset>
            <legend>Kontakt <input onclick="if (this.value=='Visa') this.value = 'Dölj';
    else this.value = 'Visa';" class="btn hide_button btn medium" type="button" data-toggle="collapse" data-target="#contact" value="Dölj" /></legend>
            <div id="contact" class="collapse in">
                <?php echo hidden_input('contact_id', $contact->id) ?>
                <?php echo form_input('text', 'control-label', 'contact_firstname', 'Förnamn:', '', $contact->first_name ) ?>
                <?php echo form_input('text', 'control-label', 'contact_lastname', 'Efternamn:', '', $contact->last_name) ?>
                <?php echo form_input('email', 'control-label', 'contact_email', 'E-post:', '', $contact->email) ?>
                <?php echo form_input('text', 'control-label', 'contact_cellphone', 'Mobil:', '', $contact->cell_phone) ?>
                <?php echo form_input('text', 'control-label', 'contact_workphone', 'Arbetstelefon:', '', $contact->work_phone) ?>

                <?php if($contact->contact_person == 1){
                    echo checkbox('checkbox', 'contact_contactperson', 'Kontaktperson', '','','checked');
                } else {
                    echo checkbox('checkbox', 'contact_contactperson', 'Kontaktperson');
                } ?>
            </div>
        </fieldset>
    </section>

    <section class="company">
        <fieldset>
            <legend>Företag <input id="company_input" onclick="ScrollFunction('company_input')" class="btn hide_button btn medium" type="button" data-toggle="collapse" data-target="#company" value="Visa" /></legend>
                <div id="company" class="collapse out">
                    <table class="company">
                        <tr>
                            <td id="company-left">
                                <?php if(!$company) : ?>
                                    Personen är inte kopplad till något företag!<br />
                                    <a href="newcompany.php?id=<?php echo $contact->id ?>">Skapa nytt företag</a>.
                                <?php endif ?>
                                <?php if($company) : ?>
                                <?php echo hidden_input('company_id', $company->id) ?>
                                <?php echo form_input('text', 'control-label', 'company_title', 'Företagsnamn:', '', $company->title) ?>
                                <?php echo form_input('text', 'control-label', 'company_alt_title', 'Företagsnamn:', '', $company->alt_title) ?>
                                <?php echo form_input('text', 'control-label', 'company_url', 'Webbadress:', '', $company->url) ?>
                                <?php echo form_input('text', 'control-label', 'company_email', 'E-post:', '', $company->email) ?>
                                <?php echo form_input('text', 'control-label', 'company_total', 'Summa:', '', $company->total) ?>
                                <?php echo form_input('text', 'control-label', 'company_billed', 'Fakturerat:', '', $company->billed) ?>
                                <?php echo form_input('text', 'control-label', 'company_reference', 'Er referens:', '', $company->reference) ?>

                                <?php echo form_input('text', 'control-label', 'company_visit_address', 'Besöksadress:', '', $company->visit_address) ?>
                                <?php echo form_input('text', 'control-label', 'company_visit_zip_code', 'Postnummer:', '', $company->visit_zip_code) ?>
                                <?php echo form_input('text', 'control-label', 'company_visit_city', 'Stad:', '',$company->visit_city) ?>
                            </td>
                            <td id="company-right">
                                <div>
                                    <?php echo form_input('text', 'control-label', 'company_mail_address', 'Postadress:', '', $company->mail_address) ?>
                                    <?php echo form_input('text', 'control-label', 'company_mail_zip_code', 'Postnummer:', '', $company->mail_zip_code) ?>
                                    <?php echo form_input('text', 'control-label', 'company_mail_city', 'Stad:', '', $company->mail_city) ?>
                                </div>
                                <div>
                                    <?php echo form_input('text', 'control-label', 'company_billing_address', 'Faktureringsadress:', '', $company->billing_address) ?>
                                    <?php echo form_input('text', 'control-label', 'company_billing_zip_code', 'Postnummer:', '', $company->billing_zip_code) ?>
                                    <?php echo form_input('text', 'control-label', 'company_billing_city', 'Stad:', '', $company->billing_city) ?>
                                </div>
                            </td>
                        <?php endif ?>
                    </tr>
                    </table>
                    <div class="clear"></div>
            	</div>
        </fieldset>
    </section>
    <section class="contract">
        <fieldset>
            <legend>Avtal <input id="contract_input" onclick="ScrollFunction('contract_input')" class="btn hide_button btn medium" type="button" data-toggle="collapse" data-target="#contract" value="Visa" /></legend>
            <div id="contract" class="collapse out">
            	<?php foreach($contracts as $contract) : ?>
                    <?php if(isset($companies_cid['contract_'.$contract->id])) {
                        echo editContact($contract->id, $contract->title, $branches, 'contractid_', $contract, $companies_cid['contract_'.$contract->id],  $companies_cid['contract_'.$contract->id.'_branch'],  $companies_cid['contract_'.$contract->id.'_written'], $companies_cid['contract_'.$contract->id.'_date']);
                            } else {
                            echo editContact($contract->id, $contract->title, $branches, 'contractid_', $contract);
                            //editContact($id, $title, $select, $checkbox_title, $datebranch, $array_id,  $array_branch,  $array_written,  $array_date)
                        }?>
                 <?php endforeach ?>
                 <!--/* if(isset($companies_cid['contract_'.$contract->id])) {
                            echo contact_types($contract->id, $contract->title, 'checked', $branches, 'Filial: ', 'id', 'contractid_'.$contract->id.'_branch', 'contractid_', $contract, $companies_cid['contract_'.$contract->id.'_branch'], $companies_cid['contract_'.$contract->id.'_date']);
                        } if(!isset($companies_cid['contract_'.$contract->id])) {
                            echo contact_types($contract->id, $contract->title, '', $branches, 'Filial: ', 'id', 'contractid_'.$contract->id.'_branch', 'contractid_', $contract);
                        } if(isset($companies_cid['contract_'.$contract->id.'_written'])) {
                            echo '<div id="written">'.checkbox('checkbox', 'contractid_'.$contract->id.'_written', 'Avtalet är skriftligt', '','', 'checked').'</div>';
                        } if(!isset($companies_cid['contract_'.$contract->id.'_written'])) {
                            echo '<div id="written">'.checkbox('checkbox', 'contractid_'.$contract->id.'_written', 'Avtalet är skriftligt').'</div>';
                        } */
                             ?>
                    <div id="written">
                        <?php // echo checkbox('checkbox', 'contractid_'.$contract->id.'_written', 'Avtalet är skriftligt') ?>
                    </div> -->

            </div>
        </fieldset>
    </section>
     <section class="activities">
        <fieldset>
            <legend>Aktiviteter <input id="activity_input" onclick="ScrollFunction('activity_input')" class="btn hide_button btn medium" type="button" data-toggle="collapse" data-target="#activities" value="Visa" /></legend>
            <div id="activities" class="collapse out">
                 <?php if(!$activities) : ?>
                    Personen är inte kopplad till någon aktivitet!
                 <?php endif ?>

                <?php if(isset($activities)) : ?>
                    <?php foreach($activities as $activity) : ?>
                        <?php if(isset($contact_aid)) {
                                if(in_array($activity->id, $contact_aid)) {
                                    echo checkbox('checkbox', 'activity_'.$activity->id, $activity->title, $activity->date, $activity->branches_title, 'checked');
                                }
                              if(!in_array($activity->id, $contact_aid)) {
                                echo checkbox('checkbox', 'activity_'.$activity->id, $activity->title, $activity->date, $activity->branches_title, '');
                              }
                            } if(!isset($contact_aid)) {
                                echo checkbox('checkbox', 'activity_'.$activity->id, $activity->title, $activity->date, $activity->branches_title, '');
                            }
                            ?>
                    <?php endforeach ?>
                <?php endif ?>

            </div>
        </fieldset>
    </section>

    <section class="contact_type">
        <fieldset>
            <legend>Kontakttyper <input id="contacttype_input" onclick="ScrollFunction('contacttype_input')" class="btn hide_button btn medium " type="button" data-toggle="collapse" data-target="#contact_type" value="Visa" /></legend>
            <div id="contact_type" class="collapse out">
                <?php foreach($contacttypes as $contacttype) : ?>
                    <?php if(isset($contact_ctid['contacttype_'.$contacttype->id])) {
                        echo editContact($contacttype->id, $contacttype->title, $branches, 'contacttypeid_', $contacttype, $contact_ctid['contacttype_'.$contacttype->id], $contact_ctid['contacttype_'.$contacttype->id.'_branch'], null, $contact_ctid['contacttype_'.$contacttype->id.'_date']);
                          } else {
                            echo editContact($contacttype->id, $contacttype->title, $branches, 'contacttypeid_', $contacttype);
                          }
                    ?>
                <?php endforeach ?>
                    <!--/*if(isset($contact_ctid['contacttype_'.$contacttype->id])) {
                            if(isset($contact_ctid['contacttype_'.$contacttype->id.'_branch']) && isset($contact_ctid['contacttype_'.$contacttype->id.'_date'])) {
                                echo contact_types($contacttype->id, $contacttype->title, 'checked', $branches, 'Filial: ', 'id', 'contacttypeid_'.$contacttype->id.'_branch', 'contacttypeid_', $contacttype, $contact_ctid['contacttype_'.$contacttype->id.'_branch'], $contact_ctid['contacttype_'.$contacttype->id.'_date']);
                            } if(isset($contact_ctid['contacttype_'.$contacttype->id.'_branch']) && !isset($contact_ctid['contacttype_'.$contacttype->id.'_date'])) {
                                echo contact_types($contacttype->id, $contacttype->title, 'checked', $branches, 'Filial: ', 'id', 'contacttypeid_'.$contacttype->id.'_branch', 'contacttypeid_', $contacttype, $contact_ctid['contacttype_'.$contacttype->id.'_branch']);

                            } if(!isset($contact_ctid['contacttype_'.$contacttype->id.'_branch'])) {
                                echo contact_types($contacttype->id, $contacttype->title, 'checked', $branches, 'Filial: ', 'id', 'contacttypeid_'.$contacttype->id.'_branch', 'contacttypeid_', $contacttype, $contact_ctid['contacttype_'.$contacttype->id.'_branch']);
                            }
                          } if(!isset($contact_ctid['contacttype_'.$contacttype->id])) {
                                echo contact_types($contacttype->id, $contacttype->title, '', $branches, 'Filial: ', 'id', 'contacttypeid_'.$contacttype->id.'_branch', 'contacttypeid_', $contacttype);
                          }*/ -->

            </div>
        </fieldset>
    </section>

    <section class="mailshot">
        <fieldset>
            <legend>Utskick <input id="mailshot_input" onclick="ScrollFunction('mailshot_input')" class="btn hide_button btn medium" type="button" data-toggle="collapse" data-target="#mailshot" value="Visa" /></legend>
            <div id="mailshot" class="collapse out">
                    <?php foreach($mailshots as $mailshot) : ?>
                        <?php echo $mailshot->title ?>
                            <div class="checkbox_child">
                                <?php foreach($branches as $branch)  {
                                        $post = 1;
                                        for($i = 0; $i <= count($contact_msid); $i++) {
                                            if(isset($contact_msid['mailshot_'.$i]) && $contact_msid['mailshot_'.$i] == $mailshot->id && $contact_msid['mailshot_'.$i.'_branch'] == $branch->id) {
                                                    echo checkbox('checkbox', 'mailshot_'.$mailshot->id.'_branch_'.$branch->id, $branch->title, '', '', 'checked');
                                                        $post = 0;
                                            }
                                        } if($post == 1) {
                                            echo checkbox('checkbox', 'mailshot_'.$mailshot->id.'_branch_'.$branch->id, $branch->title, '', '', '');
                                        }
                                      }
                                       ?>
                            </div>
                    <?php endforeach ?>
            </div>
        </fieldset>
    </section>

    <section class="notes_section">
        <fieldset>
            <legend>Anteckningar<input id="notes_input" onclick="ScrollFunction('notes_input')" class="btn hide_button btn medium" type="button" data-toggle="collapse" data-target="#notes_area" value="Visa" /></legend>
            <div id="notes_area" class="collapse out">
                <!--<textarea id="notes" name="notes" onKeyDown="LimitText(this.form.notes,this.form.countdown,1000);"
onKeyUp="LimitText(this.form.notes,this.form.countdown,1000);" rows="8" maxlength="1000"></textarea>-->
				<?php echo text_area('notes', '', '', $contact->notes); ?>
                <p><input readonly type="text" name="countdown" value="1000" readonly="readonly" id="remain"></p>
            </div>
        </fieldset>

        <div class="balloon">
            <button class="btn btn-primary btn-medium" type="button" onClick="history.go(-1);">Tillbaka</button>
            <button class="btn btn-primary btn-medium" type="submit">Spara</button>
        </div>
    </section>
</form>

<?php
require_once(ROOT_PATH.'/footer.php');
      ?>
