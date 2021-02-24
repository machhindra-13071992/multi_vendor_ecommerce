$(function() {
    $('.comma').each(function() {
        var value = checkIsNaN(parseInt($(this).html() * 1));
        value = addCommas(value);
        $(this).html(value);
    });
    $('.comma2').each(function() {
        var value = parseInt($(this).html());
        if (value < 0) {
            $(this).html(0);
        } else {
            value = addCommas(value);
            $(this).html(value);
        }
    });
	$('input[alt=pan]').on('blur', function() {
        var string = $(this).val();
        string = string.toUpperCase();
        $(this).val(string);
    });
	$('input[alt=tan]').on('blur', function() {
        var string = $(this).val();
        string = string.toUpperCase();
        $(this).val(string);
    });
	$('input').on('focusout', function() {
        $(this).parent('div').removeClass('fg-line');
        if($(this).val() == '' || $(this).val() == 0){
            $(this).parent('div').removeClass('fg-toggled');
        }
    });
	$('input').on('focus', function() {
        $(this).parent('div').addClass('fg-line').addClass('fg-toggled');
    });
	$('.numeric').on('blur', function() {
		if ($(this).val() == "") {
			$(this).val(0);
		}
	});
	$('.numeric').each(function(index) {
		if ($(this).val() == '') {
			var readOnlyCheck = $(this).attr('readonly');
			if (readOnlyCheck != 'true') {
				$(this).val(0);
			}
		}
	});
    $('.numeric').on('click', function() {
		if ($(this).val() == 0) {
			var readOnlyCheck = $(this).attr('readonly');
			if (readOnlyCheck != true) {
				$(this).val('');
			}
		}
	});
    $('.numeric').addClass('text-right');

    $('.decimal').on('blur', function() {
         if ($(this).val() == "") {
            var total=0;
            var newvalue= parseFloat(total).toFixed(2);
            $(this).val(newvalue);
        } else {
            var total =$(this).val();
            var newvalue= parseFloat(total).toFixed(2);
            $(this).val(newvalue);
        }
    });
	
	$('a[href^="http://"]').each(function(){ 
	    var oldUrl = $(this).attr("href"); // Get current url
        var newUrl = oldUrl.replace("http://", "https://"); // Create new url
        $(this).attr("href", newUrl); // Set herf value
    });
    $('img[src^="http://"]').each(function(){ 
        var oldUrl = $(this).attr("src"); // Get current url
        var newUrl = oldUrl.replace("http://", "https://"); // Create new url
        $(this).attr("src", newUrl); // Set herf value
    });
    $('form[action^="http://"]').each(function(){ 
	    var oldUrl = $(this).attr("action"); // Get current url
        var newUrl = oldUrl.replace("http://", "https://"); // Create new url
        $(this).attr("action", newUrl); // Set herf value
    });
	$('script[src^="http://"]').each(function(){ 
	    var oldUrl = $(this).attr("src"); // Get current url
        var newUrl = oldUrl.replace("http://", "https://"); // Create new url
        $(this).attr("src", newUrl); // Set herf value
    });
	/*$('link[href^="http://"]').each(function(){ 
	    var oldUrl = $(this).attr("href"); // Get current url
        var newUrl = oldUrl.replace("http://", "https://"); // Create new url
        $(this).attr("href", newUrl); // Set herf value
    });*/

    var inps = document.querySelectorAll('input');
    [].forEach.call(inps, function(inp) {
      inp.onchange = function(e) {
        console.log(this.files);
      };
    });

    
});

function showLoader(centerY,webrootUrl){
    $.blockUI({
        message: '<span class="p-10 border-1 b-c-gainsboro b-r-1"><img src="'+webrootUrl+'/resources/assets/images/ellipsis.gif" align="" height="50px;"><span> &nbsp;Please wait file is uploading...</span>',
        centerY: centerY != undefined ? centerY : true,
        baseZ: 99999,
        css: {
            border: 'none',
            padding: '2px',
            backgroundColor: 'none'
        },
        overlayCSS: {
            backgroundColor: '#000',
            opacity: 0.15,
            cursor: 'wait'
        }
    });
}

function hideLoader(){
    $.unblockUI({
        onUnblock: function () {
            $.removeAttr("style");
        }
    });
}


function goToPage(url){
    window.location = url;
}

function checkemail(email) {
    var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
    if (filter.test(email)) {
        return 1;
    }
    else {
        return 0;
    }
}

function goToByScroll(id){
	$('html,body').animate({scrollTop: $(id).offset().top - 100},'slow');
}

function checkCookie(){
    var cookie_ass_id = $.cookie("aid");
    if(cookie_ass_id == undefined || cookie_ass_id == ''){
        returnFlag = false;
        location.reload();
    }
    var ass = decodeURI(cookie_ass_id);
    ass = ass.split("").reverse().join("");
//    var ass_id = window.atob(ass);
    var ass_id = decodeBase64(ass);
    var returnFlag = true;
    if(ass_id != page_ass_id){
        returnFlag = false;
        location.reload();
//        window.location.href = window.location.href + "?single";
    }
    return returnFlag;
}


function showNotificationToastr (toasterType, customMsg, positionTostr) {
	var toasterIcon = toasterType ? toasterType : 'success';
    var positionTost = positionTostr ? positionTostr : 'top-center';
    var headingTostr = customMsg ? customMsg : 'Welcome to Traco';
    $.toast({
        heading: headingTostr,
        text: '',
        position: positionTost,
        loaderBg: '#f2b701',
        icon: toasterIcon,
        hideAfter: 5000,
        stack: 6
    });
}

//deleteSweetAlert
function deleteSweetAlert(modelName,id,deleteType) {
	swal({
	      title: "Are you sure you want to delete records ? #"+id,
		  text: "!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Yes, delete it!",
		  closeOnConfirm: false
	  },
	  function(isConfirm){
		  if (isConfirm) {
				$.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				  }
			  });
			jQuery.ajax({
			  url: webrootUrl+"/delete_sweet_alert",
			  method: 'POST',
			  data: {
				 modelName: modelName,
				 id: id,
				 deleteType: deleteType
			  },
			  success: function(resultData){
				  if(resultData.error == 0){
					  swal("Deleted!", "The "+ resultData.model_name +" has been deleted.", "success");
					  setTimeout(function(){ window.location.href = webrootUrl+"/"+modelName;  }, 3000);
				  }
			  }});
		  }
	  });
}

function openLiteBox(id) {
    $(id).modal('show');
}

function closeLiteBox(id) {
    $(id).modal('hide');
}
function openModal(id) {
    $('#' + id).modal('show');
}

function closeModal(id) {
    $('#' + id).modal('hide');
}

