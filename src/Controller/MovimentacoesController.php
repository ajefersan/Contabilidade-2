<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Movimentacoes Controller
 *
 * @property \App\Model\Table\MovimentacoesTable $Movimentacoes
 */
class MovimentacoesController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['edit','delete', 'view'])) {
            $movimentacoes_id = (int)$this->request->params['pass'][0];

            if (!$this->Movimentacoes->isOwnedBy($movimentacoes_id, $user['id'])) {
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
            'contain' => ['Contas', 'Historicos'],
            'finder' => [
                'userMovimentacoes' => [
                    'user_id' => $this->Auth->user('id')
                ]
            ]
        ];
        $movimentacoes = $this->paginate($this->Movimentacoes);

        $this->set(compact('movimentacoes'));
        $this->set('_serialize', ['movimentacoes']);
    }

    /**
     * View method
     *
     * @param string|null $id Movimentaco id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $movimentaco = $this->Movimentacoes->get($id, [
            'contain' => ['Contas', 'Historicos']
        ]);

        $this->set('movimentaco', $movimentaco);
        $this->set('_serialize', ['movimentaco']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $movimentaco = $this->Movimentacoes->newEntity();
        if ($this->request->is('post')) {
            $movimentaco = $this->Movimentacoes->patchEntity($movimentaco, $this->request->data);
            if ($this->Movimentacoes->save($movimentaco)) {
                $this->Flash->success(__('The movimentaco has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The movimentaco could not be saved. Please, try again.'));
            }
        }

        $contas = $this->Movimentacoes->Contas->getContasFormatadas($this->Auth->user('id'));
        $historicos = $this->Movimentacoes->Historicos->getHistoricosFormatados($this->Auth->user('id'));

        $this->set(compact('movimentaco', 'contas', 'historicos'));
        $this->set('_serialize', ['movimentaco']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Movimentaco id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $movimentaco = $this->Movimentacoes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $movimentaco = $this->Movimentacoes->patchEntity($movimentaco, $this->request->data);
            if ($this->Movimentacoes->save($movimentaco)) {
                $this->Flash->success(__('The movimentaco has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The movimentaco could not be saved. Please, try again.'));
            }
        }
        $contas = $this->Movimentacoes->Contas->find('list', ['limit' => 200]);
        $historicos = $this->Movimentacoes->Historicos->find('list', ['limit' => 200]);
        $this->set(compact('movimentaco', 'contas', 'historicos'));
        $this->set('_serialize', ['movimentaco']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Movimentaco id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $movimentaco = $this->Movimentacoes->get($id);
        if ($this->Movimentacoes->delete($movimentaco)) {
            $this->Flash->success(__('The movimentaco has been deleted.'));
        } else {
            $this->Flash->error(__('The movimentaco could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
