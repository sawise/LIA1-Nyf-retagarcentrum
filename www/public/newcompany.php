<?php
  require_once('../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Skapa nytt Företag";

  $db = new Db();
  
  $contact_id = null;
  if (isset($_GET['id'])) {
    $contact_id = $_GET['id'];
  }

  $contacts = $db->getContacts();
  $branches = $db->getBranches();
  $contacttypes = $db->getContacttypes();
  $mailshots = $db->getMailshots();
  $manytomany = $db->getContactsBranchesContacttypes();
  $companies = $db->getCompanies();

?>
<?php require_once(ROOT_PATH.'/header.php');?>

<form class="form-horizontal" method="post" action="createcompany.php">
  <section class="contact_types">
    <fieldset>
      <legend>Företag</legend>
      <div id="company">
        <table class="company">
          <tr>
            <td id="company-left">
              <?php if (isset($_GET['id'])) : ?>
                <?php echo hidden_input('contact_id',$contact_id) ?>
              <?php endif ?>
              <?php echo form_input('text', 'control-label', 'company_title', 'Företagsnamn:', 'Företagsnamn') ?>
              <?php echo form_input('text', 'control-label', 'company_alt_title', 'Företagsnamn:', 'Alt. företagsnamn') ?>
              <?php echo form_input('text', 'control-label', 'company_url', 'Webbadress:', 'Webbadress') ?>
              <?php echo form_input('text', 'control-label', 'company_email', 'E-post:', 'exempel@hotmail.com') ?>
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
        <table>
          <?php foreach($companies as $company) : ?>
            <tr>
              <td><?php echo $company->title ?></td>
              <td><a href="editcompany.php?id=<?php echo $company->id  ?>">Redigera</a></td>
              <td>|</td>
              <td><a href="deletecomapny.php?id=<?php echo $company->id  ?>">Ta bort</a></td>
            </tr>
          <?php endforeach ?>
        </table>
      </fieldset>
      <div class="clear"></div>
    </div>
    <div class="balloon">
      <button class="btn btn-medium btn-primary btn-Action" type="button" onClick="history.go(-1);">Tillbaka</button>
      <button class="btn btn-medium btn-primary btn-Action" type="submit">Skapa</button>
    </div>
  </section>
</form>

<?php require_once(ROOT_PATH.'/footer.php'); ?>