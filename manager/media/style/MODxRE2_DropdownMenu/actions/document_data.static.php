<?php
if(IN_MANAGER_MODE != "true") {
	die("<b>INCLUDE_ORDERING_ERROR</b><br /><br />Please use the MODX Content Manager instead of accessing this file directly.");
}

if(isset($_REQUEST['id'])) {
	$id = (int) $_REQUEST['id'];
} else {
	$id = 0;
}

if(isset($_GET['opened'])) {
	$_SESSION['openedArray'] = $_GET['opened'];
}

$url = $modx->config['site_url'];

// Get table names (alphabetical)
$tbl_document_groups = $modx->getFullTableName('document_groups');
$tbl_manager_users = $modx->getFullTableName('manager_users');
$tbl_site_content = $modx->getFullTableName('site_content');
$tbl_site_templates = $modx->getFullTableName('site_templates');

// Get access permissions
if($_SESSION['mgrDocgroups']) {
	$docgrp = implode(",", $_SESSION['mgrDocgroups']);
}
$access = "1='" . $_SESSION['mgrRole'] . "' OR sc.privatemgr=0" . (!$docgrp ? "" : " OR dg.document_group IN ($docgrp)");

//
if($_SESSION['tree_show_only_folders']) {
	$parent = $id ? ($modx->db->getValue("SELECT parent FROM " . $tbl_site_content . " WHERE id=$id LIMIT 1")) : 0;
	$isfolder = $modx->db->getValue("SELECT isfolder FROM " . $tbl_site_content . " WHERE id=$id LIMIT 1");
	if(!$isfolder && $parent != 0) {
		$id = $_REQUEST['id'] = $parent;
	}
}

