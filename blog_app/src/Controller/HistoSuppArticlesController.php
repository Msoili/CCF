<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * HistoSuppArticles Controller
 *
 */
class HistoSuppArticlesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
       $query = $this->HistoSuppArticles
    ->find()
    ->contain(['Users']); // ← AJOUT OBLIGATOIRE

        $histoSuppArticles = $this->paginate($query);

        $this->set(compact('histoSuppArticles'));
    }

    /**
     * View method
     *
     * @param string|null $id Histo Supp Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $histoSuppArticle = $this->HistoSuppArticles->get($id, contain: ['Users']);
        $this->set(compact('histoSuppArticle'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $histoSuppArticle = $this->HistoSuppArticles->newEmptyEntity();
        $users = $this->HistoSuppArticles->Users->find('list')->all();
        if ($this->request->is('post')) {
            $histoSuppArticle = $this->HistoSuppArticles->patchEntity($histoSuppArticle, $this->request->getData());
            if ($this->HistoSuppArticles->save($histoSuppArticle)) {
                $this->Flash->success(__('L histo supp article est bien sauvegarder.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The histo supp article could not be saved. Please, try again.'));
        }
        $this->set(compact('histoSuppArticle', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Histo Supp Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $histoSuppArticle = $this->HistoSuppArticles->get($id, contain: []);
        $users = $this->HistoSuppArticles->Users->find('list')->all();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $histoSuppArticle = $this->HistoSuppArticles->patchEntity($histoSuppArticle, $this->request->getData());
            if ($this->HistoSuppArticles->save($histoSuppArticle)) {
                $this->Flash->success(__('The histo supp article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The histo supp article could not be saved. Please, try again.'));
        }
        $this->set(compact('histoSuppArticle', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Histo Supp Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $histoSuppArticle = $this->HistoSuppArticles->get($id);
        if ($this->HistoSuppArticles->delete($histoSuppArticle)) {
            $this->Flash->success(__('L histo supp article est bien supprimer.'));
        } else {
            $this->Flash->error(__('The histo supp article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
