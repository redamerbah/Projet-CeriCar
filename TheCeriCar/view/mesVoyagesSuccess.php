<div id="container">
    <div id="page_maincontent">	

      	<div class="col" > 
            <div class="rounded-lg">
                <div class="col col-lg "style = "font-size: 27px; font-weight: 600; serif;padding-top:20px;">
                    <p style="color:#612D75;font-size: 30px;font-weight: 550;float:left;margin-left:10px">Mes Voyages</p>
                    <div class="col col-sm-3" style="float:right;">
                 <!-- bouton pour accer au formulaire proposer un voyage-->
                  <a id="nouveauVoyage" href="monApplication.php?action=newVoyage" class="btn btn-light btn-lg btn-block" style="color:#612D75fc;">
                     Nouveau voyage</a>
                  </div>
                </div>


<table id="voyages" class="table table-hover" style="background-image: url('images/bg_1.jpg');background-position: center; background-attachment: fixed; background-repeat: no-repeat;background-size: cover ;">
  <thead>
    <tr>
      <th>depart</th>
      <th>arrivee</th>
      <th>contrainte</th>
      <th>conducteur</th>
      <th>places</th>
      <th>heure depart</th>
    </tr>
  </thead>

  <?php if($context->voyagesData!=null): ?>

<!--
    <script type="text/javascript">
        console.log('<?php //echo count($context->voyagesData) ;?>');
    </script>
-->
     <?php 
     $i=0;
     for($i=0;$i<count($context->voyagesData);$i+=2){ ?>
      <tr>
        <!-- colonne0 : depart -->
        <td ><?php echo $context->voyagesData[$i]->voyage->trajet->depart;?></td>
      
        <!-- colonne1 : arrivee -->
        <td><?php echo  $context->voyagesData[$i]->voyage->trajet->arrivee;?></td>
    
        <!-- colonne2 :  contraintes -->
        <td><?php echo  $context->voyagesData[$i]->voyage->contraintes; ?></td>
      
        <!-- colonne3 : condicteur -->
        <td><?php echo  $context->voyagesData[$i]->voyage->conducteur->nom." ".$context->voyagesData[$i]->voyage->conducteur->prenom?></td>
        <!-- colonne3 : places -->
        <td><?php echo  $context->voyagesData[$i]->placeReserve?></td>
      
        <!-- colonne5 : heuredepart -->
        <td><?php echo  $context->voyagesData[$i]->departFormat?></td>

       
      </tr>
    <?php } ?>
  <?php endif; ?>
</table>



<!-- script pour bouton accer a la pager proposer un voyage -->
<script>

    $("#nouveauVoyage").click(function(){
         
      
         
        $.ajax({
            url : 'ajaxDispatcher.php?action=newVoyage',
            type : 'GET',
            dataType : 'html', 
            success : function(code_html, statut){ 
                
                $("#page_maincontent").html(code_html);
            }
            });
            
    });
</script>