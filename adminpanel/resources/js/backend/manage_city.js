$(document).ready(function() 
{
	ont = $('.user').dataTable(
    {
    	'iDisplayLength': 100,
        "sPaginationType": "full_numbers"
    });   
	
	$('.update').on("click",function()
	{
		button = $(this).closest('tr');//.find('.button');
		city_name = $(this).closest('tr').find('.city_name').html();
		select_id = $(this).closest('tr').find('#select_city option:selected').val();
		$.post('ajax-city.php',{city_name:city_name,select_id:select_id},function(data)
		{
			if($.trim(data)=='done')
			{
				button.css('display','none');
			}
			else
			{
				alert('The Data was not added.')
			}
		});
	});
});