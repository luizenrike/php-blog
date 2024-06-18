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

document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
      var alert = document.getElementById("alert-message");
      if (alert) {
        alert.classList.remove("show");
        alert.classList.add("fade");
        setTimeout(function() {
          alert.remove();
        }, 150); // Tempo para a animação de fade-out completar
      }
    }, 3000); // 3 segundos
  });

  function refreshPage() {
    location.reload();
}