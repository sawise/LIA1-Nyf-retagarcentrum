<?php
  require_once('../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');

  $id = null;
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
  }

  $db = new Db();
  $contact = $db->getContact($id);
  $page_title = full_name($contact->first_name, $contact->last_name);
?>
<?php require_once(ROOT_PATH.'/header.php');?>

<section class="indent-1">
  <section>
    <div class="span6">
      <table>
        <tbody>
          <tr>
            <td class="td_bold"> <?php echo full_name($contact->first_name, $contact->last_name).'<br>';  ?></td>
          </tr>
          <tr>
            <td class="td_normal"> <?php echo $contact->companies_title.'<br>';  ?></td>
          </tr>
          <tr><td class="td_break">&nbsp;</td></tr>
          <tr>
            <td class="td_normal">
              <?php
                if($contact->cell_phone) {
                  echo $contact->cell_phone;
                  echo '<span class="grey"> Mobil<br></span>';
                } else {
                  echo '<br>';
                }
              ?>
            </td>
          </tr>
          <tr>
            <td class="td_normal">
              <?php
                if($contact->work_phone) {
                  echo $contact->work_phone;
                  echo '<span class="grey"> Arbete<br></span>';
                } else {
                  echo '<br>';
                }
              ?>
            </td>
          </tr>
          <tr>
            <td class="td_normal"> <?php echo $contact->email.'<br>';  ?></td>
          </tr>
          <tr>
            <td class="td_normal"> <?php echo $contact->companies_url.'<br>';  ?></td>
          </tr>
          <tr><td class="td_break">&nbsp;</td></tr>
          <tr>
            <td class="td_normal"> <?php echo $contact->companies_mail_address.'<br>';  ?></td>
          </tr>
          <tr>
            <td class="td_normal"> <?php echo $contact->companies_mail_zip_code.'&nbsp;'; echo $contact->companies_mail_city.'<br>';  ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</section>
<p id="print-button">
  <button class="btn btn-medium btn-primary btn-Action" type="button" onClick="printContent()">Skriv ut</button>
</p>

<style type="text/css">
  body {
    background:none;
  }
  header, .nav, .heading, .menu, .user_info {
    display:none;
  }
  @media print {
  * {
      color: #000 !important;
      text-shadow: none !important;
      background: transparent !important;
      box-shadow: none !important;
    }
    a,
    a:visited {
      text-decoration: underline;
    }
    a[href]:after {
      content: " (" attr(href) ")";
    }
    abbr[title]:after {
      content: " (" attr(title) ")";
    }
    .ir a:after,
    a[href^="javascript:"]:after,
    a[href^="#"]:after {
      content: "";
    }
    .grey {
      color:#333 !important;
    }
    pre,
    blockquote {
      border: 1px solid #999;
      page-break-inside: avoid;
    }
    thead {
      display: table-header-group;
    }
    tr,
    img {
      page-break-inside: auto;
    }
    img {
      max-width: 100% !important;
    }
    @page  {
      margin: 0.5cm;
    }
    p,
    h2,
    h3 {
      orphans: 3;
      widows: 3;
    }
    h2,
    h3 {
      page-break-after: avoid;
    }
    header, .nav, .balloon, .balloon_top, #print-button {
      display: none;
    }
    legend {
      display: block;
      width: 100%;
      padding: 0;
      margin-bottom: 20px;
      font-size: 21px;
      line-height: 40px;
      color: #333333;
      border: 0;
      border-bottom: 1px solid #e5e5e5;
    }
    section {
      margin: 0;
      padding: 0;
      width: 500px;
      border: none;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      border-radius: 0px;
      -webkit-box-shadow: 0 rgba(0,0,0,0);
      -moz-box-shadow: 0 rgba(0,0,0,0);
      box-shadow: 0 rgba(0,0,0,0);
    }
    .contactshow {
      margin-bottom: 5em;
    }
    .row {
      margin-left: 0px;
      margin-bottom:10px;
    }
    .span6 {
      display: block;
      width: 200px;
      margin:0;
      padding:0;
      clear:both;
    }
    fieldset {
      padding: 0;
      margin: 0;
      border: 0;
    }
    td {
      margin-bottom: -20px;
      margin-top: -10px;
    }
    .span12 {
      display: block;
      float:left;
      width: 940px;
      clear:both;
    }
    .span3 {
      display: block;
      float:left;
      width: 220px;
    }
    .span2_5 {
      display: block;
      float:left;
      width: 180px;
    }
    .offset1 {
      margin-left: 100px;
    }
  }
  section {
    border:none;
  }
  section > section {
    float:left;
  }
  .span6 {
    width:275px;
    border:1px solid black;
    padding:8px 0 8px 8px;
    clear:both;
  }
  table {
    font-family:Arial, Helvetica, sans-serif;
  }
  .td_bold {
    font-weight:bold;
    font-size:14px;
  }
  .td_break {
    line-height:8px;
  }
  td {
    font-size:12px;
    line-height:14px;
  }
  .grey {
    color:#333;
  }
  #print-button {
    margin:50px;
  }
</style>

<?php require_once(ROOT_PATH.'/footer.php'); ?>