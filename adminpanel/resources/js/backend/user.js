$(document).ready(function() {
	ont = $('.user').dataTable(
    {
        "sPaginationType": "full_numbers"
    });    
	
	$('.send-certificate').on("click",function()
	{
		userID = $(this).closest('tr').attr('id');
		$(this).attr('value','Resend');
		$.post('ajax-user.php',{func:'sendCert',userID:userID},function(data)
		{
		
		});
	});
	
	$('.send-all-1').click(function()
	{
		$.post('ajax-user.php',{func:'getUser'},function(data)
		{
			data  = jQuery.parseJSON(data);
			
			$.each(data,function(i,val)
			{
				$.post('ajax-user.php',{func:'sendCert',userID:val.userID},function(data)
				{
				
				});
				
			});
			

			
		});
	});
	
	$('.send-all-mail').click(function()
	{
		$.post('ajax-user.php',{func:'getUser'},function(data)
		{
			data  = jQuery.parseJSON(data);
			$.each(data,function(i,val)
			{
				userID = val.userID;
				if(val.userCertificateStatus == 0)
				{
					$.post('ajax-user.php',{func:'sendMail',userID:userID},function(data)
					{
					
					});
				}
			});
		});
	});

	$('.send-all').click(function()
	{
		$.post('ajax-user.php',{func:'getUser'},function(data)
		{
			data  = jQuery.parseJSON(data);
			$.each(data,function(i,val)
			{
				userID = val.userID;
				if(val.userCertificateStatus == 0)
				{
					$.post('ajax-user.php',{func:'sendCert',userID:userID},function(data)
					{
					
					});
				}
			});
		});
	});

	
});