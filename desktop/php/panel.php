<?php
if (!isConnect()) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
?>
<style type="text/css">
	.bs-sidebar ul.bs-sidenav li a{
		font-size: 0.85em;
	}

</style>
<div class="row row-overflow">
	<div class="col-lg-3 col-md-4 col-sm-4" style="margin-top : 4px;">
		<a class="btn btn-default btn-sm" id="bt_statistics"><i class="fa fa-bar-chart"></i> {{Statistiques}}</a>
		<a class="btn btn-default btn-sm" id="bt_consume"><i class="fa fa-calendar"></i> {{A consommer}}</a>
		<div class="bs-sidebar" style="margin-top : 4px;">
			<ul id="ul_region" class="nav nav-list bs-sidenav">
				<li class="nav-header"><i class="icon nature-planet5"></i> {{Region}}</li>
				<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
				<li class="cursor li_region active" data-region="all"><a>{{Toutes}}</a></li>
				<?php
foreach (wcellar_wine::listRegion() as $region) {
	echo '<li class="cursor li_region" data-region="' . $region['region'] . '"><a>' . $region['region'] . '</a></li>';
}
?>
			</ul>
		</div>
		<div class="bs-sidebar">
			<ul id="ul_wine" class="nav nav-list bs-sidenav">
				<li class="nav-header"><i class="icon nature-leaf32"></i> {{Vins}}</li>
				<a class="btn btn-default wineAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter}}</a>
				<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
			</ul>
		</div>
	</div>
	<div class="col-lg-2 col-md-3 col-sm-4" style="margin-top : 4px;">
		<div class="form-group">
			<div class="input-group">
				<span class="input-group-btn">
					<input class="form-control input-sm" id="in_search" style="display: inline-block; width:calc(100% - 80px)" value="<?php echo init('search') ?>" />
					<a class="btn btn-default btn-sm" id="bt_clearSearch"><i class="fa fa-times"></i></a>
					<a class="btn btn-default btn-sm" id="bt_search"><i class="fa fa-search"></i> {{OK}}</a>
				</span>
			</div>
		</div>
		<div class="bs-sidebar" style="margin-top : -10px;">
			<ul id="ul_cellar" class="nav nav-list bs-sidenav">
				<li class="nav-header"><i class="icon nourriture-wine23"></i> {{Ma cave}}</li>
				<a class="btn btn-default cellarAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter}}</a>
				<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
			</ul>
		</div>
		<div class="bs-sidebar">
			<ul id="ul_history" class="nav nav-list bs-sidenav">
				<li class="nav-header"><i class="fa fa-file"></i> {{Historique}}</li>
				<a class="btn btn-default historyAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter}}</a>
				<li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
			</ul>
		</div>
	</div>

	<div class="col-lg-7 col-md-5 col-sm-4" style="border-left: solid 1px #EEE; padding-left: 25px;" id="div_wcellarDisplay">
		<div class="wine" style="display:none;">
			<form class="form-horizontal">
				<fieldset>
					<legend><i class="icon nature-leaf32"></i> {{Vin}}
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
									<select class="wineAttr form-control" data-l1key="color">
										<?php
foreach (wcellar_wine::$_colors as $key => $value) {
	echo '<option value="' . $key . '">' . $value . '</option>';
}
?>
									</select>
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
								<label class="col-sm-4 control-label">{{Plat recommandé}}</label>
								<div class="col-sm-8">
									<textarea class="wineAttr form-control" data-l1key="recommended_dish"></textarea>
								</div>
							</div>
						</div>
					</div>
				</fieldset>
			</form>
		</div>

		<div class="cellar" style="display:none;">
			<form class="form-horizontal">
				<fieldset>
					<legend><i class="icon nourriture-wine23"></i> {{Cave}}
						<a class="btn btn-success btn-xs cellarAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
						<a class="btn btn-danger btn-xs cellarAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
					</legend>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Année}}</label>
								<div class="col-sm-8">
									<input type="text" class="cellarAttr form-control" data-l1key="id" style="display : none;" />
									<input type="number" class="cellarAttr form-control" data-l1key="year" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{A consommer}}</label>
								<div class="col-sm-4">
									<input type="number" class="cellarAttr form-control" data-l1key="peak" placeholder="{{Année apogée}}" />
								</div>
								<div class="col-sm-4">
									<input type="number" class="cellarAttr form-control" data-l1key="deadline" placeholder="{{Année limite}}" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Prix}}</label>
								<div class="col-sm-8">
									<input type="number" class="cellarAttr form-control" data-l1key="cost" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Position}}</label>
								<div class="col-sm-3">
									<input type="text" class="cellarAttr form-control" data-l1key="position" data-l2key="rack" placeholder="{{Casier}}" />
								</div>
								<div class="col-sm-2">
									<input type="number" class="cellarAttr form-control" data-l1key="position" data-l2key="x" placeholder="{{X}}" />
								</div>
								<div class="col-sm-2">
									<input type="number" class="cellarAttr form-control" data-l1key="position" data-l2key="y" placeholder="{{Y}}" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Quantité}}</label>
								<div class="col-sm-8">
									<input type="number" class="cellarAttr form-control" data-l1key="number" />
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

		<div class="history" style="display:none;">
			<form class="form-horizontal">
				<fieldset>
					<legend><i class="fa fa-file"></i> {{Historique}}
						<a class="btn btn-success btn-xs historyAction pull-right" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
						<a class="btn btn-danger btn-xs historyAction pull-right" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
					</legend>
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Nom}}</label>
								<div class="col-sm-8">
									<input type="text" class="historyAttr form-control" data-l1key="id" style="display : none;" />
									<input type="text" class="historyAttr form-control" data-l1key="name" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Date}}</label>
								<div class="col-sm-8">
									<input type="date" class="historyAttr form-control" data-l1key="date" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Quantité}}</label>
								<div class="col-sm-8">
									<input type="number" class="historyAttr form-control" data-l1key="number" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">{{Note}}</label>
								<div class="col-sm-8">
									<input type="number" class="historyAttr form-control" data-l1key="note" />
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
<?php include_file('core', 'wcellar', 'class.js', 'wcellar');?>
<?php include_file('desktop', 'panel', 'js', 'wcellar');?>