<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Skapa nytt utskick";

  $db = new Db();
  $mailshots = $db->getMailshots();
?>
<?php require_once(ROOT_PATH.'/header.php');?>
<form class="form-horizontal" method="post" action="create.php">
  <section class="mailshots">
    <fieldset>
      <legend>Utskick</legend>
      <div id="mailshots" class="collapse in">
        <table class="contact_type_options">
          <tr>
            <td class="contact_type_options_td">
              <?php echo form_input('text', 'control-label', 'title', 'Titel:', 'Ex. Nätverkslunch') ?>
            </td>
          </tr>
        </table>
        <table>
          <?php foreach($mailshots as $mailshot) : ?>
            <tr>
              <td><?php echo $mailshot->title ?></td>
              <td><a href="edit.php?id=<?php echo $mailshot->id  ?>">Redigera</a></td>
              <td>|</td>
              <td><a href="delete.php?id=<?php echo $mailshot->id  ?>">Ta bort</a></td>
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