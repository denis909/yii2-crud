<?php

namespace denis909\yii;

use Yii;
use yii\base\Model;
use denis909\yii\Assert;

class CrudController extends \denis909\yii\Controller
{

    public $modelClass;

    public $searchModelClass;

    public $formModelClass;

    public $parentModelClass;

    public $parentAttribute;

    public $postActions = ['delete'];

    public $pageSize = 10;

    public $dataProvider = [];

    public $indexActionClass = IndexAction::class;

    public $createActionClass = CreateAction::class;

    public $updateActionClass = UpdateAction::class;

    public $deleteActionClass = DeleteAction::class;

    public $viewActionClass = ViewAction::class;

    public $i18nCategory = 'app';

    public function t(string $name, array $params = []) : string
    {
        return Yii::t($this->i18nCategory, $name, $params);
    }

    public function createModel(string $className, array $params = [])
    {
        return $className::instantiate($params);
    }

    public function createQuery(string $className)
    {
        return $className::find();
    }    

    public function loadModel(Model $model, array $data = [])
    {
        return $model->load($data);
    }

    public function saveModel(Model $model, bool $validate = true, array $attributes = null)
    {
        return $model->save($validate, $attributes);
    }

    public function validateModel(Model $model, $attributes = null)
    {
        return $model->validate($attributes);
    }

    public function deleteModel(Model $model)
    {
        return $model->delete();
    }
    
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

        if ($this->viewActionClass)
        {
            $return['view'] = ['class' => $this->viewActionClass];
        }

        return $return;
    }

}