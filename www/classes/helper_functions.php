<?php
	function form_select($name, $title, $items, $selected_id = null) {
		$html = '<select name="'.$name.'">';
		$html .= '<option>-- Välj --</option>';

		foreach ($items as $item) {
			$selected = '';
			if ($selected_id && $selected_id == $item->id) {
				$selected = ' selected="selected"';
			}
			$html .= '<option'.$selected.' value="'.$item->id.'">'.$item->title.'</option>';
		}

		$html .= '</select>';
		return $html;
	}

	function form_select_year($title, $selected = null) {
		$html = '<select name="'.$title.'_date" style="width: 100px">';
		$html .= '<option value="null">-- Välj --</option>';
		$thisyear = date("Y");
		for ($i = 1990; $i <= $thisyear ; $i++) {
			if($selected != null && $selected == $i) {
		  	$html .= '<option selected="selected" value="'.$i.'">'.$i.'</option>';
			} else {
				$html .= '<option value="'.$i.'">'.$i.'</option>';
			}
		}
		$html .= '</select>';
		return $html;
	}

  function editContact($id, $title, $select, $checkbox_title, $datebranch, $array_id = null,  $array_branch = null,  $array_written = null,  $array_date = null) {
  	$html = '';
  	if(isset($array_id) && isset($array_branch) && isset($array_date)) {
      $html .= contact_types($id, $title, 'checked', $select, 'Filial: ', 'id', $checkbox_title.$id.'_branch', $checkbox_title, $datebranch, $array_branch, $array_date);
    } if(isset($array_id) && isset($array_branch) && !isset($array_date)) {
      $html .= contact_types($id, $title, 'checked', $select, 'Filial: ', 'id', $checkbox_title.$id.'_branch', $checkbox_title, $datebranch, $array_branch);
    } if(isset($array_id) && !isset($array_branch) && !isset($array_date)) {
      $html .= contact_types($id, $title, 'checked', $select, 'Filial: ', 'id', $checkbox_title.$id.'_branch', $checkbox_title, $datebranch);
    } if(!isset($array_id)) {
      $html .= contact_types($id, $title, '', $select, 'Filial: ', 'id', $checkbox_title.$id.'_branch', $checkbox_title, $datebranch);
    } if(isset($array_written)) {
      $html .= '<div id="written">';
      $html .= checkbox('checkbox', $checkbox_title.$id.'_written', 'Avtalet är skriftligt', '','', 'checked');
      $html .= '</div>';
    }  if(!isset($array_written) && $checkbox_title == 'contractid_'	) {
       $html .= '<div id="written">';
       $html .= checkbox('checkbox', $checkbox_title.$id.'_written', 'Avtalet är skriftligt');
       $html .= '</div>';	 	
    }
    return $html; 
  }

	function contact_types($checkbox_id, $checkbox_title, $checkbox_checked = null, $formselect, $formfor, $formid, $selectname, $checkboxname, $datebranch, $selected_id = null, $date = null) {

		$html = '<table class="contact_type_options">';
		$html .= '<tr><td class="contact_type_options_td">';
		if ($checkbox_checked != null) {
			$html .= checkbox('checkbox', $checkboxname.$checkbox_id, $checkbox_title,'','','checked');
		} else {
			$html .= checkbox('checkbox', $checkboxname.$checkbox_id, $checkbox_title);
		}
		$html .= '</td>'; 

		if ( $datebranch->branch == '1') {
			$html .= '<td class="contact_type_options_td">';
			$html .= '<select id="select_branch" name="'.$selectname.'">';
			$html .= '<option>-- Välj --</option>';

			foreach ($formselect as $form) {
				$selected = '';
				if ($selected_id && $selected_id == $form->id) {
					$selected = ' selected="selected"';
				}
			$html .= '<option'.$selected.' value="'.$form->id.'">'.$form->title.'</option>';
			}
			$html .= '</td>';
		} else {
			$html .= '<td class="contact_type_options_td">';
			$html .= '</td>';
		}

		if( $datebranch->date == '1') {
				$html .= '<td class="contact_type_options_td">';
        $html .= '<div href="#" class="tooltip-date2" data-toggle="tooltip" title="Startdatum. Måste skrivas som ÅÅÅÅ-MM-DD">';
        if($date != null) {
        	$html .= form_input('date', 'control-label', $checkboxname.$checkbox_id.'_date', '', 'Startdatum', $date);
        } else {
        	$html .= form_input('date', 'control-label', $checkboxname.$checkbox_id.'_date', '', 'Startdatum');
        }
        $html .=  '</div></td>';
		}

			$html .= '</tr></table>';
		return $html;
	}

	function contact_types_adv_search($checkbox_id, $checkbox_title, $formselect, $formfor, $formid, $datebranch, $selected_id = null, $checkbox_checked = null, $selected_year = null) {
		$html = '<table class="contact_type_options">';
		$html .= '<tr><td class="contact_type_options_td6">';
		if($checkbox_checked != null) {
			$html .= checkbox('checkbox', $checkbox_id, $checkbox_title,'','','checked');
		} else {
			$html .= checkbox('checkbox', $checkbox_id, $checkbox_title);
		}
		if ($datebranch->date == '1') {
			if($selected_year != null) {
				$html .= '<br>'.form_select_year($checkbox_id, $selected_year);
			} else {
				$html .= '<br>'.form_select_year($checkbox_id);
			}
		}
		$html .= '</td>'; //1,2,3,16
		if ($datebranch->branch == '1') {
			$html .= '<td class="contact_type_options_td6">';
			$html .= '<select multiple="multiple" class="adv_search_select" id="'.$checkbox_title.'" name="'.$checkbox_id.'_branch[]">';
			//$html .= '<input type="checkbox" value="'.$checkbox_id.'_branch">';
			foreach ($formselect as $form) {
				$selected = '';
				if ($selected_id && in_array($form->id, $selected_id)) {
					$selected = ' selected="selected"';
				}
			$html .= '<option'.$selected.' value="'.$form->id.'">'.$form->title.'</option>';
			//$html .='<div id="checkbox_child">';
			//$html .= '<input type="checkbox" value="'.$form->id.'">'.$form->title.'</input>';
			//$html .='</div>';
			}
			$html .='</select>';
			$html .= '</td>';
			/*$html .= '<td class="contact_type_options_td">';
			$html .= '</td>';*/
		}
		$html .= '</tr></table>';

		return $html;
	}

	function submit_button($text) {
		$html = '<div>';
		$html .= '<button type="submit">';
		$html .= $text;
		$html .= '</button>';
		$html .= '</div>';

		return $html;
	}

	function form_control_wrapper() {
		return '<div class="control-group">';
	}

	function form_label($class, $for, $text = null){
		if ($text != null) {
			$text = $text;
		}
		return '<label class="'.$class.'" for="'.$for.'">'.$text.' </label>';
	}

	function text_area($name, $label_text, $placeholder_text = null, $valuetext = null){
		if ($placeholder_text != null) {
			$placeholder_text = ' placeholder="'.$placeholder_text.'"';
		}
		if ($valuetext != null) {
			$valuetext = $valuetext;
		}

		$html = form_control_wrapper();
		$html .= form_label($name, $label_text);
		$html .= '<textarea id="'.$name.'" name="'.$name.'"';
		$html .= $placeholder_text.' onKeyDown="LimitText(this.form.notes,this.form.countdown,1000);"
onKeyUp="LimitText(this.form.notes,this.form.countdown,1000);" rows="8" maxlength="1000">';
		$html .= $valuetext;
		$html .= "</textarea></div>";

		return $html;
	}

	function hidden_input($name, $id) {
		$html = '<input type="hidden" name="'.$name.'" value="'.$id.'">';
		return $html;
	}

	function form_input($type, $class, $name, $label_text, $placeholder_text = null, $valuetext = null) {
		if ($placeholder_text != null) {
			$placeholder_text = ' placeholder="'.$placeholder_text.'"';
		} if ($valuetext != null) {
			$valuetext = ' value="'.$valuetext.'"';
		}

		$html  = form_control_wrapper();
		$html .= form_label($class, $name, $label_text);
		$html .= '<div class="controls">'; //toggle(checkboxID, toggleID)
		$html .= '<input type="'.$type.'" id="'.$name.'" name="'.$name.'"  '.$placeholder_text.''.$valuetext.'>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	function checkbox($class, $name, $text, $date = null, $branch = null, $checked = null) {
		if ($date != null) {
			$date = ' '.$date;
		} if ($branch != null) {
			$branch = ' '.$branch;
		} if($checked != null){
			$checked = ' checked="checked"';
		}
		$html = '<label class="'.$class.'">';
		$html .= '<input type="'.$class.'" name="'.$name.'" id="'.$name.'" '.$checked.'>'.$text.''.$date.''.$branch;
		$html .= '</label>';
		return $html;
	}

	function checkbox_checked($class, $name, $text, $date = null, $branch = null) {
		if ($date != null) {
			$date = ' '.$date;
		} if ($branch != null) {
			$branch = ' '.$branch;
		}
		$html = '<label class="'.$class.'">';
		$html .= '<input checked="checked" onclick="return false" onkeydown="return false" type="'.$class.'" name="'.$name.'" id="'.$name.'">'.$text.''.$date.''.$branch;
		$html .= '</label>';
		return $html;
	}

	function search_sorttype($text) {
		$search_sort = $text;
		if($search_sort == 'DESC'){
			$search_sort = 'ASC';
			} else {
				$search_sort = 'DESC';
			}
		return $search_sort;
	}

	function search_pages($text) {

	}


	function set_feedback($status, $text) {
    	$_SESSION['feedback'] = array('status' => $status, 'text' => $text);
	}

	function get_feedback() {
		$html = "";
		if (isset($_SESSION['feedback'])) {
			$html .= '<div class="alert alert-'.$_SESSION['feedback']['status'].'">';
			$html .= '<button type="button" class="close" data-dismiss="alert">×</button>';
			$html .= $_SESSION['feedback']['text'];
			$html .= '</div>';
			$_SESSION['feedback'] = null;
		}
		return $html;
	}

	function contact_person($contact) {
		$html = '<article class="contact_person">';
		$html .= '<h4>'.$contact->first_name.'</h4>';
		$html .= '<p>'.nl2br($contact->last_name).'</p>';
		$html .= '</article>';

		return $html;
	} //<h1>Example page header <small>Subtext for header</small></h1>

	function search_bottom($searchstring, $sortby, $sorttype, $pages, $page, $limit, $showall) {
		$html = '';
		if($pages == 1){
			$html .= '';
		} else {
			$html .= '<div class="pagination balloonpages"><ul>';
			if (($page-1) > 0){

				$html .= '<li class"enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=1&limit='.$limit.'">&laquo;&laquo;</a></li>';
				$html .= '<li class"enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.($page-1).'&limit='.$limit.'">&laquo;</a></li>';
				} else {
					$html .= '<li class="active"><a>&laquo;&laquo;</a></li>';
					$html .= '<li class="active"><a>&laquo;</a></li>';
				}

				for($i = 1; $i <= $pages; $i++) {
					if($i == $page) {
						$html .= ' <li class="active"><a>'.$i.'</a></li> ';
					} else {
						$html .= ' <li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$i.'&limit='.$limit.'">'.$i.'</a></li>';
					}
				}
					/*if($i >= 6){
							$html .= ' <li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$i.'&limit='.$limit.'">'.$i.'</a></li>';
					  } */

				if (($page+1) <= $pages){
					$html .= '<li class"enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.($page+1).'&limit='.$limit.'">&raquo;</a></li>';
					$html .= '<li class"enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$pages.'&limit='.$limit.'">&raquo;&raquo;</a></li>';
				} else {
					$html .= '<li class="active"><a>&raquo;</a></li>';
					$html .= '<li class="active"><a>&raquo;&raquo;</a></li>';
				}
			$html .= '</ul></div>';
		}

		$i = 10;
		$html .= '<div class="pagination balloon"><ul>';
		$html .= '<li class="enabled"><a>Resultat per sida</a></li>';

		while($i <= 40) {
			if($limit == $i){
				$html .= '<li class="active"><a>'.$i.'</a></li>';
			} else {
			$html .= '<li class"enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=1&limit='.$i.'">'.$i.'</a> </li>';
			}
			$i = $i + 10;
		}
		
		if($limit == $showall){
			$html .= '<li class"active"><a>Visa alla</a></li></ul></div>';
		} else {
			$html .= '<li class"enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=1&limit='.$showall.'">Visa 
		alla</a> </li></ul></div>';
		}

		return $html;
	}

	function showcontact_other($th1, $th2, $td1, $td2) {
			$html = '<thead>';
	        $html .= '<th>'.$th1.'</th><th>'.$th2.'</th>';
	        $html .= '</thead>';
	        $html .= '<tbody>';
	        $html .= '<tr><td>'.$td1.'</td>';                                        
	        $html .= '<td>'.$td2.'</td></tr>';
	        return $html;

	}

	function full_name($first_name, $last_name) {
		$html = $first_name.' '.$last_name;
		return $html;
	}
	
