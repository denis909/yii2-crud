<?php

namespace denis909\yii;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\base\Model;
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
        $params = $this->getParams($params);

        return $this->controller->render($template, $params);
    }

    public function createQuery(string $className)
    {
        return $this->controller->createQuery($className);
    }

    public function loadModel(Model $model, array $data = [])
    {
        return $this->controller->loadModel($model, $data);
    }    

    public function createModel(string $className)
    {
        return $this->controller->createModel($className);
    }    

    public function findModel($id, $modelClass = null)
    {
        return $this->controller->findModel($id, $modelClass);
    }

    public function saveModel(Model $model, bool $validate = true, array $attributes = null)
    {
        return $this->controller->saveModel($model, $validate, $attributes);
    }

    public function validateModel(Model $model, $attributes = null)
    {
        return $this->controller->validateModel($model, $attributes);
    }

    public function deleteModel(Model $model)
    {
        return $this->controller->deleteModel($model);
    }    


}