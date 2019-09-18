<?php

namespace denis909\yii;

use yii\web\NotFoundHttpException;

class ViewAction extends BaseAction
{

	public $templateName = 'view';
			
	public $beforeRender;

	public function run()
	{
		parent::run();
		
		$className = $this->modelClassName;
			
		$model = $className::findOne(Yii::$app->request->get('id'));
		
		if ($model == FALSE)
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
				
		if ($this->beforeRender != FALSE)
		{
			call_user_func_array(
				$this->beforeRender, 
				array(
					$model
				)
			);
		}		
		
		return $this->controller->render(
			$this->templateName,
			array(
				'model' => $model
			)
		);
	}

}