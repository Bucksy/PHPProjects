<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;


class UsersController extends AppController {
  
     public function beforeFilter(\Cake\Event\Event $event) {
        //allow users to register and logout 
       $this->Auth->allow(['add', 'logout']);
     }
   
    public function login(){
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            //pr($user);
            //exit;
            if ($user) {
//                pr($user);
//                exit;
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect. Please try again');
        }
   }
   
   public function logout(){
       $this->Flash->success('You are now logged out.');
       return $this->redirect($this->Auth->logout());
   }
   
   public function add(){
       
       $user = $this->Users->newEntity();
      
       if ($this->request->is('post')) {
          $user = $this->Users->patchEntity($user, $this->request->data);
          if ($this->Users->save($user)) {
             $this->Flash->success(__('The user has been saved'));
             return $this->redirect(['action' => 'add']);
          }
//          pr($user->errors());
          $this->Flash->error(('Unable to add user'));
       }
       $this->set('user', $user); //add a new user to the database 
   }
}
