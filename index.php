<?php
include_once 'autoload.php';

$db = new Database();

// Filter Status
$totalActive = $db->fetchRow("SELECT COUNT(`id`) AS `total` FROM `" . DB_TABLE . "` WHERE `status` = 'active'")['total'];
$totalInactive = $db->fetchRow("SELECT COUNT(`id`) AS `total` FROM `" . DB_TABLE . "` WHERE `status` = 'inactive'")['total'];
$totalAll = $db->fetchRow("SELECT COUNT(`id`) AS `total` FROM `" . DB_TABLE . "`")['total'];

$linkInactive = URLHelper::createParamLink(array('status' => 'inactive'));
$linkActive = URLHelper::createParamLink(array('status' => 'active'));
$linkAll = URLHelper::createParamLink(array('status' => 'all'));

$arrFilterStatus = array(
    'all' => array('name' => 'All', 'class' => 'btn-default', 'link' => $linkAll, 'total' => $totalAll),
    'active' => array('name' => 'Active', 'class' => 'btn-default', 'link' => $linkActive, 'total' => $totalActive),
    'inactive' => array('name' => 'InActive', 'class' => 'btn-default', 'link' => $linkInactive, 'total' => $totalInactive),
);

$queryList = "SELECT *FROM " . DB_TABLE . " WHERE id > 0";
$queryCount = "SELECT COUNT(`id`) as 'total' FROM " . DB_TABLE . " WHERE id > 0";

// Get Param
$paramStatus = $_GET['status'] ?? 'all';
$paramSearch = $_GET['search'] ?? '';
$currentPage = $_GET['page'] ?? 1;
$paramField = $_GET['field'] ?? 'id';
$paramType = $_GET['type'] ?? 'asc';

// Active class
$arrFilterStatus[$paramStatus]['class'] = 'btn-success';

// Filter Status
if ($paramStatus != 'all') {
    $queryList .= " AND `status` = '{$paramStatus}'";
    $queryCount .= " AND `status` = '{$paramStatus}'";
}

// Filter Search
if ($paramSearch != '') {
    $queryList .= " AND `name` LIKE '%{$paramSearch}%'";
    $queryCount .= " AND `name` LIKE '%{$paramSearch}%'";
}

// Sort
$queryList .= " ORDER BY `$paramField` $paramType";

// Pagination
$totalItem = $db->fetchRow($queryCount)['total'];
$configPagination = ['totalItemsPerPage' => 3, 'pageRange' => 3, 'currentPage' => $currentPage];
$objPagination = new Pagination($totalItem, $configPagination);

if ($objPagination->getTotalPage() > 1) {
    $position = ($currentPage - 1) * $configPagination['totalItemsPerPage'];
    $queryList .= " LIMIT $position, {$configPagination['totalItemsPerPage']}";
}

$listItem = $db->fetchAll($queryList);
$xhtml = '';
if (!empty($listItem)) {
    foreach ($listItem as $item) {
        $linkEdit = '';
        $xhtml .= '<tr>
						<td  class="td-content"><input type="checkbox" name="cid[]" value="' . $item['id'] . '"></td>
						<td  class="td-content">' . $item['id'] . '</td>
						<td  class="text-left td-content">' . $item['name'] . '</td>
						<td  class="td-content">
							' . HTMLHelper::showStatus($item['status']) . '
						</td>
						<td  class="td-content">
							<div class="col-md-6 col-md-offset-3">
								<input class="form-control text-center" type="text" name="ordering[' . $item['id'] . ']" value="' . $item['ordering'] . '">
							</div>
						</td>
						<td  class="td-content"">
							<a href="form.php?id='.$item['id'].'" class="btn btn-warning btn-sm" >Edit</button>
							<a class="btn btn-danger btn-sm" onclick="javascript:deleteItem(\''.$item['id'].'\')">Delete</a>
						</td>
					</tr>';
    }
}

?>
<!DOCTYPE html>
<html>
	<head>
	<?php include_once 'elements/head.php';?>
	</head>
	<body>
		<div class="container">
			<div class="row title">
				<h1>Item Management</h1>
			</div>
			<div class="row" id="alert">
				<?php
					if(!empty(Session::get('alert'))){
						echo AlertHelper::showSuccess(Session::get('alert'));
						Session::delete('alert');
					}
				?>
			</div>
			<form name="form1" action="bulk-action.php" id="form1" method="POST">
				<div class="row">
					<?php include_once 'elements/filter-search.php';?>
				</div>
				<div class="row">
					<?php include_once 'elements/list.php';?>
				</div>
			</form>
			<div class="row">
				<?php include_once 'elements/pagination.php';?>
			</div>
		</div>
		<?php include_once 'elements/script.php';?>
	</body>
</html>