<?php

namespace borales\widgets\ace;

use yii\web\AssetBundle;

/**
 * ACE widget asset bundle
 */
class Asset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/ace-builds/src';
    /**
     * @inheritdoc
     */
    public $js = [
        'ace.js'
    ];

    public function init()
    {
        if (!YII_DEBUG) {
            $this->sourcePath = str_replace("ace-builds/src", "ace-builds/src-min", $this->sourcePath);
        }
    }
}