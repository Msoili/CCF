<?php

namespace App\Controller;

class CommentsController extends AppController {

    public function add() {
              
        $leNewComment = $this->Comments->newEmptyEntity();
        if ($this->request->is('post')) {
            $leNewComment = $this->Comments->patchEntity($leNewComment, $this->request->getData());
            $leNewComment->article_id = 1;
            if ($this->Comments->save($leNewComment)) {
                $this->Flash->success(__("Le comment a été sauvegardé."));
                return $this->redirect(['action' => 'add']);
            } else
                $this->Flash->error(__("Impossible d'ajouter le commentaire."));
        }
        $this->set(compact('leNewComment'));
    }
    
     public function delete($id = null) {
$leComment = $this->Comments->get($id);     
        if ($this->Comments->delete($leComment)) {
            $this->Flash->success(__("L'article {0} d' id {1} a bien été supprimé ! ", $leComment->title, $leComment->id));
        } else {
            $this->Flash->error(__("L'article ne peux pas etre supprimé, reessayez plus tard"));
        }
        return $this->redirect(['action' => 'detail','controller' => 'articles', $leComment->article_id]);
    }
}
