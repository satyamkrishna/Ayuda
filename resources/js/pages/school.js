$(document).ready(function() {
	var upload= $('#upload').upload({
        name: 'file',
        action: 'fileUpload.php',
        enctype: 'multipart/form-data',
        params: {'func':'profile'},
        autoSubmit: true,
        onSubmit: function() {
        	//alert('submit');
        },
        onComplete: function(data) {
        	alert('Complete');
        	alert(data);
        },
        onSelect: function() {
        	//alert('Select');
        }
	});
	var name,email,passeord,confpassword,mobile,country,city,institute;
	$('#signup').click(function() {
		name=$('#name').val();
		password=$('#password').val();
		confpassword=$('#confpassword').val();
		mobile=$('#mobile').val();
		scountry=$('#country').val();
		city=$('#city').val();
		institute=$('#institute').val();
		//alert($(this).closest('.form').html());
		var flag=true;
		message = '';
		$(this).closest('.form').find('.required').each(function(index) {
		  	//alert($(this).attr('name'));
			
		  	if($(this).val()=='')
		  	{
		  		message = message + 'Please Enter '+$(this).attr('name') + '\n';
		  		flag=false;
		  	}
		  	
		  		
		});
		if(flag == false)
  		{
	  		alert(message);
  		}
		else
		{
			if(password!=confpassword)
			{
				alert('The passwords do not match');
			}
			else
			{
				$('a.reveal-link').trigger('click');
			}
		}
		
		//$('a.reveal-link').trigger('click');
	});
	
	$('#confirmreg').click(function() {
		if ($('#accept').is(':checked')) {
			$('a.close-reveal-modal').trigger('click');
			$('#form-school').submit();
		}else
		{
			
		}
	});
	
	
	
});