//ExportToxls
	function xlsBOF() {
		echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
	return;
	}

	function xlsEOF() {
		echo pack("ss", 0x0A, 0x00);
	return;
	}

	function xlsWriteNumber($Row, $Col, $Value) {
		echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
		echo pack("d", $Value);
	return;
	}

	function xlsWriteLabel($Row, $Col, $Value ) {
		$L = strlen($Value);
		echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
		echo $Value;
		return;
	}

	function convertcharset($text){
		$convtext = iconv("UTF-8", "CP1252", $text);
		return $convtext;
	}
//EndExportToxls

	function search_bottom2($searchstring, $sortby, $sorttype, $pages, $page = 1, $limit = 10, $showall, $adjacents = 1) {
		if(!$adjacents) $adjacents = 1;
		if(!$limit) $limit = 10;
		if(!$page) $page = 1;
		
		$prev = $page - 1;									
		$next = $page + 1;
		$lpm1 = $pages - 1;
		
		$html = '';
		if($pages == 1){
			$html .= '';
		} else {
			$html .= '<div class="pagination balloonpages">';
			$html .= '<ul>';
		
			//previous button	
			if ($page > 1){
				$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=1&limit='.$limit.'">&laquo;&laquo;</a></li>';
				$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.($page-1).'&limit='.$limit.'">&laquo;</a></li>';
			} else {
				$html .= '<li class="active"><a>&laquo;&laquo;</a></li>';
				$html .= '<li class="active"><a>&laquo;</a></li>';
			} 

			if ($pages < 7 + ($adjacents * 2)) {	//not enough pages to bother breaking it up
				for($i = 1; $i <= $pages; $i++) {
					if($i == $page)
						$html .= '<li class="active"><a>'.$i.'</a></li> ';
					else
						$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$i.'&limit='.$limit.'">'.$i.'</a></li>';
				}
			}
			
			elseif($pages >= 7 + ($adjacents * 2)) {	//enough pages to hide some
				//close to beginning; only hide later pages
				if($page < 1 + ($adjacents * 3)) {
					for($i = 1; $i < 4 + ($adjacents * 2); $i++) {
						if($i == $page)
							$html .= '<li class="active"><a>'.$i.'</a></li>';
						else
							$html .= ' <li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$i.'&limit='.$limit.'">'.$i.'</a></li>';
					}	
					$html .= '<li class="active"><a>...</a></li>';
					$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$lpm1.'&limit='.$limit.'">'.$lpm1.'</a></li>';
					$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$pages.'&limit='.$limit.'">'.$pages.'</a></li>';
				}
				
				//in middle; hide some front and some back
 				elseif($pages - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
					$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=1&limit='.$limit.'">1</a></li>';
					$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=2&limit='.$limit.'">2</a></li>';
					$html .= '<li class="active"><a>...</a></li>';
					for ($i = $page - $adjacents; $i <= $page + $adjacents; $i++) {
						if ($i == $page)
							$html .= '<li class="active"><a>'.$i.'</a></li>';
						else 
							$html .= $html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$i.'&limit='.$limit.'">'.$i.'</a></li>';
					}
					$html .= '<li class="active"><a>...</a></li>';
					$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$lpm1.'&limit='.$limit.'">'.$lpm1.'</a></li>';
					$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$pages.'&limit='.$limit.'">'.$pages.'</a></li>';		
				}
				
				//close to end; only hide early pages
				else {
					$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=1&limit='.$limit.'">1</a></li>';
					$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=2&limit='.$limit.'">2</a></li>';
					$html .= '<li class="active"><a>...</a></li>';
					for ($i = $pages - (1 + ($adjacents * 3)); $i <= $pages; $i++) {
						if ($i == $page)
							$html .= '<li class="active"><a>'.$i.'</a></li> ';
						else
							$html .= $html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$i.'&limit='.$limit.'">'.$i.'</a></li>';
					}
				}
			}
		
			//next button	
			if ($page < $i - 1){
				$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.($page+1).'&limit='.$limit.'">&raquo;</a></li>';
				$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$pages.'&limit='.$limit.'">&raquo;&raquo;</a></li>';
			} else {
				$html .= '<li class="active"><a>&raquo;</a></li>';
				$html .= '<li class="active"><a>&raquo;&raquo;</a></li>';
			}
				
			$html .= '</ul>';
			$html .= '</div>';
		}

		$i2 = 10;
		$html .= '<div class="pagination balloon">';
		$html .= '<ul>';
		$html .= '<li class="enabled"><a>Resultat per sida</a></li>';

		while($i2 <= 40) {
			if($limit == $i2){
				$html .= '<li class="active"><a>'.$i2.'</a></li>';
			} else {
			$html .= '<li class"enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=1&limit='.$i2.'">'.$i2.'</a> </li>';
			}
			$i2 = $i2 + 10;
		}
		
		if($limit == $showall){
			$html .= '<li class"active"><a>Visa alla</a></li>';
		} else {
			$html .= '<li class"enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=1&limit='.$showall.'">Visa alla</a> </li>';
		}
		$html .= '</ul>';
		$html .= '</div>';

		return $html;
	}
	
