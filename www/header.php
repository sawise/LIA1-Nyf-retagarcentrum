<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $page_title; ?></title>
    <link href="/css/bootstrap.css" rel="stylesheet" media="screen">
    <!-- CSS STYLE START -->
    <style type="text/css">
      body {
        background:url(/img/bg.png) fixed;
        background-size:cover;
       	height: 100%;

      }
      header .img-polaroid {
        margin: 10px 0 0 10px;
        position: fixed;
        float: left;

      }
      section {
        margin: 0 auto 10px;
        padding: 0 5px 0 5px;
        width: 860px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
-webkit-border-radius: 5px;
   -moz-border-radius: 5px;
        border-radius: 5px;
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
   -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .row {
        margin-left: 0px;
        margin-bottom:10px;
      }
      .span6 {
        width: 430px;
      }
      .span12 {
        width: 860px;
      }
      .offset1 {
        margin-left: 100px;
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
      header, .nav, .balloon, .balloon_top, .well, .pagination, .balloon_top2 {
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
        width: 860px;
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
        float:left;
        width: 430px;
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
      .heading {
        position: absolute;
        bottom: 0;
      }
      .heading-holder {
        margin: 0 auto;
        width: 870px;
        height: 60px;
        position: relative;
      }
      .form-horizontal .control-label {
        width: 120px;
        padding-top: 5px;
            text-align: left;
      }
      .form-horizontal .controls {
        *display: inline-block;
        *padding-left: 20px;
        margin-left: 140px;
        *margin-left: 0;
      }
      .hide_button {
        float: right;
        position: inherit;
        margin-right: -5px;
        height: 40px;
      }
      .collapse {
        margin-bottom: -20px;
      }
      .collapse.in {
        margin-bottom: 0px;
      }
      h1 {
        color:#FFF;
      }
      .checkbox_child {
        margin-left:20px;
      }
      .balloon {
        float:right;
        position:fixed;
        right:1em;
        bottom:1em;
        z-index:1;
      }
      .balloon_top {
        float:right;
        position:fixed;
        right:1em;
        bottom:3.6em;
        z-index:1;
      }
	  .balloon_top2 {
		float:right;
        position:fixed;
        right:1em;
        bottom:6.2em;
        z-index:1;
	  }
      .balloonpages {
        float:left;
        /*position:fixed;*/
        margin-left: 2.5em;
        margin-bottom:1em;
        margin-top:-0.4em;
      }
      .pagination.balloon {
        margin: 0;
      }
      .nav {
        width: 205px;
        margin-left: 10px;
        margin-top: 120px;
        position: fixed;
      }
      .search {
      }
      .form-search {
        float:none;
        margin: 0;
      }
      .center-search {
        margin: 40px 10px 10px 80px;
      }
      #search {
        width:100%;
        margin: 0px 10px 10px 80px;
      }
      .control-group {
        margin-top:10px;
      }
      .form-horizontal > .contact_types select {
        display: inline-block;
        *display: inline;
        margin-bottom: 0;
        vertical-align: middle;
        *zoom: 1;
        margin-left: 120px;
      }
      .control-group {
        margin-bottom: 10px;
      }
      .form-horizontal .control-group {
        margin-bottom: 10px;
        *zoom: 1;
      }
      .contact_type_options {
        margin-bottom:20px;
        width:100%;
      }
      .contact_type_options {
        /*margin-bottom:20px;*/
        width:100%;
      }
      .contact_type_options_td {
        padding-top:1.2em;
        width:30%;
        float:left;
      }
      .contact_type_options_td1 {
        padding-top:1em;
        width:30%;
        float:left;
      }
      .contact_type_options_td2 {
        width:30%;
        float:left;
      }
      .contact_type_options_td3 {
        width:40%;
      }
      .contact_type_options_td4 {
        width:20%;
      }
      .contact_type_options_td5 {
        width:30%;
        float:left;
        margin:13px -50px -13px 30px;
        /*margin-left:20px;
        margin-top:13px;*/
      }
      .contact_type_options_td6 {
        padding-top:10px;
        padding-bottom:10px;
        width:40%;
        float:left;
        margin-right:-7em;
      }
      .contact_type_options_td7 {
        width:46%;
      }
      .contract .contact_type_options_td {
        padding-top:1em;
        padding-bottom:0.5em;
        width:25%;
        float:left;
        margin-right:-1em;
      }
      .tooltip-date {
        float:right;
      }
      .tooltip-date2 {
        float:left;
        margin:-10px 0 -10px -40px;
      }
      .tooltip-date3 {
        float:left;
        margin:-5px 0 0 -110px;
      }
      .tooltip-date4 {
        width:73%;
      }
      .form-horizontal .contact_type_options_td .control-label {
        width: 20px;
        padding-top: 5px;
        text-align: left;
      }
      .form-horizontal .contact_type_options_td  .controls {
        *display: inline-block;
        *padding-left: 20px;
        margin-left: 40px;
        *margin-left: 0;
        }
      .form-horizontal .contact_types .contact_type_options_td select {
        margin-left: 0px;
        margin-right: 0px;
      }
      input[type="date"] {
        width: 135px;
        margin-bottom: -5px;
        margin-top: -2,5px;
      }
      #back {
        margin-left:792px;
        margin-top:-8px;
        margin-bottom:5px;
      }
      td {
        margin-bottom: -20px;
        margin-top: -10px;
      }
      #company {
        width:100%;
      }
      #company-left {
        width:50%;
        padding-right:5em;
      }
      #company-right {
        width:50%;
        padding-bottom:9em;
      }
      #pagelimit {
        border: 1px solid #dddddd;
        float: right;
        margin-left: 100px;
      }
      #search-input {
        height:22px;
      }
      #hide_mail_address, #hide_billing_address{
        visibility: hidden;
        left: 0;
      }
      .notes_section {
        margin-bottom:55em;
      }
      .td_bold {
        font-weight:bold;
        padding-right:5px;
      }
      .contactshow {
        margin-bottom: 5em;
      }
      .adv_li_title {
        font-weight:bold;
        font-size:18px;
        padding-bottom:5px;
      }
      .adv_search_list {
        list-style-type:none;
        padding:0;
        margin:0.5em 0 1em 1em;
      }
      #adv_left {
        width:90%;
        display:inline-block;
        *display:inline;
        float:left;
        margin-right:-26em;
      }
      #adv_right {
        width:40%;
        display:inline-block;
        *display:inline;
        position:relative;
      }
      .adv_search_select {
        width:45%;
      }
      .adv_li {
        padding-bottom:10px;
      }
      .adv_li2 {
        padding-bottom:4px;
      }
      #notes {
        margin-left:1em;
        margin-bottom:0.5em;
        width:350px;
        max-width: 800px;
        max-height: 400px;
      }
      #remain {
        margin-left:1em;
        width:34px;
      }
      .menu > a {
        color:#FFF;
      }
      a.menu-link:hover {
        color:#000;
      }
      .nav-header{
        color:#9F9FFF;
      }
      #show_company {
      }
      th {
        text-align: left;
      }
      #select_branch {
        width:70%;
      }
      .contract #written .checkbox {
        float:right;
        width:20%;
        margin:-2.2em 3.2em 0 0;
      }
	  .pagination ul > li > a.pagelink:hover {
		background-color: #FFF;
		color:#08c;
	  }
	  .exportjobs {
		float:right;
        position:fixed;
        right:2em;
        bottom:6.5em;
        z-index:1;
	  }
	  .exportcard {
		float:right;
        position:fixed;
        right:1.6em;
        bottom:4em;
        z-index:1;
      }
	  #user_info {
		float:right;
        position:fixed;
        top:0px;
		right:0px;
       	z-index:1;
		width:200px;
		height:20px;
	  }
	  #user_info > p {
		  padding-left:5px;
	  }
	  #user_info > p > span {
		  text-transform:uppercase;
	  }
	  .alert {
		  position:absolute;
		  z-index:10000;
		  width:13.5em;
		  text-align:center;
		  left:auto;
		  right:auto;
	  }
    </style>
    <!-- CSS STYLE END -->

    <!-- JavaScript -->
    <script type="text/javascript">
      window.onload = function() {
        $(document).ready(function(){
          $('.tooltip-date').tooltip({'placement':'right', 'trigger':'hover'});
          $('.tooltip-date2').tooltip({'placement':'right', 'trigger':'hover'});
          $('.tooltip-date3').tooltip({'placement':'right', 'trigger':'hover'});
          $('.tooltip-date4').tooltip({'placement':'right', 'trigger':'hover'});
        });
      }

      function ScrollFunction(target) {
        var showsection = document.getElementById(target);
        if (showsection.value == 'Visa') {
          showsection.value = 'Dölj';
        } else {
          showsection.value = 'Visa';
        }
        //setTimeout(function() {showsection.scrollIntoView();},180);
        showsection.scrollIntoView();
      }

      function LimitText(limitField, limitCount, limitNum) {
        if (limitField.value.length > limitNum) {
          limitField.value = limitField.value.substring(0, limitNum);
        } else {
          limitCount.value = limitNum - limitField.value.length;
        }
      }

      function HideElements(target) {
        var hideshow = document.getElementById(target);
        if(hideshow.style.visibility == 'hidden' || hideshow.style.visibility == '') {
          hideshow.style.visibility="visible";
        } else {
          hideshow.style.visibility="hidden";
        }
      }

      function printContent(id){
        window.print();
      }

	  //http://www.htmlforums.com/client-side-scripting/t-simulate-ctrl-presshold-117760.html
	  	var previous	= new Array();
		var lastClicked = '';

		function addEvent(obj, evType, fn)
		{
			if(obj.addEventListener)
			{
				obj.addEventListener(evType, fn, false);
				return true;
			}
			else if(obj.attachEvent)
			{
				var r = obj.attachEvent('on' + evType, fn);
				return r;
			}
			else
			{
				return false;
			}
		}

		addEvent(window, 'load', begin);

		function begin()
		{
			addSelect('Företagsgrundare');
			addSelect('Projektägare');
			addSelect('Kommunregister i');
			addSelect('Externt företag tillhörande');
		}

		function addSelect(id)
		{
			var sel = document.getElementById(id);
			addEvent(sel, 'click', whichElement);
			addEvent(sel, 'click', addRemoveClicked);
		}

		function whichElement(e)
		{
			if(!e)
			{
				var e = window.event;
			}

			if(e.target)
			{
				lastClicked = e.target;
			}
			else if(e.srcElement)
			{
				lastClicked = e.srcElement;
			}

			if(lastClicked.nodeType == 3) // Safari bug
			{
				lastClicked = lastClicked.parentNode;
			}
		}

		function addRemoveClicked(e)
		{
			if(!previous[this.id])
			{
				previous[this.id] = new Array();
			}

			if(previous[this.id][lastClicked.value] == 1)
			{
				previous[this.id][lastClicked.value] = 0;
			}
			else
			{
				previous[this.id][lastClicked.value] = 1;
			}

			var selectBox = document.getElementById(this.id);

			for(var i = 0; i < selectBox.options.length; i++)
			{
				selectBox.options[i].selected = '';

				if(previous[this.id][selectBox.options[i].value] == 1)
				{
					selectBox.options[i].selected = 'selected';
				}
			}
		}
    </script>
  </head>
  <body>
    <header>
      <a href="/"><img src="/img/NFC.png" class="img-polaroid"></a>
    </header>
      <?php if (isset($_SESSION['is_logged_in'])) : ?>
      <div class="well well-small" id="user_info">
          <p>Inloggad som <?php echo '<span>'.USER.'</span>'; ?> | <a class="logout_link" href="logout.php">Logga ut</a>
          </p>
      </div>
      <?php endif ?>
      <?php echo get_feedback(); ?>
    <ul class="nav nav-pills nav-stacked">
      <li class="menu"><a class="menu-link" href="/">Sök</a></li>
      <li class="nav-header">Skapa ny / redigera</li>
      <li class="menu"><a class="menu-link" href="/newcontact.php">Kontakt</a></li>
      <li class="menu"><a class="menu-link" href="/newcompany.php">Företag</a></li>
      <li class="menu"><a class="menu-link" href="/contract/new.php">Avtal</a></li>
      <li class="menu"><a class="menu-link" href="/activity/new.php">Aktivitet</a></li>
      <li class="menu"><a class="menu-link" href="/contacttype/new.php">Kontakttyp</a></li>
      <li class="menu"><a class="menu-link" href="/mailshot/new.php">Utskick</a></li>
      <li class="menu"><a class="menu-link" href="/branch/new.php">Filial</a></li>
    </ul>
    <div class="container">
      <div class="heading-holder">
        <div class="heading">
          <h1><?php echo $page_title; ?></h1>
        </div>
      </div>