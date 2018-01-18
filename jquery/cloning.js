var randCounter = 1000;

//global function for cloning
function makeClone(cloneParentId, max, getclonehtml, ittrator) {
    if (max === undefined || max.trim() === '' || parseInt(max) < 0) {
        max = 5;
    } else {
        max = parseInt(max);
    }
    if (max && $('#' + cloneParentId).children().length >= max) {
        alert('You reached the maximum limit');
        return false;
    }
    var reg_ex = new RegExp("\\[1\\]", "g");
    if (ittrator !== undefined) {
        reg_ex = new RegExp("\\[" + ittrator + "\\]", "g");
    }
    var html = $('#' + cloneParentId + ' :first').clone();
    html.find('.select2.select2-container').remove();
    if (html.prop('name') !== undefined) {
        html.each(function () {
            if ($.inArray($(this).prop('type'), ['checkbox', 'radio']) !== -1) {
                $(this).attr('checked', false).prop('checked', false);
            } else {
                $(this).val('');
            }
            $(this).prop('name', $(this).prop('name').replace(reg_ex, '[' + randCounter + ']')).removeAttr('id');
        });
    }
    html.find('input').each(function () {
        if ($.inArray($(this).prop('type'), ['checkbox', 'radio']) !== -1) {
            $(this).attr('checked', false).prop('checked', false);
        } else {
            $(this).val('');
        }
        $(this).prop('name', $(this).prop('name').replace(reg_ex, '[' + randCounter + ']')).removeAttr('id');
    });
    html.find('select').each(function () {
        $(this).val('');
        $(this).prop('name', $(this).prop('name').replace(reg_ex, '[' + randCounter + ']'));
    });
    html.find('.selectBoxDropdown').removeClass('select2-hidden-accessible').removeAttr('tabindex').select2({"width": "100%"});
    randCounter++;
    if (getclonehtml !== undefined && getclonehtml == true) {
        return html;
    } else {
        $('#' + cloneParentId).append(html);
    }

}
//global function for remove clone.

function removeClone(dom, container) {
    $(dom).closest(container).remove();
}

function getAjaxData(url, payload, callbackfun) {
    $.ajax({
        url: url,
        type: 'post',
        timeout: 60000, // sets timeout to 60 seconds
        data: payload,
        success: function (data) {
            if (data['response'] === undefined) {
                alert('Something went wrong please try again.');
            } else {
                data = data['response'];
            }
            if (data['error'] !== undefined) {
                alert(data['message']);
            } else {
                callbackfun(data);
            }
        },
        error: function (jqXHR) {
            alert(jqXHR);
        }
    });
}

function getOppurtunity(client) {
    $('#oppurtunity').html('<option value="">Select Oppurtunity</option>').val('').trigger('change');
    if ($(client).val().trim() === '') {
        return false;
    }
    getAjaxData(base_url + '/getOppurtunity/' + $(client).val(), {}, fillOppurtunity);
}

function fillOppurtunity(data) {
    $.each(data, function (value, name) {
        $('#oppurtunity').append('<option value="' + value + '">' + name + '</option>');
    });
    var fill_value = '';
    if ($('#oppurtunity').attr('init_value') !== undefined) {
        fill_value = $('#oppurtunity').attr('init_value');
        $('#oppurtunity').attr('disabled', 'disabled');
    }
    $('#oppurtunity').val(fill_value).trigger('change');
}

function getContactDetails(oppurtunity) {
    $('.Contact-person-options').html('<option value="">Select Contact Person</option>').val('').trigger('change');
    if ($(oppurtunity).val().trim() === '') {
        return false;
    }
    getAjaxData(base_url + '/getContacts/' + $('#client').val() + '/' + $(oppurtunity).val(), {}, fillContactDetails);
}

