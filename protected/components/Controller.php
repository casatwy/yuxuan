<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();

    public $cs = null;

    public $baseUrl = null;

    public $jsUrl = null;
    public $jsCommon = null;

    public function init(){
        parent::init();
        $this->baseUrl = Yii::app()->request->getBaseUrl(true);
        $this->cs = Yii::app()->clientScript;

        $this->cs->packages = array(
            'jquery'=>array(
                'basePath' => 'webroot.js.libs',
                'baseUrl' => $this->baseUrl.'/js/libs/',
                'js' => array('jquery-1.8.3.min.js')
            ),

            'jqueryPlugins' => array(
                'basePath' => 'webroot.js.libs.plugins',
                'baseUrl' => $this->baseUrl.'/js/libs/plugins',
                'js' => array(
                    'jquery.json-2.4.min.js',
                    'jgrowl/jquery.jgrowl_minimized.js',
                ),
                'css' => array(
                    'jgrowl/jquery.jgrowl.css'
                ),
                'depends' => array('jquery')
            ),

            'underscore'=>array(
                'basePath' => 'webroot.js.libs',
                'baseUrl' => $this->baseUrl.'/js/libs/',
                'js' => array('underscore-min.js')
            ),

            'fancybox'=>array(
                'basePath' => 'webroot.js.libs.plugins.fancybox',
                'baseUrl' => $this->baseUrl.'/js/libs/plugins/fancybox',
                'js' => array(
                    'jquery.fancybox.pack.js',
                    'helpers/jquery.fancybox-buttons.js',
                    'helpers/jquery.fancybox-media.js',
                    'helpers/jquery.fancybox-thumbs.js',
                ),
                'css' => array(
                    'jquery.fancybox.css',
                    'helpers/jquery.fancybox-buttons.css',
                    'helpers/jquery.fancybox-thumbs.css',
                ),
                'depends' => array('jquery')
            ),
        );
        $this->cs->registerPackage('jquery');
        $this->cs->registerPackage('jqueryPlugins');
        $this->cs->registerPackage('underscore');
        $this->cs->registerPackage('fancybox');

        $this->jsUrl = $this->baseUrl.Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.js.app.'.$this->id)).'/';
        $this->jsCommon = $this->baseUrl.Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.js.common.'.$this->id)).'/';
        Yii::app()->user->setReturnUrl('/storage/resource');
    }
}
