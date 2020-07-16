<?php

namespace denis909\yii;

use yii\data\ActiveDataProvider;
use Exception;
use Yii;
use yii\helpers\ArrayHelper;

class IndexAction extends BaseAction
{

    public $searchModelClass;

    public $parentId;

    public $templateName = 'index';
    
    public $pageSize = 10;

    public $dataProvider = [];

    public $defaultDataProvider = [
        'pagination' => [
            'pageSize' => 10
        ]
    ];
    
    public function run()
    {
        $className = $this->modelClass;

        $query = $className::find();

        $ownerModel = $this->loadOwner();

        if ($ownerModel)
        {
            $query->ownerId($ownerModel->id);
        }

        if ($this->searchModelClass)
        {
            $searchModelClass = $this->searchModelClass;
        
            $searchModel = new $searchModelClass;

            $searchModel->load(Yii::$app->request->get());

            $searchModel->applyToQuery($query);
        }
        else
        {
            $searchModel = null;
        }
        
        $dataProvider = new ActiveDataProvider(
            ArrayHelper::merge(
                array(
                    'query' => $query
                ),
                $this->defaultDataProvider,
                $this->dataProvider
            )
        );
    
        return $this->controller->render(
            $this->templateName,
            $this->getParams([
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'ownerModel' => $ownerModel
            ])
        );
    }

}