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
		ajax::success(utils::o2a(wcellar_cellar::all()));
	}

	if (init('action') == 'byId') {
		$cellar = wcellar_cellar::byId(init('id'));
		if (!is_object($cellar)) {
			throw new Exception(__('Objet inconnu verifié l\'id : ', __FILE__) . init('id'));
		}
		ajax::success(utils::o2a($cellar));
	}

	if (init('action') == 'byWineId') {
		ajax::success(utils::o2a(wcellar_cellar::byWineId(init('id'))));
	}

	if (init('action') == 'remove') {
		$cellar = wcellar_cellar::byId(init('id'));
		if (!is_object($cellar)) {
			throw new Exception(__('Objet inconnu verifié l\'id', __FILE__));
		}
		$cellar->remove();
		ajax::success();
	}

	if (init('action') == 'save') {
		$dataSave = json_decode(init('cellar'), true);
		if (isset($dataSave['id'])) {
			$cellar = wcellar_cellar::byId($dataSave['id']);
		}
		if (!isset($cellar) || !is_object($cellar)) {
			$cellar = new wcellar_cellar();
		}
		utils::a2o($cellar, $dataSave);
		$cellar->save();
		ajax::success(utils::o2a($cellar));
	}

	throw new Exception(__('Aucune méthode correspondante à : ', __FILE__) . init('action'));
	/*     * *********Catch exeption*************** */
} catch (Exception $e) {
	ajax::error(displayExeption($e), $e->getCode());
}
?>
