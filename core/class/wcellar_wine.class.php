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
class wcellar_wine {
	/*     * *************************Attributs****************************** */

	public static $_colors = array(
		'rouge' => 'Rouge',
		'blanc' => 'Blanc',
		'rose' => 'Rosé',
		'champage' => 'Champage',
	);

	private $id;
	private $country = 'France';
	private $region;
	private $name;
	private $producer;
	private $color;
	private $comment;
	private $advise;
	private $recommended_dish;
	private $configuration;

	/*     * ***********************Methode static*************************** */

	public static function all() {
		$sql = 'SELECT ' . DB::buildField(__CLASS__, 'wcellar_wine') . '
                FROM wcellar_wine
                LEFT JOIN wcellar_cellar ON wcellar_cellar.wine_id=wcellar_wine.id
                ORDER BY wcellar_cellar.number DESC,wcellar_wine.region,wcellar_wine.name';
		return DB::Prepare($sql, array(), DB::FETCH_TYPE_ALL, PDO::FETCH_CLASS, __CLASS__);
	}

	public static function search($_search) {
		$values = array(
			'search' => '%' . $_search . '%',
		);
		$sql = 'SELECT ' . DB::buildField(__CLASS__, 'wcellar_wine') . '
                FROM wcellar_wine
                INNER JOIN wcellar_cellar ON wcellar_cellar.wine_id=wcellar_wine.id
                INNER JOIN wcellar_history ON wcellar_history.cellar_id=wcellar_cellar.id
                WHERE wcellar_wine.region LIKE :search
                	OR wcellar_wine.country LIKE :search
                	OR wcellar_wine.name LIKE :search
                	OR wcellar_wine.producer LIKE :search
                	OR wcellar_wine.color LIKE :search
                	OR wcellar_wine.comment LIKE :search
                	OR wcellar_wine.advise LIKE :search
                	OR wcellar_wine.recommended_dish LIKE :search
                	OR wcellar_cellar.year LIKE :search
                	OR wcellar_cellar.cost LIKE :search
                	OR wcellar_cellar.comment LIKE :search
                	OR wcellar_cellar.advise LIKE :search
                	OR wcellar_cellar.recommended_dish LIKE :search
                	OR wcellar_history.comment LIKE :search
                GROUP BY wcellar_wine.id
                ORDER BY name';
		return DB::Prepare($sql, $values, DB::FETCH_TYPE_ALL, PDO::FETCH_CLASS, __CLASS__);
	}

	public static function byId($_id) {
		$values = array(
			'id' => $_id,
		);
		$sql = 'SELECT ' . DB::buildField(__CLASS__) . '
		FROM wcellar_wine
		WHERE id=:id';
		return DB::Prepare($sql, $values, DB::FETCH_TYPE_ROW, PDO::FETCH_CLASS, __CLASS__);
	}

	public static function listRegion() {
		$sql = 'SELECT distinct(region)
		FROM wcellar_wine';
		return DB::Prepare($sql, array(), DB::FETCH_TYPE_ALL);
	}

	/*     * *********************Méthodes d'instance************************* */

	public function save() {
		DB::save($this);
	}

	public function preRemove() {
		foreach (wcellar_cellar::byWineId($this->getId()) as $cellar) {
			$cellar->remove();
		}
	}

	public function remove() {
		DB::remove($this);
	}

	public function getNumberOfBottle() {
		$values = array(
			'wine_id' => $this->getId(),
		);
		$sql = 'SELECT SUM(`number`) as result
		FROM wcellar_cellar
		WHERE wine_id=:wine_id';
		$result = DB::Prepare($sql, $values, DB::FETCH_TYPE_ROW);
		return $result['result'];
	}

	public function toArray() {
		$return = utils::o2a($this, true);
		$return['numberOfBottle'] = $this->getNumberOfBottle();
		$return['humanName'] = $this->getHumanName();
		return $return;
	}

	public function getHumanName() {
		$bottle = $this->getNumberOfBottle();
		$return = $this->getRegion() . ' - ' . trim($this->getName() . ' ' . $this->getProducer()) . ' - ' . $this->getColor();
		if ($bottle > 0) {
			$return .= ' (' . $this->getNumberOfBottle() . ')';
		}
		return $return;
	}

	/*     * **********************Getteur Setteur*************************** */
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getCountry() {
		return $this->country;
	}

	public function setCountry($country) {
		$this->country = $country;
	}

	public function getRegion() {
		return $this->region;
	}

	public function setRegion($region) {
		$this->region = $region;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getProducer() {
		return $this->producer;
	}

	public function setProducer($producer) {
		$this->producer = $producer;
	}

	public function getColor() {
		return $this->color;
	}

	public function setColor($color) {
		$this->color = $color;
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
}