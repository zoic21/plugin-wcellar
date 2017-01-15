
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


 jeedom.wcellar = function() {
 };


 /*************************Wine************************************************/

 jeedom.wcellar.wine = function() {
 };

 jeedom.wcellar.wine.save = function (_params) {
 	var paramsRequired = ['wine'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_wine.ajax.php';
 	paramsAJAX.data = {
 		action: 'save',
 		wine: json_encode(_params.wine),
 	};
 	$.ajax(paramsAJAX);
 }

 jeedom.wcellar.wine.remove = function (_params) {
 	var paramsRequired = ['id'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_wine.ajax.php';
 	paramsAJAX.data = {
 		action: 'remove',
 		id: _params.id,
 	};
 	$.ajax(paramsAJAX);
 }

 jeedom.wcellar.wine.all = function (_params) {
 	var paramsRequired = [];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_wine.ajax.php';
 	paramsAJAX.data = {
 		action: 'all',
 		search: _params.search || '',
 	};
 	$.ajax(paramsAJAX);
 }

 jeedom.wcellar.wine.byId = function (_params) {
 	var paramsRequired = ['id'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_wine.ajax.php';
 	paramsAJAX.data = {
 		action: 'byId',
 		id: _params.id,
 	};
 	$.ajax(paramsAJAX);
 }



 /*************************cellar************************************************/

 jeedom.wcellar.cellar = function() {
 };


 jeedom.wcellar.cellar.save = function (_params) {
 	var paramsRequired = ['cellar'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_cellar.ajax.php';
 	paramsAJAX.data = {
 		action: 'save',
 		cellar: json_encode(_params.cellar),
 	};
 	$.ajax(paramsAJAX);
 }

 jeedom.wcellar.cellar.remove = function (_params) {
 	var paramsRequired = ['id'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_cellar.ajax.php';
 	paramsAJAX.data = {
 		action: 'remove',
 		id: _params.id,
 	};
 	$.ajax(paramsAJAX);
 }

 jeedom.wcellar.cellar.byId = function (_params) {
 	var paramsRequired = ['id'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_cellar.ajax.php';
 	paramsAJAX.data = {
 		action: 'byId',
 		id: _params.id,
 	};
 	$.ajax(paramsAJAX);
 }

 jeedom.wcellar.cellar.byWineId = function (_params) {
 	var paramsRequired = ['wine_id'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_cellar.ajax.php';
 	paramsAJAX.data = {
 		action: 'byWineId',
 		wine_id: _params.wine_id,
 	};
 	$.ajax(paramsAJAX);
 }

 /*************************history************************************************/

 jeedom.wcellar.history = function() {
 	
 };


 jeedom.wcellar.history.save = function (_params) {
 	var paramsRequired = ['history'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_history.ajax.php';
 	paramsAJAX.data = {
 		action: 'save',
 		history: json_encode(_params.history),
 	};
 	$.ajax(paramsAJAX);
 }

 jeedom.wcellar.history.remove = function (_params) {
 	var paramsRequired = ['id'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_history.ajax.php';
 	paramsAJAX.data = {
 		action: 'remove',
 		id: _params.id,
 	};
 	$.ajax(paramsAJAX);
 }

 jeedom.wcellar.history.byId = function (_params) {
 	var paramsRequired = ['id'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_history.ajax.php';
 	paramsAJAX.data = {
 		action: 'byId',
 		id: _params.id,
 	};
 	$.ajax(paramsAJAX);
 }

  jeedom.wcellar.history.byCellarId = function (_params) {
 	var paramsRequired = ['cellar_id'];
 	var paramsSpecifics = {};
 	try {
 		jeedom.private.checkParamsRequired(_params || {}, paramsRequired);
 	} catch (e) {
 		(_params.error || paramsSpecifics.error || jeedom.private.default_params.error)(e);
 		return;
 	}
 	var params = $.extend({}, jeedom.private.default_params, paramsSpecifics, _params || {});
 	var paramsAJAX = jeedom.private.getParamsAJAX(params);
 	paramsAJAX.url = 'plugins/wcellar/core/ajax/wcellar_history.ajax.php';
 	paramsAJAX.data = {
 		action: 'byCellarId',
 		cellar_id: _params.cellar_id,
 	};
 	$.ajax(paramsAJAX);
 }