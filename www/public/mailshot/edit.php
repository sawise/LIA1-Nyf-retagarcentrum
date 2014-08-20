<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Redigera Utskick";

  $id = null;
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $db = new Db();
  $mailshot = $db->getMailshot($id);
?>
<?php require_once(ROOT_PATH.'/header.php');?>
<form class="form-horizontal" method="post" action="update.php">
  <section class="mailshots">
    <fieldset>
      <legend>Redigera <?php echo $mailshot->title ?></legend>
      <div id="mailshots" class="collapse in">
        <table class="contact_type_options">
          <tr>
            <td class="contact_type_options_td">
              <input type="hidden" name="id" value="<?php echo $mailshot->id ?>">
              <?php echo form_input('text', 'control-label', 'title', 'Titel:', "", $mailshot->title) ?>
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