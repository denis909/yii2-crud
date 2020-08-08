<?php

namespace denis909\yii;

use Yii;
use yii\web\NotFoundHttpException;

class ViewAction extends BaseAction
{

    public $template = 'view';

    public function run()
    {
        $id = Yii::$app->request->get('id');

        $model = $this->controller->findModel($id, $this->controller->modelClass);
                
        return $this->render($this->template, [
            'model' => $model
        ]);
    }

}