jQuery(function($){
	
	// generate a slug when the user types a title in
	pyro.generate_slug('input[name="name"]', 'input[name="slug"]');

	$('#btnaddcp').colorbox({
			srollable: false,
			innerWidth: 700,
			innerHeight: 280,
			href: SITE_URL + 'admin/cic/cp/create_ajax',
			onComplete: function() {
				$.colorbox.resize();
				$('form#cp_frm').removeAttr('action');
				$('form#cp_frm').live('submit', function(e) {
					
					var form_data = $(this).serialize();
					
					$.ajax({
						url: SITE_URL + 'admin/cic/cp/create_ajax',
						type: "POST",
					        data: form_data,
						success: function(obj) {
							
							if(obj.status == 'ok') {
								
								//succesfull db insert do this stuff
								var select = '#cp_select';
								var opt_val = obj.cp;
								var opt_text = obj.title;
								var option = '<option value="'+opt_val+'" selected="selected">'+opt_text+'</option>';
								
								//append to dropdown the new option
								console.log($(select));
								$(select).append(option);
																
								// TODO work this out? //uniform workaround
								//$('#blog-options-tab li:first span').html(obj.title);
								$(select).trigger("liszt:updated");
								
								//close the colorbox
								$.colorbox.close();

							} else {
								//no dice
							
								//append the message to the dom
								$('#cboxLoadedContent').html(obj.message + obj.form);
								$('#cboxLoadedContent p:first').addClass('notification error').show();
							}
						}
						
						
					});
					e.preventDefault();
				});
				
			}
		});

	
	if($('#cic_type').val()==1){
		$(".comp_holder").slideUp();
		//$("#i_name_holder").slideDown();
	} else {
		$(".comp_holder").slideDown();
		//$("#i_name_holder").slideUp();
	}
	

	$('#cic_type').change(function(){
		if($(this).val()==1){
			$(".comp_holder").slideUp();
			//$("#i_name_holder").slideDown();
		} else {
			$(".comp_holder").slideDown();
			//$("#i_name_holder").slideUp();
		}
	});

	$('.addmore').click(function(){
		var newelement = $(this).prev('input').clone();
		//console.log(input);
		//$(newelement).after('<span onclick="$(this).parent(\'.new\').remove();">Remove[-]</span>');
		$(this)
			.parents('.more_container')
			.append(newelement)
			.append("<br/>")
		return false;
	});
	/*
	$("#btnaddcp").colorbox({inline:true, width:"50%"});
	$('#btnaddcp').click(function(){
		return false;
	});
	*/

});