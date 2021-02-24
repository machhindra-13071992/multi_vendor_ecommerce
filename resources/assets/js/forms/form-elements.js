// Form Elements JavaScripts

(function ($) {
	'use strict';
    
	$('#selectize-dropdown').selectize({
		create: false,
		sortField: {
			field: 'text',
			direction: 'asc'
		},
		dropdownParent: 'body'
	});

	$('#selectize-tags-1').selectize({
	    delimiter: ',',
	    persist: false,
	    create: function(input) {
	        return {
	            value: input,
	            text: input
	        }
	    }
	});

	$('#selectize-tags-2').selectize({
	    delimiter: ',',
	    persist: false,
	    create: function(input) {
	        return {
	            value: input,
	            text: input
	        }
	    }
	});

	$('#selectize-group').selectize({
	    sortField: 'text'
	});

	$('.datepicker-1').datepicker();
	$('.datepicker-2').datepicker();

	$('#date-range-picker').daterangepicker();

	$(".summernote").summernote({
	    height: 200,
		fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto','Lohit-Devanagari'],
		spellCheck: true,
		fontNamesIgnoreCheck: ['Lohit-Devanagari']
	});

})(jQuery);
