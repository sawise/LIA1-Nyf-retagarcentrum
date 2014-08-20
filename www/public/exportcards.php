<?php
  require_once('../config.php');
  require_once(ROOT_PATH.'/classes/authorization.php');
  $page_title = "Visitkort";

 	$db = new Db();
    $contacts = $db->getContacts();
    //$manytomany = $db->getContactsBranchesContacttypes();
    $activities = $db->getActivities();
    $contacttypes = $db->getContacttypes();
    $branches = $db->getBranches();
    $mailshots = $db->getMailshots();

    $pages = null;
    $page = null;
    $sorttype = null;
    $sortby = null;
    $searchresults = null;
    $searchstring = null;
    $limit = null;
    $currenturl = $_SERVER['REQUEST_URI'];

    /*if(isset($_POST['search'])){
        header("Location: index.php?search=".$_POST['search']."&sortby=first_name&sorttype=ASC&page=1&limit=10");
    }*/

if(isset($_GET['search'])) {
    $searchstring = $_GET['search'];
    $sortby = $_GET['sortby'];
    $limit = $_GET['limit'];
    $page  = $_GET['page'];


    $search_contacttypes = null;
    $search_mailshots = null;
    $search_activities = null;

    $j = 0;
    foreach($contacttypes AS $contacttype) {
        if (isset($_GET['contacttypeid_'.$contacttype->id])) {
            if (isset($_GET['contacttypeid_'.$contacttype->id.'_date']) && $_GET['contacttypeid_'.$contacttype->id.'_date'] != 'null') {
                $search_contacttypes['contacttype_'.$j.'_date'] = $_GET['contacttypeid_'.$contacttype->id.'_date'];
            }  else {
                $search_contacttypes['contacttype_'.$j.'_date'] = null;
            } if (isset($_GET['contacttypeid_'.$contacttype->id.'_branch'])) {
                foreach ($_GET['contacttypeid_'.$contacttype->id.'_branch'] as $branch_id) {
                    $search_contacttypes['contacttype_'.$j.'_branch'][] = $branch_id;
                } //var_dump($search_contacttypes);
            } else {
                $search_contacttypes['contacttype_'.$j.'_branch'] = null;
            }
            $search_contacttypes['contacttype_'.$j] = $contacttype->id;
            $j++;
        }
    }

    $i = 0;
    foreach($mailshots AS $mailshot) {
        foreach ($branches as $branch) {
            if (isset($_GET['mailshot_'.$mailshot->id.'_branch_'.$branch->id])) {
                //$search_mailshots[] = 'mailshot_'.$mailshot->id.'_branch_'.$branch->id;
                $search_mailshots['mailshot_'.$i] = $mailshot->id;
                $search_mailshots['mailshot_'.$i.'_branch'] = $branch->id;
                $i++;
            }
        }
    }
    foreach($activities AS $activity) {
        if (isset($_GET['activity_'.$activity->id])) {
            $search_activities[] = $activity->id;
        }
    }
    $count = $db->search_count('contacts', $searchstring, $search_contacttypes, $search_mailshots, $search_activities);
    $count_search = $count->contacts;
    $pages = ceil($count_search / $limit);
    $start_from = ($page-1) * $limit;
    $searchresults = $db->advsearch($searchstring, $sortby, $_GET['sorttype'], $start_from, $limit, $search_contacttypes, $search_mailshots, $search_activities);

    $sorttype =  search_sorttype($_GET['sorttype']);

    //var_dump($searchresults);
}

?>

<?php require_once(ROOT_PATH.'/header.php');?>

