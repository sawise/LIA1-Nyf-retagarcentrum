<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Skapa ny aktivitet";

  $db = new Db();
  $activities = $db->getActivities();
  $branches = $db->getBranches();
  $lastactivitie = $db->getLastactivity();
?>
<?php require_once(ROOT_PATH.'/header.php');?>

<form class="form-horizontal" method="post" action="create.php">
  <section class="activities">
    <fieldset>
      <legend>Aktivitet</legend>
      <div id="activities" class="collapse in">
        <table class="contact_type_options">
          <tr>
            <td class="contact_type_options_td">
              <?php echo hidden_input('activity_id',$lastactivitie->id) ?>
              <?php echo form_input('text', 'control-label', 'title', 'Titel:', 'Ex. Bowlinglördag') ?>
            </td>
            <td class="contact_type_options_td5">
              <?php echo form_select('branch_id', 'Filial: ', $branches) ?>
            </td>
            <td class="contact_type_options_td">
              <div href="#" class="tooltip-date4" data-toggle="tooltip" title="Datum för aktiviteten. Måste skrivas som ÅÅÅÅ-MM-DD">
                <?php echo form_input('date', 'control-label', 'date', '', 'Startdatum') ?>
              </div>
            </td>
          </tr>
        </table>
        <table>
          <?php foreach($activities as $activity) : ?>
            <tr>
              <td>
                <?php echo $activity->title, " ", $activity->date, " ", $activity->branches_title ?>
              </td>
              <td><a href="edit.php?id=<?php echo $activity->id  ?>">Redigera</a></td>
              <td>|</td>
              <td><a href="delete.php?id=<?php echo $activity->id  ?>">Ta bort</a></td>
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