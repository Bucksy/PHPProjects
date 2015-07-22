<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class BookmarksController extends AppController {
    
   public function tags(){
       
       $tags = $this->request->params['pass'];
       
       $bookmarks = $this->Bookmarks->find('tagged', ['tags' => $tags]);
       
       //pass variable into the view 
       $this->set([
           'bookmarks' => $bookmarks,
           'tags' => $tags
       ]);
   }
   
   public function isAuthorized($user) {
       
       $action = $this->request->params['action'];
     
       if (in_array($action, ['index', 'add', 'tags'])) {
           return true;
       }
       if (empty($this->request->params['pass'][0])) {
           return false;
       }
       
       $id = $this->request->params['pass'][0];
       $bookmark = $this->Bookmarks->get($id);
       if ($bookmark->user_id == $user['id']) {
           return true;
       }
       
       return parent::isAuthorized($user);
       //check that the bookmark belongs to the current user
   }
   
   public function index(){
       $this->paginate = [
           'conditions' => [
               'Bookmarks.user_id' => $this->Auth->user('id'),
           ]
       ];
   }
   
   public function add(){
       $bookmark = $this->Bookmarks->newEntity();
       if ($this->request->is('post')) {
           
           $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->data);
           
           $bookmark->user_id = $this->Auth->user('id');
           if ($this->Bookmarks->save($bookmark)) {
               $this->Flash->success('The bookmark has been saved.');
               return $this->redirect(['action' => 'index']);
           }
           $this->Flash->error('The bookmark could not saved.');
       }
       
       $tags = $this->Bookmarks->Tags->find('list'); 
       $this->set(compact('bookmark', 'tags')); 
       $this->set('_serialize', ['bookmark']);
 
   }
}
