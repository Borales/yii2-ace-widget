Yii2 Ace (Ajax.org Cloud9 Editor) Widget
========================================

[![Latest Stable Version](https://poser.pugx.org/borales/yii2-ace-widget/v/stable.svg)](https://packagist.org/packages/borales/yii2-ace-widget)
[![Total Downloads](https://poser.pugx.org/borales/yii2-ace-widget/downloads.svg)](https://packagist.org/packages/borales/yii2-ace-widget) 
[![Latest Unstable Version](https://poser.pugx.org/borales/yii2-ace-widget/v/unstable.svg)](https://packagist.org/packages/borales/yii2-ace-widget) 
[![License](https://poser.pugx.org/borales/yii2-ace-widget/license.svg)](https://packagist.org/packages/borales/yii2-ace-widget)

Ace (Ajax.org Cloud9 Editor) source repository can be found here - [https://github.com/ajaxorg/ace](https://github.com/ajaxorg/ace).

Original demo can be found here - [http://ace.c9.io/#nav=embedding](http://ace.c9.io/#nav=embedding).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ php composer.phar require "borales/yii2-ace-widget" "*"
```

or add

```
"borales/yii2-ace-widget": "*"
```

to the `require` section of your `composer.json` file.

## Usage (with default options)

```php
// For your model
echo \borales\widgets\ace\Widget::widget([
    'model' => $model,
    'attribute' => 'attribute_name',
]);

// Using with ActiveForm/ActiveField
echo $this->field($model, 'attribute_name')->widget(\borales\widgets\ace\Widget::className());

// For basic usage
echo \borales\widgets\ace\Widget::widget([
    'name' => 'editor_name',
]);

```

### Default options

- `mode` = `php`
- `theme` is `chrome`