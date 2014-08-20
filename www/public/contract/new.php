<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Skapa nytt Avtal";

  $db = new Db();
  $contracts = $db->getContracts();
?>
<?php require_once(ROOT_PATH.'/header.php');?>
<form class="form-horizontal" method="post" action="create.php">
  <section class="contracts">
    <fieldset>
      <legend>Avtal</legend>
      <div id="contracts" class="collapse in">
        <table class="contact_type_options">
          <tr>
            <td class="contact_type_options_td">
              <?php echo form_input('text', 'control-label', 'title', 'Titel:', 'Ex. DHL-avtal') ?>
            </td>
          </tr>
        </table>
        <table>
          <?php foreach($contracts as $contract) : ?>
            <tr>
              <td><?php echo $contract->title ?></td>
              <td><a href="edit.php?id=<?php echo $contract->id  ?>">Redigera</a></td>
              <td>|</td>
              <td><a href="delete.php?id=<?php echo $contract->id  ?>">Ta bort</a></td>
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