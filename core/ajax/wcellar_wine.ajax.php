<?php

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

try {
	require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';
	include_file('core', 'authentification', 'php');

	if (!isConnect()) {
		throw new Exception(__('401 - Accès non autorisé', __FILE__));
	}

	ajax::init();

	if (init('action') == 'all') {
		if (init('search') != '') {
			ajax::success(utils::o2a(wcellar_wine::search(init('search'))));
		}
		ajax::success(utils::o2a(wcellar_wine::all()));
	}

	if (init('action') == 'byId') {
		$wine = wcellar_wine::byId(init('id'));
		if (!is_object($wine)) {
			throw new Exception(__('Objet inconnu verifié l\'id : ', __FILE__) . init('id'));
		}
		ajax::success(utils::o2a($wine));
	}

	if (init('action') == 'remove') {
		$wine = wcellar_wine::byId(init('id'));
		if (!is_object($wine)) {
			throw new Exception(__('Objet inconnu verifié l\'id', __FILE__));
		}
		$wine->remove();
		ajax::success();
	}

	if (init('action') == 'save') {
		$dataSave = json_decode(init('wine'), true);
		if (isset($dataSave['id'])) {
			$wine = wcellar_wine::byId($dataSave['id']);
		}
		if (!isset($wine) || !is_object($wine)) {
			$wine = new wcellar_wine();
		}
		utils::a2o($wine, $dataSave);
		$wine->save();
		ajax::success(utils::o2a($wine));
	}

	throw new Exception(__('Aucune méthode correspondante à : ', __FILE__) . init('action'));
	/*     * *********Catch exeption*************** */
} catch (Exception $e) {
	ajax::error(displayExeption($e), $e->getCode());
}
?>
