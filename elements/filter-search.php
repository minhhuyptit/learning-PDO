<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Search & Filter
								<span class="glyphicon glyphicon-refresh pull-right" class="pointer" aria-hidden="true"></span>
							</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-4">
								<?=HTMLHelper::showFilterStatus($arrFilterStatus)?>
							</div>
							<div class="col-md-4 pull-right">
								<div class="input-group">
									<input type="text" class="form-control" id="search" name="search" placeholder="Search for" aria-label="search" value="<?=$paramSearch?>">
									<div class="input-group-btn">
										<button type="button" name="clear" id="clear" class="btn btn-default">Clear</button>
										<button type="button" name="search" id="search" class="btn btn-success">Search</button>
									</div>
								</div>
							</div>
						</div>
					</div>