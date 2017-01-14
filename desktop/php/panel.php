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
				<a class="btn btn-default wineAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter}}</a>
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
				<a class="btn btn-default cellarAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter}}</a>
				<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
			</ul>
		</div>
		<div class="bs-sidebar">
			<ul id="ul_history" class="nav nav-list bs-sidenav">
				<li class="nav-header">{{Historique}}</li>
				<a class="btn btn-default historyAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter}}</a>
				<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
			</ul>
		</div>
	</div>

	<div class="col-lg-8 col-md-6 col-sm-4" style="border-left: solid 1px #EEE; padding-left: 25px;">
		<div class="wine">
			<form class="form-horizontal">
				<fieldset>
					<legend>{{Vin}}
					<a class="btn btn-success btn-xs wineAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
						<a class="btn btn-danger btn-xs wineAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
					</legend>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Nom}}</label>
								<div class="col-sm-8">
									<input type="text" class="wineAttr form-control" data-l1key="id" style="display : none;" />
									<input type="text" class="wineAttr form-control" data-l1key="name" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Pays}}</label>
								<div class="col-sm-8">
									<input type="text" class="wineAttr form-control" data-l1key="country" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Region}}</label>
								<div class="col-sm-8">
									<input type="text" class="wineAttr form-control" data-l1key="region" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Couleur}}</label>
								<div class="col-sm-8">
									<input type="text" class="wineAttr form-control" data-l1key="color" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Producteur}}</label>
								<div class="col-sm-8">
									<input type="text" class="wineAttr form-control" data-l1key="producer" />
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Commentaire}}</label>
								<div class="col-sm-8">
									<textarea class="wineAttr form-control" data-l1key="comment"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Conseil}}</label>
								<div class="col-sm-8">
									<textarea class="wineAttr form-control" data-l1key="advise"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Accompagne}}</label>
								<div class="col-sm-8">
									<textarea class="wineAttr form-control" data-l1key="recommended_dish"></textarea>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			</form>
		</div>

		<div class="cellar">
			<form class="form-horizontal">
				<fieldset>
					<legend>{{Cave}}
					<a class="btn btn-success btn-xs cellarAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
						<a class="btn btn-danger btn-xs cellarAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
					</legend>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Année}}</label>
								<div class="col-sm-8">
									<input type="text" class="cellarAttr form-control" data-l1key="id" style="display : none;" />
									<input type="numeric" class="cellarAttr form-control" data-l1key="year" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Prix}}</label>
								<div class="col-sm-8">
									<input type="numeric" class="cellarAttr form-control" data-l1key="cost" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Position}}</label>
								<div class="col-sm-3">
									<input type="text" class="cellarAttr form-control" data-l1key="position" data-l2key="rack" placeholder="{{Casier}}" />
								</div>
								<div class="col-sm-2">
									<input type="text" class="cellarAttr form-control" data-l1key="position" data-l2key="x" placeholder="{{X}}" />
								</div>
								<div class="col-sm-2">
									<input type="text" class="cellarAttr form-control" data-l1key="position" data-l2key="y" placeholder="{{Y}}" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Quantité}}</label>
								<div class="col-sm-8">
									<input type="numeric" class="cellarAttr form-control" data-l1key="number" />
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Commentaire}}</label>
								<div class="col-sm-8">
									<textarea class="cellarAttr form-control" data-l1key="comment"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Conseil}}</label>
								<div class="col-sm-8">
									<textarea class="cellarAttr form-control" data-l1key="advise"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Accompagne}}</label>
								<div class="col-sm-8">
									<textarea class="cellarAttr form-control" data-l1key="recommended_dish"></textarea>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			</form>
		</div>


		<div class="history">
			<form class="form-horizontal">
				<fieldset>
					<legend>{{Historique}}
						<a class="btn btn-success btn-xs historyAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
						<a class="btn btn-danger btn-xs historyAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
					</legend>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Date}}</label>
								<div class="col-sm-8">
									<input type="text" class="historyAttr form-control" data-l1key="id" style="display : none;" />
									<input type="text" class="historyAttr form-control" data-l1key="date" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Quantité}}</label>
								<div class="col-sm-8">
									<input type="numeric" class="historyAttr form-control" data-l1key="number" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Note}}</label>
								<div class="col-sm-8">
									<input type="numeric" class="historyAttr form-control" data-l1key="note" />
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Commentaire}}</label>
								<div class="col-sm-8">
									<textarea class="historyAttr form-control" data-l1key="comment"></textarea>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			</form>
		</div>

	</div>
</div>

<?php include_file('desktop', 'panel', 'js', 'wcellar');?>