jQuery(document).ready(function() {

	/* audio short code generate */
	jQuery("body").on("click", ".gen-short", function(e) {

		e.preventDefault();
		jQuery(".aud-text-wrap .err-txt").remove();
		var data_id = jQuery(this).data('id');
		var file_val = jQuery("input[type='file'][data-id='"+data_id+"']").val();
		var num_val = jQuery("input[type='number'][data-id='"+data_id+"']").val();
		var sel_val = jQuery("select.button-type[data-id='"+data_id+"']").val();
		if(file_val == '') {
			jQuery(".aud-text-wrap input[type='file'][data-id='"+data_id+"']").closest('td').addClass('error');
			jQuery("body .aud-text-wrap").find("td.error").append("<span class='err-txt'>Please upload audio file</span>");
			return false;
		}else {
			jQuery(".aud-text-wrap .err-txt").remove();
		}
		

		if(num_val == '') {
			jQuery(".aud-text-wrap input[type='number'][data-id='"+data_id+"']").closest('td').addClass('errornum');
			jQuery("body .aud-text-wrap").find("td.errornum").append("<span class='err-txt'>Please enter seconds to play</span>");
			return false;
		}else {
			jQuery(".aud-text-wrap .err-txt").remove();
		}

		var dataf =  new FormData();
		dataf.append('action', 'generate_code');
		dataf.append('theFile', jQuery("input[type='file'][data-id='"+data_id+"']")[0].files[0]);
		dataf.append('num_val', num_val);
		dataf.append('btn_val', sel_val);

		jQuery.ajax({
            url: aud_txt_ajax.ajax_url,
            type: 'post',
            dataType: 'json',
            data: dataf,
            processData: false,
    		contentType: false,
            success: function (response) {
            	console.log(response);
            	if(response.status == 'success') {
            		jQuery("td.short-code[data-id='"+data_id+"']").show();
            		jQuery("#short_dis"+data_id).val(response.html);
            		jQuery("#add-more-aud").show();
            	} else {
            		
            	}
            }
        });
		

	});


	/* text short code generate */
	jQuery("body").on("click", ".gen-short-text", function(e) {

		e.preventDefault();
		jQuery(".aud-text-wrap .err-txt").remove();
		var data_id = jQuery(this).data('id');
		var text_val = jQuery("textarea[data-id='"+data_id+"']").val();
		var sel_val = jQuery("select.button-text[data-id='"+data_id+"']").val();
		if(text_val == '') {
			jQuery(".aud-text-wrap textarea[data-id='"+data_id+"']").closest('td').addClass('error');
			jQuery("body .aud-text-wrap").find("td.error").append("<span class='err-txt'>Please enter text</span>");
			return false;
		}else {
			jQuery(".aud-text-wrap .err-txt").remove();
		}	

		var dataf =  new FormData();
		dataf.append('action', 'text_generate_code');
		dataf.append('text_val', text_val);
		dataf.append('btn_val', sel_val);

		jQuery.ajax({
            url: aud_txt_ajax.ajax_url,
            type: 'post',
            dataType: 'json',
            data: dataf,
            processData: false,
    		contentType: false,
            success: function (response) {
            	console.log(response);
            	if(response.status == 'success') {
            		jQuery("td.short-code-text[data-id='"+data_id+"']").show();
            		jQuery("#short_text"+data_id).val(response.html);
            		jQuery("#add-more-text").show();
            	} else {
            		
            	}
            }
        });
		

	});


    /* add more audio */
    jQuery('#add-more-aud').click(function (e){
    	var count = parseInt(jQuery("#aud-count").val());
	   	jQuery.ajax({
            url: aud_txt_ajax.ajax_url,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'aud_txt_more',
                count : count
            },
            success: function (response) {
            	if(response.data) {
            		jQuery(".new-row").before(response.data);
            		count = count + 1;
            		jQuery("#aud-count").val(count);
            	} 
            }
        });
	});


	/* add more text */
    jQuery('#add-more-text').click(function (e){
    	var count = parseInt(jQuery("#text-count").val());
	  	jQuery.ajax({
            url: aud_txt_ajax.ajax_url,
            type: 'post',
            dataType: 'json',
            data: {
                action: 'text_load_more',
                count : count
            },
            success: function (response) {
            	if(response.data) {
            		jQuery(".new-row-text").before(response.data);
            		count = count + 1;
            		jQuery("#text-count").val(count);
            	} 
            }
        });
	});


	/* Remove audio btn*/
	jQuery("body").on("click", ".remove_row", function () {
		var data_id = jQuery(this).data("id");
		jQuery(this).closest("tr").remove();
	});


	/* Copy audio shortcode*/
	jQuery("body").on("click", ".copy-short", function(e) {
		e.preventDefault();
		var data_id = jQuery(this).data('id');
		var copyText = document.getElementById("short_dis"+data_id);

		copyText.select();
		copyText.setSelectionRange(0, 99999);
		navigator.clipboard.writeText(copyText.value);

		jQuery(this).addClass('show-aud');
		setTimeout(RemoveClass, 1000);  		
	});

	/* Copy text shortcode*/
	jQuery("body").on("click", ".copy-short-text", function(e) {
		e.preventDefault();
		var data_id = jQuery(this).data('id');
		var copyText = document.getElementById("short_text"+data_id);

		copyText.select();
		copyText.setSelectionRange(0, 99999);
		navigator.clipboard.writeText(copyText.value);


		jQuery(this).addClass('show-txt');
		setTimeout(RemoveClassText, 1000);  		
	});

 	
} );


function RemoveClass() {
	jQuery("body .copy-short.show-aud").removeClass("show-aud");
}
function RemoveClassText() {
	jQuery("body .copy-short-text.show-txt").removeClass("show-txt");
}
