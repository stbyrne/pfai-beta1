
function ConvertFormToJSON(form){
			var array = $(form).serializeArray();
			var json = {};
			
			$.each(array, function() {
				json[this.name] = this.value || '';
			});
			
			return json;
		};

$(function(){
    
	console.log('jQuery Loaded');
    
    

    
 /*Posting News to submitnews.php*/    
    
    $('form#new-article').bind('submit', function(event){
        event.preventDefault();
        
        var form = this;
        var newsjson = ConvertFormToJSON(form);
        var tbody = $('#news-articles > tbody');
        
        $.ajax({
            type: "POST",
            url: "submitnews.php",
            data: newsjson,
            dataType: "json"
            }).success(function(state) { 
            console.log(state);
                    if(state.success === true) {
                        tbody.append('<tr><th><input type="checkbox"/></th><td>' + state['headline'] + '</td><td><img src="../images/news/' + state['image'] + '"></td><td>' + state['caption'] + '</td><td>' + state['text'] + '</td></tr>');
                        
                        $('#new-article').each(function(){
                            this.reset();
                            
                        });
                        
                        console.log(json);
                        
                    } else {
                        alert(state.error.join());
                    }
                }).fail(function(state) { 
                alert("Failed to add article"); 
            });
        
        
        
    });
    
    
    
});

var $check = $('tr input:checkbox');

$check.each(function(){
    var $id = $(this).attr('id');
    
    $(this).closest('th').append($('<div/>', {
        'class': 'btn-group',
        'id': 'edit-' + $id
    }).html('<button type="button" name="delete-row" class="btn btn-danger btn-sm">Delete</button><button type="button" id="' + $id + '" name="cancel-delete-row" class="btn btn-default btn-sm">Cancel</button>').hide()); 
    
});

$check.click(function(){
    
    var idnum = $(this).attr('id');
    $('#edit-' + idnum).toggle(500);
    
});

var $cancel = $('button[name=cancel-delete-row]');

$cancel.click(function(){
    console.log('Cancelled');
    $(this).closest('div').hide(500);
    alert($(this).attr('id'));
    /*if($(this).closest('input:checked').prop('checked', true)){
    $(this).closest('input:checked').prop('checked', false);
    }*/
    
});





$('button[name=delete-row]').click(function(){
    console.log('Danger');
    
    $('tr input:checkbox').each(function(i){
        console.log(i);
        if(this.checked){
         
          
            /*if(confirm('Are you sure you want to delete ' + $name)){
                console.log('deleting');
                $(this).closest('tr').remove();
                
            }else{
                console.log('cancelled');
                
            }*/
            /*return false;*/
             /*$(this).closest('tr').remove();*/
        }
    });
    return false;
});
        
  
    






	


	







