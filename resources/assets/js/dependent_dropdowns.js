$(function() {
	$('select[name="video_category_id"]').on('change', function() {
		var videoCategoryID = $(this).val();
		if(videoCategoryID) {
			$.ajax({
				url: webrootUrl+'/pitchsubcategory/'+videoCategoryID,
				type: "GET",
				dataType: "json",
				success:function(data) {
					$('select[name="video_sub_category_id"]').empty();
					$('select[name="video_sub_category_id"]').append('<option value=""> Select</option>');
					$.each(data, function(key, value) {
						$('select[name="video_sub_category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
					});
				}
			});
		}else{
			$('select[name="video_sub_category_id"]').empty();
		}
	});

	/*$('.primaryPitchPlatform').on('change', function() {
        $.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}});   
        var Platforms = $(this).val();
        if(Platforms) {
            $.ajax({
                url: webrootUrl+'get_channels',
                type: "POST",
                dataType: "json",
                data:{platform_ids:Platforms},
                success:function(data) {
                    $('.primaryPitchChannel').empty();
                    $('.primaryPitchChannel').select2("val", "");
                    $('.primaryPitchChannel').append('<option value=""> Select</option>');
                    $.each(data, function(key, value) {
                        var options = $('<option/>');
                            options.attr('value', key).text(value);
                            $('.primaryPitchChannel').append(options);
                    });
					$('.primaryPitchChannel').select2("destroy");
					$('.primaryPitchChannel').select2();
                }
            });
        }else{
            $('.primaryPitchChannel').empty();
        }
    });
	*/
	
	
	$(document).on('change','.primaryPitchPlatform',function(e) {
        $.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}}); 
		var primaryLanguageIndexRow = parseInt($(this).attr('name').replace(/[^0-9.]/g,"")[0]);
		var primaryIndexRow = parseInt($(this).attr('name').replace(/[^0-9.]/g,"")[1]);
        var Platforms = $(this).val();
        if(Platforms) {
            $.ajax({
                url: webrootUrl+'get_channels',
                type: "POST",
                dataType: "json",
                data:{platform_ids:Platforms},
                success:function(data) {
					$("select[name='data[pitch_approver_assign_users_primary]["+primaryLanguageIndexRow+"][pitch_approver_assign_user_platforms]["+primaryIndexRow+"][page_channel_id]']").empty();
                    $("select[name='data[pitch_approver_assign_users_primary]["+primaryLanguageIndexRow+"][pitch_approver_assign_user_platforms]["+primaryIndexRow+"][page_channel_id]']").select2("val", "");
                    $("select[name='data[pitch_approver_assign_users_primary]["+primaryLanguageIndexRow+"][pitch_approver_assign_user_platforms]["+primaryIndexRow+"][page_channel_id]']").append('<option value=""> Select</option>');
                    $.each(data, function(key, value) {
                        var options = $('<option/>');
                            options.attr('value', key).text(value);
                            $("select[name='data[pitch_approver_assign_users_primary]["+primaryLanguageIndexRow+"][pitch_approver_assign_user_platforms]["+primaryIndexRow+"][page_channel_id]']").append(options);
                    });
                }
            });
        }else{
            $("select[name='data[pitch_approver_assign_users_primary]["+primaryLanguageIndexRow+"][pitch_approver_assign_user_platforms]["+primaryIndexRow+"][page_channel_id]']").empty();
        }
    });
	
	/*primary language should not be appear as secondary language validation*/
	$('.pitchPrimaryVideoLanguageDropdownId').on('change', function() {
		var language_id = $(this).val();
		$(".pitchSecondaryVideoLanguageDropdownId option[value='"+language_id+"']").remove();
	});
		
	
});


