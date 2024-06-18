$(document).ready(function(){
    $("#busca").keyup(function(){
        var busca = $(this).val();
        if(busca.length > 0){
            $.ajax({
                url: $('form').attr('function-busca'),
                method: 'POST',
                data: {
                    busca: busca
                },

                success: function(data) {
                    if(data){
                        $('#resultado-busca').html(
                            "<div class='card'><div class='card-body'>"+data+"<ul class='list-group list-group-flush ></ul> </div> </div>"
                        );
                    }else
                        $('#resultado-busca').html(
                            "<div class='alert alert-warning'>Nenhum resultado foi encontrado</div>"
                        ); 
                    
                },


            });
            $('#resultado-busca').show();
        }else{
            $('#resultado-busca').hide();
        }
    });
});