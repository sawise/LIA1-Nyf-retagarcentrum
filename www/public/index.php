<?php
    require_once('../config.php');
    require_once(ROOT_PATH.'/classes/authorization.php');
    $page_title = "Sök";

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

    <form class="form-search" method="get" action="index.php">
        <section class="search">
        <div class="center-search">
            <input type="text" name="search" id="search-input" class="input-xxlarge search-query" placeholder="Sök" value="<?php echo $searchstring ?>">
            <button type="submit" class="btn btn-medium btn-primary btn-Action">Sök</button>
            <input onclick="if (this.value=='Avancerad sökning') this.value = 'Enkel sökning';
                else this.value = 'Avancerad sökning';" class="btn btn-medium btn-primary btn-Action" type="button" data-toggle="collapse" data-target="#search" value="Avancerad sökning" />
        </div>
        <div id="search" class="collapse out">
            <?php echo hidden_input('sortby', 'first_name') ?>

            <?php echo hidden_input('sorttype', 'ASC')?>
            <?php echo hidden_input('limit', '20') ?>
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
        <table class="table table-striped">
            <th><a href="<?php echo $currenturl.'&sortby=first_name&sorttype='.$sorttype ?>">Förnamn</a></th>
            <th><a href="<?php echo $currenturl.'&sortby=last_name&sorttype='.$sorttype ?>">Efternamn</a></th>
            <th><a href="<?php echo $currenturl.'&sortby=email&sorttype='.$sorttype  ?>">E-post</a></th>
            <th><a href="<?php echo $currenturl.'&sortby=cell_phone&sorttype='.$sorttype ?>">Mobil</a></th>
            <th><a href="<?php echo $currenturl.'&sortby=companies_title&sorttype='.$sorttype  ?>">Företagsnamn</a></th>
            <th></th>
         </thead>
         <tbody>
            <tr>
            <?php if($searchresults) : ?>
            <?php foreach($searchresults as $searchresult) : ?>
                <td><?php echo $searchresult->first_name.'<br>';  ?></td>
                <td><?php echo $searchresult->last_name.'<br>';  ?></td>
                <td><?php echo $searchresult->email.'<br>';  ?></td>
                <td><?php echo $searchresult->cell_phone.'<br>';  ?></td>
                <td><?php echo $searchresult->companies_title.'<br>';  ?></td>
                <td><a href="showcontact.php?id=<?php echo $searchresult->id  ?>" class="btn btn-mini btn-primary btn-Action" type="button">Mer info</button></td>
                <!--<td><?php //echo checkbox('checkbox', 'ContactsExport', '', '', '', ''); ?></td>-->
            </tr>

            <?php endforeach ?>

          <!--  <div id="back">
                <a href="index.php" class="btn btn-mini btn-info" type="button"> Tillbaka </button></a>
                <button class="btn btn-mini btn-inverse" type="button" onClick="history.go(-1);">Tillbaka</button>
            </div> -->
        </tbody>
        </table>

            <?php endif; ?>
    </section>
    <?php if(isset($searchresult)) : ?>
        <div class="exportjobs">
           <a href="exportjobs.php?<?php echo $db->currentPageURL() ?>" target="_blank" class="btn btn-medium btn-primary" type="button">Exportera till jobs</a>
        </div>
    <?php endif; ?>
    <div class="exportcard">
        <a href="exportcards.php" target="_blank" class="btn btn-medium btn-primary btn-Action" type="button">Exportera visitkort</a>
    </div>

    <?php if($pages > 1 || isset($limit) && $limit  >= $count_search) : ?>
        <?php echo search_bottom4($searchstring, $sortby, $_GET['sorttype'], $pages, $page, $limit, $count_search, $currenturl); ?>
    <?php endif ?>

<?php require_once(ROOT_PATH.'/footer.php'); ?>