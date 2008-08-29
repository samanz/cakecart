<?php
class TaxesController extends AppController {
   var $name = 'Taxes';
   var $uses = array('Tax');
   function admin_index() {
      $this->set('current', 'settings');
      $this->set('sidebar', array('admin_settings'));
      $taxes = $this->Tax->find('all');
      $this->set('taxes', $taxes);
   }
   function admin_edit($id = null) {
      $this->set('current', 'settings');
      if(empty($this->data)) {
         $this->Tax->id = $id;
         $this->data = $this->Tax->read();
      } else {
         if($this->Tax->save($this->data)) {
            $this->Session->setFlash('Tax saved');
            $this->redirect('/admin/taxes');
         }
      }
   }
   function admin_add() {
      $this->set('current', 'settings');
      if(!empty($this->data)) {
         if($this->Tax->save($this->data)) {
            $this->Session->setFlash('Tax saved');
            $this->redirect('/admin/taxes');
         }
      }
   }
   function admin_remove($id) {
      $this->set('current', 'settings');
      if(!isset($_POST['sent'])) {
         $tax = $this->Tax->find(array('Tax.id' => $id));
         $this->set('tax', $tax);
      } else {
         $this->Tax->del($id);
         $this->Session->setFlash('Tax Deleted.');
         $this->redirect('/admin/taxes');
      }
   }
}
?>