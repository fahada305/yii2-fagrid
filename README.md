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

in your Controller add new function for getting data 

`
	public function actionData() {

		$model = Category::find()->asArray()->all();
		//print_r($data);

		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		return $model;
	}`
	
	
	
dataUrl is something like this

` $dataUrl = "category/data"; `

columns must be an array of columns that need to display at table 

`
$columns = [
	['name' => 'name'],
	['name' => 'type'],
	['name' => 'description'],
	];`
	
And Finally use below code where you want to show table grid


```php
<?=\fahada305\fagrid\FaGrid::widget(['columns' => $columns, 'dataUrl' => $dataUrl]);?>```