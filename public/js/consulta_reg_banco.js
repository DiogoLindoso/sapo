// JavaScript Document

$(function(){
    var $body = $('.consulta');
    $('#atualizarDados').on('click', function(e){
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: './atualiza/getProcessosJSON',
            timeout: 300000,
            beforeSend: function(){
                $('div.refresh').remove();
                $('tbody tr').remove();
                $body.append('<div class="refresh"> <i class="nc-icon nc-refresh-02"></i></div>'); 
                //console.log('beforeSend');
            },
            complete: function(){
                $('div.refresh').remove();
                //console.log('complete');
            },
            success: function(data){
                var responseObject = data;
                var newContent;
                    for(var chave in responseObject){
                      newContent += '<tr>';
                      newContent += '<td>' + responseObject[chave].tipo + '</td>';
                      newContent += '<td>' + responseObject[chave].curso_area + '</td>';
                      newContent += '<td>' + responseObject[chave].nome + '</td>';
                      newContent += '<td>' + responseObject[chave].prazo_para_analise + '</td>';
                      newContent += '</tr>';
                    }
                    $('tbody').html(newContent);
                //console.log('success');
            },
            fail: function(){
                $('div.refresh').remove();
                $body.append('<div class="refresh"> Erro!</div>');
                //console.log('fail'); 
            }
        });
    });
});