<section class="search">
  <form class="form-search" method="get" action="exportcards.php">
    <div class="center-search">
      <input type="text" name="search" id="search-input" class="input-xxlarge search-query" placeholder="Sök">
      <button type="submit" class="btn btn-medium btn-primary btn-Action">Sök</button>
      <input onclick="if (this.value=='Avancerad sökning') this.value = 'Enkel sökning';
        else this.value = 'Avancerad sökning';" class="btn btn-medium btn-primary btn-Action" type="button" data-toggle="collapse" data-target="#search" value="Avancerad sökning" />
    </div>
    <div id="search" class="collapse out">
            <?php echo hidden_input('sortby', 'first_name') ?>
            <?php echo hidden_input('sorttype', 'ASC')?>
            <?php echo hidden_input('limit', '12') ?>
            <?php echo hidden_input('page', '1') ?>
            <div id="adv_left">
                <ul class="adv_search_list">
                    <li class="adv_li_title">Kontakttyp</li>
                    <?php foreach($contacttypes as $contacttype) : ?>
                        <?php if (isset($_GET['contacttypeid_'.$contacttype->id]) && isset($_GET['contacttypeid_'.$contacttype->id.'_date']) && isset($_GET['contacttypeid_'.$contacttype->id.'_branch'])) : ?>
                            <li><?php echo contact_types_adv_search('contacttypeid_'.$contacttype->id, $contacttype->title, $branches, 'Filial: ', 'id', $contacttype, $_GET['contacttypeid_'.$contacttype->id.'_branch'], 'checked', $_GET['contacttypeid_'.$contacttype->id.'_date']) ?></li>
                         <?php endif ?>
                        <?php if (isset($_GET['contacttypeid_'.$contacttype->id]) && isset($_GET['contacttypeid_'.$contacttype->id.'_date']) && !isset($_GET['contacttypeid_'.$contacttype->id.'_branch'])) : ?>
                            <li><?php echo contact_types_adv_search('contacttypeid_'.$contacttype->id, $contacttype->title, $branches, 'Filial: ', 'id', $contacttype, '', 'checked', $_GET['contacttypeid_'.$contacttype->id.'_date']) ?></li>
                         <?php endif ?>  
                         <?php if (isset($_GET['contacttypeid_'.$contacttype->id]) && !isset($_GET['contacttypeid_'.$contacttype->id.'_date']) && !isset($_GET['contacttypeid_'.$contacttype->id.'_branch'])) : ?>
                            <li><?php echo contact_types_adv_search('contacttypeid_'.$contacttype->id, $contacttype->title, $branches, 'Filial: ', 'id', $contacttype, '', 'checked') ?></li>
                         <?php endif ?>     
                         <?php if (isset($_GET['contacttypeid_'.$contacttype->id]) && !isset($_GET['contacttypeid_'.$contacttype->id.'_date']) && isset($_GET['contacttypeid_'.$contacttype->id.'_branch'])) : ?>
                            <li><?php echo contact_types_adv_search('contacttypeid_'.$contacttype->id, $contacttype->title, $branches, 'Filial: ', 'id', $contacttype, $_GET['contacttypeid_'.$contacttype->id.'_branch'], $contacttype, '', 'checked') ?></li>
                         <?php endif ?>                  
                         <?php if (!isset($_GET['contacttypeid_'.$contacttype->id])) : ?>
                            <li><?php echo contact_types_adv_search('contacttypeid_'.$contacttype->id, $contacttype->title, $branches, 'Filial: ', 'id', $contacttype) ?></li>
                         <?php endif ?>
                    <?php endforeach ?>
                </ul>
            </div>
            <div id="adv_right">
                <ul class="adv_search_list">
                    <li class="adv_li_title">Aktiviteter</li>
                    <?php foreach($activities as $activity) : ?>
                        <?php if (isset($_GET['activity_'.$activity->id])) : ?>
                        <li class="adv_li"><?php echo checkbox('checkbox', 'activity_'.$activity->id, $activity->title, $activity->date, $activity->branches_title, 'checked') ?></li>
                       <?php endif ?>
                       <?php if (!isset($_GET['activity_'.$activity->id])) : ?>
                        <li class="adv_li"><?php echo checkbox('checkbox', 'activity_'.$activity->id, $activity->title, $activity->date, $activity->branches_title) ?></li>
                       <?php endif ?>
                    <?php endforeach ?>
                    <br />
                    <li class="adv_li_title">Utskick</li>
                    <?php foreach($mailshots as $mailshot) : ?>
                    <li class="adv_li2"><?php echo $mailshot->title ?></li>
                        <div class="checkbox_child">
                            <?php foreach($branches as $branch) : ?>
                                <?php if (isset($_GET['mailshot_'.$mailshot->id.'_branch_'.$branch->id])) : ?>
                                    <li class="adv_li2"><?php echo checkbox('checkbox', 'mailshot_'.$mailshot->id.'_branch_'.$branch->id, $branch->title,'','', 'checked'); ?></li>
                                <?php endif ?>
                                <?php if (!isset($_GET['mailshot_'.$mailshot->id.'_branch_'.$branch->id])) : ?>
                                    <li class="adv_li2"><?php echo checkbox('checkbox', 'mailshot_'.$mailshot->id.'_branch_'.$branch->id, $branch->title); ?></li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
  </form>
  <div class="logo-img"><img src="img/NFClogo_195x90.png" /></div>
  <div id="textarea">
    <p>Rubrik:</p>
    <textarea id="caption" rows="4"></textarea>
  </div>
  <?php if($searchresults) : ?>
    <?php
      $number_of_results_in_column =  ceil(count($searchresults) / 2);
      $column_one_results = array_slice($searchresults, 0, $number_of_results_in_column);
      $column_two_results = array_slice($searchresults, count($column_one_results), count($searchresults));
    ?>
    <div class="row-fluid">
      <div class="span12">
        <div class="span6">
          <?php foreach($column_one_results as $searchresult) : ?>
            <div class="results">
              <table>
                <tbody>
                  <tr>
                    <td class="td_bold"> <?php echo full_name($searchresult->first_name, $searchresult->last_name).'<br>';  ?></td>
                  </tr>
                  <tr>
                    <td class="td_normal"> <?php echo $searchresult->companies_title.'<br>';  ?></td>
                  </tr>
                  <tr><td class="td_break">&nbsp;</td></tr>
                  <tr>
                    <td class="td_normal">
                      <?php
                        if($searchresult->cell_phone) {
                          echo $searchresult->cell_phone;
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
                        if($searchresult->work_phone) {
                          echo $searchresult->work_phone;
                          echo '<span class="grey"> Arbete<br></span>';
                        } else {
                          echo '<br>';
                        }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td class="td_normal"> <?php echo $searchresult->email.'<br>';  ?></td>
                  </tr>
                  <tr>
                    <td class="td_normal"> <?php echo $searchresult->companies_url.'<br>';  ?></td>
                  </tr>
                  <tr><td class="td_break">&nbsp;</td></tr>
                  <tr>
                    <td class="td_normal"> <?php echo $searchresult->companies_mail_address.'<br>';  ?></td>
                  </tr>
                  <tr>
                    <td class="td_normal"> <?php echo $searchresult->companies_mail_zip_code.'&nbsp;'; echo $searchresult->companies_mail_city.'<br>';  ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="span6">
          <?php foreach($column_two_results as $searchresult) : ?>
            <div class="results">
              <table>
                <tbody>
                  <tr>
                    <td class="td_bold"> <?php echo full_name($searchresult->first_name, $searchresult->last_name).'<br>';  ?></td>
                  </tr>
                  <tr>
                    <td class="td_normal"> <?php echo $searchresult->companies_title.'<br>';  ?></td>
                  </tr>
                  <tr><td class="td_break">&nbsp;</td></tr>
                  <tr>
                    <td class="td_normal">
                      <?php
                        if($searchresult->cell_phone) {
                          echo $searchresult->cell_phone;
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
                        if($searchresult->work_phone) {
                          echo $searchresult->work_phone;
                          echo '<span class="grey"> Arbete<br></span>';
                        } else {
                          echo '<br>';
                        }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td class="td_normal"> <?php echo $searchresult->email.'<br>';  ?></td>
                  </tr>
                  <tr>
                    <td class="td_normal"> <?php echo $searchresult->companies_url.'<br>';  ?></td>
                  </tr>
                  <tr><td class="td_break">&nbsp;</td></tr>
                  <tr>
                    <td class="td_normal"> <?php echo $searchresult->companies_mail_address.'<br>';  ?></td>
                  </tr>
                  <tr>
                    <td class="td_normal"> <?php echo $searchresult->companies_mail_zip_code.'&nbsp;'; echo $searchresult->companies_mail_city.'<br>';  ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
</section>
<div class="balloon">
  <button class="btn btn-medium btn-primary btn-Action" type="button" onClick="printContent()">Skriv ut</button>
</div>

<?php if($pages > 1 || isset($limit) && $limit  >= $count_search) : ?>
 	<?php echo search_bottom5($searchstring, $sortby, $_GET['sorttype'], $pages, $page, $limit, $count_search, $currenturl); ?>
<?php endif ?>

<style type="text/css">
	body {
	}
	.nav, .heading, .menu, .user_info, .logo-img {
		display:none;
	}
	 @media print {
      * {
        color: #000 !important;
        text-shadow: none !important;
        background: transparent !important;
        box-shadow: none !important;
		font-family:Arial, Helvetica, sans-serif;
      }
	  #caption {
		  border:none;
	  }
	  #textarea > p {
		  display:none;
	  }
	  .logo-img {
		  display:block;
		  padding-bottom:20px;
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
      .nav, .balloon, .balloon_top, .center-search, #search, .paginationn {
        display: none;
      }
	  section {
        margin-left:150px;
		padding:0;
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
	  .row-fluid {
	  }
      .span6 {
		margin:0;
		padding:0;
		width:320px;
      }
	  .results {
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
        margin:0;
		padding:0;
      }
    }
	  section {
		padding:0 0 20px 20px;
      }
      .span6 {
	  }
	  .results {
		  border:1px solid black;
		  padding:8px 0 8px 8px;
	  }
	  .row-fluid {
		  width:75%;
		  padding-left:70px;
	  }
	  .span12 {
		  margin:0;
		  padding:0;
	  }
	  .td_bold {
		  font-size:14px;
	  }
	  .td_break {
		  line-height:8px;
	  }
	  td {
		  font-size:12px;
		  line-height:14px;
	  }
	  .balloon {
		  margin-right:2em;
	  }
	  .grey {
		  color:#333;
	  }
	  #caption {
		  resize:none;
		  width:820px;
		  font-size:20px;
	  }
	  #textarea > p {
		  font-size:20px;
		  font-weight:bold;
		  padding-left:5px;
	  }
</style>
<?php require_once(ROOT_PATH.'/footer.php'); ?>
