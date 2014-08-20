<?php
    require_once('../config.php');
	require_once(ROOT_PATH.'/classes/authorization.php');
    $page_title = "Export";

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

  if(isset($_GET['search'])) {
    $searchstring = $_GET['search'];
    $sortby = $_GET['sortby'];
    $limit = $_GET['limit'];
    $page  = $_GET['page'];
    $count = $db->search_count('contacts', $searchstring);
    $count_search = $count->contacts;
    $pages = ceil($count_search / $limit);
      $start_from = ($page-1) * $limit;

        $search_contacttypes = null;
        $search_mailshots = null;
        $search_activities = null;

        foreach($contacttypes AS $contacttype) {
            if (isset($_GET['contacttypeid_'.$contacttype->id])) {
                $search_contacttypes[] = $contacttype->id;
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
      $searchresults = $db->advsearch($searchstring, $sortby, $_GET['sorttype'], $start_from, $limit, $search_contacttypes, $search_mailshots, $search_activities);
      $sorttype =  search_sorttype($_GET['sorttype']);
    }
?>
<?php
  $file_name = "csv-".date('dmy-His');
  header("Pragma: public");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Content-Type: application/download");
  header("Content-Disposition: attachment;filename=$file_name.csv");
  header("Content-Transfer-Encoding: binary ");
?>
Förnamn;Efternamn;Företag;Språk;Mobilnr;E-post;
<?php foreach($searchresults as $searchresult) : ?>
<?php echo $searchresult->first_name?>;<?php echo $searchresult->last_name?>;<?php echo $searchresult->companies_title?>;<?php echo "" ?>;<?php echo $searchresult->cell_phone?>;<?php echo $searchresult->email?>;
<?php endforeach ?>
<?php exit(); ?>