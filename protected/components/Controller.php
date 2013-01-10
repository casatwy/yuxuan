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
        );
        $this->cs->registerPackage('jquery');
        $this->cs->registerPackage('jqueryPlugins');
        $this->cs->registerPackage('underscore');

        $this->jsUrl = $this->baseUrl.Yii::app()->assetManager->publish(Yii::getPathOfAlias('webroot.js.app.'.$this->id)).'/';
        Yii::app()->user->setReturnUrl('/storage/resource');
    }
}
