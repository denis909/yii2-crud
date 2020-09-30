<?php

namespace denis909\yii;
use Yii;
use Exception;

class DeleteAction extends BaseAction
{

    public function run()
    {
        $model = $this->findModel(Yii::$app->request->get('id'), $this->controller->modelClass);
                        
        if (!$this->deleteModel($model))
        {
            throw new Exception('Model not deleted.');
        }
    
        return $this->controller->redirectBack();
    }

}