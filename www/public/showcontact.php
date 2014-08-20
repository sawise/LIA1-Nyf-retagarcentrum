<?php
    require_once('../config.php');
	require_once(ROOT_PATH.'/classes/authorization.php');
    $page_title = "Kontakt";

	$id = null;
	  if(isset($_GET['id'])) {
		$id = $_GET['id'];
	  }

	$db = new Db();
	$contact = $db->getContact($id);
	$branches = $db->getBranches();
	//$mailshots = $db->showMailshots($id);
    $contracts = $db->showCompanies_contracts_branches($contact->company_id);
    //$manytomany = $db->getcontacts_branches_contacttypes();
	$branches = $db->getBranches();
    $activities = $db->showActivities_contacts($contact->id);
    $contacttypes = $db->showContacts_branches_contacttypes($contact->id);
	$showmailshots = $db->showMailshots($id);
	$mailshots = $db->getMailshots();


?>
<?php require_once(ROOT_PATH.'/header.php');?>
<section class="contactshow" id="print_contact">
    <div class="row">
        <div class="span12">
            <fieldset>
                <legend>Namn och kontakt</legend>
                <div class="span6">
                <table>
                    <tbody>
                        <tr>
                        	<td class="td_bold">Namn:</td>
                            <td><?php echo full_name($contact->first_name, $contact->last_name)?></td>
                       	</tr>
                        <tr>
                        	<td class="td_bold">E-post:</td>
                            <td><?php echo $contact->email;  ?></td>
                        </tr>
                        <tr>
                        	<td class="td_bold">Mobil:</td>
                            <td><?php echo $contact->cell_phone;  ?></td>
                      	</tr>
                        <tr>
                        	<td class="td_bold">Tel. arbete:</td>
                        	<td><?php echo $contact->work_phone;	?></td>
                      	</tr>
                        <tr>
                            <td class="td_bold">Kontaktperson:</td>
                            <td><?php if($contact->contact_person == 1){
                                echo 'Ja';
                            } else {
                                echo 'Nej';
                            } ?></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="span6">
                    <table>
                        <tbody>
                            <tr>
                                <th>Anteckningar</th>
                            </tr>
                            <tr>
                                <td><?php echo $contact->notes; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <fieldset>
                <legend>Företag</legend>
                <div id="show_company" class="span3">
                	<table>
                    	<tbody>
                        	<tr>
                        		<td class="td_bold">Företagsnamn:</td>
                            	<td><?php echo $contact->companies_title;  ?></td>
                       		</tr>
                        	<tr>
                        		<td class="td_bold">Webbadress:</td>
                            	<td><?php echo $contact->companies_url;  ?></td>
                      		</tr>
                        	<tr>
                        		<td class="td_bold">E-post:</td>
                            	<td><?php echo $contact->companies_email;	?></td>
                       		</tr>
                        	<tr>
                        		<td class="td_bold">Referens:</td>
                            	<td><?php echo $contact->companies_reference;	?></td>
                       		</tr>
                        	<tr>
                        		<td class="td_bold">Fakturerat:</td>
                            	<td><?php echo $contact->companies_billed;	?></td>
                       		</tr>
                        	<tr>
                        		<td class="td_bold">Summa:</td>
                            	<td><?php echo $contact->companies_total;	?></td>
                       		</tr>
                 		</tbody>
                	</table>
                </div>
                <div class="span2_5 offset1">
                	<table>
                    	<thead>
                        	<tr>
                        		<th>Besöksadress</th>
                       		</tr>
                    	</thead>
                   		<tbody>
                        	<tr>
                        		<td><?php echo $contact->companies_visit_address;  ?></td>
                      		</tr>
                        	<tr>
                        		<td><?php echo $contact->companies_visit_zip_code;  ?></td>
                       		</tr>
                        	<tr>
                        		<td><?php echo $contact->companies_visit_city;  ?></td>
                       		</tr>
                    	</tbody>
                	</table>
                </div>
                <div class="span2_5">
                	<table>
                    	<thead>
                        	<tr>
                        		<th>Postadress</th>
                       		</tr>
                    	</thead>
                    	<tbody>
                        	<tr>
                        		<td><?php echo $contact->companies_mail_address;  ?></td>
                      		</tr>
                        	<tr>
                        		<td><?php echo $contact->companies_mail_zip_code;  ?></td>
                       		</tr>
                        	<tr>
                        		<td><?php echo $contact->companies_mail_city;  ?></td>
                      		</tr>
                    	</tbody>
                	</table>
                </div>
                <div class="span2_5">
                	<table>
                    	<thead>
                        	<tr>
                        		<th>Fakturaadress</th>
                      		</tr>
                    	</thead>
                    	<tbody>
                        	<tr>
                        		<td><?php echo $contact->companies_billing_address;  ?></td>
                       		</tr>
                        	<tr>
                        		<td><?php echo $contact->companies_billing_zip_code;  ?></td>
                       		</tr>
                        	<tr>
                        		<td><?php echo $contact->companies_billing_city;  ?></td>
                      		</tr>
                    	</tbody>
                	</table>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="span12">
            <div class="span6">
                <fieldset>
                    <legend>Övrigt</legend>
                    <table>
                        <thead><?php if($contracts) : ?>
                            <th>Avtal </th><th> Filial</th>
                        </thead>
                        <tbody>
                        <?php foreach($contracts as $contract) : ?>
                            <tr><td><?php echo $contract->title ?> </td>
                            <td> <?php echo $contract->branch_title ?></td></tr>
                            <?php endforeach ?>
                            <tr><td></td></tr><tr><td></td></tr>
                        <?php endif ?>
                        <?php if($contacttypes) : ?>
                            <th>Kontakttyper</th><th>Filial</th>
                             <?php foreach($contacttypes as $contacttype) : ?>
                            <tr><td><?php  echo $contacttype->contact_types_title ?></td>
                            <td><?php  echo $contacttype->branches_title ?></td></tr>
                            <?php endforeach ?>
                            <tr><td></td></tr><tr><td></td></tr>
                        <?php endif ?>
                        <?php if($activities) : ?>
                            <th>Aktiviteter</th>
                            <?php foreach($activities  as $activity) : ?>
                            <tr><td><?php  echo $activity->title ?></td></tr>
                            <?php endforeach ?>
                            <?php //var_dump($contacttypes) ?>
                        <?php endif ?>
                    </tbody>
                </table>
                </fieldset>
            </div>
            <div class="span6">
                <fieldset>
                    <legend>Utskick</legend>
                    <?php foreach($showmailshots as $showmailshot) : ?>
                    <?php //echo $showmailshot->title ?>

                     <?php  foreach($branches as $branch) : ?>
                      <?php //foreach($showmailshots as $showmailshot) : ?>
                      <?php // echo $branch->title ?>

					<?php // foreach($mailshots as $mailshot) : ?>

                     <?php if($branch->title == $showmailshot->branches_title) :// && $mailshot->id == $showmailshot->id) : ?>
                             <?php //echo checkbox_checked('checkbox','_branch_'.$branch->id, $branch->title); ?> <?php  echo $showmailshot->title ?> i <?php echo $branch->title ?><br /><br />
                         <?php endif ?>
						<?php // endforeach ?>
                     <?php  endforeach ?> <?php endforeach ?>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="balloon_top2">
        <a href="deletecontact.php?id=<?php echo $contact->id ?>" class="btn btn-medium btn-primary" type="button">Ta bort</a>
    </div>
    <div class="balloon_top">
        <button class="btn btn-medium btn-primary btn-Action" type="button" onClick="printContent()">Skriv ut</button>
        <!--<button class="btn btn-medium btn-primary btn-Action" type="button">Exportera</button>-->
        <a href="exportcard.php?id=<?php echo $contact->id ?>" target="_blank" class="btn btn-medium btn-primary btn-Action" type="button">Exportera</a>
    </div>
    <div class="balloon">
        <button class="btn btn-medium btn-primary btn-Action" type="button" onClick="history.go(-1);">Tillbaka</button>
        <a href="editcontact.php?id=<?php echo $contact->id ?>" class="btn btn-medium btn-primary btn-Action" type="button">Redigera</a>
    </div>
</section>

<?php require_once(ROOT_PATH.'/footer.php'); ?>