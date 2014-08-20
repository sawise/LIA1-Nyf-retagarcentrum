<?php
  require_once('../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Ta bort Kontakt";

  $id = null;
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $db = new Db();
  $contact = $db->getContact($id);

  if (!$contact) {
    header('HTTP/1.0 404 not found');
    exit();
  }
?>
<?php require_once(ROOT_PATH.'/header.php'); ?>

<form class="form-horizontal" method="post" action="destroycontact.php?id=<?php echo $contact->id ?>">
  <section class="mailshots">
    <fieldset>
      <legend>Ta bort kontakt</legend>
      <div id="mailshots" class="collapse in">
        <table class="contact_type_options">
          <tr>
            <td>
              <input type="hidden" name="id" value="<?php echo $contact->id ?>">
              <p>Är du säker på att du vill ta bort <?php echo $contact->first_name.' '.$contact->last_name ?>?</p>
              <?php echo checkbox('checkbox', 'delete_company', 'Ta även bort företaget') ?>
            </td>
          </tr>
        </table>
      </div>
    </fieldset>
    <div class="balloon">
      <button class="btn btn-medium btn-primary btn-Action" type="button" onClick="history.go(-1);">Tillbaka</button>
      <button class="btn btn-medium btn-primary btn-Action" type="submit">Ta bort</button>
    </div>
  </section>
</form>

<?php require_once(ROOT_PATH.'/footer.php'); ?>