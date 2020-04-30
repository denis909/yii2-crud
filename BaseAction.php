<?php

namespace denis909\yii;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use Yii;
use Exception;

abstract class BaseAction extends \yii\base\Action
{

    public $viewParams = [];
    
    public $modelClass;
        
    public $returnUrl;

    public $ownerClass;

    public $ownerIndex = 'parentId';
        
    public function returnUrl()
    {
        if (Yii::$app->request->get('returnUrl') != FALSE)
        {
            return Yii::$app->request->get('returnUrl');
        }
    
        if ($this->returnUrl != FALSE)
        {
            return $this->returnUrl;
        }
        
        return Url::to([$this->controller->defaultAction]);
    }

    public function redirectBack()
    {
        if (Yii::$app->request->isAjax)
        {
            return;
        }
        
        return $this->controller->redirect($this->returnUrl());
    }

    public function render($template, $params = [])
    {
        return $this->controller->render($template, $params);
    }

    public function loadModel()
    {
        $className = $this->modelClass;
            
        $model = $className::findOne(Yii::$app->request->get('id'));
        
        if (!$model)
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $model;
    }

    protected function loadOwner()
    {
        $ownerModel = null;

        if ($this->ownerClass)
        {
            $ownerClass = $this->ownerClass;

            $ownerId = Yii::$app->request->get($this->ownerIndex);

            if (!$ownerId)
            {
                throw new Exception('Owner id not defined.');
            }

            $ownerModel = $ownerClass::findOne($ownerId);

            if (!$ownerModel)
            {
                throw new Exception('Owner model not found.');
            }
        }

        return $ownerModel;     
    }

}