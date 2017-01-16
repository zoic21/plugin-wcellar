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
class wcellar_cellar {
	/*     * *************************Attributs****************************** */

	private $id;
	private $wine_id;
	private $year;
	private $peak;
	private $deadline;
	private $cost;
	private $position;
	private $number;
	private $comment;
	private $advise;
	private $recommended_dish;
	private $configuration;
	private $image;

	/*     * ***********************Methode static*************************** */

	public static function all() {
		$sql = 'SELECT ' . DB::buildField(__CLASS__) . '
                FROM wcellar_cellar';
		return DB::Prepare($sql, array(), DB::FETCH_TYPE_ALL, PDO::FETCH_CLASS, __CLASS__);
	}

	public static function byId($_id) {
		$values = array(
			'id' => $_id,
		);
		$sql = 'SELECT ' . DB::buildField(__CLASS__) . '
		FROM wcellar_cellar
		WHERE id=:id';
		return DB::Prepare($sql, $values, DB::FETCH_TYPE_ROW, PDO::FETCH_CLASS, __CLASS__);
	}

	public static function byWineId($_wine_id) {
		$values = array(
			'wine_id' => $_wine_id,
		);
		$sql = 'SELECT ' . DB::buildField(__CLASS__) . '
		FROM wcellar_cellar
		WHERE wine_id=:wine_id';
		return DB::Prepare($sql, $values, DB::FETCH_TYPE_ALL, PDO::FETCH_CLASS, __CLASS__);
	}

	public static function listYear() {
		$sql = 'SELECT distinct(year)
		FROM wcellar_cellar';
		return DB::Prepare($sql, array(), DB::FETCH_TYPE_ALL);
	}

	public static function statistics($_on = 'number', $_filter = array()) {
		$values = array();
		$sql = 'SELECT ';
		if ($_on == 'number') {
			$sql .= 'SUM(`number`) as result ';
		}
		if ($_on == 'cost') {
			$sql .= 'SUM(`cost`*`number`) as result ';
		}
		$sql .= 'FROM wcellar_cellar ';
		if (isset($_filter['wine'])) {
			$sql .= 'LEFT JOIN wcellar_wine ON wcellar_wine.id=wine_id ';
		}
		$sql .= 'WHERE ';
		if (isset($_filter['wine'])) {
			foreach ($_filter['wine'] as $key => $value) {
				$values['wine_' . $key] = $value;
				$sql .= 'wcellar_wine.' . $key . '=:wine_' . $key . ' AND ';
			}
		}
		if (isset($_filter['cellar'])) {
			foreach ($_filter['cellar'] as $key => $value) {
				$values['cellar_' . $key] = $value;
				$sql .= 'wcellar_cellar.' . $key . '=:cellar_' . $key . ' AND ';
			}
		}
		$sql .= '1=1';
		$return = DB::Prepare($sql, $values, DB::FETCH_TYPE_ROW);
		if (!isset($return['result'])) {
			return '-';
		}
		return $return['result'];
	}

	public static function atPeak() {
		$values = array(
			'year' => date('Y'),
		);
		$sql = 'SELECT ' . DB::buildField(__CLASS__) . '
		FROM wcellar_cellar
		WHERE peak <= :year
			AND deadline > :year
			AND `number` > 0';
		return DB::Prepare($sql, $values, DB::FETCH_TYPE_ALL, PDO::FETCH_CLASS, __CLASS__);
	}

	public static function atDeadline() {
		$values = array(
			'year' => date('Y'),
		);
		$sql = 'SELECT ' . DB::buildField(__CLASS__) . '
		FROM wcellar_cellar
		WHERE deadline <= :year
			AND `number` > 0';
		return DB::Prepare($sql, $values, DB::FETCH_TYPE_ALL, PDO::FETCH_CLASS, __CLASS__);
	}

	/*     * *********************Méthodes d'instance************************* */

	public function preSave() {
		if ($this->getWine_id() == '' || !is_numeric($this->getWine_id())) {
			throw new Exception('Vous devez d\'abord choisir un vin avant de l\'ajouter à votre cave');
		}
		$wine = wcellar_wine::byId($this->getWine_id());
		if (!is_object($wine)) {
			throw new Exception('Vous devez d\'abord choisir un vin avant de l\'ajouter à votre cave');
		}
		if ($this->getYear() == '' || !is_numeric($this->getYear())) {
			throw new Exception('Vous ne pouvez pas ajouter un vin sans année');
		}
	}

	public function save() {
		DB::save($this);
	}

	public function preRemove() {
		foreach (wcellar_history::byCellarId($this->getId()) as $history) {
			$history->remove();
		}
	}

	public function remove() {
		DB::remove($this);
	}

	public function getWine() {
		return wcellar_wine::byId($this->getWine_id());
	}

	/*     * **********************Getteur Setteur*************************** */
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getWine_id() {
		return $this->wine_id;
	}

	public function setWine_id($wine_id) {
		$this->wine_id = $wine_id;
	}

	public function getYear() {
		return $this->year;
	}

	public function setYear($year) {
		$this->year = $year;
	}

	public function getPeak() {
		return $this->peak;
	}

	public function setPeak($peak) {
		$this->peak = $peak;
	}

	public function getDeadline() {
		return $this->deadline;
	}

	public function setDeadline($deadline) {
		$this->deadline = $deadline;
	}

	public function getCost() {
		return $this->cost;
	}

	public function setCost($cost) {
		$this->cost = $cost;
	}

	public function getPosition($_key = '', $_default = '') {
		return utils::getJsonAttr($this->position, $_key, $_default);
	}

	public function setPosition($_key, $_value) {
		$this->position = utils::setJsonAttr($this->position, $_key, $_value);
	}

	public function getNumber() {
		return $this->number;
	}

	public function setNumber($number) {
		$this->number = $number;
	}

	public function getComment() {
		return $this->comment;
	}

	public function setComment($comment) {
		$this->comment = $comment;
	}

	public function getAdvise() {
		return $this->advise;
	}

	public function setAdvise($advise) {
		$this->advise = $advise;
	}

	public function getRecommended_dish() {
		return $this->recommended_dish;
	}

	public function setRecommended_dish($recommended_dish) {
		$this->recommended_dish = $recommended_dish;
	}

	public function getConfiguration($_key = '', $_default = '') {
		return utils::getJsonAttr($this->configuration, $_key, $_default);
	}

	public function setConfiguration($_key, $_value) {
		$this->configuration = utils::setJsonAttr($this->configuration, $_key, $_value);
	}

	public function getImage() {
		return $this->image;
	}

	public function setImage($image) {
		$this->image = $image;
	}
}