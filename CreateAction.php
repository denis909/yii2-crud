<?php

namespace denis909\yii;

use Yii;
use yii\helpers\ArrayHelper;

class CreateAction extends BaseAction
{

    public $template = 'create';
    
    public $scenario;

    public $ownerClass;

    public $parentId;

    public $params = [];

    public function loadModel($model, $data)
    {
        return $model->load($data);
    }

    public function saveModel($model, $validate = true, $attributes = null)
    {
        return $model->save($validate, $attributes);
    }

    public function validateModel($model, $attributes = null)
    {
        return $model->validate($attributes);
    }
    
    public function run()
    {
        $ownerModel = $this->loadOwner();

        $className = $this->modelClass;
            
        $model = new $className;

        if ($ownerModel)
        {
            $model->setOwner($ownerModel);
        }

        if ($this->scenario != FALSE)
        {
            $model->scenario = $this->scenario;
        }

        $model->loadDefaultValues(true);

        if ($this->loadModel($model, Yii::$app->request->post()) && $this->saveModel($model))
        {
            if (Yii::$app->request->post('action') == static::ACTION_SAVE)
            {
                Yii::$app->session->addFlash('success', Yii::t($this->i18nCategory, 'Data saved.'));

                return $this->controller->redirect([
                    'update', 
                    'id' => $model->primaryKey,
                    'returnUrl' => Yii::$app->request->get('returnUrl')
                ]);
            }
            else
            {
                return $this->redirectBack();
            }
        }

        $params = ArrayHelper::merge($this->params, [
            'model' => $model,
            'ownerModel' => $ownerModel
        ]);

        return $this->render($this->template, $params);
    }
    
}