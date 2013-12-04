function ConvertListToJSON(list){
			var array = $(list).serializeArray();
			var json = {};
			
			$.each(array, function() {
				json[this.name] = this.value || '';
			});
			
			return json;
		};

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

/*Posting Transfer List to Submit.php*/    
    
    $('form#new-player').bind('submit', function(event){
        event.preventDefault();
        
        var list = this;
        var json = ConvertListToJSON(list);
        var tbody = $('#transfer-list > tbody');
        
        $.ajax({
            type: "POST",
            url: "submit.php",
            data: json,
            dataType: "json"
            }).success(function(state) { 
            console.log(state);
                    if(state.success === true) {
                        tbody.append('<tr><th><input type="checkbox"/></th><td>' + state['name'] + '</td><td>' + state['club'] + '</td><td>' + state['pos'] + '</td><td>' + state['age'] + '</td><td>' + state['dob'] + '</td><td>' + state['weight'] + '</td><td style="background-color: ' + state['exp'] + '"></td></tr>');
                        
                        $('#new-player').each(function(){
                            this.reset();
                            
                        });
                        
                        console.log(json);
                        
                    } else {
                        alert(state.error.join());
                    }
                }).fail(function(state) { 
                alert("Failed to add player to list"); 
            });
        });
    
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
});/*End jQuery function*/

/*---------------------------*/

/*Adding a delete and cancel button to each row with a checkbox*/

var $check = $('tr input:checkbox');

$check.each(function(){
    var $id = $(this).attr('id');
    
    $(this).closest('th').append($('<div/>', {
        'class': 'edit-group',
        'id': 'edit-' + $id
    }).html('<button type="button" id="del-' + $id + '"name="delete-row" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button><button type="button" id="' + $id + '" name="cancel-delete-row" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span></button>').hide()); 
    
});

/*Show delete and cancel button when check box is clicked */

$check.click(function(){
    
    var idnum = $(this).attr('id');
    $('#edit-' + idnum).toggle(500);
    
});

/*What to do when cancel button is clicked*/

var $cancel = $('button[name=cancel-delete-row]');

$cancel.click(function(){
    var $id = $(this).attr('id');
    $(this).closest('div').hide(500);
    
    if($('input#' + $id + '').prop('checked', true)){
    $('input#' + $id + '').prop('checked', false);
    }
    
});

/*What to do when delete button is clicked*/

var $delete = $('button[name=delete-row]');

$delete.click(function(){
    var $id = $(this).attr('id').slice(4),
        $rowstring = $(this).parent().parent().closest('tr').attr('id'),
        $rowid = $(this).parent().parent().closest('tr').attr('name'),
        $table = null;
    
    
    if($rowstring.indexOf('t') === 0){
        $table = 'tasks';
        $rowname = $('td#player-' + $id + '').html();
    }
    if($rowstring.indexOf('a') === 0){
        $table = 'articles';
        $rowname = $('td#article-' + $id + '').html();
    }
    
    console.log('Name' + $rowid);
    
    if(confirm('Are you sure you want to delete "' + $rowname + '' + '"')){
            $(this).closest('tr').remove();
            $.ajax({
              type:'POST',
              url:'deletedata.php',
              data:{delete_id: $id, row_id: $rowid, table: $table},
              success:function(data) {
                  console.log(data);
              }
                          
                }).fail(function(){
                    alert('No connection to database at this time.');
                });
    }else{
        return false;
    }
   
});


        
  
    






	


	







