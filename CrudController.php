<?php

namespace denis909\yii;

class CrudController extends \denis909\yii\Controller
{

    public $indexAction = IndexAction::class;

    public $createAction = CreateAction::class;

    public $updateAction = UpdateAction::class;

    public $deleteAction = DeleteAction::class;

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
                'class' => $this->indexAction,
                'i18nCategory' => $this->i18nCategory,
                'modelClass' => $this->modelClass,
                'searchModelClass' => $this->searchModelClass,
                'ownerClass' => $this->ownerClass,
                'parentId' => $this->parentId,
                'dataProvider' => $this->dataProvider,
                'ownerIndex' => $this->ownerIndex
            ],
            'create' => [
                'class' => $this->createAction,
                'i18nCategory' => $this->i18nCategory,
                'modelClass' => $this->formModelClass,
                'ownerClass' => $this->ownerClass,
                'parentId' => $this->parentId,
                'ownerIndex' => $this->ownerIndex
            ],
            'update' => [
                'class' => $this->updateAction,
                'i18nCategory' => $this->i18nCategory,
                'modelClass' => $this->formModelClass
            ],
            'delete' => [
                'class' => $this->deleteAction,
                'i18nCategory' => $this->i18nCategory,
                'modelClass' => $this->modelClass
            ]
        ];
    }

}