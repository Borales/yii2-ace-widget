<?php

namespace borales\widgets\ace;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * ACE Widget
 */
class Widget extends InputWidget
{
    /** @var string */
    public $mode = 'php';
    /** @var string */
    public $theme = 'github';
    /** @var bool Static syntax highlight */
    public $editable = true;
    /** @var bool */
    public $autocompletion = false;
    /** @var array */
    public $extensions = [];
    /** @var array */
    public $aceOptions = [
        "maxLines" => 100,
        "minLines" => 5,
    ];

    /**
     * @return string
     */
    public function run()
    {
        if(!$this->editable) {
            $this->extensions[] = 'static_highlight';
        }
        if($this->autocompletion) {
            $this->extensions[] = 'language_tools';
        }
        Asset::register($this->view, $this->extensions);
        return $this->editable ? $this->editable() : $this->readable();
    }

    protected function editable()
    {
        $id = $this->id;
        $autocompletion = $this->autocompletion ? 'true' : 'false';
        if($this->autocompletion) {
            $this->aceOptions['enableBasicAutocompletion'] = true;
            $this->aceOptions['enableSnippets'] = true;
            $this->aceOptions['enableLiveAutocompletion'] = false;
        }

        $aceOptions = Json::encode($this->aceOptions);
        $this->view->registerJs(
            <<<JS
(function(){
    if({$autocompletion}) {
        ace.require("ace/ext/language_tools");
    }

    var _editor = ace.edit("{$id}");
    _editor.setTheme("ace/theme/{$this->theme}");
    _editor.getSession().setMode("ace/mode/{$this->mode}");
    _editor.setOptions({$aceOptions});
})();
JS
        );

        if($this->hasModel()) {
            $html = Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            $html = Html::textarea($this->name, $this->value, $this->options);
        }
        return $html;
    }

    /**
     * @return string
     */
    protected function readable()
    {
        $this->options['id'] = $this->id;
        $this->view->registerJs(
            <<<JS
(function(){
    var _highlight = ace.require("ace/ext/static_highlight");
    _highlight($('#{$this->id}')[0], {
        mode: "ace/mode/{$this->mode}",
        theme: "ace/theme/{$this->theme}",
        startLineNumber: 1,
        showGutter: true,
        trim: true
    });
})();
JS
        );

        return Html::tag('pre', htmlspecialchars($this->value), $this->options);
    }
}