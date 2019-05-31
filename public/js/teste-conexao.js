// JavaScript Document

$(function(){
   /*$('#bt-teste').on('click', function(e){
       console.log('teste');
       e.preventDefault();
       $.ajax({
           type: 'POST',
           url: '/sapo/configuracoes/testeconexao',
           timeout: 30000,
           beforeSend: function(){
               alerta.showNotification('Verificando conecxão com o portal','info');
           },
           success: function(login){
               var response = login;
               alerta.showNotification(response.msg,response.msg_type);
               delete response;
               
           }
       });
   });*/
   $('#bt-teste').on('click', function(e){
    e.preventDefault();
    alerta.showNotification('Verificando conecxão com o portal','info');
    window.location.replace("http://localhost/sapo/configuracoes/testeconexao");
            
        
    
   });
});