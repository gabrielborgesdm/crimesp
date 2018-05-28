function changeFields(){
    if($("#sentenca option:selected").val() == "1"){
        $("#groupDataExec").attr("style", "display:none");
        $("#groupTempoCadeia").attr("style", "display:none");

    }else if($("#sentenca option:selected").val() == "2"){
        $("#groupDataExec").attr("style", "display:none");
        $("#groupTempoCadeia").attr("style", "display:initial");

    }else if($("#sentenca option:selected").val() == "3"){
        $("#groupDataExec").attr("style", "display:initial");
        $("#groupTempoCadeia").attr("style", "display:none");

    }
    }    
        
$(document).ready(function(){
    //Efeitos
    $(".divForm").fadeIn('slow');
    $('.carousel').carousel({
        interval: 2000   
    })
    
    
    //Call function when page the loads 
    $("#sentenca").on("change", function(){ 
        changeFields();
    });
    
    //Call function when changes an option
    $("#sentenca").ready(function(){
        changeFields();
    });
   
});