function search_bottom4($searchstring, $sortby, $sorttype, $pages, $page, $limit, $showall, $currenturl) {
		$html = '';
		if($pages == 1){
			$html .= '';
		} else {
			$html .= '<div class="pagination balloonpages"><ul>';
			if ($page > 1){
				//$html .= '<li class="enabled"><a href="index.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=1&limit='.$limit.'" title="Första sidan">&laquo;&laquo;</a></li>';
				$html .= '<li class="enabled"><a href="'.$currenturl.'&page=1" title="Första sidan">&laquo;&laquo;</a></li>';
				$html .= '<li class="enabled"><a href="'.$currenturl.'&page='.($page-1).'" title="Föregående sida">&laquo;</a></li>';
				} else {
					$html .= '<li class="active"><a>&laquo;&laquo;</a></li>';
					$html .= '<li class="active"><a>&laquo;</a></li>';
				}
			
			$html .= '<li class="enabled"><a class="pagelink">'.$page.'</a></li>';
			$html .= '<li class="enabled"><a class="pagelink">av</a></li>';
			$html .= '<li class="enabled"><a class="pagelink">'.$pages.'</a></li>';

			if (($page+1) <= $pages){
				$html .= '<li class="enabled"><a href="'.$currenturl.'&page='.($page+1).'" title="Nästa sida">&raquo;</a></li>';
				$html .= '<li class="enabled"><a href="'.$currenturl.'&page='.$pages.'" title="Sista sidan">&raquo;&raquo;</a></li>';
			} else {
				$html .= '<li class="active"><a>&raquo;</a></li>';
				$html .= '<li class="active"><a>&raquo;&raquo;</a></li>';
			}
			$html .= '</ul></div>';
		}

		$i = 10;
		$html .= '<div class="pagination balloon"><ul>';
		$html .= '<li class="enabled"><a>Visa antal</a></li>';

		while($i <= 40) {
			if($limit == $i){
				$html .= '<li class="active"><a>'.$i.'</a></li>';
			} else {
			$html .= '<li class="enabled"><a href="'.$currenturl.'&limit='.$i.'">'.$i.'</a> </li>';
			}
			$i = $i + 10;
		}
		
		if($limit == $showall){
			$html .= '<li class"active"><a>Visa alla</a></li></ul></div>';
		} else {
			$html .= '<li class"enabled"><a href="'.$currenturl.'&limit='.$showall.'">Visa 
		alla</a> </li></ul></div>';
		}

		return $html;
	}
	
	function search_bottom5($searchstring, $sortby, $sorttype, $pages, $page, $limit, $showall) {
		$html = '';
		if($pages == 1){
			$html .= '';
		} else {
			$html .= '<div class="pagination balloonpages"><ul>';
			if ($page > 1){
				$html .= '<li class="enabled"><a href="exportcards.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page=1&limit='.$limit.'" title="Första sidan">&laquo;&laquo;</a></li>';
				$html .= '<li class="enabled"><a href="exportcards.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.($page-1).'&limit='.$limit.'" title="Föregående sida">&laquo;</a></li>';
				} else {
					$html .= '<li class="active"><a>&laquo;&laquo;</a></li>';
					$html .= '<li class="active"><a>&laquo;</a></li>';
				}
			
			$html .= '<li class="enabled"><a class="pagelink">'.$page.'</a></li>';
			$html .= '<li class="enabled"><a class="pagelink">av</a></li>';
			$html .= '<li class="enabled"><a class="pagelink">'.$pages.'</a></li>';

			if (($page+1) <= $pages){
				$html .= '<li class="enabled"><a href="exportcards.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.($page+1).'&limit='.$limit.'" title="Nästa sida">&raquo;</a></li>';
				$html .= '<li class="enabled"><a href="exportcards.php?search='.$searchstring.'&sortby='.$sortby.'&sorttype='.$sorttype.'&page='.$pages.'&limit='.$limit.'" title="Sista sidan">&raquo;&raquo;</a></li>';
			} else {
				$html .= '<li class="active"><a>&raquo;</a></li>';
				$html .= '<li class="active"><a>&raquo;&raquo;</a></li>';
			}
			$html .= '</ul></div>';
		}

		return $html;
	}
	
?>