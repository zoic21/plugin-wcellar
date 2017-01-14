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

	private $id;
	private $country;
	private $region;
	private $name;
	private $producer;
	private $color;
	private $comment;
	private $advise;
	private $recommended_dish;
	private $configuration;

	/*     * ***********************Methode static*************************** */

	/*     * *********************Méthodes d'instance************************* */

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