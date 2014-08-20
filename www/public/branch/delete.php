<?php
  require_once('../../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Ta bort Filial";

  $id = null;
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $db = new Db();
  $branch = $db->getBranch($id);

  if (!$branch) {
    header('HTTP/1.0 404 not found');
    exit();
  }
?>
<?php require_once(ROOT_PATH.'/header.php'); ?>

<form class="form-horizontal" method="post" action="destroy.php">
  <section class="branches">
    <fieldset>
      <legend>Ta bort <?php echo $branch->title ?></legend>
      <div id="branches" class="collapse in">
        <table class="contact_type_options">
          <tr>
            <td>
              <input type="hidden" name="id" value="<?php echo $branch->id ?>">
              <p>Är du säker på att du vill ta bort <?php echo $branch->title ?>?</p>
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