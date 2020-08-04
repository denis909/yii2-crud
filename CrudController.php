<?php

namespace denis909\yii;

class CrudController extends \denis909\yii\Controller
{

    public $indexActionClass = IndexAction::class;

    public $createActionClass = CreateAction::class;

    public $updateActionClass = UpdateAction::class;

    public $deleteActionClass = DeleteAction::class;

    public $viewActionClass = ViewAction::class;

    public $modelClass;

    public $searchModelClass;

    public $formModelClass;

    public $parentModelClass;

    public $parentAttribute;

    public $postActions = ['delete'];

    public $pageSize = 10;

    public $dataProvider = [];
    
    public function actions()
    {
        $return = [];

        if ($this->indexActionClass)
        {
            $return['index'] = ['class' => $this->indexActionClass];
        }

        if ($this->createActionClass)
        {
            $return['create'] = ['class' => $this->createActionClass];
        }

        if ($this->updateActionClass)
        {
            $return['update'] = ['class' => $this->updateActionClass];
        }

        if ($this->deleteActionClass)
        {
            $return['delete'] = ['class' => $this->deleteActionClass];
        }

        return $return;
    }

}