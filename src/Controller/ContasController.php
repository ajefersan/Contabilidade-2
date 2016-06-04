<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Contas Controller
 *
 * @property \App\Model\Table\ContasTable $Contas
 */
class ContasController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['edit','delete', 'view'])) {
            $conta_id = (int)$this->request->params['pass'][0];

            if (!$this->Contas->isOwnedBy($conta_id, $user['id'])) {
                return false;
            }
        }

        return parent::isAuthorized($user);
    }

    public function all($matchDate = false)
    {
        $this->loadModel('Historicos');
        $this->loadModel('Movimentacoes');

        if(!$matchDate) {
            $matchDate = $this->Movimentacoes->find('all', [
                'contain' => ['Contas'],
                'fields' => 'data',
                'group' => 'data',
                'order' => 'Movimentacoes.id ASC',
               'conditions' => ['Contas.users_id' => $this->Auth->user('id')]
            ])->last()->data;
        }

        $contas = $this->Contas->find('all', [
            'contain' => ['Users', 'Movimentacoes' => function($e) use ($matchDate) {
                return $e->where(['Movimentacoes.data' => $matchDate]);
            }],
            'conditions' => ['users_id' => $this->Auth->user('id')]
        ]);

        $periodos = $this->Movimentacoes->find('all', [
            'contain' => ['Contas'],
            'fields' => 'data',
            'group' => 'data',
            'conditions' => ['Contas.users_id' => $this->Auth->user('id')]
        ]);

        $diario = $this->Movimentacoes->find('all', [
            'contain' => ['Contas', 'Historicos'],
            'order' => 'Movimentacoes.id ASC',
            'conditions' => ['Contas.users_id' => $this->Auth->user('id')]
        ]);

        foreach($contas as $conta) {
            $conta_id = $conta->id;

            $creditos[$conta_id] = 0;
            $debitos[$conta_id] = 0;

            foreach($conta->movimentacoes as $movimentacoes) {
                if($movimentacoes->tipo == 'D') {
                    $debitos[$conta_id] += $movimentacoes->valor;
                }
                else {
                    $creditos[$conta_id] += $movimentacoes->valor;
                }

                $historico = $this->Historicos->findById($movimentacoes->historico_id)->first();
                $historicos[$movimentacoes->historico_id] = $historico->nome;
            }

            if($conta->movimentacoes) {
                $total[$conta_id]['nome'] = $conta->nome;
                $total[$conta_id]['saldo'] = $creditos[$conta_id] - $debitos[$conta_id];
                $total[$conta_id]['creditos'] = $creditos[$conta_id];
                $total[$conta_id]['debitos'] = $debitos[$conta_id];
            }
        }


        $this->set('historicos', $historicos);
        $this->set('contas', $contas);
        $this->set('periodos', $periodos);
        $this->set('matchDate', $matchDate);
        $this->set('diario', $diario);
        $this->set('total', $total);
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
                'userContas' => [
                    'user_id' => $this->Auth->user('id')
                ]
            ]
        ];
        $contas = $this->paginate($this->Contas);

        $this->set(compact('contas'));
        $this->set('_serialize', ['contas']);
    }

    /**
     * View method
     *
     * @param string|null $id Conta id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $conta = $this->Contas->get($id, [
            'contain' => ['Users', 'Movimentacoes']
        ]);

        $this->set('conta', $conta);
        $this->set('_serialize', ['conta']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $conta = $this->Contas->newEntity();
        if ($this->request->is('post')) {
            $conta = $this->Contas->patchEntity($conta, $this->request->data);
            $conta->users_id = $this->Auth->user('id');

            if ($this->Contas->save($conta)) {
                $this->Flash->success(__('The conta has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The conta could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('conta', 'users'));
        $this->set('_serialize', ['conta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Conta id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $conta = $this->Contas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $conta = $this->Contas->patchEntity($conta, $this->request->data);
            if ($this->Contas->save($conta)) {
                $this->Flash->success(__('The conta has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The conta could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('conta', 'users'));
        $this->set('_serialize', ['conta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Conta id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $conta = $this->Contas->get($id);
        if ($this->Contas->delete($conta)) {
            $this->Flash->success(__('The conta has been deleted.'));
        } else {
            $this->Flash->error(__('The conta could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
