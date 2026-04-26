<?php

namespace App\Controller;

class UsersController extends AppController {

    public function index() {
        //on récupére tous les posts et on les stocke dans $mesUsers
        $mesUsers = $this->Users->find()->contain([
                    'Articles' => function ($q) {
                        return $q
                                ->select(['user_id']);
                    }])->all();
        $this->set(compact('mesUsers'));
    }

    public function view($id = null) {
        try {
            $leUser = $this->Users->get($id);
        } catch (\Exception $ex) {
            if ($id == null) {
                $this->Flash->error(__("L'action detail doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L’user {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('leUser'));
    }

    public function add() {
        $leNewUser = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $leNewUser = $this->Users->patchEntity($leNewUser, $this->request->getData());
            if ($this->Users->save($leNewUser)) {
                $this->Flash->success(__("L’user a été sauvegardé."));
                return $this->redirect(['action' => 'index']);
            } else
                $this->Flash->error(__("Impossible d'ajouter votre user."));
        }
        $this->set(compact('leNewUser'));
    }

    public function edit($id = null) {
        try {
            $leUser = $this->Users->get($id);
        } catch (\Exception $ex) {
            if ($id == null) {
                $this->Flash->error(__("L'action edit doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L’user {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['post', 'put'])) {
            $this->Users->patchEntity($leUser, $this->request->getData());
            if ($this->Users->save($leUser)) {
                $this->Flash->success(__('Votre user a été mis à jour.'));
                return $this->redirect(['action' => 'index']);
            } else
                $this->Flash->error(__('Impossible de mettre à jour votre user.'));
        }
        $this->set(compact('leUser'));
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $leUser = $this->Users->get($id);

        try {
            if ($this->Users->delete($leUser)) {
                $this->Flash->success(__("L'utilisateur {0} d' id {1} a bien été supprimé ! ", $leUser->username, $leUser->id));
            } else {
                $this->Flash->error(__("L'article ne peux pas etre supprimé, reessayez plus tard"));
            }
        } catch (\Exception $ex) {
            $this->Flash->error(__("Impossible de supprimer l’utilisateur {0}", $ex->getMessage()));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event) {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Authentication->allowUnauthenticated(['login', 'add',]);
    }

    public function login() {
        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result && $result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/';
            return $this->redirect($target);
        }
        if ($this->request->is('post')) {
            $this->Flash->error('Mauvais username ou mot de passe, veuillez réessayer');
        }
    }

    public function logout() {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }
}
