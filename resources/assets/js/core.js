var core = function () {

    // Set the default date format
    var dateFormat = 'yyyy-mm-dd';
    
    var dateFormatUpperCase = dateFormat.toUpperCase();

    var handleDateFieldValidations = function() {
        if(dateFormat === 'dd-mm-yyyy') {
            jQuery.validator.addMethod("date", function(value, element) {
                return this.optional(element) || moment(value,"DD/MM/YYYY").isValid();
            }, "Please enter a valid date");
        }
    };

    var handleDateFields = function() {
        $('body').off('click', '.date').on('click', '.calendarIcon', function (e) {
            $(this).prev('input').trigger('focus');
        });

        var maskFormat = dateFormat.replace(/\w/g, '0');

        $('.date').mask(maskFormat);
        $('.datetime').mask(maskFormat+' 00:00');

        $('.date:not(.hasDatePicker)').each(function(index, element) {
            var input = $(this);
            var options = {
                format: dateFormat,
                todayBtn: "linked",
                clearBtn: true,
                autoclose: true,
                todayHighlight: true
            };

            if(!empty(input.data('min-date'))) {
                options.startDate = input.data('min-date');
            }
            if(!empty(input.data('min-date'))) {
                options.endDate = input.data('max-date');
            }
            if(!empty(input.data('days-of-week-disabled')) || input.data('days-of-week-disabled') == 0) {
                options.daysOfWeekDisabled = '"'+input.data('days-of-week-disabled')+'"';
            }
            if(!empty(input.data('dates-disabled'))) {
                options.datesDisabled = input.data('dates-disabled').split(";");
            }
            if(input.data('today-btn') === false) {
                options.todayBtn = false;
            }

            input.datepicker(options).on('hide', function(event) {
                event.preventDefault();
                event.stopPropagation();
            }).on('changeDate clearDate', function(event) {
                $(this).valid();
            });

            input.addClass('hasDatePicker');

            var placeHolderAttr = input.attr('placeholder');
            if(empty(placeHolderAttr)) {
                input.attr('placeholder', dateFormatUpperCase);
            }
        });

        $('.time:not(.hasTimePicker)').each(function(index, element) {
            var input = $(this);

            input.datetimepicker({
               format: 'HH:mm'
            }).on('hide', function(event) {
                event.preventDefault();
                event.stopPropagation();
            });

            input.addClass('hasTimePicker');

            var placeHolderAttr = input.attr('placeholder');
            if(empty(placeHolderAttr)) {
                input.attr('placeholder', "HH:mm");
            }
        });

        $('.datetime:not(.hasDateTimePicker)').each(function(index, element) {
            var input = $(this);
            var options = {
                format : dateFormatUpperCase+' HH:mm',
                showTodayButton: true,
                showClear:true,
                showClose:true
            };

            if(!empty(input.data('min-date'))) {
                options.minDate = input.data('min-date');
            }
            if(!empty(input.data('max-date'))) {
                options.maxDate = input.data('max-date');
            }

            input.datetimepicker(options).on('hide', function(event) {
                event.preventDefault();
                event.stopPropagation();
            });
            input.addClass('hasDateTimePicker');

            var placeHolderAttr = input.attr('placeholder');
            if(empty(placeHolderAttr)) {
                input.attr('placeholder', dateFormatUpperCase+" HH:mm");
            }
        });
    };

    // Handles panel tools & actions
    var handlePanelTools = function () {

        $('body').on('click', '.panel > .panel-heading > .tools > a.remove', function (e) {
            e.preventDefault();
            $(this).closest(".panel").remove();
        });

        $('body').on('click', '.panel > .panel-heading > .tools > a.reload', function (e) {
            e.preventDefault();
            var el = $(this).closest(".panel").children(".panel-body");
        });

        $('body').on('click', '.panel > .panel-heading > .tools > .collapse, .panel .panel-heading > .tools > .expand', function (e) {
            e.preventDefault();

            var el = $(this).closest(".panel").children(".panel-body");
            var elt = $(this).closest(".panel").children("table");
            if ($(this).hasClass("collapse")) {
                $(this).removeClass("collapse fa-angle-down").addClass("expand fa-angle-up");
                el.slideUp(200);
                elt.slideUp(200);
            } else {
                $(this).removeClass("expand fa-angle-up").addClass("collapse fa-angle-down");
                el.slideDown(200).removeClass('hide');
                elt.slideDown(200).removeClass('hide');
            }
        });
    };

    var handleUniform = function() {
        if (!$().uniform) {
            return;
        }
        $("input:radio:not(.toggle), input:checkbox:not(.toggle)").uniform({resetSelector: 'button[type="reset"]'});
    };

    var handleSelect2 = function() {
        if($().select2) {
            $("select:not(.noSelect2)").each(function(index, element) {
                $(element).select2({
                    placeholder: 'Select',
                    allowClear: true
                }).on('change', function() {
                    $(this).trigger('blur');
                    $(this).valid();
                });
            });
        }
    };

    var handleRichEditor = function() {
        is_tinyMCE_active = false;
        if (typeof(tinyMCE) != "undefined") {
          if (tinyMCE.activeEditor === null || tinyMCE.activeEditor.isHidden() !== false) {
            is_tinyMCE_active = true;
          }
        }

        if(is_tinyMCE_active) {

            tinymce.init({
                selector: "textarea.rich-editor-min-toolbar",
                plugins: [
                    "advlist lists preview hr",
                    "searchreplace wordcount nonbreaking",
                    "directionality paste nanospell"
                ],
                toolbar: "undo redo | bold italic | strikethrough superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist",
                nanospell_server: "php", // choose "php" "asp" "asp.net" or "java"
                relative_urls: false,
                paste_as_text: true
            });

            tinymce.init({
                selector: "textarea.rich-editor",
                plugins: [
                     "advlist autolink link image imagetools lists charmap print preview hr anchor pagebreak",
                     "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                     "save table contextmenu directionality paste textcolor jbimages nanospell"
                ],
                toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | preview media fullpage | forecolor backcolor",
                nanospell_server: "php", // choose "php" "asp" "asp.net" or "java"
                relative_urls: false,
                paste_as_text: true
            });
        }
    };

    var handleScrollers = function () {
        $('.scroller').each(function () {
            var height;
            if ($(this).attr("data-height")) {
                height = $(this).attr("data-height");
            } else {
                height = $(this).css('height');
            }

        });
        $('.scroller').perfectScrollbar({suppressScrollX: true});
    };

    var handleModalManager = function() {
        var modalProgresBar = '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div><div class="modal-body">'+core.progressBar()+'</div>';

        var maxModals = 3;

        $('.modal-manager').find('.modal-content').html(modalProgresBar);

        $('.modal-manager').on('hide.bs.modal', function () {
            $(this).removeData('bs.modal');
            $('.modal-content', this).html(modalProgresBar);
        });

        $(document).on('click', '[data-toggle~="modal-manager"]', function (e) {

            var href = $(this).attr('href');
            var modalsVisible = $('.modal:visible').length;

            if(modalsVisible < 3) {
                e.preventDefault();
            } else {
                window.location.href = href;
            }

            var modalId = '#myModal'+(modalsVisible+1);
            var modalEle = $(modalId);

            $.ajax({
                statusCode: {
                    403: function(data) {
                        modalEle.find('.modal-body').html(data.responseText);
                        modalEle.modal('show');
                    }
                },
                url: href,
                success: function(data) {
                    modalEle.find('.modal-body').html(data);
                    modalEle.modal({show:true, backdrop: 'static'});
                }
            });

            modalEle.one('loaded.bs.modal', function () {
                var maxheight = '500';
                var modalBody = $('.modal-body', this);
                var height = modalBody.height();

                if(height > maxheight) {
                    modalBody.css('max-height', 490).perfectScrollbar({suppressScrollX: true});
                }
            });
        });

        $(document).on('click', '[data-toggle~="modal-inpage"]', function (e) {
            var ele = $(this);
            var modalId = ele.data('target');
            var modalEle = $(modalId);
            modalEle.modal({show:true, backdrop: 'static'});

            modalEle.one('shown.bs.modal', function () {
                $('.modal-backdrop').insertAfter(modalEle);
                var modalDialog = $('.modal-dialog', this);
                modalDialog.css('margin-top', '54px');

                var maxheight = '500';
                var modalBody = $('.modal-body', this);
                var height = modalBody.height();

                if(height > maxheight) {
                    modalBody.css('max-height', 490).perfectScrollbar({suppressScrollX: true});
                }

                core.formEleInit();
            });
        });
    };

    var handleTablePagination = function() {
        $('.pagination > li > a').click(function() {
            var parentNode = $(this).closest('.tableData');
            core.scrollTo(parentNode, -165);
        });
    };

    var handleListSearch = function() {
        $("body").on("click", ".list-search-submit", function() {
            var parentNode = $(this).closest('[data-toggle="list-search"]');
            var target = parentNode.data('target');
            var url = parentNode.data('url');

            var field = parentNode.find("#"+target+"Field").val();
            var query = encodeURIComponent($("."+target+"Query").val());
            var targetUrl = url+'/'+field+':'+encodeURI(query)+"/?source=search #"+target+" > *";

            $("#"+target).load(targetUrl, function() {
                core.displayTableColumnsBasedOnColumnsToggler();
            });
        });

        $("body").on("click", ".list-search-reset", function() {
            var parentNode = $(this).closest('[data-toggle="list-search"]');
            var target = parentNode.data('target');
            var url = parentNode.data('url');

            var targetUrl = url+"/?search=true #"+target+" > *";

            $("#"+target).load(targetUrl, function() {
                core.displayTableColumnsBasedOnColumnsToggler();
            });
        });

        $("body").on("keypress", ".list-search-input", function(event) {
            var parentNode = $(this).closest('[data-toggle="list-search"]');

            if (event.which == 13 ) {
                event.preventDefault();
                parentNode.find('.list-search-submit').trigger("click");
            }
        });
    };

    var handleTableColToggler = function() {
        /*
          For touch supported devices disable the
          hoverable dropdowns - data-hover="dropdown"
        */
        if (core.isTouchDevice()) {
            $('[data-hover="dropdown"]').each(function(){
                $(this).parent().off("hover");
                $(this).off("hover");
            });
        }

        /*
          Hold dropdown on click
        */
        $('body').on('click', '.dropdown-menu.hold-on-click', function (e) {
            e.stopPropagation();
        });

        $('body').on('click', '.dropdown-checkboxes input[type=checkbox]', function (e) {
            e.stopPropagation();

            var dropdownCheckboxes = $(this).closest('.dropdown-checkboxes');
            var table = '#' + dropdownCheckboxes.data('table');
            var iCol = parseInt($(this).attr("data-column"));

            var col = $(table+' tr th:nth-child('+iCol+'), '+table+' tr td:nth-child('+iCol+')');
            var colHead = $(table+' tr th:nth-child('+iCol+')');

            // console.log((colHead.css('display') != 'none'));
            if(colHead.css('display') == 'none') {
                col.removeClass('hide').addClass('show');
            } else {
                col.addClass('hide').removeClass('show');
            }

            core.tableColumnsTogglerSetCookie(dropdownCheckboxes);
        });
    };

    var handleTableGroupSelect = function() {
        $("body").on("change", "[data-toggle='group-checkable']", function(e){
            var set = 'input[data-set-row="'+$(this).attr("data-set")+'"]';
            var checked = $(this).is(":checked");

            $(set).each(function () {
                if (!checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            $.uniform.update(set);
            $('[data-set-row]').trigger('click');
        });

        $("body").on("change", '[data-set-row]', function(e){
            var dataSetRow = $(this).attr('data-set-row');

            var vals = Array();
            $("input[data-set-row='"+dataSetRow+"']:checked").each(function() {
                vals.push($(this).val());
            });

            var grpActions = $('.'+dataSetRow+'-actions .group-actions');
            var href = '';

            grpActions.each(function(index, el) {
                grpAction = $(this);

                if(empty(vals)){
                    grpAction.closest('li').addClass('disabled');
                    href = '#';
                    grpAction.attr('data-toggle', '');
                } else {
                    href = grpAction.data('url') +'/'+ vals.join();
                    grpAction.closest('li').removeClass('disabled');
                    //grpAction.attr('data-toggle', 'modal-manager')
                }

                grpAction.attr('href', href);
            });
        });

        $("body").on("click", '.group-actions[href="#"]', function(e){
            e.preventDefault();
            event.stopPropagation();
        });
    };

    var handleTableToExcel = function() {
        $("body").on("click", "[data-toggle='table-to-excel']", function(e){
            var target = $(this).data('target');

            //getting values of current time for generating the file name
            var dt = new Date();
            var day = dt.getDate();
            var month = dt.getMonth() + 1;
            var year = dt.getFullYear();
            var hour = dt.getHours();
            var mins = dt.getMinutes();
            var postfix = day + "." + month + "." + year + "_" + hour + "." + mins;

            //creating a temporary HTML link element (they support setting file names)
            var a = document.createElement('a');

            //getting data from our div that contains the HTML table
            var data_type = 'data:application/vnd.ms-excel';
            var table_div = $(target);
            table_div.find('table').attr('border', 1);
            var table_html = table_div[0].outerHTML;
            table_html = table_html.replace(/ /g, '%20');

            a.href = data_type + ', ' + table_html;
            //setting the file name
            a.download = 'exported_table_' + postfix + '.xls';
            //triggering the function
            a.click();
            //just in case, prevent default behaviour
            table_div.find('table').attr('border', 0);
            e.preventDefault();
        });
    };

    var handleMask = function() {
        $.applyDataMask('*[data-mask]');
    };

    var handleTextCaseChange = function() {
        $("body").on("keyup", ".toUpperCase", function(e){
            var ele = $(this);

            var strLength = !empty(ele.data('strlength')) ? ele.data('strlength') : 0;

            if(ele.val().length !== strLength) {
                ele.val(ele.val().toUpperCase());
                ele.data('strlength', ele.val().length);
            }
        });

        $("body").on("keyup", ".toLowerCase", function(e){
            var ele = $(this);

            var strLength = !empty(ele.data('strlength')) ? ele.data('strlength') : 0;

            if(ele.val().length !== strLength) {
                ele.val(ele.val().toLowerCase());
                ele.data('strlength', ele.val().length);
            }
        });
    };

    var handleAjaxLoad = function() {
        $('[data-toggle="ajax-load"]:not(.loaded)').each(function(index, element) {
            var el = $(this);
            var url = el.data('url');
            el.html(core.progressBar).load(url, function() {
                el.addClass('loaded');
            });
        });
    };

    var handleAfterAjaxLoad = function() {
        $('[data-toggle="ajax-load"].afterAjaxLoad:not(.loaded)').each(function(index, element) {
            var el = $(this);
            var url = el.data('url');
            el.html(core.progressBar).load(url, function() {
                el.addClass('loaded');
            });
        });
    };

    var handleAddMore = function() {
        $('body').off('click', '[data-toggle="add-more"]').on('click', '[data-toggle="add-more"]', function(e) {
            e.preventDefault();

            var addMoreBtn = $(this);
            addMoreBtn.addClass('handled');

            var tbody = $(this).closest('table').children('tbody');
            var lastChild = tbody.children().last();

            // Remove SELECT2 elements
            if($().select2) {
                lastChild.find('select').select2('destroy');
            }

            // Remove UNIFORM elements
            if ($().uniform) {
                var fields = lastChild.find("input:radio:not(.toggle), input:checkbox:not(.toggle)");
                $.uniform.restore(fields);
            }

            // Make a Pure HTML copy of last child row
            lastChild.clone().appendTo(tbody);

            // Find name dept available
            var depth = 0;

            lastChild.find(':input[name], select[name]').each(function() {
                var x = $(this).attr('name');
                var depthMatch = x.match(/\[\d+\]/g);

                if(depthMatch !== null) {
                    var depthMatchLength = depthMatch.length;
                    if(depthMatchLength > depth) {
                        depth = depth + depthMatchLength;
                    }
                }
            });

            // Reattach SELECT2 elements
            if($().select2) {
                lastChild.find('select').not('.noSelect2').select2();
            }

            // Reattach UNIFORM elements
            if ($().uniform) {
                lastChild.find("input:radio:not(.toggle), input:checkbox:not(.toggle)").uniform({resetSelector: 'button[type="reset"]'});
            }

            var newLastChild = tbody.children().last();
            if(newLastChild.length === 0) {
                window.location.reload();
            } else {
                var newLastChildHtml = newLastChild.html().replace(/((name|id|for|data-target)="\S+")|(href="#\S+")/gi, function myFunction(x, i, original) {
                    var originalAttr = original;
                    var pattern;

                    switch(originalAttr) {
                        case 'id':
                        case 'for':
                        case 'data-target':
                            pattern = /[a-z]?\d+[A-Z]/g;
                        break;

                        case 'name':
                            pattern = /\[\d+\]/g;
                        break;
                    }

                    var numberedBracketCount = 1;
                    var matchResult = x.match(pattern);

                    if(matchResult !== null) {
                        if(depth == 2) {
                            numberedBracketCount = matchResult.length;
                        }
                    }

                    var returnText = '';

                    var nth = 0;
                    returnText = (x.replace(pattern, function myFunction(x) {
                        return (x.replace(/\d+/g, function myFunction(x, i, original) {
                            nth++;
                            return (nth === numberedBracketCount) ? (parseInt(x) + 1) : x;
                        }));
                    }));

                    return returnText;
                });

                newLastChild.html(newLastChildHtml);

                var lastTr = newLastChild.closest('tr');
                lastTr.removeAttr('style');
                    // Data id removed on add-more
                    var lastTdInner = lastTr.find('a');
                    lastTdInner.removeAttr('data-id');
                    lastTdInner.removeAttr('data-key');
                    // end
                newLastChild.find('input, textarea, select').removeAttr('disabled');
                newLastChild.find('input, checkbox').removeAttr('checked');
                newLastChild.find('input:not(:checkbox):not(:hidden), select, textarea').val('');
                newLastChild.find('input[name*="[id]"]').val('');
                newLastChild.find('label[id*="-error"]').remove();
                /*newLastChild.find('input[type="file"]').addClass('required');*/
                newLastChild.find(':input').removeClass('hasDatePicker hasDateTimePicker hasTimePicker');
                newLastChild.find('.fileinput').each(function() {
                    $(this).find('[data-dismiss="fileinput"]').click();
                });
                newLastChild.find('[data-default-value]').each(function() {
                    $(this).attr('value', $(this).attr('data-default-value'));
                });
                newLastChild.find('[data-default-disabled]').each(function() {
                    $(this).attr('disabled', $(this).attr('data-default-disabled'));
                });
                newLastChild.find('[data-default-readonly]').each(function() {
                    $(this).attr('readonly', $(this).attr('data-default-readonly'));
                });

                newLastChild.find('.update-count').each(function() {
                    var count_text = $(this).text().replace(/[0-9]+/gi, function myFunction(x) {
                        return (parseInt(x) + 1);
                    });
                    $(this).text(count_text);
                });

                newLastChild.children('td').last().html('<a href="javascript:void(0)" class="btn btn-default removeRow" data-toggle="tooltip" title="Remove Row"><i class="fa fa-times"></i></a>');
                handleDateFields();

                // Apply SELECT2 to the new row
                if($().select2) {
                    newLastChild.find('select').not('.noSelect2').select2();
                }

                // Apply UNIFORM to the new row
                if ($().uniform) {
                    newLastChild.find("input:radio:not(.toggle), input:checkbox:not(.toggle)").uniform({resetSelector: 'button[type="hidden"]'});
                }

                // Custom event is fired
                addMoreBtn.trigger("rowAdded");
            }
        });
    };

    var handleUpdateQueryString = function(key, value, url) {
        if (!url) url = window.location.href;
        var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
            hash;

        if (re.test(url)) {
            if (typeof value !== 'undefined' && value !== null)
                return url.replace(re, '$1' + key + "=" + value + '$2$3');
            else {
                hash = url.split('#');
                url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];
                return url;
            }
        }
        else {
            if (typeof value !== 'undefined' && value !== null) {
                var separator = url.indexOf('?') !== -1 ? '&' : '?';
                hash = url.split('#');
                url = hash[0] + separator + key + '=' + value;
                if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                    url += '#' + hash[1];
                return url;
            }
            else
                return url;
        }
    };

    // Handle full screen mode toggle
    var handleFullScreenMode = function() {
        // mozfullscreenerror event handler

        // toggle full screen
        function toggleFullScreen() {
          if (!document.fullscreenElement &&    // alternative standard method
              !document.mozFullScreenElement && !document.webkitFullscreenElement) {  // current working methods
            if (document.documentElement.requestFullscreen) {
              document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
              document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
              document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
          } else {
            if (document.cancelFullScreen) {
              document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
              document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
              document.webkitCancelFullScreen();
            }
          }
        }

        $('#trigger_fullscreen').click(function() {
            toggleFullScreen();
        });
    };

    var handleTouchSpin = function() {

        $('input.touch-spin:not(.hasTouchSpinner)').each(function(index, element) {
            var input = $(this);
            var options = {
                verticalbuttons: true
            };

            if(typeof(input.data('verticalbuttons') !== 'undefined')) {
                options.verticalbuttons = input.data('verticalbuttons');
            }
            if(typeof(input.attr('min') !== 'undefined')) {
                options.min = input.attr('min');
            }
            if(typeof(input.attr('max') !== 'undefined')) {
                options.max = input.attr('max');
            }
            if(typeof(input.attr('step') !== 'undefined')) {
                options.step = input.attr('step');
            }

            input.TouchSpin(options);

            input.addClass('hasTouchSpinner');
        });
    };

    return {
        //main function to initiate the core
        init: function () {
            handleScrollers();
            handleModalManager();

            handleDateFieldValidations();
            handleDateFields();

            handlePanelTools();
            handleUniform();
            handleSelect2();
            handleRichEditor();

            handleListSearch();

            handleTableColToggler();
            handleTableGroupSelect();
            handleTableToExcel();
            handleTablePagination();

            handleTextCaseChange();
            handleAjaxLoad();

            handleAddMore();
            handleFullScreenMode(); // handles full screen
            handleTouchSpin();

            core.updateTableColumnsToggler();
        },

        ajaxInit: function () {
            handleDateFields();

            setTimeout(function(){ Holder.run(); }, 100);

            handleUniform();
            handleSelect2();
            //handleRichEditor();

            // handleTableColToggler();
            core.updateTableColumnsToggler();
            handleTablePagination();
            handleAfterAjaxLoad();

            handleAddMore();
            handleTouchSpin();

            handleMask();
        },

        formEleInit: function () {
            handleDateFields();

            setTimeout(function(){ Holder.run(); }, 100);

            handleUniform();
            handleSelect2();

            handleTouchSpin();

            handleMask();
        },

        // To access it Globally 
        dateFormat: dateFormat,

        // To access it Globally
        dateFormatUpperCase: dateFormatUpperCase,

        // Hetu core js functions
        slug : function(str) {
          str = str.replace(/^\s+|\s+$/g, ''); // trim
          str = str.toLowerCase();

          // remove accents, swap Ã± for n, etc
          var from = "Ã£Ã Ã¡Ã¤Ã¢áº½Ã¨Ã©Ã«ÃªÃ¬Ã­Ã¯Ã®ÃµÃ²Ã³Ã¶Ã´Ã¹ÃºÃ¼Ã»Ã±Ã§Â·/_,:;";
          var to   = "aaaaaeeeeeiiiiooooouuuunc------";
          for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
          }

          str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '_') // collapse whitespace and replace by -
            .replace(/-+/g, '_'); // collapse dashes

          return str;
        },

        // check for device touch support
        isTouchDevice: function () {
            try {
                document.createEvent("TouchEvent");
                return true;
            } catch (e) {
                return false;
            }
        },

        // wrapper function to scroll(focus) to an element
        scrollTo: function (el, offeset) {
            pos = (el && el.size() > 0) ? el.offset().top : 0;
            jQuery('html,body').animate({
                scrollTop: pos + (offeset ? offeset : 0)
            }, 'slow');
        },

        // function to scroll to the top
        scrollTop: function () {
            core.scrollTo();
        },

        updateDropDown: function(ele, url, rootNode, callback) {
            if(typeof(ele) === 'string') {
                ele = $(ele);
            }

            var hasEmpty = false;
            var emptyText = '';

            var firstChild = ele.find('option:first-child');
            var firstOpt = firstChild.val();

            if(empty(firstOpt)) {
                hasEmpty = true;
                emptyText = firstChild.text();
            }

            ele.html('<option>Loading...</option>');
            if($().select2) {
                ele.select2('readonly', true);
                ele.select2();
            }

            $.getJSON(url, function(data){
                var json;

                if(typeof(data) == 'object') {
                    json = data;
                } else {
                    json = $.parseJSON(data);
                }

                if(!empty(rootNode)) {
                    json = json[rootNode];
                }

                var html = core.dropDownOptionsHtml(json);

                if(hasEmpty) {
                    html = '<option value="">'+emptyText+'</option>'+html;
                }

                // If select is of type multiple
                if(!empty(ele.attr('multiple'))) {
                    html = html.replace('<option value="">Select</option>', '');
                }
                ele.html('').html(html);
                if($().select2) {
                    ele.select2('readonly', false);
                    ele.select2();
                }

                if (!empty(callback)) {
                    callback();
                }
            });
        },

        updateDropDownValues: function(ele, data, callback) {
            if(typeof(ele) === 'string') {
                ele = $(ele);
            }

            var hasEmpty = false;
            var emptyText = '';

            var firstChild = ele.find('option:first-child');
            if(firstChild.length > 0) {
                var firstOpt = firstChild.val();

                if(empty(firstOpt)) {
                    hasEmpty = true;
                    emptyText = firstChild.text();
                }
            }

            ele.html('<option>Loading...</option>');
            if($().select2) {
                ele.select2('readonly', true);
                ele.select2();
            }

            var json;

            if(typeof(data) == 'object') {
                json = data;
            } else {
                json = $.parseJSON(data);
            }

            var html = core.dropDownOptionsHtml(json);

            if(hasEmpty) {
                html = '<option value="">'+emptyText+'</option>'+html;
            }

            // If select is of type multiple
            if(!empty(ele.attr('multiple'))) {
                html = html.replace('<option value="">Select</option>', '');
            }
            ele.html('').html(html);
            if($().select2) {
                ele.select2('readonly', false);
                ele.select2();
            }

            if (!empty(callback)) {
                callback();
            }
        },

        dropDownOptionsHtml: function(json) {
            var html = '';
            $.each(json, function(index, value) {
                if(typeof(value) !== 'undefined') {
                    if(typeof(value) == 'object') {
                        var dataFields = '';
                        $.each(value.data, function(datafield, datavalue) {
                            dataFields += 'data-'+datafield+'="'+datavalue+'"';
                        });
                        html += '<option value="'+value.id+'" '+dataFields+'>'+value.text+'</option>';
                    } else {
                        html += '<option value="'+index+'">'+value+'</option>';
                    }
                }
            });
            return html;
        },

        progressBar: function(percentage) {
            if(empty(percentage)) {
                percentage = 100;
            }
            return '<div class="progress progress-striped active"><div class="progress-bar" role="progressbar" aria-valuenow="'+percentage+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percentage+'%"><span class="sr-only">'+percentage+'% Complete</span></div></div>';
        },

        resetFormSection: function(ele) {
            if(typeof(ele) === 'string') { ele = $(ele); }

            ele.find('input:not(:radio,:checkbox)').val('');
            ele.find('input:radio:not(.toggle)').removeAttr('checked').uniform('update');
            ele.find('textarea').val('');

            if($().select2) {
                ele.find('select').select2('val', '');
            } else {
                ele.find('select').val('');
            }
        },

        disableFormSectionInputs: function(ele) {
            if(typeof(ele) === 'string') { ele = $(ele); }

            ele.find('input:not(:radio,:checkbox)').attr('disabled', 'disabled');
            ele.find('input:radio:not(.toggle)').attr('disabled', 'disabled').uniform('update');
            ele.find('textarea').attr('disabled', 'disabled');

            if($().select2) {
                ele.find('select').prop('disabled', true);
            } else {
                ele.find('select').attr('disabled', 'disabled');
            }
        },

        enableFormSectionInputs: function(ele) {
            if(typeof(ele) === 'string') { ele = $(ele); }

            ele.find('input:not(:radio,:checkbox)').removeAttr('disabled');
            ele.find('input:radio:not(.toggle)').removeAttr('disabled').uniform('update');
            ele.find('textarea').removeAttr('disabled');

            if($().select2) {
                ele.find('select').prop('disabled', false);
            } else {
                ele.find('select').removeAttr('disabled');
            }
        },

        UpdateQueryString: function(key, value, url) {
            if (!url) url = window.location.href;
            var re = new RegExp("([?&])" + key + "=.*?(&|#|$)(.*)", "gi"),
                hash;

            if (re.test(url)) {
                if (typeof value !== 'undefined' && value !== null)
                    return url.replace(re, '$1' + key + "=" + value + '$2$3');
                else {
                    hash = url.split('#');
                    url = hash[0].replace(re, '$1$3').replace(/(&|\?)$/, '');
                    if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                        url += '#' + hash[1];
                    return url;
                }
            }
            else {
                if (typeof value !== 'undefined' && value !== null) {
                    var separator = url.indexOf('?') !== -1 ? '&' : '?';
                    hash = url.split('#');
                    url = hash[0] + separator + key + '=' + value;
                    if (typeof hash[1] !== 'undefined' && hash[1] !== null)
                        url += '#' + hash[1];
                    return url;
                }
                else
                    return url;
            }
        },

        updateQueryString: function(key, value, url) {
            var newurl = handleUpdateQueryString(key, value, url);
            window.history.pushState({path:newurl}, '', newurl);
        },

        getNamedUrlFromForm: function(baseUrl, formElement) {
            if(typeof(formElement) === 'string') {
                formElement = $(formElement);
            }

            var formData = formElement.serializeArray();
            var namedParts = [];

            namedParts.push(baseUrl);

            $.each(formData, function(index, obj) {
                var key = obj.name;
                var value = obj.value;

                var keyString = key.replace('data[', '').replace('][', '.').replace(']', '');

                if(value !== '') {
                    if(keyString != '_method') {
                        namedParts.push(keyString+':'+value);
                    }
                }
            });
            url = namedParts.join("/");
            return url;
        },

        numToWords: function (num) {
            var a = ['', 'One ', 'Two ', 'Three ', 'Four ', 'Five ', 'Six ', 'Seven ', 'Eight ', 'Nine ', 'Ten ', 'Eleven ', 'Twelve ', 'Thirteen ', 'Fourteen ', 'Fifteen ', 'Sixteen ', 'Seventeen ', 'Eighteen ', 'Nineteen '];
            var b = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

            if ((num = num.toString()).length > 9) return 'overflow';
            n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            if (!n) return;
            var str = '';
            str += (n[1] !== 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'Crore ' : '';
            str += (n[2] !== 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'Lakh ' : '';
            str += (n[3] !== 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'Thousand ' : '';
            str += (n[4] !== 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'Hundred ' : '';
            str += (n[5] !== 0) ? ((str !== '') ? '& ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'only ' : '';
            return str;
        },

        /**
         *  Update Toggle Columns Dropdown based on Table Rendered
         */
        updateTableColumnsToggler: function() {
            $('.dropdown-checkboxes').each(function(index, element) {
                var toggleColsDropdown = $(this);
                var targetTable = $(this).data('table');

                var tableColumns = [];
                $('#'+targetTable+' th').each(function(index, element) {
                    tableColumns.push(($(this).text()).trim());
                });

                var availableChecboxes = $('[data-table='+targetTable+'] input:checkbox').length;

                if(availableChecboxes === 0) {
                    // If no checkboxes are mentioned then find columns in the table
                    // and add it into the dropdown

                    if(tableColumns.length < 2) {
                        toggleColsDropdown.prev().addClass('disabled');
                    } else {
                        toggleColsDropdown.prev().removeClass('disabled');
                    }

                    $.each(tableColumns, function(index, val) {
                        if(!empty(val)) {
                            var cbHtml = '<label><input type=\"checkbox\" checked>'+val+'</label>';
                            toggleColsDropdown.append(cbHtml);
                        }
                    });
                }

                $('[data-table='+targetTable+'] input:checkbox').each(function(index, element) {
                    var cb = $(this);
                    var cbLabel = $(this).closest('label').text();
                    var columnIndex = tableColumns.indexOf(cbLabel);

                    if(columnIndex >= 0) {
                        // Column found
                        cb.removeAttr('disabled').attr('data-column', columnIndex+1);

                        if($('#'+targetTable+' th').eq(columnIndex).css('display') != 'none') {
                            cb.attr('checked', 'checked');
                        } else {
                            cb.removeAttr('checked');
                        }
                    } else {
                        // Column not found
                        cb.removeAttr('checked').attr('disabled', 'disabled');
                    }
                });

                if (jQuery().uniform) {
                    $('[data-table='+targetTable+'] input:checkbox').uniform('update');
                }

                $.cookie.json = true;
                var tableColumnCookieSeting = $.cookie(targetTable+'ToggleColumns');

                if(empty(tableColumnCookieSeting)) {
                    core.tableColumnsTogglerSetCookie($(this));
                } else {
                    // console.log(tableColumnCookieSeting);
                    $.each(tableColumnCookieSeting, function (index, value) {
                        $('[data-table='+targetTable+'] input:checkbox[data-column="'+index+'"]').attr('checked', value);
                    });

                    core.displayTableColumnsBasedOnColumnsToggler();
                }

                if (jQuery().uniform) {
                    $('[data-table='+targetTable+'] input:checkbox').uniform('update');
                }

            });
        },


        /**
         *
         */
        tableColumnsTogglerSetCookie: function(ele) {
            var targetTable = ele.data('table');
            var cookieJSON = {};

            $('input[type=checkbox]', ele).map(function() {
                cookieJSON[$(this).data('column')] = $(this).is(':checked');
            });

            $.cookie.json = true;
            $.cookie(targetTable+'ToggleColumns', cookieJSON);
        },

        /**
         *  Update Table based on selected Toggle Columns Dropdown
         */
        displayTableColumnsBasedOnColumnsToggler: function() {
            $('.dropdown-checkboxes').each(function(index, element) {
                var targetTable = $(this).data('table');

                var tableColumns = [];
                $('#'+targetTable+' th').each(function(index, element) {
                    tableColumns.push(($(this).text()).trim());
                });

                $('[data-table='+targetTable+'] input:checkbox').each(function(index, element) {
                    var cb = $(this);
                    var cbLabel = $(this).closest('label').text();
                    var columnIndex = tableColumns.indexOf(cbLabel) + 1;

                    if(columnIndex >= 0) {
                        // Column found

                        var col = $('#'+targetTable+' tr th:nth-child('+columnIndex+'), #'+targetTable+' tr td:nth-child('+columnIndex+')');

                        if(!cb.is(':checked')) {
                            col.addClass('hide');
                        } else {
                            col.removeClass('hide');
                        }
                    } else {
                        // Column not found
                        cb.removeAttr('checked').attr('disabled', 'disabled');
                    }
                });
                if (jQuery().uniform) {
                    $('[data-table='+targetTable+'] input:checkbox').uniform('update');
                }
            });
        },

        getDatesFromRange: function(startDate, endDate) {
            var dates = [];

            if(typeof startDate === 'string') {
                startDate = moment(startDate, dateFormatUpperCase);
            }

            if(typeof endDate === 'string') {
                endDate = moment(endDate, dateFormatUpperCase);
            }

            dates.push(startDate.clone().format(dateFormatUpperCase));

            var currDate = startDate.clone().startOf('day');
            var lastDate = endDate.clone().startOf('day');

            while(currDate.add(1, 'days').diff(lastDate) <= 0) {
                dates.push(currDate.clone().format(dateFormatUpperCase));
            }

            return dates;
        }
    };
}();

!function ($) {
    $(function(){
        var $window = $(window);

        $('body').tooltip({
            selector: '[data-toggle~=tooltip]'
        });

        $("[data-toggle=popover]")
            .popover()
            .click(function(e) {
                e.preventDefault();
            });

        // Reset Attached Dropdown Chain
        var resetAttachedDropdown = function(form, target) {
            var targetEle = $(target, form);
            if($().select2) {
               targetEle.select2('val', '');
            } else {
               targetEle.val('');
            }
            var newTarget = targetEle.attr('data-target');
            if(!empty(newTarget)) {
                resetAttachedDropdown(form, newTarget);
            } else {
                return;
            }
        };

        var populateParent = function(form, ele) {
            var formId = form.attr('id');
            var eleId = ele.attr('id');
            var fieldName = ele.attr('data-view-model-name');

            var parentField = $('[data-target*="'+fieldName+'Id"]', form);

            var viewUrl = ele.attr('data-view-url');
            if(!empty(viewUrl)) {
                var value;
                if($().select2) {
                    value = ele.select2('val');
                } else {
                    value = ele.val();
                }

                var rootNode = ele.data('view-rootnode');

                viewUrl = viewUrl.replace('datavalue', value);
                $.getJSON(viewUrl, function(data){
                    var json;

                    if(typeof(value) !== 'object') {
                        json = data;
                    } else {
                        json = $.parseJSON(data);
                    }
                    if(empty(json[rootNode])){
                        return;
                    }
                    if(!empty(rootNode)) {
                        json = json[rootNode][fieldName];
                    }

                    $.each(json, function(index, value) {
                        if(index.indexOf("_id") < 0) {
                            return;
                        }
                        var node = $('[name*="['+index+']"]');
                        var tagName = node.prop('tagName');

                        switch(tagName) {
                            case 'SELECT':
                                if($().select2) {
                                    node.select2('val', value);
                                } else {
                                    node.val(value);
                                }
                            break;
                            default:
                                node.val(value);
                            break;
                        }
                    });
                });
            }
        };

        $('body').on('click', '.toogle-form-div', function() {
            var thisEle = $(this);
            var targetDiv = thisEle.data('target-div');
            var targetEle = $(targetDiv);

            if(targetEle.css('display') == 'none') {
                targetEle.show();
                targetEle.removeClass('hide');
                thisEle.text(thisEle.text().replace('Add', 'Remove'));

                targetEle.find('input:not(:radio,:checkbox)').removeAttr('disabled');
                targetEle.find('input:radio:not(.toggle)').removeAttr('disabled').uniform('update');
                targetEle.find('textarea').removeAttr('disabled');

                if($().select2) {
                    targetEle.find('select').prop('disabled', false);
                } else {
                    targetEle.find('select').removeAttr('disabled');
                }
            } else {
                if(targetEle.find('[data-delete-row-id]').length === 0) {
                    targetEle.hide();
                    targetEle.addClass('hide');
                    thisEle.text(thisEle.text().replace('Remove', 'Add'));

                    core.resetFormSection(targetEle);

                    targetEle.find('input:not(:radio,:checkbox)').attr('disabled', 'disabled');
                    targetEle.find('input:radio:not(.toggle)').attr('disabled', 'disabled').uniform('update');
                    targetEle.find('textarea').attr('disabled', 'disabled');

                    if($().select2) {
                        targetEle.find('select').prop('disabled', true);
                    } else {
                        targetEle.find('select').attr('disabled', 'disabled');
                    }
                } else {
                    var removeMessage = thisEle.data('remove-message');
                    if(empty(removeMessage)) {
                        removeMessage = 'Cannot remove the section, as there are few records saved in it. First, delete them and then remove the section.';
                    }

                    var alertDiv = thisEle.next('.alert');

                    if(alertDiv.length === 0) {
                        removeMessage = '<div class="alert alert-danger alert-dismissable">'+
                            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+
                            '<span>'+removeMessage+'</span>'+
                            '</div>';

                        thisEle.after(removeMessage);
                    } else {
                        alertDiv.find('span').text(removeMessage);
                    }
                }
            }
        });

        $("body").on("change", '[data-toggle="dropdown-update"]', function(e){
            var ele = $(this);
            var value;
            if($().select2) {
                value = ele.select2('val');
            } else {
                value = ele.val();
            }

            if(empty(value)) {
                return;
            }

            var form = ele.closest('form');

            // Populate attached parent fields
            if(!ele.hasClass('filtered')) {
                populateParent(form, ele);
            }

            var target = ele.data('target');
            if(!empty(target)) {
                var url = ele.data('url');
                url = url.replace('datavalue', value);

                var rootNode = ele.data('rootnode');

                var targetEle = $(target, form);

                core.updateDropDown(targetEle, url, rootNode, function(){
                    targetEle.addClass('filtered');
                });

                // Clear other targets attached to target
                resetAttachedDropdown(form, target);

                var targetAddNewBtn = targetEle.next('.addNewBtn');
                if(!empty(targetAddNewBtn)) {
                    var targetModel = targetAddNewBtn.data('model');
                    var targetBtnLink = targetAddNewBtn.data('original-href');

                    var field = ele.attr('name').replace(/data\[|\]/gi, '').replace(/\[/gi, '.').split('.');
                    if(field.length > 1) {
                        field = field[field.length-1];
                    }
                    var passStr = targetModel+'.'+field+':'+value;
                    targetAddNewBtn.attr('href', targetBtnLink+'/'+passStr);
                }
            }
        });

        $(document).ajaxStart(function() {
            $(".loader").removeClass('hide');
        }).ajaxStop(function() {
            $(".loader").addClass('hide');
//          $("input:radio, input:checkbox").uniform({resetSelector: 'button[type="reset"]'});
        });

        $("body").on("click", "[data-toggle='ajaxLink']", function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            var target = $(this).data('target');
            $(this).addClass('active');

            var el = $(target);
            // console.log(el);
            if(el.length !== 0) {
                el.html(core.progressBar).load(url+' '+target, function() {
                    el.addClass('loaded');
                });
            } else {
                window.location.href = url;
            }
        });

        $("body").on("click", ".removeRow", function(e){
             var tbody = $(this).closest('table').children('tbody');
             var trCount = tbody.find('tr').length;
             var lastChild = $(this).closest('tr');
             if(trCount == 1){
                 lastChild.hide();
                 lastChild.find('input, textarea, select').attr("disabled", true);
             }else{
                e.preventDefault();
                lastChild.closest('tr').remove();
             }
        });

        $("body").on("change", "[data-toggle='group-checkable']", function(e){
            var set = $(this).attr("data-set");
            var checked = $(this).is(":checked");
            $(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            $.uniform.update(set);
        });

        $('body').on('click', '.dropdown-menu.hold-on-click', function(e){
            e.stopPropagation();
        });

        var timer = 0;

        $('body').on('mouseenter', '.youtube-thumbnail', function() {
            var imageEle = $(this);
            var imageUrl = imageEle.attr('src');
            var urlParts = imageUrl.split('/');
            var lastElementIndex = urlParts.length - 1;

            var count = 1;
            timer = setInterval(function(){
                newFileName = count+'.jpg';
                urlParts[lastElementIndex] = newFileName;
                var newUrl = urlParts.join('/');

                imageEle.attr('src', newUrl);
                count++;

                if(count > 3) {
                    count = 0;
                }
            }, 600);

        }).on('mouseleave', '.youtube-thumbnail', function() {
            if (timer) {
                clearInterval(timer);
                timer = 0;
            }
        });
    });
}(window.jQuery);

$(window).bind('beforeunload',function(){
    $('.page-content .animated').addClass('fadeOut');
});

// Additional jQuery functions

function hasHandler(element, event) {
    var ev = $._data(element, 'events');
    return (ev && ev[event]) ? true : false;
}
