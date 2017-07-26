root_URL = "http://desenv.duckdns.org:8080/~rmattos/partiu/api/users";
form_save = document.querySelector('#form_save');
listed_users = $('table tbody');
input_name = $('input#name');
input_value = $('input#value');
button_save = $('button#save');
button_create = $('button#create');
button = $('button');
container_form = $('#container_form');

$(document).ready(function() {
 
    listed_users.on('click','a',function(event){
    	event.preventDefault();
    	if($(this).data('action')=='update'){
    		if(!container_form.is(':visible')){
    			container_form.fadeIn();	
    		}
    	    form_save.setAttribute('data-user_id', $(this).closest('tr').data('id'));	
    	    input_name.val($(this).closest('tr').children('td:eq(1)').text());
    	    input_value.val($(this).closest('tr').children('td:eq(2)').text());
    	    button_save.text('Atualizar');
    	}
    	if($(this).data('action')=='delete'){
    		remove($(this).closest('tr').data('id'));
    	}    	
    });

    button.on('click', function(event){
    	event.preventDefault();
    	if($(this).prop('id')=='save'){
    		save();	
    	}
    	if($(this).prop('id')=='create'){
    		if(!container_form.is(':visible')){
    			container_form.fadeIn();	
    		}
    	}
    	
    });
});



function listAll() {
    $.ajax({
        type: 'GET',
        url: root_URL,
        crossDomain:true,
        dataType: "json", 
        success: renderList
    });
}

function remove(cod){
	$.ajax({
		 type: 'DELETE',
	     url: root_URL + '/' + cod,
	     crossDomain:true,
         dataType: "json", 

	     success: function(data){
	        
	     },
	     error: function(){
	            
	     }
 	});
 	listed_users.find('tr').each(function(indice){
		if($(this).data('id')==cod){
	    	$(this).remove();
	    }
	 });
}

function save(){
		var userId = form_save.getAttribute('data-user_id');

    	var saveParams = {
	    	name:  input_name.val() , 
	    	value: input_value.val()
    	}
    	if(typeof  userId == 'undefined'||userId==''||userId==null){
    		var route = {
    			type: 'POST',
    			url: root_URL
    		}
    	} else {
    		var	route = {
    			type: 'PUT',
	    		url: root_URL+'/'+userId
	    	}
    	}
    	$.ajax({
			type: route.type,
			headers:{'Content-Type': 'application/json'},
			url: route.url,
			crossDomain:true,
			dataType: "json",
			data: JSON.stringify(saveParams),
			success: function(data){
				listAll();
				
				container_form.fadeOut(function(){
					form_save.removeAttribute('data-user_id');
					input_name.val('');
					input_value.val('');
				});
			},
			error: function(){
				console.log('error');
			}
		});
    }

function renderList(data) {
	var users = '';
	$.each(data, function(index, user) {
		 	users += '<tr data-id="' + user.id + '">';
		    users += '<td>'+user.id+'</td>';
		    users += '<td id="name" data-name="' + user.name + '">'+user.name+'</td>';
		    users += '<td id="value" data-value="' + user.value + '">'+user.value+'</td>';
		    users += '<td>';
			users += '<div class="btn-group">';
		    users += '<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">';
		    users += 'Ação<span class="caret"></span></button>';
		    users += '<ul class="dropdown-menu" role="menu">';
		    users += '<li><a href="#" data-action="update">Alterar</a></li>';
		    users += '<li><a href="#" data-action="delete">Remover</a></li>';
			users += '</ul></div></td>';
			users += '</tr>';
	});
	listed_users.html(users);
}