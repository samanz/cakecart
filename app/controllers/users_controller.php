<?php
class UsersController extends AppController {

    var $name = 'Users';
    var $helpers = array('Html', 'Onorder');
    function beforeFilter() {
       $this->setUser();
       $this->Auth->allow('register');
       $this->Auth->fields = array('username'=>'email','password'=>'password');  
    }

    function admin_index() {
       $this->set('current', 'users');
       $users = $this->User->find('all', array('conditions' => array('User.admin' => '0')));
       $this->set('users', $users);
       $this->set('sidebar', array('admin_users'));
    }
    function admin_admins() {
       $this->set('current', 'users');
       $users = $this->User->find('all', array('conditions' => array('User.admin' => '1')));
       $this->set('users', $users);
       $this->set('sidebar', array('admin_users'));
    }
    function admin_show($id) {
       $this->set('current', 'users');
       $this->User->recursive = 2;
       $user = $this->User->find(array('User.id'=>$id));
       $this->set('user', $user);
    }
    function admin_edit($id = null) {
       $this->set('current', 'users');
       if(empty($this->data)) {
          $this->User->id = $id;
          $this->data = $this->User->read();
       } else {
          if($this->User->save($this->data)) {
             $this->Session->setFlash('User edited');
             $this->redirect('/admin/users');
          }
       }   
    }
    function admin_remove($id) {
       if($this->User->lastAdmin()) {
          $this->Session->setFlash('Cannot delete last admin');
          $this->redirect('/admin/users/admins');
          exit();
       }
       if(!isset($_POST['sent'])) {
          $user = $this->User->find(array('User.id' => $id));
          $this->set('user', $user);
       } else {
          $this->User->del($id);
          $this->Session->setFlash('User Deleted.');
          $this->redirect('/admin/users');
       }
    }
    function admin_add_admin() {
       if(!empty($this->data)) {
          $this->data['User']['admin'] = 1;
          if( $this->data['User']['password'] == $this->Auth->password($this->data['User']['password2']) ) {
             if( $this->User->save($this->data) ) {
                $this->Session->setFlash('User Registered');
                $this->redirect('/admin/users/admins');
             }
         }
       }
    }
    function login() {
    }
    function admin_login() {
       $this->layout = 'admin_login';
    }
    function logout() {
        $this->redirect($this->Auth->logout());
    }
    function admin_logout() {
       $this->redirect($this->Auth->logout());
    }
    function register() {
       if(!empty($this->data)) {
          $this->data['User']['admin'] = 0;
          if( $this->data['User']['password'] == $this->Auth->password($this->data['User']['password2']) ) {
             if( $this->User->save($this->data) ) {
                $this->Auth->login();
                $this->Session->setFlash('User Registered');
                $this->redirect('/');
             }
         }
       }
    }
}
?>