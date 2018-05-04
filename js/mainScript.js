$(document).ready(function(){
    //Efeitos
    $(".divForm").fadeIn('slow');
    $('.carousel').carousel({
        interval: 2000
    })
    
    //Ajax
    $(document).on("submit", "#formCriminosos", function (event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "processaCriminosos.php",
            type: "post",
            data: formData,
            dataType: "json",
            success: function (result) {
                if (result.acao === 1) {
                    alert("Criminoso cadastrado com sucesso!");
                    $('#formCriminosos')[0].reset();
                }else{
                    switch(result.mensagem){
                        case 0:
                            alert("Algum erro ocorreu");
                            break;
                        default:
                            alert("Algum erro ocorreu");
                    }
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                swal("Desculpe!", "Algo nÃ£o estÃ¡ certo", "error");
                console.log(xhr.status);
                console.log(thrownError);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
   
});