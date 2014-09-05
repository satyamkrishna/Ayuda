$(document).ready(function() 
{
	ont = $('.user').dataTable(
    {
    	'iDisplayLength': 25,
        "sPaginationType": "full_numbers"
    });   
	
	$('#city_select').change(function()
	{
		$('#email_div').hide();
	});
	
	$('#get_report').click(function()
	{
		url = $('#url').html() + $('#city_select option:selected').val();
		window.location.href = url;
	});
	
	$('#get_excel').click(function()
	{
		email   = $.trim($('#email_select option:selected').html());
		city_id = $.trim($('#city_id').html());
		func    = $.trim($('#func').html());
		name    = $.trim($('#city_select option:selected').html());
		
		$.post('ajax-report.php',{func:func,email:email,city_id:city_id,name:name},function()
		{
			$('#myModal').html('<h4>Email Sent Successfully.</h4><p>Check your email.</p><a class="close-reveal-modal">&#215;</a>');
		});
	});
});