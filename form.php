<?php
	include_once 'autoload.php';
	$db = new Database();
	$name = '';
	$status = 'active';
	$ordering = '';
	$errors		= null;

	$task 		= 'Add';
	$title 		= 'CRUD - Item Management - Add';

	if(isset($_GET['id'])){ // edit
		$title = 'CRUD - Item Management - Edit';
		$task  = 'Edit';
		$query = "SELECT `id`, `name`, `status`, `ordering` FROM `".DB_TABLE."` WHERE `id` = ".$_GET['id'];
		$item  = $db->fetchRow($query);
		$name  		= $item['name'];
		$ordering 	= $item['ordering'];
		$status 	= $item['status'];
	}

	if(isset($_POST['form']['submit'])){
		$name = $_POST['form']['name'];
		$ordering = $_POST['form']['ordering'];

		$validate = new Validate($_POST['form']);
		$validate->addRule('name', 'string', array('min' => 3, 'max' => 100))
				 ->addRule('ordering', 'int', array('min' => 1, 'max' => 100));
		$validate->run();

		$arrForm['form'] =  $validate->getResult();

		if($validate->isValid() == false){
			$errors = $validate->getError();
		}else{
			$data = array(
				'name' 		=> $arrForm['form']['name'],
				'status' 	=> $arrForm['form']['status'],
				'ordering' 	=> $arrForm['form']['ordering']
			);

			if($task == "Add") {
				$db->insert($data);
				Session::set('alert', 'You have successfully added item');
			}else if($task == "Edit") {
				$db->update($data, array(['id', $_GET['id'] ]));
				Session::set('alert', 'You have successfully updated item');
			}

			header('location:index.php');
			exit();
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
				<h1><?= $title ?></h1>
			</div>
			<?php 
				if(!empty($errors)) echo '<div class="row">'.AlertHelper::showErrors($errors).'</div>';
			?>
			<div class="row">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Form</h3>
					</div>
					<form name="form1" action="#" method="POST" class="form-horizontal">
							<div class="form-group">
								<label for="name" class="col-sm-1 control-label">Name</label>
								<div class="col-sm-11">
									<input type="text" class="form-control" id="name"  name="form[name]" placeholder="Enter name ..." value="<?=$name?>">
								</div>
							</div>
							<div class="form-group">
								<label for="ordering" class="col-sm-1 control-label">Ordering</label>
								<div class="col-sm-11">
									<input type="number" class="form-control" id="ordering"  name="form[ordering]" placeholder="Enter ordering ..." value="<?=$ordering?>">
								</div>
							</div>
							<div class="form-group">
								<label for="status" class="col-sm-1 control-label">Status</label>
								<div class="col-sm-11">
									<select class="form-control" name="form[status]">
										<option <?php if($status == 'active') echo 'selected="selected"';?> value="1">Active</option>
										<option <?php if($status == 'inactive') echo 'selected="selected"';?> value="0">Inactive</option>							</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-1"></div>
								<div class="col-sm-11">
									<div>
										<button type="submit" name="form[submit]" class="btn btn-primary">Submit</button>
										<a href="index.php" name="form[cancel]" class="btn btn-default" >Cancel</button>
									</div>
								</div>
							</div>
						</form>
				</div>
			</div>
		</div>
		<?php include_once 'elements/script.php';?>
	</body>
</html>