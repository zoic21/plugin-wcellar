<?php
if (!isConnect()) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
?>
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#wcellar_stats" aria-controls="home" role="tab" data-toggle="tab">{{Statistiques}}</a></li>
	<li role="presentation"><a href="#wcellar_top" aria-controls="profile" role="tab" data-toggle="tab">{{Top}}</a></li>
</ul>

<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="wcellar_stats">

		<legend>{{Actuellement/quantité}}</legend>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th></th>
					<?php
foreach (wcellar_wine::$_colors as $value) {
	echo '<th>' . $value . '</th>';
}
?>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{Nombre de bouteilles}}</td>
					<?php
foreach (wcellar_wine::$_colors as $key => $value) {
	echo '<td>' . wcellar_cellar::statistics('number', array('wine' => array('color' => $key))) . '</td>';
}
echo '<td>' . wcellar_cellar::statistics('number') . '</td>';
?>
				</tr>
				<?php
foreach (wcellar_wine::listRegion() as $region) {
	echo '<tr>';
	echo '<td>{{Nombre de bouteilles de}} ' . $region['region'] . '</td>';
	foreach (wcellar_wine::$_colors as $key => $value) {
		echo '<td>' . wcellar_cellar::statistics('number', array('wine' => array('color' => $key, 'region' => $region['region']))) . '</td>';
	}
	echo '<td>' . wcellar_cellar::statistics('number', array('wine' => array('region' => $region['region']))) . '</td>';
	echo '</tr>';
}
foreach (wcellar_cellar::listYear() as $year) {
	echo '<tr>';
	echo '<td>{{Nombre de bouteilles de}} ' . $year['year'] . '</td>';
	foreach (wcellar_wine::$_colors as $key => $value) {
		echo '<td>' . wcellar_cellar::statistics('number', array('wine' => array('color' => $key), 'cellar' => array('year' => $year['year']))) . '</td>';
	}
	echo '<td>' . wcellar_cellar::statistics('number', array('cellar' => array('year' => $year['year']))) . '</td>';
	echo '</tr>';
}
?>
			</tbody>
		</table>

		<legend>{{Actuellement/coût}}</legend>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th></th>
					<?php
foreach (wcellar_wine::$_colors as $value) {
	echo '<th>' . $value . '</th>';
}
?>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{Nombre de bouteilles}}</td>
					<?php
foreach (wcellar_wine::$_colors as $key => $value) {
	echo '<td>' . wcellar_cellar::statistics('cost', array('wine' => array('color' => $key))) . ' €</td>';
}
echo '<td>' . wcellar_cellar::statistics('cost') . ' €</td>';
?>
				</tr>
				<?php
foreach (wcellar_wine::listRegion() as $region) {
	echo '<tr>';
	echo '<td>{{Nombre de bouteilles de}} ' . $region['region'] . '</td>';
	foreach (wcellar_wine::$_colors as $key => $value) {
		echo '<td>' . wcellar_cellar::statistics('cost', array('wine' => array('color' => $key, 'region' => $region['region']))) . ' €</td>';
	}
	echo '<td>' . wcellar_cellar::statistics('cost', array('wine' => array('region' => $region['region']))) . ' €</td>';
	echo '</tr>';
}
foreach (wcellar_cellar::listYear() as $year) {
	echo '<tr>';
	echo '<td>{{Nombre de bouteilles de}} ' . $year['year'] . '</td>';
	foreach (wcellar_wine::$_colors as $key => $value) {
		echo '<td>' . wcellar_cellar::statistics('cost', array('wine' => array('color' => $key), 'cellar' => array('year' => $year['year']))) . ' €</td>';
	}
	echo '<td>' . wcellar_cellar::statistics('cost', array('cellar' => array('year' => $year['year']))) . ' €</td>';
	echo '</tr>';
}
?>
			</tbody>
		</table>

		<legend>{{Historique/quantité}}</legend>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th></th>
					<?php
foreach (wcellar_wine::$_colors as $value) {
	echo '<th>' . $value . '</th>';
}
?>
					<th>{{Total}}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{Nombre de bouteilles bu}}</td>
					<?php
foreach (wcellar_wine::$_colors as $key => $value) {
	echo '<td>' . wcellar_history::statistics('number', array('wine' => array('color' => $key))) . '</td>';
}
echo '<td>' . wcellar_history::statistics('number') . '</td>';
?>
				</tr>
				<?php
foreach (wcellar_wine::listRegion() as $region) {
	echo '<tr>';
	echo '<td>{{Nombre de bouteilles bu de}} ' . $region['region'] . '</td>';
	foreach (wcellar_wine::$_colors as $key => $value) {
		echo '<td>' . wcellar_history::statistics('number', array('wine' => array('color' => $key, 'region' => $region['region']))) . '</td>';
	}
	echo '<td>' . wcellar_history::statistics('number', array('wine' => array('region' => $region['region']))) . '</td>';
	echo '</tr>';
}
foreach (wcellar_cellar::listYear() as $year) {
	echo '<tr>';
	echo '<td>{{Nombre de bouteilles bu de}} ' . $year['year'] . '</td>';
	foreach (wcellar_wine::$_colors as $key => $value) {
		echo '<td>' . wcellar_history::statistics('number', array('wine' => array('color' => $key), 'cellar' => array('year' => $year['year']))) . '</td>';
	}
	echo '<td>' . wcellar_history::statistics('number', array('cellar' => array('year' => $year['year']))) . '</td>';
	echo '</tr>';
}
?>
			</tbody>
		</table>

		<legend>{{Historique/coût}}</legend>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th></th>
					<?php
