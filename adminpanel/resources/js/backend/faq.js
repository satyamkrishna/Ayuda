$(document).ready(function() {
	ont = $('.faq').dataTable(
    {
        "sPaginationType": "full_numbers"
    });
    
    var flag=false;
    var deleteFaqId,editFaqId,selector;
    $('.faq').on('click','.delete-faq',function() {
    	var resp = confirm('Are you sure you want to delete this?');
    	if(resp==true)
    	{
    		deleteFaqId = $(this).closest('div').attr('id');
    		selector=$(this).closest('tr');
	    	$.post('ajax-faq.php',{'func':'del-faq','faqID':deleteFaqId},function(data)
	    	{
	    		if(data=="Ok")
	    		{
	    			ont.fnDeleteRow(selector[0]);
	    		}
	    		else
	    		{
	    			alert('Fail');
	    		}
	    	});
    	}
	    	
	    });
    	
    	
    	$('.edit-faq').on('click',function() {
	    	editFaqId = $(this).closest('div').attr('id');
	    	selector = $(this).closest('tr');
	    	var count=0
	    	$('#addFaq').html('Update Faq');
	    	selector.find('td').each(function()
	    	{
	    		if(count==1)
	    		$('#question').val($(this).html());
	    		else if(count==2)
	    		$('#answer').val($(this).html());
	    			    		
	    		count++;
	    		
	    	});
	    	flag = true;
	    	
	    });
    
    $('#addFaq').click(function() {
    	var title = $('#question').val();
    	var content = $('#answer').val();
    	
    	if(flag == false)
    	{
    		$.post('ajax-faq.php',{'func':'add-faq','question':title,'answer':content},function(data)
	    	{
	    		data = JSON.parse(data);
	    		if(data.result=="Ok")
	    		{
	    			$('input[type="text"],textarea').each(function(index) {
					  $(this).val('');
					});
					
			    	ont.fnAddData([data.no,title,content,'<div id="'+data.no+'"><input type="button" class="edit-button edit-faq"/><input type="button" class="delete-button delete-faq"/></div>']);   	
			    	
					
	    		}
	    	});
    	}
    	else
    	{
    		//alert('editServiceId');
    		$.post('ajax-faq.php',{'func':'edit-faq','question':title,'answer':content,'id':editFaqId},function(data)
	    	{
	    		flag =false;
	    		if(data=="Ok")
	    		{
	    			$('#addFaq').html('Add Faq');
	    			$('input[type="text"],textarea').each(function(index) {
					  $(this).val('');
					});
					selector.find('td').each(function(index) {
					  switch(index)
					  {
					  	case 0:
					  	break;
					  	case 1:
					  	$(this).html(title);
					  	break;
					  	case 2:
					  	$(this).html(content);
					  	break;
					  }
					});
	    		}
	    	});
    	}
    	
    });
});

