<?php

namespace denis909\yii;

use yii\web\NotFoundHttpException;

class ViewAction extends BaseAction
{

    public $templateName = 'view';
            
    public $beforeRender;

    public function run()
    {
        $model = $this->findModel(Yii::$app->request->get('id'), $this->controller->modelClass);
                
        if ($this->beforeRender != FALSE)
        {
            call_user_func_array(
                $this->beforeRender, 
                array(
                    $model
                )
            );
        }       
        
        return $this->controller->render(
            $this->templateName,
            array(
                'model' => $model
            )
        );
    }

}