// Get the document content
$rs = $modx->db->select('DISTINCT sc.*', "{$tbl_site_content} AS sc
		LEFT JOIN {$tbl_document_groups} AS dg ON dg.document = sc.id", "sc.id ='{$id}' AND ({$access})");
$content = $modx->db->getRow($rs);
if(!$content) {
	$modx->webAlertAndQuit($_lang["access_permission_denied"]);
}

/**
 * "General" tab setup
 */
// Get Creator's username
$rs = $modx->db->select('username', $tbl_manager_users, "id='{$content['createdby']}'");
$createdbyname = $modx->db->getValue($rs);

// Get Editor's username
$rs = $modx->db->select('username', $tbl_manager_users, "id='{$content['editedby']}'");
$editedbyname = $modx->db->getValue($rs);

// Get Template name
$rs = $modx->db->select('templatename', $tbl_site_templates, "id='{$content['template']}'");
$templatename = $modx->db->getValue($rs);

// Set the item name for logger
$_SESSION['itemname'] = $content['pagetitle'];

/**
 * "View Children" tab setup
 */
$maxpageSize = $modx->config['number_of_results'];
define('MAX_DISPLAY_RECORDS_NUM', $maxpageSize);

$modx->loadExtension('makeTable');

// Get child document count
$rs = $modx->db->select('count(DISTINCT sc.id)', "{$tbl_site_content} AS sc
		LEFT JOIN {$tbl_document_groups} AS dg ON dg.document = sc.id", "sc.parent='{$content['id']}' AND ({$access})");
$numRecords = $modx->db->getValue($rs);

$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'createdon';
$dir = isset($_REQUEST['dir']) ? $_REQUEST['dir'] : 'DESC';

// Get child documents (with paging)
$rs = $modx->db->select('DISTINCT sc.*', "{$tbl_site_content} AS sc
		LEFT JOIN {$tbl_document_groups} AS dg ON dg.document = sc.id", "sc.parent='{$content['id']}' AND ({$access})", "{$sort} {$dir}", $modx->table->handlePaging() // add limit clause
);
$filter_sort = '';
$filter_dir = '';
if($numRecords > 0) {
	$filter_sort = '<p><select size="1" name="sort" onchange="document.location=\'index.php?a=3&id=' . $id . '&dir=' . $dir . '&sort=\'+this.options[this.selectedIndex].value">' . '<option value="createdon"' . (($sort == 'createdon') ? ' selected' : '') . '>' . $_lang['createdon'] . '</option>' . '<option value="pub_date"' . (($sort == 'pub_date') ? ' selected' : '') . '>' . $_lang["page_data_publishdate"] . '</option>' . '<option value="pagetitle"' . (($sort == 'pagetitle') ? ' selected' : '') . '>' . $_lang['pagetitle'] . '</option>' . '<option value="menuindex"' . (($sort == 'menuindex') ? ' selected' : '') . '>' . $_lang['resource_opt_menu_index'] . '</option>' . //********  resource_opt_is_published - //
		'<option value="published"' . (($sort == 'published') ? ' selected' : '') . '>' . $_lang['resource_opt_is_published'] . '</option>' . //********//
		'</select>';
	$filter_dir = '<select size="1" name="dir" onchange="document.location=\'index.php?a=3&id=' . $id . '&sort=' . $sort . '&dir=\'+this.options[this.selectedIndex].value">' . '<option value="DESC"' . (($dir == 'DESC') ? ' selected' : '') . '>' . $_lang['sort_desc'] . '</option>' . '<option value="ASC"' . (($dir == 'ASC') ? ' selected' : '') . '>' . $_lang['sort_asc'] . '</option>' . '</select></p>';
	$resource = $modx->db->makeArray($rs);

	// CSS style for table
	$tableClass = 'grid';
	$rowHeaderClass = 'gridHeader';
	$rowRegularClass = 'gridItem';
	$rowAlternateClass = 'gridAltItem';

	$modx->table->setTableClass($tableClass);
	$modx->table->setRowHeaderClass($rowHeaderClass);
	$modx->table->setRowRegularClass($rowRegularClass);
	$modx->table->setRowAlternateClass($rowAlternateClass);

	// Table header
	$listTableHeader = array(
		'docid' => $_lang['id'],
		'title' => $_lang['resource_title'],
		'createdon' => $_lang['createdon'],
		'pub_date' => $_lang['page_data_publishdate'],
		'status' => $_lang['page_data_status'],
		'edit' => $_lang['mgrlog_action'],
	);
	$tbWidth = array(
		'2%',
		'',
		'10%',
		'10%',
		'90',
		'150'
	);
	$modx->table->setColumnWidths($tbWidth);

	$sd = isset($_REQUEST['dir']) ? '&amp;dir=' . $_REQUEST['dir'] : '&amp;dir=DESC';
	$sb = isset($_REQUEST['sort']) ? '&amp;sort=' . $_REQUEST['sort'] : '&amp;sort=createdon';
	$pg = isset($_REQUEST['page']) ? '&amp;page=' . (int) $_REQUEST['page'] : '';
	$add_path = $sd . $sb . $pg;

	$icons = array(
		'text/html' => $_style['tree_page_html'],
		'text/plain' => $_style['tree_page'],
		'text/xml' => $_style['tree_page_xml'],
		'text/css' => $_style['tree_page_css'],
		'text/javascript' => $_style['tree_page_js'],
		'application/rss+xml' => $_style['tree_page_rss'],
		'application/pdf' => $_style['tree_page_pdf'],
		'application/vnd.ms-word' => $_style['tree_page_word'],
		'application/vnd.ms-excel' => $_style['tree_page_excel'],
		'image/gif' => $_style['tree_page_gif'],
		'image/jpg' => $_style['tree_page_jpg'],
		'image/png' => $_style['tree_page_png']
	);

	$listDocs = array();
	foreach($resource as $k => $children) {

		switch($children['id']) {
			case $modx->config['site_start']            :
				$icon = $_style['tree_page_home'];
				break;
			case $modx->config['error_page']            :
				$icon = $_style['tree_page_404'];
				break;
			case $modx->config['site_unavailable_page'] :
				$icon = $_style['tree_page_hourglass'];
				break;
			case $modx->config['unauthorized_page']     :
				$icon = $_style['tree_page_info'];
				break;
			default:
				if($children['isfolder']) {
					$isPrivate = ($children['privateweb'] || $children['privatemgr']) ? '1' : '0';
					$icon = $isPrivate ? $_style['tree_folder_secure'] : $_style['tree_folder_new'];
				} else {
					if($children['privateweb'] || $children['privatemgr']) {
						if(isset($icons[$children['contentType']])) {
							$icon = $icons[$children['contentType']];
						} else {
							$icon = $_style['tree_page_secure'];
						}
					} elseif(isset($icons[$children['contentType']])) {
						$icon = $icons[$children['contentType']];
					} else {
						$icon = $_style['tree_page'];
					}
				}
		}

		/*
		$listDocs[] = array(
			'docid' =>  $children['id'],
			'title' =>  (($children['deleted'] ? ('<s>'.$children['pagetitle'].'</s>') : ( ($modx->hasPermission('edit_document')) ? ('<a href="index.php?a=27&amp;id='.$children['id'].'">' . $children['pagetitle'] . '</a>') : $children['pagetitle'] ))),
			'createdon' =>  ($modx->toDateFormat($children['createdon']+$server_offset_time,'dateOnly')),
			'pub_date' =>  ($children['pub_date']? ($modx->toDateFormat($children['pub_date']+$server_offset_time,'dateOnly')) : ''),
			'status' => ($children['published'] == 0) ? '<span class="unpublishedDoc">'.$_lang['page_data_unpublished'].'</span>' : '<span class="publishedDoc">'.$_lang['page_data_published'].'</span>',
			'edit' =>   (($modx->hasPermission('edit_document')) ? '&nbsp;<a href="index.php?a=27&amp;id='.$children['id'].'" title="'.$_lang['edit'].'"><img src="' . $_style["icons_save"] .'" /></a>&nbsp;<a href="index.php?a=51&amp;id='.$children['id'].'" title="'.$_lang['move'].'"><img
			src="' . $_style["icons_move_document"] .'" /></a>&nbsp;<a href="index.php?a=61&amp;id='.$children['id'].'" title="'.$_lang["publish_resource"].'"><img src="' . $_style["icons_publish_document"] .'" /></a>&nbsp;<a
			href="index.php?a=62&amp;id='.$children['id'].'" title="'.$_lang["unpublish_resource"].'"><img src="' . $_style["icons_unpublish_resource"] .'" /></a>' : '') .
			(($modx->hasPermission('delete_document')) ? '&nbsp;<a href="index.php?a=6&amp;id='.$children['id'].'" title="'.$_lang['delete_resource'].'"><img src="' . $_style["icons_delete_document"] .'" /></a>&nbsp;<a href="index.php?a=63&amp;id='.$children['id'].'" title="'.$_lang['undelete_resource'].'"><img
			src="' . $_style["icons_undelete_resource"] .'" /></a>' : ''),
		);
		*/

		// дописываем в заголовок класс для неопубликованных плюс по всем ссылкам обратный путь
		// для сохранения сортировки
		$icon_pub_unpub = (!$children['published']) ? '<a class="btn btn-xs btn-default" href="index.php?a=61&amp;id=' . $children['id'] . $add_path . '" title="' . $_lang["publish_resource"] . '"><i class="' . $_style["icons_publish_document"] . '"></i></a>' : '<a class="btn btn-xs btn-default" href="index.php?a=62&amp;id=' . $children['id'] . $add_path . '" title="' . $_lang["unpublish_resource"] . '"><i class="' . $_style["icons_unpublish_resource"] . '" ></i></a>';

		$icon_del_undel = (!$children['deleted']) ? '<a onclick="return confirm(\'' . $_lang["confirm_delete_resource"] . '\')" class="btn btn-xs btn-default" href="index.php?a=6&amp;id=' . $children['id'] . $add_path . '" title="' . $_lang['delete_resource'] . '"><i class="' . $_style["icons_delete_resource"] . '"></i></a>' : '<a onclick="return confirm(\'' . $_lang["confirm_undelete"] . '\')" class="btn btn-xs btn-default" href="index.php?a=63&amp;id=' . $children['id'] . $add_path . '" title="' . $_lang['undelete_resource'] . '"><i class="' . $_style["icons_undelete_resource"] . '"></i></a>';

		$listDocs[] = array(
			'docid' => $children['id'],
			'title' => (($children['deleted'] ? ('<span class="deleted">' . $icon . ' ' . $children['pagetitle'] . '</span>') : (($modx->hasPermission('edit_document')) ? ('<a href="index.php?a=27&amp;id=' . $children['id'] . $add_path . '">' . ($children['published'] ? $icon . ' ' . $children['pagetitle'] : '<span class=unpublish>' . $icon . ' ' . $children['pagetitle'] . '</span>') . '</a>') : $icon . ' ' . $children['pagetitle']))),
			'createdon' => ($modx->toDateFormat($children['createdon'] + $server_offset_time, 'dateOnly')),
			'pub_date' => ($children['pub_date'] ? ($modx->toDateFormat($children['pub_date'] + $server_offset_time, 'dateOnly')) : ''),
			'status' => ($children['published'] == 0) ? '<span class="unpublishedDoc">' . $_lang['page_data_unpublished'] . '</span>' : '<span class="publishedDoc">' . $_lang['page_data_published'] . '</span>',
			'edit' => (($modx->hasPermission('edit_document')) ? '&nbsp;<a class="btn btn-xs btn-default" href="index.php?a=27&amp;id=' . $children['id'] . $add_path . '" title="' . $_lang['edit'] . '"><i class="' . $_style["icons_edit_resource"] . '"></i></a>&nbsp;<a class="btn btn-xs btn-default" href="index.php?a=51&amp;id=' . $children['id'] . $add_path . '" title="' . $_lang['move'] . '"><i 
				class="' . $_style["icons_move_document"] . '"></i></a>&nbsp;' . $icon_pub_unpub . '&nbsp;' : '') . (($modx->hasPermission('delete_document')) ? $icon_del_undel : ''),
		);
	}

	$modx->table->createPagingNavigation($numRecords, 'a=3&id=' . $content['id'] . '&dir=' . $dir . '&sort=' . $sort);
	$children_output = $modx->table->create($listDocs, $listTableHeader, 'index.php?a=3&amp;id=' . $content['id']);
} else {
	// No Child documents
	$children_output = "<p>" . $_lang['resources_in_container_no'] . "</p>";
}
?>
	<script type="text/javascript">
		function duplicatedocument() {
			if(confirm("<?php echo $_lang['confirm_resource_duplicate']?>") === true) {
				document.location.href = "index.php?id=<?php echo $_REQUEST['id']?>&a=94";
			}
		}

		function deletedocument() {
			if(confirm("<?php echo $_lang['confirm_delete_resource']?>") === true) {
				document.location.href = "index.php?id=<?php echo $_REQUEST['id']?>&a=6";
			}
		}

		function editdocument() {
			document.location.href = "index.php?id=<?php echo $_REQUEST['id']?>&a=27";
		}

		function movedocument() {
			document.location.href = "index.php?id=<?php echo $_REQUEST['id']?>&a=51";
		}
	</script>
	<script type="text/javascript" src="media/script/tablesort.js"></script>

	<h1>
		<i class="fa fa-info"></i><?php echo iconv_substr($content['pagetitle'], 0, 50, $modx->config['modx_charset']) . (iconv_strlen($content['pagetitle'], $modx->config['modx_charset']) > 50 ? '...' : '') . ' <small>(' . $_REQUEST['id'] . ')</small>' ?>
	</h1>

	<div id="actions">
		<ul class="actionButtons">
			<?php if($modx->hasPermission('new_document')) { ?>
				<li>
					<a href="index.php?a=4&amp;pid=<?php echo $content['id'] ?>">
						<i class="<?php echo $_style["icons_new_document"]; ?>"></i><?php echo $_lang['create_resource_here'] ?></a>
				</li>
				<li>
					<a href="index.php?a=72&amp;pid=<?php echo $content['id'] ?>">
						<i class="<?php echo $_style["icons_new_weblink"]; ?>"></i><?php echo $_lang['create_weblink_here'] ?></a>
				</li>
			<?php } ?>

			<li id="Button1" class="primary">
				<a href="javascript:;" onclick="editdocument();">
					<i class="<?php echo $_style["actions_edit"] ?>"></i><?php echo $_lang['edit'] ?></a>
			</li>
			<li id="Button2">
				<a href="javascript:;" onclick="movedocument();">
					<i class="<?php echo $_style["actions_move"] ?>"></i><?php echo $_lang['move'] ?></a>
			</li>
			<li id="Button6">
				<a href="javascript:;" onclick="duplicatedocument();">
					<i class="<?php echo $_style["actions_duplicate"] ?>"></i><?php echo $_lang['duplicate'] ?></a>
			</li>
			<li id="Button3">
				<a href="javascript:;" onclick="deletedocument();">
					<i class="<?php echo $_style["actions_delete"] ?>"></i><?php echo $_lang['delete'] ?></a>
			</li>
			<li id="Button4">
				<a href="javascript:;" onclick="<?php echo ($modx->config['friendly_urls'] == '1') ? "window.open('" . $modx->makeUrl($id) . "','previeWin')" : "window.open('" . $modx->config['site_url'] . "index.php?id=$id','previeWin')"; ?>">
					<i class="<?php echo $_style["actions_preview"] ?>"></i><?php echo $_lang['preview'] ?></a>
			</li>
		</ul>
	</div>

	<div class="sectionBody">

		<div class="tab-pane" id="childPane">
			<script type="text/javascript">
				docSettings = new WebFXTabPane(document.getElementById("childPane"), <?php echo $modx->config['remember_last_tab'] == 1 ? 'true' : 'false'; ?> );
			</script>

			<!-- General -->
			<div class="tab-page" id="tabdocGeneral">
				<h2 class="tab"><?php echo $_lang['settings_general'] ?></h2>
				<script type="text/javascript">docSettings.addTabPage(document.getElementById("tabdocGeneral"));</script>

				<table>
					<tr>
						<td colspan="2"><b><?php echo $_lang['page_data_general'] ?></b></td>
					</tr>
					<tr>
						<td width="200" valign="top"><?php echo $_lang['resource_title'] ?>:</td>
						<td><b><?php echo $content['pagetitle'] ?></b></td>
					</tr>
					<tr>
						<td width="200" valign="top"><?php echo $_lang['long_title'] ?>:</td>
						<td>
							<small><?php echo $content['longtitle'] != '' ? $content['longtitle'] : "(<i>" . $_lang['not_set'] . "</i>)" ?></small>
						</td>
					</tr>
					<tr>
						<td valign="top"><?php echo $_lang['resource_description'] ?>:</td>
						<td><?php echo $content['description'] != '' ? $content['description'] : "(<i>" . $_lang['not_set'] . "</i>)" ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $_lang['resource_summary'] ?>:</td>
						<td><?php echo $content['introtext'] != '' ? $content['introtext'] : "(<i>" . $_lang['not_set'] . "</i>)" ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $_lang['type'] ?>:</td>
						<td><?php echo $content['type'] == 'reference' ? $_lang['weblink'] : $_lang['resource'] ?></td>
					</tr>
					<tr>
						<td valign="top"><?php echo $_lang['resource_alias'] ?>:</td>
						<td><?php echo $content['alias'] != '' ? $content['alias'] : "(<i>" . $_lang['not_set'] . "</i>)" ?></td>
					</tr>
					<?php
					if($modx->config['show_meta'] === '1'):
						$tbl_keyword_xref = $modx->getFullTableName('keyword_xref');
						$tbl_site_keywords = $modx->getFullTableName('site_keywords');
						$tbl_site_content_metatags = $modx->getFullTableName('site_content_metatags');
						$tbl_site_metatags = $modx->getFullTableName('site_metatags');
						// Get list of current keywords for this document
						$keywords = array();
						$rs = $modx->db->select('k.keyword', "{$tbl_site_keywords} AS k, {$tbl_keyword_xref} AS x ", "k.id = x.keyword_id AND x.content_id='{$id}'", 'k.keyword ASC');
						$keywords = $modx->db->getColumn('keyword', $rs);

						// Get list of selected site META tags for this document
						$metatags_selected = array();
						$rs = $modx->db->select('meta.id, meta.name, meta.tagvalue', "{$tbl_site_metatags} AS meta LEFT JOIN {$tbl_site_content_metatags} AS sc ON sc.metatag_id = meta.id", "sc.content_id='{$content['id']}'");
						while($row = $modx->db->getRow($rs)) {
							$metatags_selected[] = $row['name'] . ': <i>' . $row['tagvalue'] . '</i>';
						}
						?>
						<tr>
							<td valign="top"><?php echo $_lang['keywords'] ?>:</td>
							<td><?php // Keywords
								if(count($keywords) != 0) {
									echo implode(', ', $keywords);
								} else {
									echo "(<i>" . $_lang['not_set'] . "</i>)";
								}
								?></td>
						</tr>
						<tr>
							<td valign="top"><?php echo $_lang['metatags'] ?>:</td>
							<td><?php // META Tags
								if(count($metatags_selected) != 0) {
									echo implode('<br />', $metatags_selected);
								} else {
									echo "(<i>" . $_lang['not_set'] . "</i>)";
								}
								?></td>
						</tr>
						<?php
					endif;
					?>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2"><b><?php echo $_lang['page_data_changes'] ?></b></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_created'] ?>:</td>
						<td><?php echo $modx->toDateFormat($content['createdon'] + $server_offset_time) ?> (<b><?php echo $createdbyname ?></b>)
						</td>
					</tr>
					<?php if($editedbyname != '') { ?>
						<tr>
							<td><?php echo $_lang['page_data_edited'] ?>:</td>
							<td><?php echo $modx->toDateFormat($content['editedon'] + $server_offset_time) ?> (<b><?php echo $editedbyname ?></b>)
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2"><b><?php echo $_lang['page_data_status'] ?></b></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_status'] ?>:</td>
						<td><?php echo $content['published'] == 0 ? '<span class="unpublishedDoc">' . $_lang['page_data_unpublished'] . '</span>' : '<span class="publisheddoc">' . $_lang['page_data_published'] . '</span>' ?></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_publishdate'] ?>:</td>
						<td><?php echo $content['pub_date'] == 0 ? "(<i>" . $_lang['not_set'] . "</i>)" : $modx->toDateFormat($content['pub_date']) ?></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_unpublishdate'] ?>:</td>
						<td><?php echo $content['unpub_date'] == 0 ? "(<i>" . $_lang['not_set'] . "</i>)" : $modx->toDateFormat($content['unpub_date']) ?></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_cacheable'] ?>:</td>
						<td><?php echo $content['cacheable'] == 0 ? $_lang['no'] : $_lang['yes'] ?></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_searchable'] ?>:</td>
						<td><?php echo $content['searchable'] == 0 ? $_lang['no'] : $_lang['yes'] ?></td>
					</tr>
					<tr>
						<td><?php echo $_lang['resource_opt_menu_index'] ?>:</td>
						<td><?php echo $content['menuindex'] ?></td>
					</tr>
					<tr>
						<td><?php echo $_lang['resource_opt_show_menu'] ?>:</td>
						<td><?php echo $content['hidemenu'] == 1 ? $_lang['no'] : $_lang['yes'] ?></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_web_access'] ?>:</td>
						<td><?php echo $content['privateweb'] == 0 ? $_lang['public'] : '<b style="color: #821517">' . $_lang['private'] . '</b> ' . $_style["icons_secured"] ?></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_mgr_access'] ?>:</td>
						<td><?php echo $content['privatemgr'] == 0 ? $_lang['public'] : '<b style="color: #821517">' . $_lang['private'] . '</b> ' . $_style["icons_secured"] ?></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2"><b><?php echo $_lang['page_data_markup'] ?></b></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_template'] ?>:</td>
						<td><?php echo $templatename ?></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_editor'] ?>:</td>
						<td><?php echo $content['richtext'] == 0 ? $_lang['no'] : $_lang['yes'] ?></td>
					</tr>
					<tr>
						<td><?php echo $_lang['page_data_folder'] ?>:</td>
						<td><?php echo $content['isfolder'] == 0 ? $_lang['no'] : $_lang['yes'] ?></td>
					</tr>
				</table>
			</div><!-- end tab-page -->

			<!-- View Children -->
			<div class="tab-page" id="tabChildren">
				<h2 class="tab"><?php echo $_lang['view_child_resources_in_container'] ?></h2>
				<script type="text/javascript">docSettings.addTabPage(document.getElementById("tabChildren"));</script>
				<?php
				if($numRecords > 0) {
					echo '<h4><span class="publishedDoc">' . $numRecords . '</span> ' . $_lang['resources_in_container'] . ' (<strong>' . $content['pagetitle'] . '</strong>)</h4>' . "\n";
				}
				echo $filter_sort . $filter_dir;
				echo $children_output . "\n";
				?>
			</div><!-- end tab-page -->

			<?php if($modx->config['cache_type'] != 2) { ?>
				<!-- Page Source -->
				<div class="tab-page" id="tabSource">
					<h2 class="tab"><?php echo $_lang['page_data_source'] ?></h2>
					<script type="text/javascript">docSettings.addTabPage(document.getElementById("tabSource"));</script>

					<?php
					$buffer = "";
					$filename = $modx->config['base_path'] . "assets/cache/docid_" . $id . ".pageCache.php";
					$handle = @fopen($filename, "r");
					if(!$handle) {
						$buffer = $_lang['page_data_notcached'];
					} else {
						while(!feof($handle)) {
							$buffer .= fgets($handle, 4096);
						}
						fclose($handle);
						$buffer = $_lang['page_data_cached'] . '<p><textarea style="width: 100%; height: 400px;">' . $modx->htmlspecialchars($buffer) . "</textarea>\n";
					}
					echo $buffer;
					?>
				</div><!-- end tab-page -->
			<?php } ?>

		</div><!-- end documentPane -->

	</div><!-- end sectionBody -->
<?php
if(is_numeric($_GET['tab'])) {
	echo '<script type="text/javascript"> docSettings.setSelectedIndex( ' . $_GET['tab'] . ' );</script>';
}
?>

<?php if($show_preview == 1) { ?>
	<div class="sectionHeader"><?php echo $_lang['preview'] ?></div>
	<div class="sectionBody" id="lyr2">
		<iframe src="<?php echo MODX_SITE_URL; ?>index.php?id=<?php echo $id ?>&z=manprev" frameborder="0" border="0" id="previewIframe"></iframe>
	</div>
<?php }