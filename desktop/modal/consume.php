<?php
if (!isConnect()) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
?>

<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#wcellar_peak" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-calendar-check-o"></i> {{Apogée}}</a></li>
	<li role="presentation"><a href="#wcellar_deadline" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-calendar-times-o"></i> {{Limite}}</a></li>
</ul>


<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="wcellar_peak">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>{{Nom}}</th>
					<th>{{Année}}</th>
					<th>{{Nombre}}</th>
				</tr>
			</thead>
			<tbody>
				<?php
foreach (wcellar_cellar::atPeak() as $cellar) {
	echo '<tr>';
	echo '<td>' . $cellar->getWine()->getName() . ' ' . $cellar->getWine()->getProducer() . '</td>';
	echo '<td>' . $cellar->getYear() . '</td>';
	echo '<td>' . $cellar->getNumber() . '</td>';
	echo '</tr>';
}
?>
			</tbody>
		</table>
	</div>

	<div role="tabpanel" class="tab-pane" id="wcellar_deadline">
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>{{Nom}}</th>
					<th>{{Année}}</th>
					<th>{{Nombre}}</th>
				</tr>
			</thead>
			<tbody>
				<?php
foreach (wcellar_cellar::atDeadline() as $cellar) {
	echo '<tr>';
	echo '<td>' . $cellar->getWine()->getName() . ' ' . $cellar->getWine()->getProducer() . '</td>';
	echo '<td>' . $cellar->getYear() . '</td>';
	echo '<td>' . $cellar->getNumber() . '</td>';
	echo '</tr>';
}
?>
			</tbody>
		</table>

	</div>
</div>