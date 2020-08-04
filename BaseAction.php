<?php

namespace denis909\yii;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use Yii;
use Exception;
use Closure;

abstract class BaseAction extends \yii\base\Action
{

    const ACTION_SAVE = 'save';

    public $viewParams = [];
    
    public $modelClass;
        
    public $returnUrl;

    public $ownerClass;

    public $ownerIndex = 'parentId';

    public $i18nCategory = 'app';

    public $params = [];

    public function getParams(array $return)
    {
        $params = $this->params;

        if ($params instanceof Closure)
        {
            return $params($this, $return);
        }
        
        return ArrayHelper::merge($return, $params);
    }
    
    public function render($template, $params = [])
    {
        return $this->controller->render($template, $this->getParams($params));
    }

}