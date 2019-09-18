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

		if ($model->load(Yii::$app->request->post()))
		{
			if ($model->save())
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