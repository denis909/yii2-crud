<?php

namespace denis909\yii;

class CrudController extends \yii\web\Controller
{

    public $defaultAction = 'index';

    public $modelClass;

    public $searchModelClass;

    public $formModelClass;

    public $ownerClass;

    public $ownerIndex = 'ownerId';

    public $parentId;

    public $postActions = ['delete'];

    public $dataProvider = []; 

    public $i18nCategory = 'backend';

    public function actions()
    {
        return [
            'index' => [
                'class' => IndexAction::class,
                'i18nCategory' => $this->i18nCategory,
                'modelClass' => $this->modelClass,
                'searchModelClass' => $this->searchModelClass,
                'ownerClass' => $this->ownerClass,
                'parentId' => $this->parentId,
                'dataProvider' => $this->dataProvider,
                'ownerIndex' => $this->ownerIndex
            ],
            'create' => [
                'class' => CreateAction::class,
                'i18nCategory' => $this->i18nCategory,
                'modelClass' => $this->formModelClass,
                'ownerClass' => $this->ownerClass,
                'parentId' => $this->parentId,
                'ownerIndex' => $this->ownerIndex
            ],
            'update' => [
                'class' => UpdateAction::class,
                'i18nCategory' => $this->i18nCategory,
                'modelClass' => $this->formModelClass
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'i18nCategory' => $this->i18nCategory,
                'modelClass' => $this->modelClass
            ]
        ];
    }

}