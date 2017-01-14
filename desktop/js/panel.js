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
 		}
 	})
 });

 $('.li_wine').on('click',function(){
 	$('.li_wine').removeClass('active');
 	$(this).addClass('active');
 	wine_load($(this).find('a').attr('data-wine_id'));
 });


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
 	if($('.wine .wineAttr[data-l1key=id]').value() == ''){
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
 			$('#div_alert').showAlert({message: '{{Sauvegarde réussie}}', level: 'success'});
 		}
 	})
 });

 $('#ul_cellar').on('click','.li_cellar',function(){
 	$('.li_cellar').removeClass('active');
 	$(this).addClass('active');
 	cellar_load($(this).find('a').attr('data-cellar_id'));
 });

 function load_cellarByWine(_wine_id){
 	jeedom.wcellar.cellar.byWineId({
 		wine_id: _wine_id,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			$('#ul_cellar .li_cellar').remove();
 			var ul = '';
 			for(var i in data){
 				ul += '<li class="cursor li_cellar"><a data-cellar_id="' +data[i].id+ '">' +data[i].year+ '</a></li>';
 			}
 			$('#ul_cellar').append(ul);
 		}
 	});
 }

 function cellar_load(_id){
 	load_historyByWine(_id);
 	jeedom.wcellar.cellar.byId({
 		id: _id,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			$('.cellarAttr').value('');
 			$('.cellar').setValues(data, '.cellarAttr');
 			$('#div_wcellarDisplay .cellar').show();
 			$('#div_wcellarDisplay .history').hide();
 		}
 	});
 }

 /*******************************History*********************************************/

 $('.historyAction[data-action=add]').on('click',function(){
 	if($('.cellar .cellarAttr[data-l1key=id]').value() == ''){
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
 			$('#div_alert').showAlert({message: '{{Sauvegarde réussie}}', level: 'success'});
 		}
 	})
 });

 $('#ul_history').on('click','.li_history',function(){
 	$('.li_history').removeClass('active');
 	$(this).addClass('active');
 	history_load($(this).find('a').attr('data-history_id'));
 });

 function load_historyByWine(_cellar_id){
 	jeedom.wcellar.history.byCellarId({
 		cellar_id: _cellar_id,
 		error: function (error) {
 			$('#div_alert').showAlert({message: error.message, level: 'danger'});
 		},
 		success: function (data) {
 			$('#ul_history .li_history').remove();
 			var ul = '';
 			for(var i in data){
 				ul += '<li class="cursor li_history"><a data-history_id="' +data[i].id+ '">' +data[i].date+ '</a></li>';
 			}
 			$('#ul_history').append(ul);
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