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
	private $cost;
	private $position;
	private $number;
	private $comment;
	private $advise;
	private $recommended_dish;
	private $configuration;
	private $image;

	/*     * ***********************Methode static*************************** */

	/*     * *********************Méthodes d'instance************************* */

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