function fillContactDetails(data) {
    $.each(data, function (i, row) {
        $('.Contact-person-options').append('<option value="' + row['id'] + '" data=\'' + JSON.stringify(row) + '\'>' + row['contact_name'] + '</option>');
    });
    if ($('#oppurtunity').attr('init_value') !== undefined) {
        $('.Contact-person-options').each(function () {
            $(this).val($(this).attr('init_value')).trigger('change');
        });
    } else {
        $('.Contact-person-options').val('').trigger('change');
    }
}

function fillMobileDetail(contacts) {
    var data = {"designation": "", "email": "", "location": "", "mobile_no": "", "country_code": "91"};
    var hide = true;
    if ($(contacts).val().trim() !== '') {
        data = JSON.parse($(contacts).find('option[value="' + $(contacts).val() + '"]').attr('data'));
        data['country_code'] = ($.trim(data['country_code']) === '') ? 91 : data['country_code'];
        hide = false;
    }
    var container = $(contacts).parent().parent().parent();
    if (hide) {
        container.find('.contact-container').addClass('hidden');
    } else {
        container.find('.contact-container').removeClass('hidden');
    }
    container.find('.Contact-person-countrycode').val(data['country_code']).trigger('change');
    container.find('.std-code').val('');
    container.find('.mobile-num').val(data['mobile_no']);
    container.find('.Extention').val('');
    container.find('.Email-id').val(data['email']);
    container.find('.designation').val(data['designation']);
    container.find('.autoCompleteLocation').val(data['location']);
}

function addCheckPriceRow(cloneParentId, max, ittrator) {
    var html = makeClone(cloneParentId, max, true, ittrator);
    html.find('a.delete-row').removeClass('hidden');
    $('#' + cloneParentId).append(html);
}

function addPackageNameRow(cloneParentId, cloneParentNameId, max, ittrator) {
    var html = makeClone(cloneParentId, max, true, ittrator);
    html.find('#check_parent_table_body .check_child_row:gt(0)').remove();
    var new_id = 'check_parent_table_body' + Math.floor(Math.random() * 1000000);
    html.find('a.add-pricing-row').attr('onclick', html.find('a.add-pricing-row').attr('onclick').replace('check_parent_table_body', new_id));
    html.find('#check_parent_table_body').attr('id', new_id);
    $('#' + cloneParentId).append(html);
    randCounter -= 1;
    var html = makeClone(cloneParentNameId, max, true, ittrator);
    html.find('a.add-row').addClass('hidden');
    html.find('a.delete-row').removeClass('hidden');
    $('#' + cloneParentNameId).append(html);
    renamePackageName('.' + $('#' + cloneParentId).children().first().prop('class'), '.' + $('#' + cloneParentNameId).children().first().prop('class'));
}

function removePackageNameRow(dom, container, nameContainer) {
    var dom_index = $(nameContainer).index($(dom).closest(nameContainer));
    $(container).eq(dom_index).remove();
    removeClone(dom, nameContainer);
    renamePackageName(container, nameContainer);
}

function renamePackageName(container, nameContainer) {
    $(nameContainer).each(function () {
        var i = $(nameContainer).index(this);
        var name_element = $(this).find('.package_name');
        name_element.attr('placeholder', 'Package ' + (i + 1)).prop('placeholder', 'Package ' + (i + 1));
        if (name_element.val().trim() === '') {
            $(container).eq(i).find('.package_name_tag').html('Package ' + (i + 1));
        }
    });
}

function changePackageName(dom, container, nameContainer) {
    console.log('hello')
    var dom_index = $(nameContainer).index($(dom).closest(nameContainer));
    var text = $(dom).val().trim() === '' ? ('Package ' + (dom_index + 1)) : $(dom).val();
    $(container).eq(dom_index).find('.package_name_tag').html(text);
}

function addPriceSlabRow(cloneParentId, max, ittrator) {
    var html = makeClone(cloneParentId, max, true, ittrator);
    html.find('a.add-row').addClass('hidden');
    html.find('a.delete-row').removeClass('hidden');
    $('#' + cloneParentId).append(html);
}


