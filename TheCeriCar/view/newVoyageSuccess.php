

<div style="margin-left:70px;margin-top:32px;margin-right:3px;background-image: url('images/bg_1.jpg');" class="container">
     

      <form method="GET" action="" id="newVoyage">
            <div class="row">
                <div class="col col-lg "style = "font-size: 27px; font-weight: 600; serif;text-align:center;padding-top:20px;">
                    <p style="color:#612D75;font-size: 30px;font-weight: 550;">Proposer un Voyage</p>
                </div>
            </div>

            <div class="row"> 

                

                    <div class="col">
                    <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label for="depart">Ville Départ</label>

   <!-- <label class="input-group-text" for="depart">Ville de départ</label>-->
  </div>
<select name="depart"  id="depart" class="form-control form-control-lg">
	
	<?php foreach($context->villes as $ville) { ?>
		<?php if(isset($_REQUEST['depart']) && $_REQUEST['depart'] == $ville['ville']){ ?>
		<option value="<?php echo $ville['ville'] ?>" selected><?php echo $ville['ville'] ?></option>
		<?php }else{ ?>
		<option value="<?php echo $ville['ville'] ?>"><?php echo $ville['ville'] ?></option>
	<?php } } ?> 
</select>
<small id="" style="color:#612D75;" class="form-text text-muted">choisis une ville de départ</small>
</div>
</div>
<div class="col">
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <label  for="arrivee">Ville Départ</label>
  <!--  <label class="input-group-text" for="arrivee">Ville d'arrivée</label>-->
  </div>
<select name="arrivee" id="arrivee" class="form-control form-control-lg">
	<?php foreach($context->villes as $ville) { ?>
		<?php if(isset($_REQUEST['arrivee']) && $_REQUEST['arrivee'] == $ville['ville']){ ?>
		<option value="<?php echo $ville['ville'] ?>" selected><?php echo $ville['ville'] ?></option>
		<?php }else{ ?>
		<option value="<?php echo $ville['ville'] ?>"><?php echo $ville['ville'] ?></option>
	<?php } } ?> 
</select>
<small id="" style="color:#612D75;" class="form-text text-muted">choisis une ville de d'arrivée</small>
</div>
</div>

</div>
<hr style="height: 8px;">
<div class="row">
	<div class="col">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
            <label >Nombre de places</label>
          <!--<div class="input-group-text">Nombre de Places</div>-->
        </div>
        <input type="number" max="5" min="1" class="form-control" name="nbplace" id="nbplace" value="1">
      </div>
</div>
<div class="col">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
            <label >Tarif</label>
         
        </div>
        <input type="number" max="50" min="0" step="0.001" class="form-control" name="tarifparkm" id="tarifparkm" value="1">
      </div>
</div>
</div>
<hr style="height: 8px;">
<div class="row">
	<div class="col">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <label >heure départ</label>
        </div>
        <input type="number" max="23" min="0" class="form-control" name="heuredepart"  id="heuredepart" value="0">
      </div>
</div>
<div class="col">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <label >Contraintes</label>
        </div>
        <textarea name="contraintes" id="contraintes" ></textarea>
      </div>
</div>
</div>
<div class="row">
<div class="col" style="text-align:center;">
    <br>
<button type="submit" class="btn btn-dark" style="font-size: 20px;font-weight: 600;font-family: 'Trebuchet MS', serif" >proposer</button>
</div>
            </div>
        </form>
    </div>
<div id="resultat" style="margin-top:10px;"> </div>

<script>
$(document).ready(function(){
    $('#newVoyage').submit(function(){
             var data = $(this).serialize();
             console.log(data);

    if(true){
     $.ajax({
     url : 'ajaxDispatcher.php?action=newVoyagePost',
     data: $(this).serialize(),
     type : 'POST',
     dataType : 'html', 
     success : function(html, statut){ 

     $("#resultat").html("<div class='alert alert-success' role='alert'>Le voyage a été créé avec success<a href='?action=mesVoyages'>Consulter vos voyages </a></div>");

                   }
                   });
             }

             return false;
         })
});
</script>