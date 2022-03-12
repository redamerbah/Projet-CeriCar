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