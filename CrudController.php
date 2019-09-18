<?php

namespace denis909\yii;

abstract class CrudController extends \yii\web\Controller
{

	public $defaultAction = 'index';

	public $modelClass;

	public $searchModelClass;

	public $formModelClass;

	public $ownerClass;

	public $parentId;

	public $postActions = ['delete'];

	public $dataProvider = []; 

	public function actions()
	{
		return [
			'index' => [
				'class' => ReadAction::className(),
				'modelClass' => $this->modelClass,
				'searchModelClass' => $this->searchModelClass,
				'ownerClass' => $this->ownerClass,
				'parentId' => $this->parentId,
				'dataProvider' => $this->dataProvider
			],
			'create' => [
				'class' => CreateAction::className(),
				'modelClass' => $this->formModelClass,
				'ownerClass' => $this->ownerClass,
				'parentId' => $this->parentId
			],
			'update' => [
				'class' => UpdateAction::className(),
				'modelClass' => $this->formModelClass
			],
			'delete' => [
				'class' => DeleteAction::className(),
				'modelClass' => $this->modelClass
			]
		];
	}

}