<?php
class CouponsController extends AppController {
   var $name = 'Coupons';
   var $uses = array('Coupon', 'Category');
   function admin_index() {
      $this->set('current', 'settings');
      $this->set('sidebar', array('admin_settings'));
      $coupons = $this->Coupon->findAllWithCurrent();
      $this->set('coupons', $coupons);
   }
   function admin_edit($id = null) {
      $this->set('current', 'settings');
      if(empty($this->data)) {
         $categories = $this->Category->find('all', array('conditions' => array('Category.parent_id' => 0)));
         $this->set('categories', $categories);
         $this->Coupon->id = $id;
         $this->data = $this->Coupon->read();
      } else {
         $this->data['Coupon']['start'] = $this->getDate($this->data['Coupon'], 'start');
         $this->data['Coupon']['end'] = $this->getDate($this->data['Coupon'], 'end');
         if($this->Coupon->save($this->data)) {
            $this->Session->setFlash('Coupon saved');
            $this->redirect('/admin/coupons');
         }
      }
   }
   function admin_add() {
      $this->set('current', 'settings');
      $categories = $this->Category->find('all', array('conditions' => array('Category.parent_id' => 0)));
      $this->set('categories', $categories);
      if(!empty($this->data)) {
         $this->data['Coupon']['start'] = $this->getDate($this->data['Coupon'], 'start');
         $this->data['Coupon']['end'] = $this->getDate($this->data['Coupon'], 'end');
         if($this->Coupon->save($this->data)) {
            $this->Session->setFlash('Coupon saved');
            $this->redirect('/admin/coupons');
         }
      }
   }
   function admin_remove($id) {
      $this->set('current', 'settings');
      if(!isset($_POST['sent'])) {
         $coupon = $this->Coupon->find(array('Coupon.id' => $id));
         $this->set('coupon', $coupon);
      } else {
         $this->Coupon->del($id);
         $this->Session->setFlash('Coupon Deleted.');
         $this->redirect('/admin/coupons');
      }
   }
   function getDate($data, $pre) {
	   $date = $data[$pre . '_date'];
	   $date = explode('/', $date);
	   $date = $date[2] . '-' . $date[1] . '-' . $date[0];
      return $date;
	}
}
?>