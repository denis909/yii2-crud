<?php

namespace denis909\yii;
use Yii;

class DeleteAction extends BaseAction
{

    public function run()
    {
        $model = $this->findModel(Yii::$app->request->get('id'), $this->controller->modelClass);
                        
        $model->delete();
    
        return $this->redirectBack();
    }

}