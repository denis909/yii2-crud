<?php

namespace denis909\yii;
use Yii;

class DeleteAction extends BaseAction
{

	public function run()
	{
		$model = $this->loadModel();
						
		$model->delete();
	
		return $this->redirectBack();
	}

}