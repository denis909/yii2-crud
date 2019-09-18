<?php

namespace denis909\yii;

use Yii;

class MassAction extends BaseAction
{

	public $callback;
	
	public $attributeName = 'selection';
	
	public function run()
	{
		parent::run();
	
		$className = $this->modelClassName;
		
		if (is_callable($this->callback) == FALSE)
		{
			return;
		}

        $post = Yii::$app->request->post();
		
		if (isset($post[$this->attributeName]) == FALSE)
		{
			return;
		}

		if (is_array($post[$this->attributeName]) == FALSE)
		{
			return;
		}
	
		foreach($post[$this->attributeName] as $id)
		{
			$model = $className::findOne($id);

			if ($model != FALSE)
			{						
				call_user_func_array(
					$this->callback, 
					array(
						$model
					)
				);	
			}
		}
	}

}