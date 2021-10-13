/**
 * check all records in dt
*/
function check_all(){
	$('input[class="item_checkbox"]:checkbox').each(function(){
		if($('input[class="check_all"]:checkbox:checked').length == 0){
			$(this).prop('checked', false);
		}else{
			$(this).prop('checked', true);
		}
	});
}

/**
* delete all checked records in dt
*/
function delete_all(){
	$('.delete_all').on('click', function(){
		$('#form_data').submit();
	})
	$('.deleteBtn').on('click', function(){
		// get count of checked raws in dt
		var item_checked = $('input[class="item_checkbox"]:checkbox').filter(":checked").length;

		if(item_checked > 0){
			$('.record_count').text(item_checked);
			$('.not_empty_record').removeClass('hidden');
			$('.empty_record').addClass('hidden');
		}else{
			$('.record_count').text('');
			$('.not_empty_record').addClass('hidden');
			$('.empty_record').removeClass('hidden');
		}
		$('#multipleDelete').modal();
	});
}
