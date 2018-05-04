$(document).ready(function(){
    //Efeitos
    $(".divForm").fadeIn('slow');
    $('.carousel').carousel({
        interval: 2000   
    })

    //OnChange formCriminosos
    $("#sentenca").change(function(){
        
        if($("#sentenca option:selected").val() == "1"){
            $("#groupDataExec").attr("style", "display:none");
            $("#groupTempoCadeia").attr("style", "display:none");

        }else if($("#sentenca option:selected").val() == "2"){
            $("#groupDataExec").attr("style", "display:none");
            $("#groupTempoCadeia").attr("style", "display:initial");

        }else if($("#sentenca option:selected").val() == "3"){
            $("#groupDataExec").attr("style", "display:initial");
            $("#groupTempoCadeia").attr("style", "display:none");

        }else{
            $("formCriminosos")[0].reset();
        }
        
    });
    
    //Ajax FormCriminosos
    /*$(document).on("submit", "#formCriminosos", function (event) {
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
                            break;
                    }
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                alert("Desculpe! Algo não estão certo");
                console.log(xhr.status);
                console.log(thrownError);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
*/    
   
});