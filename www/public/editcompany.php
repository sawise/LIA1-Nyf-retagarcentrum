<?php
  require_once('../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Redigera Företag";

  $id = null;
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $db = new Db();
  $company = $db->getCompany($id);
?>
<?php require_once(ROOT_PATH.'/header.php');?>
<form class="form-horizontal" method="post" action="updatecompany.php">
  <section class="company">
    <fieldset>
      <legend>Redigera <?php echo $company->title ?></legend>
      <div id="companies" class="collapse in">
        <table class="company">
          <tr>
            <td id="company-left">
              <input type="hidden" name="company_id" value="<?php echo $company->id ?>">
              <?php echo form_input('text', 'control-label', 'company_title', 'Företagsnamn:', '', $company->title) ?>
              <?php echo form_input('text', 'control-label', 'company_alt_title', 'Företagsnamn:', '', $company->alt_title) ?>
              <?php echo form_input('text', 'control-label', 'company_url', 'Webbadress:', '', $company->url) ?>
              <?php echo form_input('text', 'control-label', 'company_email', 'E-post:', '', $company->email) ?>
              <?php echo form_input('text', 'control-label', 'company_billed', 'Fakturerat:', '', $company->billed) ?>
              <?php echo form_input('text', 'control-label', 'company_total', 'Summa:', '', $company->total) ?>
              <?php echo form_input('text', 'control-label', 'company_reference', 'Er referens:', '', $company->reference) ?>

              <?php echo form_input('text', 'control-label', 'company_visit_address', 'Besöksadress:', '', $company->visit_address) ?>
              <?php echo form_input('text', 'control-label', 'company_visit_zip_code', 'Postnummer:', '', $company->visit_zip_code) ?>
              <?php echo form_input('text', 'control-label', 'company_visit_city', 'Stad:', '', $company->visit_city) ?>
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
          </tr>
        </table>
      </div>
    </fieldset>
    <div class="balloon">
      <button class="btn btn-medium btn-primary btn-Action" type="button" onClick="history.go(-1);">Tillbaka</button>
      <button class="btn btn-medium btn-primary btn-Action" type="submit">Spara</button>
    </div>
  </section>
</form>

<?php require_once(ROOT_PATH.'/footer.php'); ?>