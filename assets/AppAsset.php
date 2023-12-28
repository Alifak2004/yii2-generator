<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/_form.css',
        'css/grid_tables.css',
        'css/animate.css',
        'css/simple_modal.css',
        'css/select2.css',
        'css/login1.min.css',
        'css/login2.min.css',
        'css/ag-grid.css',
        'css/navbar.css',
        'css/login3.min.css',
        'css/ag-theme-alpine.css',
        'css/ag-theme-material.css',
        'css/jquery.contextMenu.min.css',
    ];
    public $js = [
        // 'js/ticket.js',
        // 'js/jquery-3.6.0.min.js',
        // 'js/jquery.pjax.min.js',
        'js/sweetalert2.js',
        'js/agGrid.js',
        'js/popper.min.js',
        'js/ticket.js',
        'js/Utils.js',
        'js/simple_modal.js',
        'js/ImageInput.js',
        'js/fancy_select.js',
        'js/SteroidTable.js',
        'js/select2.js',
        'js/navbar_script.js',
        'js/bootstrap.bundle.min.js',
        'js/steroidDatable.js',
        'js/jquery.contextMenu.min.js',
        'js/jquery.ui.position.js',
        // 'js/core.min.js',
        // 'js/app.min.js',
        // 'js/script.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        'yii\web\JqueryAsset',

    ];
}
