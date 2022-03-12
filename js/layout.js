$(document).ready(function () {
    xhr=createAjaxObj();

    $("#bandeau").animate({
        marginBottom: "0px",
    }, 500);

    $("#fermer").click(function () {
        $('#bandeau').animate({
            marginBottom: "-50px"
        }, 500);
    });

    

var xhr;

function updateBandeau(msg)
{
    //faire disparaitre le bandeau
    $('#bandeau').css("marginBottom","-50px");
    //attribuer msg au bandeau + la croix pour fermer
    $('#bandeau').html(msg + '\n<div id="fermer">&#10006</div>');
    //reinvoquer le script du layout pour l'anim du bandeau et la fermeture
    $.getScript("js/layout.js");
}

function createAjaxObj()
{
    if(window.ActiveXObject){
        try{
            return new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e){
            return new ActiveXObject("MSXML2.XMLHTTP");
        }
    }
    else if(window.XMLHttpRequest){
        return new XMLHttpRequest();
    }
}




    $("#affichermesVoyages").click(function(){   
        $.ajax({
            url : 'ajaxDispatcher.php?action=mesVoyages',
            type : 'GET',
            dataType : 'html', 
            success : function(code_html, statut){ 
                
                $("#page_maincontent").html(code_html);
            }
            });
    });
    

    
    $("#affichermesReservations").click(function(){
        $.ajax({
            url : 'ajaxDispatcher.php?action=mesReservations',
            type : 'GET',
            dataType : 'html', 
            success : function(code_html, statut){ 
                
                $("#page_maincontent").html(code_html);
            }
            }); 
    });
    


// script pour afficher les détail de voyage on cliqant sur une card et le reserver
/*
    $(document).ready(function() {
    $('body').on('click','.card',function (event) {

        // depart
        var depart = $(this).find("p").eq(0).data("id");
        // arrivee
        var arrivee = $(this).find("p").eq(1).data("id");
        // heur depart
        var heureDepart = $(this).find("span").eq(0).data("id");
        //heur arrivee
        var heureArrivee = $(this).find("span").eq(1).data("id");
        // voyage
        var voyage = $(this).data("id");
        // contrante
        var contraintes = $(this).data("contraintes");
        // distance
        var distance = $(this).data("distance");
        
    
        
        
        if($(this).data("id").length == 1) {
            var conducteur = $(this).find("p").eq(2).data("id");
        }
        else{
            var conducteur = $(this).find("p").eq(3).data("id");
        }
        var tarif = $(this).find("span").eq(2).data("id");

       
         
        $.ajax({
            url : 'ajaxDispatcher.php?action=afficherVoyage',
            data: {voyage: voyage, depart: depart, arrivee: arrivee, distance: distance, tarif: tarif, heureDepart: heureDepart,heureArrivee: heureArrivee,conducteur: conducteur, contraintes:contraintes },
            type : 'GET',
            dataType : 'html', 
            success : function(code_html, statut){ 
                $("#content").html(code_html);
            }
            });
    });
});








