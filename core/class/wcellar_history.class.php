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
class wcellar_history {
	/*     * *************************Attributs****************************** */

	private $id;
	private $cellar_id;
	private $date;
	private $number;
	private $note;
	private $comment;
	private $configuration;

	/*     * ***********************Methode static*************************** */

	public static function all() {
		$sql = 'SELECT ' . DB::buildField(__CLASS__) . '
                FROM wcellar_history';
		return DB::Prepare($sql, array(), DB::FETCH_TYPE_ALL, PDO::FETCH_CLASS, __CLASS__);
	}

	public static function byId($_id) {
		$values = array(
			'id' => $_id,
		);
		$sql = 'SELECT ' . DB::buildField(__CLASS__) . '
		FROM wcellar_history
		WHERE id=:id';
		return DB::Prepare($sql, $values, DB::FETCH_TYPE_ROW, PDO::FETCH_CLASS, __CLASS__);
	}

	public static function byCellarId($_cellar_id) {
		$values = array(
			'cellar_id' => $_cellar_id,
		);
		$sql = 'SELECT ' . DB::buildField(__CLASS__) . '
		FROM wcellar_history
		WHERE cellar_id=:cellar_id';
		return DB::Prepare($sql, $values, DB::FETCH_TYPE_ALL, PDO::FETCH_CLASS, __CLASS__);
	}

	public static function removeByCellarId($_cellar_id) {
		$values = array(
			'cellar_id' => $_cellar_id,
		);
		$sql = 'DELETE FROM wcellar_history
		WHERE cellar_id=:cellar_id';
		return DB::Prepare($sql, $values, DB::FETCH_TYPE_ROW);
	}

	/*     * *********************Méthodes d'instance************************* */

	public function preSave() {
		if ($this->getCellar_id() == '' || !is_numeric($this->getCellar_id())) {
			throw new Exception('Vous devez une bouteille de votre cave');
		}
		$cellar = wcellar_cellar::byId($this->getCellar_id());
		if (!is_object($cellar)) {
			throw new Exception('Vous devez une bouteille de votre cave');
		}
		if ($this->getDate() == '') {
			throw new Exception('Vous devez donner une date');
		}

		$current = self::byId($this->getId());
		$previousNumber = 0;
		if (is_object($current)) {
			$previousNumber = $current->getNumber();
		}
		$cellar = wcellar_cellar::byId($this->getCellar_id());
		if ($cellar->getNumber() >= 0) {
			$number = $cellar->getNumber() - $this->getNumber() + $previousNumber;
			if ($number < 0) {
				$number = 0;
			}
			$cellar->setNumber($number);
			$cellar->save();
		}
	}

	public function save() {
		DB::save($this);
	}

	public function remove() {
		DB::remove($this);
	}

	/*     * **********************Getteur Setteur*************************** */

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getCellar_id() {
		return $this->cellar_id;
	}

	public function setCellar_id($cellar_id) {
		$this->cellar_id = $cellar_id;
	}

	public function getDate() {
		return $this->date;
	}

	public function setDate($date) {
		$this->date = $date;
	}

	public function getNumber() {
		return $this->number;
	}

	public function setNumber($number) {
		$this->number = $number;
	}

	public function getNote() {
		return $this->note;
	}

	public function setNote($note) {
		$this->note = $note;
	}

	public function getComment() {
		return $this->comment;
	}

	public function setComment($comment) {
		$this->comment = $comment;
	}

	public function getConfiguration($_key = '', $_default = '') {
		return utils::getJsonAttr($this->configuration, $_key, $_default);
	}

	public function setConfiguration($_key, $_value) {
		$this->configuration = utils::setJsonAttr($this->configuration, $_key, $_value);
	}
}