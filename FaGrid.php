<?php
/**
 * @link https://github.com/fahada305/yii2-fagrid
 * @copyright Copyright (c) 2018-2019 fahada305
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace fahada305\fagrid;

use yii\base\InvalidConfigException;

class FaGrid extends \yii\bootstrap\Widget {
	public $dataUrl; // module/controller/action
	public $inlineUpdateUrl;
	public $deletUrl;
	public $editPageUrl;
	//public $fields = [];
	public $columns = [];

	public function init() {
		parent::init();

	}

	public function run() {

		$ctrlurls = $this->makeUrl();
		$fields = $this->makeFields();

		return $this->render('grid-view', ['ctrlurls' => $ctrlurls, 'fields' => $fields]);

	}
	public function makeUrl() {
		$ctrlurls = [];
		$ctrlurls['dataUrl'] = Yii::$app->urlManager->createAbsoluteUrl([$this->dataUrl]);
		$ctrlurls['updateUrl'] = Yii::$app->urlManager->createAbsoluteUrl([$this->inlineUpdateUrl]);
		$ctrlurls['deletUrl'] = Yii::$app->urlManager->createAbsoluteUrl([$this->deletUrl]);
		$ctrlurls['editPageUrl'] = Yii::$app->urlManager->createAbsoluteUrl([$this->editPageUrl]);
		return $ctrlurls;

	}
	public function makeFields() {

		$fields = "";

		if (count($this->columns) > 0) {
			$a_width = (100 / count($this->columns)) . "%";

			foreach ($this->columns as $k => $field) {

				$fields .= "{";

				$fields .= " name: " . $field['name'];
				$fields .= "title:" . (in_array('label', $field)) ? $field['label'] : ucfirst($field['name']);
				$fields .= "width:" . (in_array('width', $field)) ? $field['width'] : $a_width;

				$fields .= "},";

			}

			return $fields;
		} else {
			throw new InvalidConfigException("columns array must have atleast one value");
		}
	}
}