function addCkeckWisePriceRow(cloneParentId, max, ittrator) {
   var html = makeClone(cloneParentId, max, true, ittrator);
    html.find('a.delete-row').removeClass('hidden');
    $('#'+cloneParentId).append(html);
}

//get standard check price
 $('body').on('change', '.ckeckPriceCheckId', function () {
    var check_id = $(this).val();
    var case_per_year = $('#case_per_year').val();
    var checks_per_case = $('#checks_per_case').val();
    var discount_id = $('.payment_plan_discount').val();
    var standard_price_index = $('.standard_price').index($(this). closest("tr").find('.standard_price'));
    if(check_id === undefined || check_id === '') {
        alert("Please select check first.");
        return false;
    }
    $.ajax({
        url: base_url + '/calculateStandardPrice',
        type: 'post',
        timeout: 60000, // sets timeout to 60 seconds
        data: {'check_id':check_id, 'case_per_year':case_per_year, 'checks_per_case':checks_per_case, 'discount_id':discount_id},
        beforeSend: function(){
            $('.standard_price').eq(standard_price_index).val('');  
        },
        success: function (data) {
            if (data['response'] === undefined) {
                alert('Something went wrong please try again.');
            } else {
                data = data['response'];
            }
            if (data['error'] !== undefined) {
                alert(data['message']);
            } else {               
                $('.standard_price').eq(standard_price_index).val(data.standardPrice);                
            }
        },
        error: function (jqXHR) {
            alert(jqXHR);
        }
    });
 });
 var typingTimer;
 //validate proposed price
 $('body').on('keyup', '.proposed_price', function () {
    clearTimeout(typingTimer);
    var proposed_price = $(this).val();
    var checks_index = $('.ckeckPriceCheckId').index($(this). closest("tr").find('.ckeckPriceCheckId'));
    var standard_price_index = $('.standard_price').index($(this). closest("tr").find('.standard_price'));
    var approval_status_txt_index = $('.approval_status_txt').index($(this). closest("tr").find('.approval_status_txt'));
    var check_id = $('.ckeckPriceCheckId').eq(checks_index).val(); 
    var standard_price = $('.standard_price').eq(standard_price_index).val();
    if(check_id === undefined || check_id === '') {
            alert("Please select check first.");
            return false;
    } 
    typingTimer = setTimeout(function(){
        $.ajax({
                url: base_url + '/validateProposedPrice',
                type: 'post',
                timeout: 60000, // sets timeout to 60 seconds
                data: {'check_id':check_id, 'standard_price':standard_price, 'proposed_price':proposed_price},
                beforeSend: function(){
                   $('.approval_status_txt').eq(approval_status_txt_index).html('');
                },
                success: function (data) {
                    if (data['response'] === undefined) {
                        alert('Something went wrong please try again.');
                    } else {
                        data = data['response'];
                    }
                    if (data['error'] !== undefined) {
                        alert(data['message']);
                    } else {        
                        $('.approval_status_txt').eq(approval_status_txt_index).html(data.message);
                    }
                },
                error: function (jqXHR) {
                    alert(jqXHR);
                    
                }
            });
    }, 1000);
 });
 
 $('body').on('click', '.getcheckpricingDetails', function(){
    $('#check_wise_model_title').html('');
    $('#checck_wise_render_details').html('');
    var checks_index = $('.ckeckPriceCheckId').index($(this). closest("tr").find('.ckeckPriceCheckId'));
    var check_id = $('.ckeckPriceCheckId :selected').eq(checks_index).val();
   if(check_id === undefined || check_id === '') {
        $('#checck_wise_render_details').html('Please select check');        
   }else{
    $('#check_wise_model_title').html($('.ckeckPriceCheckId :selected').eq(checks_index).text());
    $('#checck_wise_render_details').html('No Data Found'); 
   }
 });
 
 
