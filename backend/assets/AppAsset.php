<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
       // 'build/css/custom.min.css',
        'css/sweetalert.css',
        'datepicker/css/datepicker.css',
        'easyautocomplete/css/easy-autocomplete.css'
    ];
    public $js = [
    //'build/js/custom.min.js',
    'js/sweetalert.min.js',
    'datepicker/js/bootstrap-datepicker.js',
    'easyautocomplete/js/jquery.easy-autocomplete.js',
    'typeahead/bloodhound.js',
    'typeahead/typeahead.bundle.js',
    'typeahead/typeahead.jquery.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
         'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}