foreach (wcellar_wine::$_colors as $value) {
	echo '<th>' . $value . '</th>';
}
?>
					<th>{{Total}}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{Nombre de bouteilles bu}}</td>
					<?php
foreach (wcellar_wine::$_colors as $key => $value) {
	echo '<td>' . wcellar_history::statistics('cost', array('wine' => array('color' => $key))) . ' €</td>';
}
echo '<td>' . wcellar_history::statistics('cost') . ' €</td>';
?>
				</tr>
				<?php
foreach (wcellar_wine::listRegion() as $region) {
	echo '<tr>';
	echo '<td>{{Nombre de bouteilles bu de}} ' . $region['region'] . '</td>';
	foreach (wcellar_wine::$_colors as $key => $value) {
		echo '<td>' . wcellar_history::statistics('cost', array('wine' => array('color' => $key, 'region' => $region['region']))) . ' €</td>';
	}
	echo '<td>' . wcellar_history::statistics('cost', array('wine' => array('region' => $region['region']))) . ' €</td>';
	echo '</tr>';
}
foreach (wcellar_cellar::listYear() as $year) {
	echo '<tr>';
	echo '<td>{{Nombre de bouteilles bu de}} ' . $year['year'] . '</td>';
	foreach (wcellar_wine::$_colors as $key => $value) {
		echo '<td>' . wcellar_history::statistics('cost', array('wine' => array('color' => $key), 'cellar' => array('year' => $year['year']))) . ' €</td>';
	}
	echo '<td>' . wcellar_history::statistics('cost', array('cellar' => array('year' => $year['year']))) . ' €</td>';
	echo '</tr>';
}
?>
			</tbody>
		</table>

		<legend>{{Historique/note}}</legend>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th></th>
					<?php
foreach (wcellar_wine::$_colors as $value) {
	echo '<th>' . $value . '</th>';
}
?>
					<th>{{Total}}</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{{Nombre de bouteilles bu}}</td>
					<?php
foreach (wcellar_wine::$_colors as $key => $value) {
	echo '<td>' . wcellar_history::statistics('note', array('wine' => array('color' => $key))) . '</td>';
}
echo '<td>' . wcellar_history::statistics('note') . '</td>';
?>
				</tr>
				<?php
foreach (wcellar_wine::listRegion() as $region) {
	echo '<tr>';
	echo '<td>{{Nombre de bouteilles bu de}} ' . $region['region'] . '</td>';
	foreach (wcellar_wine::$_colors as $key => $value) {
		echo '<td>' . wcellar_history::statistics('note', array('wine' => array('color' => $key, 'region' => $region['region']))) . '</td>';
	}
	echo '<td>' . wcellar_history::statistics('note', array('wine' => array('region' => $region['region']))) . '</td>';
	echo '</tr>';
}
foreach (wcellar_cellar::listYear() as $year) {
	echo '<tr>';
	echo '<td>{{Nombre de bouteilles bu de}} ' . $year['year'] . '</td>';
	foreach (wcellar_wine::$_colors as $key => $value) {
		echo '<td>' . wcellar_history::statistics('note', array('wine' => array('color' => $key), 'cellar' => array('year' => $year['year']))) . '</td>';
	}
	echo '<td>' . wcellar_history::statistics('note', array('cellar' => array('year' => $year['year']))) . '</td>';
	echo '</tr>';
}
?>
			</tbody>
		</table>

	</div>

	<div role="tabpanel" class="tab-pane" id="wcellar_top">
		<legend>{{Top 10/note}}</legend>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>{{Nom}}</th>
					<th>{{Année}}</th>
					<th>{{Note}}</th>
				</tr>
			</thead>
			<tbody>
				<?php
foreach (wcellar_history::most('note') as $value) {
	$cellar = wcellar_cellar::byId($value['cellar_id']);
	$wine = $cellar->getWine();
	echo '<tr>';
	echo '<td>' . $cellar->getWine()->getHumanName() . '</td>';
	echo '<td>' . $cellar->getYear() . '</td>';
	echo '<td>' . round($value['moy'], 1) . '</td>';
	echo '</tr>';
}
?>
			</tbody>
		</table>

		<legend>{{Top 10/coût}}</legend>
		<table class="table table-condensed">
			<thead>
				<tr>
					<th>{{Nom}}</th>
					<th>{{Année}}</th>
					<th>{{Prix}}</th>
				</tr>
			</thead>
			<tbody>
				<?php
foreach (wcellar_history::most('cost') as $value) {
	$cellar = wcellar_cellar::byId($value['cellar_id']);
	echo '<tr>';
	echo '<td>' . $cellar->getWine()->getHumanName() . '</td>';
	echo '<td>' . $cellar->getYear() . '</td>';
	echo '<td>' . $value['moy'] . ' €</td>';
	echo '</tr>';
}
?>
			</tbody>
		</table>

	</div>
</div>