<?php

namespace denis909\yii;

use Yii;
use yii\helpers\ArrayHelper;

class CreateAction extends BaseAction
{

    public $template = 'create';
    
    public $scenario;
    
    public function run()
    {
        $className = $this->controller->formModelClass;

        $model = $this->createModel($className);

        $parentModelClass = $this->controller->parentModelClass;

        $parentModel = null;

        if ($parentModelClass)
        {
            Assert::notEmpty($this->controller->parentAttribute);

            $parentIndex = Inflector::attribute2camel($this->controller->parentAttribute);

            $parentId = Yii::$app->request->get($parentIndex);

            if (!$parentId)
            {
                throw new Exception('Parent ID not defined.');
            }

            $parentModel = $this->findModel($parentId, $parentModelClass);

            $model->{$this->controller->parentAttribute} = $parentModel->primaryKey;
        }

        if ($this->scenario)
        {
            $model->scenario = $this->scenario;
        }

        $model->loadDefaultValues(true);

        if ($this->loadModel($model, Yii::$app->request->post()) && $this->saveModel($model))
        {
            if (Yii::$app->request->post('action') == static::ACTION_SAVE)
            {
                Yii::$app->session->addFlash('success', Yii::t($this->controller->i18nCategory, 'Data saved.'));

                return $this->controller->redirect([
                    'update', 
                    'id' => $model->primaryKey,
                    'returnUrl' => Yii::$app->request->get('returnUrl')
                ]);
            }
            else
            {
                return $this->controller->redirectBack();
            }
        }

        return $this->render($this->template, [
            'model' => $model,
            'parentModel' => $parentModel
        ]);
    }
    
}