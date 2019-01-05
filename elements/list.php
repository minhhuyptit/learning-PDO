<?php
	$filedID 		= HTMLHelper::cmsLinkSort('ID', 'id', $paramField, $paramType);
	$filedName 		= HTMLHelper::cmsLinkSort('Name', 'name', $paramField, $paramType);
	$filedStatus 	= HTMLHelper::cmsLinkSort('Status', 'status', $paramField, $paramType);
	$filedOrdering 	= HTMLHelper::cmsLinkSort('Ordering', 'ordering', $paramField, $paramType);
?>
<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">List Items</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-3">
								<div class="input-group">
									<div class="form-group">
										<select class="form-control form-inline"" name="action">
											<option value="default">Bulk Action</option>
											<option value="active">Active</option>
											<option value="inactive">InActive</option>
											<option value="ordering">Change Ordering</option>
											<option value="delete">Delete</option>
										</select>
									</div>
									<div class="input-group-btn">
										<button type="submit" name="apply" id="apply" class="btn btn-info">Appy</button>
									</div>
								</div>
							</div>
							<div class="col-md-1 pull-right btn-add">
								<a href="form.php" class="btn btn-info btn-warning">Add new</a>
							</div>
							<div class="col-md-12 table-content">
								<table class="table table-bordered">
									<thead class="text-center">
										<tr>
											
											<th>
												<input type="checkbox" class="pointer" id="checkAll" name="checkAll">
											</th>
											<?= $filedID ?>
											<?= $filedName ?>
											<?= $filedStatus ?>
											<?= $filedOrdering ?>
											<th style="width: 30%" class="text-center">Action</th>
										</tr>
									</thead>
									<tbody class="text-center">
										<?=$xhtml?>
									</tbody>
								</table>
							</div>
						</div>
					</div>