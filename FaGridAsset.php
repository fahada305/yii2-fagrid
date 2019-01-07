<?php
/**
 * @link https://github.com/fahada305/yii2-fagrid
 * @copyright Copyright (c) 2018-2019 fahada305
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace fahada305\fagrid;

use yii\web\AssetBundle;

class FaGridAsset extends AssetBundle {
	public $sourcePath = '@vendor/fahada305/yii2-fagrid/assets';

	public $js = [
		'grid.min.js',
	];

	public $css = [
		'grid.min.css',
		'grid-theme.min.css',
	];

	public $depends = [
		'yii\web\JqueryAsset',
	];
}
