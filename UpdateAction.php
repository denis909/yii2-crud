<?php

namespace denis909\yii;

use Yii;

class UpdateAction extends BaseAction
{

    public $template = 'update';
    
    public $scenario;

    public function run()
    {       
        $model = $this->loadModel();
        
        if ($this->scenario != FALSE)
        {
            $model->scenario = $this->scenario;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save())
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
        
        return $this->render(
            $this->template,
            array(
                'model' => $model
            )
        );
    }

}