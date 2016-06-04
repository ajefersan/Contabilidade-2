<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Auth Controller
 *
 * @property \EventsManager\Model\Table\AuthTable $Auth
 */
class AuthController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow();
    }

    public function index()
    {
        return $this->redirect(['action' => 'login']);
    }

    public function login()
    {
        if ($this->request->is('post')) {

            $user = $this->Auth->identify();

            if($user) {
                $this->Auth->setUser($user);

                return $this->redirect(['controller' => 'contas', 'action' => 'index']);
            }


            $this->Flash->error('Usuário ou senha inválido, tente novamente');
        }
    }

    public function logout()
    {
        $this->Flash->success('Você acabou de sair do sistema');

        return $this->redirect($this->Auth->logout());
    }

}
