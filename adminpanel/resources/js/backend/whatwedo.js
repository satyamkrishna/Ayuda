$(document).ready(function()
{
	$('#update').click(function() {
		var content=$('.whatwedo').val();
		$.post('ajax-misc.php',{'func':'whatwedo','content':content},function(data)
		{
			if(data=='Ok')
			{
				
			}
			else
			{
				alert('Failed');
			}
		});
	});
});
