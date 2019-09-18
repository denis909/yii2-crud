<?php

namespace denis909\yii;

use Yii;

class UpdateAction extends BaseAction
{

	public $template = 'update';
	
	public $scenario;

	public function run()
	{		
		$model = $this->loadModel();
		
		if ($this->scenario != FALSE)
		{
			$model->scenario = $this->scenario;
		}

		if ($model->load(Yii::$app->request->post()))
		{
			if ($model->save())
			{
				return $this->redirectBack();
			}
		}
		
		return $this->render(
			$this->template,
			array(
				'model' => $model
			)
		);
	}

}