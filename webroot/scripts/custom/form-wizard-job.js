var FormWizardJob = function () {

    return {
        //main function to initiate the module
            init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }
            
            //For Wizard setting
            $('#job_category').select2();
            $('#city').select2();
            $('#area').select2();

            var form = $('#frmJob');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);
            
            jQuery.validator.addMethod("Alphaspacedot", function(value, element) {
      		    return this.optional(element) || /^[a-zA-Z.\s]*$/.test(value);
      		}, "Please enter Letters, dot(.) and space only.");
            
            jQuery.validator.addMethod("Alphabet", function(value, element) {
      		    return this.optional(element) || /^[a-zA-Z]*$/.test(value);
      		}, "Please enter Letters, dot(.) and space only.");
            
            jQuery.validator.addMethod("Alphaspacecomma", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z,\s]*$/.test(value);
        	}, "Please enter Letters,comma,salsh and space only.");
			
			jQuery.validator.addMethod("SeoTitle", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z,\|\s]*$/.test(value);
        	}, "Please enter Letters,comma, horizontal bar(|) and space only.");
			
			jQuery.validator.addMethod("ValidSlug", function(value, element) {
        		return this.optional(element) || /^[a-z-]*$/.test(value);
        	}, "Please enter small Letters and dash(-) only.");
        	
        	jQuery.validator.addMethod("Alphaspacecommadash", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z,-\s]*$/.test(value);
        	}, "Please enter Letters,comma,dash,dot and space only.");
			
			jQuery.validator.addMethod("Address", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z0-9,.-\s]*$/.test(value);
        	}, "Please enter Letters,comma,dash,dot and space only.");
            
            jQuery.validator.addMethod("Alphanumspace", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z0-1\s]*$/.test(value);
        	}, "Please enter Letters, numbers and space only.");
            
            jQuery.validator.addMethod("Alphaspace", function(value, element) {
        		return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
        	}, "Please enter Letters  and space only.");
            
            jQuery.validator.addMethod("Alphanumspacedot", function(value, element) {
      		  return this.optional(element) || /^[a-zA-Z0-1.\s]*$/.test(value);
      		}, "Please enter Letters,number ,space and dot(.) only.");
            
            jQuery.validator.addMethod("validPancard", function (value, element) {
                return this.optional(element) || /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/i.test(value);
            }, "Please enter valid Pan Card No.");	

            jQuery.validator.addMethod("validDate", function (value, element) {
                return this.optional(element) || /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/i.test(value);
            }, "Please enter valid Date.");
            
            jQuery.validator.addMethod("validIFSC", function (value, element) {
                return this.optional(element) || /^([a-zA-Z]){4}([0-9]){7}?$/i.test(value);
            }, "Please enter valid IFSC Code."); 
            
            $.validator.addMethod("extension", function(value, element, param) {
            	param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g|gif";
            	return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
            }, $.validator.format("Please enter a value with a valid extension."));
            
            $('#frmJob').validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'label', //default input error message container
                errorClass: 'error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
					//seo validation
                	seo_title:{
						SeoTitle:true,
						maxlength:250
					},
					seo_key:{
						Alphaspacecomma:true,
						maxlength:300
					},
					seo_desc:{
						Alphaspacecomma:true,
						maxlength:300
					},
					slug:{
						ValidSlug:true,
						maxlength:250
					},
					//job validation
                    job_title:{
                    	required:true,
                    	Alphaspacecomma:true,
						maxlength:300
                    },
                    job_type:{
						required:true,
						digits:true
					},
					job_category:{
						required:true,
						digits:true
					},
					job_desc:{
						required:true,
                    	Alphaspacecomma:true
					},
					exp_year:{
						digits:true
					},
					exp_month:{
						required:true,
						digits:true
					},
					education:{
						required:true,
                    	Alphanumspacedot:true,
                    	maxlength:300
					},
					salary:{
						number:true
					},
					//address validation
					company_name:{
						required:true,
                    	Alphaspacecomma:true,
                    	maxlength:300
					},
					phone_no:{
						digits:true,
						minlength:7,
						maxlength:10
					},
					sid:{
						required:true,
						digits:true
					},
					cid:{
						required:true,
						digits:true
					},
					aid:{
						digits:true
					},
					street1:{
						required:true,
						Address:true,
						maxlength:300
					},
					street2:{
						Address:true,
						maxlength:300
					},
					house_no:{
						Address:true,
						maxlength:200
					},
					pincode:{
						digits:true,
						minlength:6,
						maxlength:6
					},
					address:{
						Address:true,
						maxlength:300
					}
                    
                },

                messages: {
                	job_title: {
                		required:"Job Title field is required."
                	}
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                	error.insertAfter(element); // for other inputs, just perform default behavior
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                /*highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },*/

                success: function (label) {
                	
                },

                submitHandler: function (form) {
                	//success.show();
                    error.hide();
                   form.submit();

                  /*$.ajax({
                		type: $(form).attr("method"),
                		url: $(form).attr("action"),
                		data: $(form).serialize(),
                		dataType: "json",
                        cache: false,
                		success: function(data){
                			if(data.message=="true"){
                				var dataId =0;
                				
                				dataId = parseInt(data.dataId);
                				
                				if(dataId>0){
                					
                					$('#custom-page-message1').html("<div class='note note-success'>"+data.successMessage+"</div>");
                      			    $('.memberRegModel').modal('show');
                				}else{
                					$('#custom-page-message1').html("<div class='note note-warning'>Member Not Register Try again latter</div>");
                      			    $('.memberRegModel').modal('show');
                				}
                				
                			}else{
                				$('#custom-page-message1').html("<div class='note note-warning'>"+data.errorMessage+"</div>");
                  			    $('.memberRegModel').modal('show');
                			} 
                	          
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log(textStatus);
                        }
                	}); */ //end ajax
                    
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });
            
            function clearFrom(){
     		   $('input[type=text]').each(function() {
     	        $(this).val('');
     	       });
     	       $("#frmJob").trigger("reset");
     		}//end clearForm

            var displayConfirm = function() {
              
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    $('#form_wizard_1').find('.button-new-job').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                    $('#form_wizard_1').find('.button-new-job').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    success.hide();
                    error.hide();
                    return false;
                    if (form.valid() == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                   if (form.valid() == false) {
                        return false;
                    }
					
                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function () {

            }).hide();
        }

    };

}();