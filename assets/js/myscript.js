function setParam(href, key, value){
	var url = new URL(href);

	url.searchParams.set(key, value);
	return url.href;
}

function changePage(page){
	url = setParam(window.location.href, 'page', page);
	window.location.href =  url;
}

//Delete
function deleteItem(id){
	var flag = confirm('Are you sure to delete ?');
	if(flag == true){
		var url = 'delete.php?id=' + id;
		window.location.href = url;
	}else{
		return false;
	}
}

// Sort
function sortList(field, type){
	var urlField    = setParam(window.location.href, 'field',field);
	var urlFileType = setParam(urlField, 'type' ,type);
	window.location.href = urlFileType;
}

$(document).ready(function(){

	// Filer seach - Submit
	$('button[name=search]').click(function(){
		var search = $('input[name=search]').val();
		var url = setParam(window.location.href, 'search', search);
		window.location.href = url;	//Hàm này bao gồm luôn submit lại form
	});

	// Filer seach - Clear
	$('button[name=clear]').click(function(){
		$('input[name=search]').val('');
		window.location.href = window.location.pathname;
	});

	$("#checkAll").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	if($('select[name=action]').val() == 'default'){
		$('button[name=apply]').attr('disabled', 'disabled');
	}

	$('select[name=action]').change(function(){
		if($('select[name=action]').val() == 'default'){
			$('button[name=apply]').attr('disabled', 'disabled');
		}else{
			$('button[name=apply]').removeAttr('disabled');
		}
	});

	$('button[name=apply]').click(function() {
		if(document.querySelectorAll('input[type="checkbox"]:checked').length == 0){
			alert('Please select the row to change!');
			return false;
		}

		if($('select[name=action]').val() == 'delete'){
			var flag = confirm('Are you sure to delete ?');
			if(flag == false) return false;
		}
	});

}); 