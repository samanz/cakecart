<?php 
class UrlHelper extends Helper
{
   var $helpers = array('Html', 'Thumbnail');
	 function ssl($url) {
			$host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
			$pre = "https://" . $host;
			return $pre . $this->Html->url($url);
	 }
   function prod($prod) {
			$name = Inflector::slug($prod['name']);
      return $this->Html->url('/product/' . $prod['id'] . '/' . $name . '.html');
   }
   function prods_image($prod) { echo $this->thumb($prod['image'], 'thumb');        }
   function prod_image($prod) {  echo $this->thumb($prod['image'], 'prod_image');   } 
   function fprods_image($prod) { echo $this->thumb($prod['image'], 'fprods_image');  }
   function cart_image($prod) {  echo $this->thumb($prod['image'], 'cart_image');   }
   function thumb($url, $prefix) {
      echo $this->Html->image(
                  'thumbs/'.$this->Thumbnail->render(
                      $url,
                      array(
                          'path'=>'products',
                          'width'=>Configure::read("Image." . $prefix . "_width"),
                          'height'=>Configure::read("Image." . $prefix . "_height"),
                          'quality'=>Configure::read("Image." . $prefix . "_quality")
                      )
                  )
              );
   }
   function prod_link($prod, $options = "", $model = True) {
			$out = '<a href = "' . $this->prod($prod) .'" ' . $options . '>';
			if($model) {
				$out .= $prod['model'] . ' - ';
			}
      $out .= $prod['name'] . '</a>';
			return $out;
   }
   function admin_prod($prod) {
			$name = Inflector::slug($prod['name']);
      return $this->Html->url('/admin/products/edit/' . $prod['id']);
   }
   function admin_prod_link($prod, $options = "", $model = false, $name = true) {
			$out = '<a href = "' . $this->admin_prod($prod) .'" ' . $options . '>';
			if($name) {
			   if($model) {
				   $out .= $prod['model'] . ' - ';
			   }
            $out .= $prod['name'] . '</a>';
         } else
         $out .= 'Edit</a>';
			return $out;
   }
	function cat($cat, $par = '') {
		 $cat = Inflector::slug($cat);
		 if($par != '')
		  return $this->Html->url('/category/' . $par . '/' . $cat );
		 else
		  return $this->Html->url('/category/' . $cat  );
	}
	function admin_catlink($cat, $options = "", $name = true) {
	   $out = '<a href = "';
	   $out .= $this->Html->url('/admin/categories/show/' . $cat['Category']['url']);
	   $out .= '" ' . $options . '>';
	   if($name) $out .= $cat['Category']['name'];
	   else $out .= 'edit';
	   $out .= "</a>";
	   return $out;
	}
	function catlink($cat, $options = "", $name = true) {
	   $out = '<a href = "';
	   $out .= $this->Html->url('/category/' . $cat['Category']['url']);
	   $out .= '" ' . $options . '>';
	   if($name) $out .= $cat['Category']['name'];
	   else $out .= 'edit';
	   $out .= "</a>";
	   return $out;
	}
	function admin_cat($cat, $par = '') {
		 $cat = Inflector::slug($cat);
		 if($par != '')
		  return $this->Html->url('/admin/categories/show/' . $par . '/' . $cat );
		 else
		  return $this->Html->url('/admin/categories/show/' . $cat  );
	}
	function cat_link($cat, $par = '', $options = "") {
		$out = '<a href = "' . $this->cat($cat, $par) . '" ' . $options . '>';
		$out .= $cat . '</a>';
		return $out;
	}
	function admin_cat_link($cat, $par = '', $options = "", $name = true) {
		$out = '<a href = "' . $this->admin_cat($cat, $par) . '" ' . $options . '>';
		if($name)
		   $out .= $cat . '</a>';
		else
		   $out .= 'edit</a>';
		return $out;
	}
}
?>