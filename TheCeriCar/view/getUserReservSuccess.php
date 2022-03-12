<div class="table-responsive">
<?php if($context->reservations==null): ?>
	<div class='alert alert-info'>
    	<strong>Aucune réservation n'a été trouvée </strong>
    	
  	</div>
<?php endif; ?>
<table id="reservations" class="table table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Depart</th>
			<th>Arrivee</th>
			<th>l'heure depart</th>
			<th>condicteur</th>
		</tr>
	</thead>
	<?php foreach($context->reservations as $reservation): ?>
		<tr>
			<!-- colonne1 : id -->
			<td><?php echo $reservation->id; ?></td>
		
			<!-- colonne2 : depart -->
			<td><?php echo $reservation->voyage->trajet->depart; ?></td>

			<!-- colonne3 : arrivee -->
			<td><?php echo $reservation->voyage->trajet->arrivee; ?></td>

			<!-- colonne4 : heure depart -->
			<td><?php echo $reservation->voyage->heuredepart . "h"; ?></td>

			<!-- colonne5 : conducteur -->
			<td><?php echo $reservation->voyage->conducteur->prenom . " " . $reservation->voyage->conducteur->nom; ?></td>
	<?php endforeach; ?>
</table>
</div>
