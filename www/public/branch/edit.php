<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Redigera Filialen";

  $id = null;
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $db = new Db();
  $branch = $db->getBranch($id);
?>
<?php require_once(ROOT_PATH.'/header.php');?>

<form class="form-horizontal" method="post" action="update.php">
  <section class="branches">
    <fieldset>
      <legend>Redigera <?php echo $branch->title ?></legend>
      <div id="branches" class="collapse in">
        <table class="contact_type_options">
          <tr>
            <td class="contact_type_options_td">
              <input type="hidden" name="id" value="<?php echo $branch->id ?>">
              <?php echo form_input('text', 'control-label', 'title', 'Titel:', "", $branch->title) ?>
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