<div class="table-responsive">



<?php if($context->voyages==null): ?>
	<div class='alert alert-warning'>
    	<strong>Error sorry : </strong>
     Aucun voyage n'a été trouvé dans la base de donnée !!!!!
  	</div>
<?php endif; ?>
<section class="probootstrap-cover overflow-hidden relative"  style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5"  id="section-home">
<table id="voyages" class="table table-hover"  style="border-spacing: 20px;">
	<thead>
		<tr>
		<th>voyage</th>
        <th>depart</th>
        <th>Arrivee</th>
        <th>Conducteur</th>
        <th>tarif</th>
        <th>heure depart</th>
        <th>nbre place </th>
        <th>contraintes  </th>
		</tr>
	</thead>
	<?php if($context->voyages!=null): ?>
		<?php foreach($context->voyages as $value): ?>
			<tr>
			
			<td><?php echo $value->id; ?></td>
            <td><?php echo $value->trajet->depart; ?></td>
            <td><?php echo $value->trajet->arrivee; ?></td>
            <td><?php echo $value->conducteur->nom;; ?></td>
            <td><?php echo $value->tarif; ?></td>
            <td><?php echo $value->heuredepart; ?></td> 
            <td><?php echo $value->nbplace; ?></td>
            <td><?php echo $value->contraintes; ?></td> 
				<!-- colonne5 : bouton reserver -->
				<td> <button class="invisible" type="button" name="reserver">check it</button> </td>
				<?php// endif; ?>

				
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
</table>
</section>
</div>
