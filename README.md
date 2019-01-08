FaGrid GridView
===============
FaGrid jQuery based table grid view

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist fahada305/yii2-fagrid "*"
```

or add

```
"fahada305/yii2-fagrid": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

in your Controller create  function for getting data 
make sure resposne format must be `json` and query must `asArray`

```php
namespace app\controllers;
..........
.........

public function actionData() {

		$model = Category::find()->asArray()->all();
		
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $model;
	}
........
........
.......
```
In Your View file 

```php
$dataUrl = "category/data";  // "controller->id/action->id or "module->id/controller->id/action->id"

$columns = [
	['name' => 'name'],
	['name' => 'type'],
	['name' => 'description'],
	];
	
<?=\fahada305\fagrid\FaGrid::widget(['columns' => $columns, 'dataUrl' => $dataUrl]);?>```
