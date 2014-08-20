<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Skapa ny kontakttyp";

  $db = new Db();
  $contacts = $db->getContacts();
  $branches = $db->getBranches();
  $contacttypes = $db->getContacttypes();
  $mailshots = $db->getMailshots();
  $manytomany = $db->getContactsBranchesContacttypes();

?>
<?php require_once(ROOT_PATH.'/header.php');?>

<form class="form-horizontal" method="post" action="create.php">
  <section class="contact_types">
    <fieldset>
      <legend>Kontakttyp</legend>
      <div id="contact_types" class="collapse in">
      	<table class="contact_type_options">
          <tr>
            <td class="contact_type_options_td">
              <?php echo form_input('text', 'control-label', 'title', 'Titel:', 'Ex. Försäljare') ?>
              <?php echo checkbox('checkbox', 'date', 'Kontakttypen kopplas till ett datum') ?>
              <?php echo checkbox('checkbox', 'branch', 'Kontakttypen kopplas till en filial') ?>
            </td>
          </tr>
        </table>
        <table>
          <?php foreach($contacttypes as $contacttype) : ?>
            <tr>
              <td>
                <?php echo $contacttype->title ?>
              </td>
              <td><a href="edit.php?id=<?php echo $contacttype->id  ?>">Redigera</a></td>
              <td>|</td>
              <td><a href="delete.php?id=<?php echo $contacttype->id  ?>">Ta bort</a></td>
            </tr>
          <?php endforeach ?>
        </table>
      </div>
    </fieldset>
    <div class="balloon">
      <button class="btn btn-medium btn-primary btn-Action" type="button" onClick="history.go(-1);">Tillbaka</button>
      <button class="btn btn-medium btn-primary btn-Action" type="submit">Skapa</button>
    </div>
  </section>
</form>

<?php require_once(ROOT_PATH.'/footer.php'); ?>