<?php 
	class AlertHelper{
		public static function showErrors($errors){
			$xhtml = '';
			foreach($errors as $key => $value){
				$xhtml .= '<div class="alert alert-danger alert-dismissible" role="alert">
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  '.$value.'
							  </div>';
			}
			return $xhtml;
		}

		public static function showSuccess($msg){
			return '<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  '.$msg.'
							  </div>';

		}
	}
 ?>