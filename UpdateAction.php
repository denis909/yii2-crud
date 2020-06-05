<?php

namespace denis909\yii;

use Yii;
use yii\helpers\ArrayHelper;

class UpdateAction extends BaseAction
{

    public $template = 'update';
    
    public $scenario;

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
        $model = $this->findModel(Yii::$app->request->get('id'), $this->modelClass);
        
        if ($this->scenario)
        {
            $model->scenario = $this->scenario;
        }

        if ($this->loadModel($model, Yii::$app->request->post()) && $this->saveModel($model))
        {
            if (Yii::$app->request->post('action') == static::ACTION_SAVE)
            {
                Yii::$app->session->addFlash('success', Yii::t($this->i18nCategory, 'Data saved.'));
            }
            else
            {
                return $this->redirectBack();
            }
        }

        $params = ArrayHelper::merge($this->params, [
            'model' => $model
        ]);
        
        return $this->render($this->template, $params);
    }

}