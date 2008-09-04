<?php

class SearchableBehavior extends ModelBehavior {
	
	var $model;

	function setup(&$model) {

		$this->model = $model;
		
	}

	function stringSearch($model, $keywords, $fields = array(), $type='OR')
	{
		// init criteria
		$criteria = '';

		// build "phrase query" first of all
		foreach($fields as $field)
		{
			$criteria .= $model->name.'.'.$field.' LIKE "%'.$keywords.'%" '.$type.' ';

		}

		// remove extra $type from end of criteria
		$len = strlen($type) + 1;
		$criteria = substr($criteria, 0, (-1)*($len));

		$ids_1 = $model->findAll($criteria, array('id'));
		$ids_1 = Set::extract($ids_1, '{n}.'.$model->name.'.id');

		// build 'AND' query now
		$criteria = '';
		$keywordsArray = explode(' ', $keywords);
		foreach($fields as $field)
		{
			$criteria .= '(';
			foreach($keywordsArray as $keyword)
			{
				$criteria .= $model->name.'.'.$field.' LIKE ';
				$criteria .= '"%'.$keyword.'%" and ';
			}
			$criteria = substr($criteria, 0, -4);
			$criteria .= ') '.$type.' ';

		}
		$criteria = substr($criteria, 0, (-1)*($len));

		$ids_2 = $model->findAll($criteria, array('id'));
		$ids_2 = Set::extract($ids_2, '{n}.'.$model->name.'.id');

		// build 'OR' query now
		$criteria = '';
		$keywordsArray = explode(' ', $keywords);
		foreach($fields as $field)
		{
			$criteria .= '(';
			foreach($keywordsArray as $keyword)
			{
				$criteria .= $model->name.'.'.$field.' LIKE ';
				$criteria .= '"%'.$keyword.'%" OR ';
			}
			$criteria = substr($criteria, 0, -4);
			$criteria .= ') '.$type.' ';

		}
		$criteria = substr($criteria, 0, (-1)*($len));
      #die($criteria);

		$ids_3 = $model->findAll($criteria, array('id'));
		$ids_3 = Set::extract($ids_3, '{n}.'.$model->name.'.id');

		/* uncomment to debug
		pr($ids_1);
		pr($ids_2);
		pr($ids_3);
		*/

		// remove all $ids_1 from $ids_2 & $ids_3
		$ids_2 = array_diff($ids_2, $ids_1);
		$ids_2 = Set::extract($ids_2, '{n}');

		$ids_3 = array_diff($ids_3, $ids_1);
		
		// remove $ids_2 from $ids_3
		$ids_3 = array_diff($ids_3, $ids_2);
		$ids_3 = Set::extract($ids_3, '{n}');

		/* uncomment to debug
		echo "filtered ids";
		pr($ids_1);
		pr($ids_2);
		pr($ids_3);
		*/

		$items_1 = $model->find('all', array('conditions' => array($model->name .'.id' => $ids_1)));
		$items_2 = $model->find('all', array('conditions' => array($model->name .'.id' => $ids_2)));
		$items_3 = $model->find('all', array('conditions' => array($model->name .'.id' => $ids_3)));

		// merge final items in order of their relevancy
		$items = am($items_1, $items_2, $items_3);

		return $items;
	}


}
?>