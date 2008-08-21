<?php
class UrlComponent extends Object {
	function parents($args) {
		$url = $this->getFuncParents($args);
		$ids = $this->getCategoryId($url);
		$a = explode('/', $ids);
		$id = $a[count($a)-1];
		return array($id, $ids, $url);
	}
	function getFuncParents($args, $remove = 0) {
	   $parents = "";
	   foreach($args as $key => $arg) {
		   if( ( count( $args ) - ($key) ) != $remove ) {
			    if($key != 0)
						$parents .= '/';
		      $parents .= $arg;
		   }
	   }
	   return $parents;
	}
	function getUrl($id) {
		$product = ClassRegistry::init('Product');
		$prod = $product->find(array('Product.id' => $id));
		$category = $prod['Product']['category_id'];
		$parents = $this->getParents($category);
		return $parents;
	}
	function getParents($id, $ids = array(), $url = array()) {
	  if($id == 0) { return ""; }
		$category = ClassRegistry::init('Category');
		$parent = $category->find(array('Category.id' => $id));
		$ids[] =  $parent['Category']['id'];
		$url[] =  $parent['Category']['name'];
		if($parent['Category']['parent_id'] == 0 )
			return array($ids , $url); 
	  return $this->getParents($parent['Category']['parent_id'], $ids, $url);
	}
	
	function getCategoryId($url) {
		$category = ClassRegistry::init('Category');
		$url = explode('/', $url);
		$first = $category->find('Category.name = \'' . str_replace('_', ' ', $url[0]) . '\' AND Category.parent_id = 0');
		if( !isset($first['Category']['id']) ) return false;
		$parids = $first['Category']['id'];
		return $this->getCategory($first['Category']['id'], array_slice($url, 1), $parids);
	}
	function getCategory($curid, $url, $parids) {
		$category = ClassRegistry::init('Category');
		if(count($url) == 0) return $parids; 
		$current = $category->findById($curid);
		$next = -1;
		foreach($current['SubCategory'] as $subcat) {
			if(strtoupper($subcat['name']) == strtoupper(str_replace('_', ' ', $url[0])) ) $next = $subcat['id'];
		}
		if( $next == -1 ) return false;
		$parids = $parids . '/' . $next;
		return $this->getCategory($next, array_slice($url,1), $parids);
	}
	function removeLast($urls) {
	   $urls = explode('/', $urls);
      $url = array();
      foreach($urls as $key => $u) {
         if( (count($urls)-1) != $key)
            $url[] = $u;
      }
      $url = implode('/', $url);
      return $url;
	}
}
?>