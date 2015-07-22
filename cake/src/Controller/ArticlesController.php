<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

class ArticlesController extends AppController{
    
    //view , edit, delete ,index
//    public function beforeFilter(\Cake\Event\Event $event) {
//       $this->Auth->allow(['index']);
//   }
    
    //TODO - fix that later (Login())
     public function beforeFilter(\Cake\Event\Event $event) {
        //allow users to register and logout 
       $this->Auth->allow(['add', 'index', 'view', 'edit', 'delete']);
     }
   
    public function index(){
        
        $articles = $this->Articles->find('all');
       //$data = $articles->toArray();
        // pr($articles);
       //  exit;
        $this->set(compact('articles')); //pass the data to the view
    }
  
    public function view($id = null){ 
        $article = $this->Articles->get($id);
        //if the id is false the get function will throw a exception
//        /exit(var_dump($article));
        $this->set(compact('article'));
    }
    
    public function add(){
     $article = $this->Articles->newEntity();
     if ($this->request->is('post')) {
         $article = $this->Articles->patchEntity($article, $this->request->data);
         if ($this->Articles->save($article)) {
             $this->Flash->success(__('Your article has been saved'));
             return $this->redirect(['action'=>'index']);
         }
         $this->Flash->error(__('Unale to add your article'));
     }
     $this->set('article', $article);
    }
    
    public function edit($id){
        $article = $this->Articles->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success('You have successfully updated the article');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Your article has not been added');
        }
        
        $this->set('article', $article);
    }
    
    public function delete($id){
        
        $this->request->allowMethod(['get']);
        
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article with id {0} has been deleted', h($id)));
            return $this->redirect(['action' => 'index']);
        }
    }
    
}
