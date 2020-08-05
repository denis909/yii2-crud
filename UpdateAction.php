<?php

namespace denis909\yii;

use Yii;
use yii\helpers\ArrayHelper;

class UpdateAction extends BaseAction
{

    public $template = 'update';
    
    public $scenario;

    public function run()
    {       
        $model = $this->controller->findModel(Yii::$app->request->get('id'), $this->controller->formModelClass);
        
        if ($this->scenario)
        {
            $model->scenario = $this->scenario;
        }

        if ($this->controller->loadModel($model, Yii::$app->request->post()) && $this->controller->saveModel($model))
        {
            if (Yii::$app->request->post('action') == static::ACTION_SAVE)
            {
                Yii::$app->session->addFlash('success', Yii::t($this->controller->i18nCategory, 'Data saved.'));
            }
            else
            {
                return $this->controller->redirectBack();
            }
        }
        
        return $this->render($this->template, [
            'model' => $model
        ]);
    }

}