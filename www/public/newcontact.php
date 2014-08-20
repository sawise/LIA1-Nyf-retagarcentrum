<?php
    require_once('../config.php');
	require_once(ROOT_PATH.'/classes/authorization.php');
    $page_title = "Skapa ny kontakt";

    $db = new Db();
    $contacts = $db->getContacts();
    $contracts = $db->getContracts();
    $lastcontact = $db->getLastcontact();
    $lastcompany = $db->getLastcompany();
    $lastcontract = $db->getLastcontract();
    $branches = $db->getBranches();
    $contacttypes = $db->getContacttypes();
    $mailshots = $db->getMailshots();
    $manytomany = $db->getContactsBranchesContacttypes();
    $activities = $db->getActivities();
    $mailshotscontact = $db->getContactsMailshotsBranches();
?>

<?php require_once(ROOT_PATH.'/header.php');?>

<form class="form-horizontal"  method="post" action="createcontact.php">
    <section class="contact">
        <fieldset>
            <legend>Kontakt <input onclick="if (this.value=='Visa') this.value = 'Dölj';
                else this.value = 'Visa';" class="btn hide_button btn medium" type="button" data-toggle="collapse" data-target="#contact" value="Dölj"/></legend>
            <div id="contact" class="collapse in">
                <?php echo hidden_input('contact_id',$lastcontact->id) ?>
                <?php echo form_input('text', 'control-label', 'contact_firstname', 'Förnamn:', 'Förnamn') ?>
                <?php echo form_input('text', 'control-label', 'contact_lastname', 'Efternamn:', 'Efternamn') ?>
                <?php echo form_input('email', 'control-label', 'contact_email', 'E-post:', 'E-post') ?>
                <?php echo form_input('text', 'control-label', 'contact_cellphone', 'Mobil:', 'Mobil') ?>
                <?php echo form_input('text', 'control-label', 'contact_workphone', 'Arbetstelefon:', 'Arbetstelefon') ?>

                <?php echo checkbox('checkbox', 'contact_contactperson', 'Kontaktperson') ?>
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
                            <?php echo hidden_input('company_id',$lastcompany->id) ?>
                            <?php echo form_input('text', 'control-label', 'company_title', 'Företagsnamn:', 'Företagsnamn') ?>
                            <?php echo form_input('text', 'control-label', 'company_alt_title', 'Företagsnamn:', 'Alt. företagsnamn') ?>
                            <?php echo form_input('text', 'control-label', 'company_url', 'Webbadress:', 'Webbadress') ?>
                            <?php echo form_input('text', 'control-label', 'company_email', 'E-post:', 'exempel@hotmail.com') ?>
                            <?php echo form_input('text', 'control-label', 'company_cellphone', 'Mobil:', 'Mobil') ?>
                            <?php echo form_input('text', 'control-label', 'company_billed', 'Fakturerat:', 'Fakturerat') ?>
                            <?php echo form_input('text', 'control-label', 'company_total', 'Summa:', 'Summa') ?>
                            <?php echo form_input('text', 'control-label', 'company_reference', 'Er referens:', 'Er referens') ?>

                            <?php echo form_input('text', 'control-label', 'company_visit_address', 'Besöksadress:', 'Besöksadress') ?>
                            <?php echo form_input('text', 'control-label', 'company_visit_zip_code', 'Postnummer:', 'Postnummer') ?>
                            <?php echo form_input('text', 'control-label', 'company_visit_city', 'Stad:', 'Stad') ?>
                        </td>
                        <td id="company-right">
                            <button class="btn btn-action btn-mini" type="button" onclick="HideElements('hide_mail_address')">Skriv in postadress</button>
                            <div id="hide_mail_address">
                                <?php echo form_input('text', 'control-label', 'company_mail_address', 'Postadress:', 'Postadress') ?>
                                <?php echo form_input('text', 'control-label', 'company_mail_zip_code', 'Postnummer:', 'Postnummer') ?>
                                <?php echo form_input('text', 'control-label', 'company_mail_city', 'Stad:', 'Stad') ?>
                            </div>

                            <button class="btn btn-action btn-mini" type="button" onclick="HideElements('hide_billing_address')">Skriv in faktureringsadress</button>
                            <div id="hide_billing_address">
                                <?php echo form_input('text', 'control-label', 'company_billing_address', 'Faktureringsadress:', 'Faktureringsadress') ?>
                                <?php echo form_input('text', 'control-label', 'company_billing_zip_code', 'Postnummer:', 'Postnummer') ?>
                                <?php echo form_input('text', 'control-label', 'company_billing_city', 'Stad:', 'Stad') ?>
                            </div>
                        </td>
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
                    <?php echo contact_types($contract->id, $contract->title, '', $branches, 'Filial: ', 'id', 'contractid_'.$contract->id.'_branch', 'contractid_', $contract) ?>
                    <div id="written">
                        <?php echo checkbox('checkbox', 'contractid_'.$contract->id.'_written', 'Avtalet är skriftligt') ?>
                    </div>
                <?php endforeach ?>
            </div>
        </fieldset>
    </section>

    <section class="activities">
        <fieldset>
            <legend>Aktiviteter <input id="activity_input" onclick="ScrollFunction('activity_input')" class="btn hide_button btn medium" type="button" data-toggle="collapse" data-target="#activities" value="Visa" /></legend>
            <div id="activities" class="collapse out">
                <?php foreach($activities as $activity) : ?>
                    <?php echo checkbox('checkbox', 'activity_'.$activity->id, $activity->title, $activity->date, $activity->branches_title) ?>
                <?php endforeach ?>
            </div>
        </fieldset>
    </section>

    <section class="contact_type">
        <fieldset>
            <legend>Kontakttyper <input id="contacttype_input" onclick="ScrollFunction('contacttype_input')" class="btn hide_button btn medium " type="button" data-toggle="collapse" data-target="#contact_type" value="Visa" /></legend>
            <div id="contact_type" class="collapse out">
                <?php foreach($contacttypes as $contacttype) : ?>
                    <?php echo contact_types($contacttype->id, $contacttype->title, '', $branches, 'Filial: ', 'id', 'contacttypeid_'.$contacttype->id.'_branch', 'contacttypeid_', $contacttype) ?>
                <?php endforeach ?>
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
                            <?php foreach($branches as $branch) : ?>
                                <?php echo checkbox('checkbox', 'mailshot_'.$mailshot->id.'_branch_'.$branch->id, $branch->title); ?>
                            <?php endforeach ?>
                        </div>
                <?php endforeach ?>
            </div>
        </fieldset>
    </section>

    <section class="notes_section">
        <fieldset>
            <legend>Anteckningar<input id="notes_input" onclick="ScrollFunction('notes_input')" class="btn hide_button medium" type="button" data-toggle="collapse" data-target="#notes_area" value="Visa" /></legend>
            <div id="notes_area" class="collapse out">
                <?php echo text_area('notes', 'Kommentar'); ?>
                <p><input readonly type="text" name="countdown" value="1000" readonly="readonly" id="remain"></p>
            </div>
        </fieldset>

        <div class="balloon">
            <button class="btn btn-medium btn-primary btn-Action" type="button" onClick="history.go(-1);">Tillbaka</button>
            <button class="btn btn-medium btn-primary btn-Action" type="submit">Skapa</button>
        </div>
    </section>
</form>

<?php require_once(ROOT_PATH.'/footer.php'); ?>