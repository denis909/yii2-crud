<?php

namespace denis909\yii;

use Yii;

class CreateAction extends BaseAction
{

    public $template = 'create';
    
    public $scenario;

    public $ownerClass;

    public $parentId;
    
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

        if ($model->load(Yii::$app->request->post()) && $model->save())
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

        return $this->render($this->template, [
            'model' => $model,
            'ownerModel' => $ownerModel
        ]);
    }
    
}