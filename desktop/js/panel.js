/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

 $('#bt_statistics').on('click',function(){
 	$('#md_modal').dialog({title: "{{Statistique de la cave}}"});
 	$("#md_modal").load('index.php?v=d&modal=statistics&plugin=wcellar').dialog('open');
 });

 $('#bt_consume').on('click',function(){
 	$('#md_modal').dialog({title: "{{A consommer}}"});
 	$("#md_modal").load('index.php?v=d&modal=consume&plugin=wcellar').dialog('open');
 });


 $('#bt_search').on('click',function(){
 	load_wine($('#in_search').value())
 });

 $("#in_search").on('keypress', function (e) {
 	if (e.which == '13') {
 		load_wine($('#in_search').value())
 	}
 })

 $('#bt_clearSearch').on('click',function(){
 	$('#in_search').value('');
 	load_wine($('#in_search').value())
 });

 load_wine();

 /*********************************WINE**********************************************/

 $('.wineAction[data-action=add]').on('click',function(){
 	$('.wineAttr').value('');
 	$('#div_wcellarDisplay .wine').show();
 	$('#div_wcellarDisplay .cellar').hide();
 	$('#div_wcellarDisplay .history').hide();
 });

 $('.wineAction[data-action=save]').on('click',function(){
 	var wine = $('.wine').getValues('.wineAttr')[0];
 	jeedom.wcellar.wine.save({
 		wine: wine,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			$('#div_alert').showAlert({message: '{{Sauvegarde réussie}}', level: 'success'});
 			load_wine($('#in_search').value())
 		}
 	})
 });

 $('.wineAction[data-action=remove]').on('click',function(){
 	bootbox.confirm('{{Etes-vous sûr de vouloir supprimer ce vin ? Attention cela supprimera les bouteilles associées dans votre cave}}', function (result) {
 		if (result) {
 			var id = $('.wine .wineAttr[data-l1key=id]').value();
 			jeedom.wcellar.wine.remove({
 				id: id,
 				error: function (error) {
 					$('#div_alert').showAlert({message: error.message, level: 'danger'});
 				},
 				success: function (data) {
 					$('.wineAttr').value('');
 					$('.li_wine[data-wine_id='+id+']').remove();
 					$('#div_wcellarDisplay .wine').hide();
 					$('#div_wcellarDisplay .cellar').hide();
 					$('#div_wcellarDisplay .history').hide();
 					$('#ul_cellar .li_cellar').remove();
 					$('#ul_history .li_history').remove();
 					$('#div_alert').showAlert({message: '{{Suppression réussie}}', level: 'success'});
 					load_wine($('#in_search').value())
 				}
 			});
 		}
 	});
 });

 $('#ul_wine').on('click','.li_wine',function(){
 	$('.li_wine').removeClass('active');
 	$(this).addClass('active');
 	wine_load($(this).attr('data-wine_id'));
 });

 $('.li_region').on('click',function(){
 	$('.li_region').removeClass('active');
 	$(this).addClass('active');
 	if($(this).attr('data-region') == 'all'){
 		$('.li_wine').show();
 	}else{
 		$('.li_wine').hide();
 		$('.li_wine[data-region="'+$(this).attr('data-region')+'"]').show();
 	}
 });

 function load_wine(_search){
 	jeedom.wcellar.wine.all({
 		search : init(_search),
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			$('#ul_wine .li_wine').remove();
 			var ul = '';
 			for(var i in data){
 				ul += '<li class="li_wine cursor" data-wine_id="'+data[i].id+'" data-region="' +data[i].region+ '"><a style="font-size:0.9em;">'+data[i].humanName+'</a></li>';
 			}
 			$('#ul_wine').append(ul);
 		}
 	});
 }


 function wine_load(_id){
 	load_cellarByWine(_id);
 	jeedom.wcellar.wine.byId({
 		id: _id,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			$('.wineAttr').value('');
 			$('.wine').setValues(data, '.wineAttr');
 			$('#div_wcellarDisplay .wine').show();
 			$('#div_wcellarDisplay .cellar').hide();
 			$('#div_wcellarDisplay .history').hide();
 		}
 	});
 }

 /********************************CELLAR*********************************************/

 $('.cellarAction[data-action=add]').on('click',function(){
 	if($('.wine .wineAttr[data-l1key=id]').value() == '' || !$('#div_wcellarDisplay .wine').is(':visible')){
 		$('#div_alert').showAlert({message: '{{Vous ne pouvez ajouter une bouteille sans choisir un vin}}', level: 'danger'});
 		return;
 	}
 	$('.cellarAttr').value('');
 	$('#div_wcellarDisplay .cellar').show();
 	$('#div_wcellarDisplay .history').hide();
 });

 $('.cellar').on('click','.cellarAction[data-action=save]',function(){
 	var cellar = $('.cellar').getValues('.cellarAttr')[0];
 	cellar.wine_id = $('.wine .wineAttr[data-l1key=id]').value();
 	jeedom.wcellar.cellar.save({
 		cellar: cellar,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			load_cellarByWine(cellar.wine_id,data.id);
 			$('.cellarAttr').value('');
 			$('.cellar').setValues(data, '.cellarAttr');
 			$('#div_alert').showAlert({message: '{{Sauvegarde réussie}}', level: 'success'});
 		}
 	})
 });

 $('#ul_cellar').on('click','.li_cellar',function(){
 	$('.li_cellar').removeClass('active');
 	$(this).addClass('active');
 	cellar_load($(this).attr('data-cellar_id'));
 });

 $('.cellarAction[data-action=remove]').on('click',function(){
 	bootbox.confirm('{{Etes-vous sûr de vouloir supprimer cette bouteille ? Attention cela supprimera les historique associé', function (result) {
 		if (result) {
 			var id = $('.cellar .cellarAttr[data-l1key=id]').value();
 			jeedom.wcellar.cellar.remove({
 				id: id,
 				error: function (error) {
 					$('#div_alert').showAlert({message: error.message, level: 'danger'});
 				},
 				success: function (data) {
 					$('.cellarAttr').value('');
 					$('.li_cellar[data-cellar_id='+id+']').remove();
 					$('#div_wcellarDisplay .cellar').hide();
 					$('#div_wcellarDisplay .history').hide();
 					$('#ul_history .li_history').remove();
 					$('#div_alert').showAlert({message: '{{Suppression réussie}}', level: 'success'});
 				}
 			});
 		}
 	});
 });

 function load_cellarByWine(_wine_id,_select_id){
 	$('#ul_history .li_history').remove();
 	jeedom.wcellar.cellar.byWineId({
 		wine_id: _wine_id,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			$('#ul_cellar .li_cellar').remove();
 			var ul = '';
 			for(var i in data){
 				ul += '<li class="cursor li_cellar" data-cellar_id="' +data[i].id+ '"><a>' +data[i].humanName+'</a></li>';
 			}
 			$('#ul_cellar').append(ul);
 			if(init(_select_id) != ''){
 				$('.li_cellar[data-cellar_id='+_select_id+']').addClass('active');
 			}
 		}
 	});
 }

 function cellar_load(_id,_select_history){
 	load_historyByWine(_id,init(_select_history));
 	jeedom.wcellar.cellar.byId({
 		id: _id,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			$('.cellarAttr').value('');
 			$('.cellar').setValues(data, '.cellarAttr');
 			$('#div_wcellarDisplay .cellar').show();
 			if(init(_select_history) == ''){
 				$('#div_wcellarDisplay .history').hide();
 			}
 		}
 	});
 }

 /*******************************History*********************************************/

 $('.historyAction[data-action=add]').on('click',function(){
 	if($('.cellar .cellarAttr[data-l1key=id]').value() == '' || !$('#div_wcellarDisplay .cellar').is(':visible')){
 		$('#div_alert').showAlert({message: '{{Vous ne pouvez ajouter un historique sans choisir de bouteille}}', level: 'danger'});
 		return;
 	}
 	$('.historyAttr').value('');
 	$('#div_wcellarDisplay .history').show();
 });


 $('.history').on('click','.historyAction[data-action=save]',function(){
 	var history = $('.history').getValues('.historyAttr')[0];
 	history.cellar_id = $('.cellar .cellarAttr[data-l1key=id]').value();
 	jeedom.wcellar.history.save({
 		history: history,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			load_cellarByWine($('.wine .wineAttr[data-l1key=id]').value(),history.cellar_id);
 			cellar_load(history.cellar_id,data.id);
 			$('.historyAttr').value('');
 			$('.history').setValues(data, '.historyAttr');
 			$('#div_alert').showAlert({message: '{{Sauvegarde réussie}}', level: 'success'});
 		}
 	})
 });

 $('#ul_history').on('click','.li_history',function(){
 	$('.li_history').removeClass('active');
 	$(this).addClass('active');
 	history_load($(this).attr('data-history_id'));
 });

 $('.historyAction[data-action=remove]').on('click',function(){
 	bootbox.confirm('{{Etes-vous sûr de vouloir supprimer cette historique ?', function (result) {
 		if (result) {
 			var id = $('.history .historyAttr[data-l1key=id]').value();
 			jeedom.wcellar.history.remove({
 				id: id,
 				error: function (error) {
 					$('#div_alert').showAlert({message: error.message, level: 'danger'});
 				},
 				success: function (data) {
 					$('.historyAttr').value('');
 					$('.li_history[data-history_id='+id+']').remove();
 					$('#div_wcellarDisplay .history').hide();
 					load_cellarByWine($('.wine .wineAttr[data-l1key=id]').value(),$('.li_cellar.active').attr('data-cellar_id'));
 					cellar_load($('.li_cellar.active').attr('data-cellar_id'));
 					$('#div_alert').showAlert({message: '{{Suppression réussie}}', level: 'success'});
 				}
 			});
 		}
 	});
 });

 function load_historyByWine(_cellar_id,_select_id){
 	jeedom.wcellar.history.byCellarId({
 		cellar_id: _cellar_id,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			$('#ul_history .li_history').remove();
 			var ul = '';
 			for(var i in data){
 				ul += '<li class="cursor li_history" data-history_id="' +data[i].id+ '"><a>' +data[i].humanName+ '</a></li>';
 			}
 			$('#ul_history').append(ul);
 			if(init(_select_id) != ''){
 				$('.li_history[data-history_id='+_select_id+']').addClass('active');
 			}
 		}
 	});
 }

 function history_load(_id){
 	jeedom.wcellar.history.byId({
 		id: _id,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			$('.historyAttr').value('');
 			$('.history').setValues(data, '.historyAttr');
 			$('#div_wcellarDisplay .history').show();
 		}
 	});
 }