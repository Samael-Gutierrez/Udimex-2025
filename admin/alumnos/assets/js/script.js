$(document).ready(function(){  	
    $('#nom').keyup(function() {  
        $.ajax({  
            url: 'busca.php?nom='+$('#nom').val()+'&ap='+$('#ap').val()+'&am='+$('#am').val()+'&esc='+$('#esc').val(),  
                success: function(data) {  
                $('#resultado').html(data);
            }  
        });  
    }); 

    $('#ap').keypress(function() {  
        $.ajax({  
            url: 'busca.php?nom='+$('#nom').val()+'&ap='+$('#ap').val()+'&am='+$('#am').val()+'&esc='+$('#esc').val(), 
                success: function(data) {  
                $('#resultado').html(data);
            }  
        });  
    }); 

    $('#am').keypress(function() {  
        $.ajax({  
            url: 'busca.php?nom='+$('#nom').val()+'&ap='+$('#ap').val()+'&am='+$('#am').val()+'&esc='+$('#esc').val(),   
                success: function(data) {  
                $('#resultado').html(data);
            }  
        });  
    }); 
}); 