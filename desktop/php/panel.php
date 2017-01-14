<?php
if (!isConnect()) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
?>
<div class="row row-overflow">
	<div class="col-lg-2 col-md-3 col-sm-4">
		<div class="bs-sidebar">
			<ul id="ul_region" class="nav nav-list bs-sidenav">
				<li class="nav-header">{{Region}}</li>
				<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
				<li class="cursor"><a>{{Toutes}}</a></li>
				<?php
foreach (wcellar_wine::listRegion() as $region) {
	echo '<li class="cursor"><a>' . $region['region'] . '</a></li>';
}
?>
			</ul>
		</div>
		<div class="bs-sidebar">
			<ul id="ul_wine" class="nav nav-list bs-sidenav">
				<li class="nav-header">{{Vins}}</li>
				<a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter}}</a>
				<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
				<?php
foreach (wcellar_wine::all() as $wine) {
	echo '<li class="cursor"><a data-wine_id="' . $wine->getId() . '" data-region="' . $wine->getRegion() . '">' . $wine->getName() . ' ' . $wine->getProducer() . '</a></li>';
}
?>
			</ul>
		</div>
	</div>
	<div class="col-lg-2 col-md-3 col-sm-4">
		<div class="bs-sidebar">
			<ul id="ul_cellar" class="nav nav-list bs-sidenav">
				<li class="nav-header">{{Ma cave}}</li>
				<a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter}}</a>
				<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
			</ul>
		</div>
		<div class="bs-sidebar">
			<ul id="ul_history" class="nav nav-list bs-sidenav">
				<li class="nav-header">{{Historique}}</li>
				<a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter}}</a>
				<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
			</ul>
		</div>
	</div>


</div>







<?php include_file('desktop', 'panel', 'js', 'wcellar');?>