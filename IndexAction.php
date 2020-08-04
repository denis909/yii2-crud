<?php

namespace denis909\yii;

use yii\data\ActiveDataProvider;
use Exception;
use Yii;
use yii\helpers\ArrayHelper;

class IndexAction extends BaseAction
{

    public $template = 'index';
        
    public function run()
    {
        $className = $this->controller->modelClass;

        $query = $className::find();

        $parentModel = null;

        $parentModelClass = $this->controller->parentModelClass;

        if ($parentModelClass)
        {
            Assert::notEmpty($this->controller->parentAttribute, 'Parent attribute not defined.');

            $parentIndex = Inflector::attribute2camel($this->controller->parentAttribute);

            $parentId = Yii::$app->request->get($parentIndex);

            if (!$parentId)
            {
                throw new Exception('Parent ID not defined.');
            }

            $parentModel = $this->findModel($parentId, $parentModelClass);

            $query->andWhere([$this->controller->parentAttribute => $parentModel->primaryKey]);
        }

        $searchModelClass = $this->controller->searchModelClass;

        if ($searchClass)
        {
            $searchModel = Yii::createObject($searchModelClass);

            $searchModel->load(Yii::$app->request->get());

            $searchModel->applyToQuery($query);
        }
        else
        {
            $searchModel = null;
        }

        $dataProvider = Yii::createObject(ArrayHelper::merge(
            [
                'class' => ActiveDataProvider::class,
                'query' => $query
            ],
            $this->controller->defaultDataProvider,
            $this->controller->dataProvider
        ));
    
        return $this->render($this->template, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'parentModel' => $parentModel
        ]);
    }

}