<?php

namespace App\Controller;

class ArticlesController extends AppController {

    public function index() {
        //on récupére tous les posts et on les stocke dans $mesArticles
        $mesArticles = $this->Articles->find()->contain([
                    'Users' => function ($q) {
                        return $q
                                ->select(['username', 'email']);
                    }, 'Comments' => function ($q) {
                        return $q
                                ->select(['article_id']);
                    }, 'Tags' => function ($q) {
                        return $q
                                ->select(['ArticlesTags.article_id']);
                    }])
                ->orderBy(['Articles.modified' => 'DESC'])
                ->all();

        $this->set(compact('mesArticles'));
    }

    public function detail($id = null) {
        $comments = $this->fetchTable('Comments');
        $leNewComment = $comments->newEmptyEntity();
        if ($this->request->is('post')) {
            $leNewComment = $comments->patchEntity($leNewComment, $this->request->getData());
            $leNewComment->article_id = $id;
            $leNewComment->user_id = $this->request->getAttribute('identity')->id;
            if ($comments->save($leNewComment)) {
                $this->Flash->success(__("Le commentaire a été sauvegardé."));
                return $this->redirect(['action' => 'detail', $id]);
            } else {
                $this->Flash->error(__("Impossible d'ajouter le commentaire."));
            }
        }

        try {
            $leArticle = $this->Articles->get($id,
                    contain: ['Comments.Users' => function ($q) {
                            return $q
                                    ->select('Users.username')
                                    ->orderBy(['Comments.created asc']);
                        },
                        'Users' => function ($q) {
                            return $q
                                    ->select(['Users.username']);
                        }, 'Tags' => function ($q) {
                            return $q
                                    ->select(['Tags.id',
                                        'Tags.title',
                                        'Tags.modified',
                                        'ArticlesTags.priority']);
                        }
            ]);
        } catch (\Exception $ex) {
            if ($id == null) {
                $this->Flash->error(__("L'action detail doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L’article {0} n'existe pas {1}", $id, $ex->getMessage()));
            }
            return $this->redirect(['action' => 'index']);
        }

        $this->set(compact('leArticle', 'leNewComment'));
    }

    public function add() {
        $mesTags = $this->fetchTable('Tags')
                ->find('list', keyField: 'id', valueField: 'title')
                ->toArray();
        //2 si je veux d'autres utlisateurs veulent avoirNB article
        //$users = $this->Articles->Users->find('list')->all();

        $leNewArticle = $this->Articles->newEmptyEntity();

        if ($this->request->is('post')) {

            //on recupere le data du formulaire pour recreer un tableau tag/priorite
            $data = $this->request->getData();

            //newData contient les données à enregistrer dans la base (articles et articles_tags 
            $newData['title'] = $data['title'];
            $newData['content'] = $data['content'];

            //Pour enregistrer les tags en meme temps, il faut la structure tags._joinData
            $newData['tags'] = [];

            // Nettoyer les données des tags
            if (!empty($data['tags']['_ids'])) {
                foreach ($data['tags']['_ids'] as $tagId) {
                    //On crée la structure qui permetre d'enregistrer dans la table de jointure grace à _joinData
                    foreach ($data['tags']['_joinData'] as $tag => $prio) {
                        $tab = [];
                        if ($tag == $tagId) {
                            $tab = ['id' => $tagId, '_joinData' => $prio];
                            $newData['tags'][] = $tab;
                             //3 si je veux d'autres utlisateurs veulent avoirNB article 
                            //$newData['user_id'] = $data['user_id'];
                        }
                    }
                }
            }

            //on recupere l'id du user connecté et on le rajoute en tant que clé étrangere
            $leNewArticle->user_id = $this->request->getAttribute('identity')->id;

            $leNewArticle = $this->Articles->patchEntity($leNewArticle, $newData,
                    ['associated' => ['Tags._joinData']]);
            if ($this->Articles->save($leNewArticle)) {
                $this->Flash->success(__("L’article a été sauvegardé."));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__("Impossible d'ajouter votre article. Erreur : {0}",));
            }
        }
        //4 si je veux d'autres utlisateurs veulent avoirNB article
        //$this->set(compact('leNewArticle', 'mesTags', 'users'));

        $this->set(compact('leNewArticle', 'mesTags'));
    }

    public function edit($id = null) {
//        $mesUsers = $this->fetchTable('Users')
//                ->find('list', keyField: 'id', valueField: 'username')
//                ->toArray();
        $mesTags = $this->fetchTable('Tags')
                ->find('list', keyField: 'id', valueField: 'title')
                ->toArray();
        try {
            $leArticle = $this->Articles->get($id,
                    contain: ['Tags' => function ($q) {
                            return $q
                                    ->select(['ArticlesTags.article_id',
                                        'ArticlesTags.tag_id',
                                        'ArticlesTags.priority']);
                        }
            ]);
            $identity = $this->request->getAttribute('identity');
            if ($identity && ($leArticle->user_id != $identity->id)) {
                $this->Flash->error(__("Vous n'avez pas le droit d'éditer cet article"));
                return $this->redirect(['action' => 'index']);
            }
        } catch (\Exception $ex) {
            if ($id == null) {
                $this->Flash->error(__("L'action edit doit être appelé avec un identifiant"));
            } else {
                $this->Flash->error(__("L’article {0} n'existe pas", $id));
            }
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['post', 'put'])) {

            $data = $this->request->getData();

            //newData contient les données à enregistrer dans la base (articles et articles_tags 
            $newData['title'] = $data['title'];
            $newData['content'] = $data['content'];

            //Pour enregistrer les tags en meme temps, il faut la structure tags._joinData
            $newData['tags'] = [];

            // Nettoyer les données des tags
            if (!empty($data['tags']['_ids'])) {
                foreach ($data['tags']['_ids'] as $tagId) {
                    //On crée la structure qui permetre d'enregistrer dans la table de jointure grace à _joinData
                    foreach ($data['tags']['_joinData'] as $tag => $prio) {
                        $tab = [];
                        if ($tag == $tagId) {
                            $tab = ['id' => $tagId, '_joinData' => $prio];
                            $newData['tags'][] = $tab;
                        }
                    }
                }
            }

            $this->Articles->patchEntity($leArticle, $newData);
            $leArticle->user_id = $this->request->getAttribute('identity')->id;
            if ($this->Articles->save($leArticle,
                            ['associated' => ['Tags._joinData']])) {
                $this->Flash->success(__('Votre article a été mis à jour.'));
            } else {
                $this->Flash->error(__('Impossible de mettre à jour votre article.'));
            }
            return $this->redirect(['action' => 'edit', $leArticle->id]);
        }
        $this->set(compact('leArticle', 'mesTags'));
    }

    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $leArticle = $this->Articles->get($id);
        if ($this->Articles->delete($leArticle)) {
            $this->Flash->success(__("L'article {0} d' id {1} a bien été supprimé ! ", $leArticle->title, $leArticle->id));
        } else {
            $this->Flash->error(__("L'article ne peux pas etre supprimé, reessayez plus tard"));
        }
        return $this->redirect(['action' => 'index']);
    }
}
