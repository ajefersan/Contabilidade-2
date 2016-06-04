<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Historicos Controller
 *
 * @property \App\Model\Table\HistoricosTable $Historicos
 */
class HistoricosController extends AppController
{

    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['edit','delete', 'view'])) {
            $historico_id = (int)$this->request->params['pass'][0];

            if (!$this->Historicos->isOwnedBy($historico_id, $user['id'])) {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'finder' => [
                'userHistoricos' => [
                    'user_id' => $this->Auth->user('id')
                ]
            ]
        ];

        $historicos = $this->paginate($this->Historicos);

        $this->set(compact('historicos'));
        $this->set('_serialize', ['historicos']);
    }

    /**
     * View method
     *
     * @param string|null $id Historico id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $historico = $this->Historicos->get($id, [
            'contain' => ['Users', 'Movimentacoes']
        ]);

        $this->set('historico', $historico);
        $this->set('_serialize', ['historico']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $historico = $this->Historicos->newEntity();
        if ($this->request->is('post')) {
            $historico = $this->Historicos->patchEntity($historico, $this->request->data);
            $historico->users_id = $this->Auth->user('id');

            if ($this->Historicos->save($historico)) {
                $this->Flash->success(__('The historico has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The historico could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('historico', 'users'));
        $this->set('_serialize', ['historico']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Historico id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $historico = $this->Historicos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $historico = $this->Historicos->patchEntity($historico, $this->request->data);
            if ($this->Historicos->save($historico)) {
                $this->Flash->success(__('The historico has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The historico could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('historico', 'users'));
        $this->set('_serialize', ['historico']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Historico id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $historico = $this->Historicos->get($id);
        if ($this->Historicos->delete($historico)) {
            $this->Flash->success(__('The historico has been deleted.'));
        } else {
            $this->Flash->error(__('The historico could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
