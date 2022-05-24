<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['logout', 'edit']);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['delete', 'status', 'add', 'search']) && $user['role_id'] > 1) {
            return false;
        }elseif (in_array($action, ['edit']) && $user['role_id'] > 1) {
            $userIdEdit = (int)$this->request->getParam('pass.0');
            if ($this->Users->isOwnedBy($userIdEdit, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Los datos ingresados son incorrectos');
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles'],
            'limit' => 10
        ];

        $search = $this->request->getData('search') ?? false;        
        $users = $this->paginate($this->Users->searchDataUser($search));

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles'],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('El usuario ha sido registrado exitosamente');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('El usuario no pudo ser registrado, verifique he intente nuevamente');
        }

        $roles = $this->Users->Roles->find('list');
        $this->set(compact('user', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            if(empty($data['password'])){
                unset($data['password']);
            }
            $user = $this->Users->patchEntity($user, $data);$user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('El usuario fue actualizado con exito');

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('El usuario no pudo ser actualizado, verifique he intente de nuevo');
        }else{
            $user->password = null;
        }
        $roles = $this->Users->Roles->find('list');
        $this->set(compact('user', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('El usuario ha sido eliminado');
        } else {
            $this->Flash->error('El usuario no pudo ser eliminado, intente nuevamente');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function status( $id = null){

        if($this->request->is('post')){
            $user = $this->Users->get($id);
            if($this->Users->updateAll(['active' => !$user['active']], ['id' => $id])){
                $this->Flash->success('El usuario ha sido '.(!$user['active'] ? 'activado':'desactivado').' exitosamente');
            }else {
                $this->Flash->error('El estado del usuario no pudo ser cambiado, verifique he intente nuevamente');
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    public function search($username){
        $this->autoRender = false;

        if($this->Users->exists(['username' => $username])){
            $exist = true;
        }else{
            $exist = false;
        }

        return $this->response->withType('application/json')->withStringBody(json_encode(['exist' => $exist]));
    }
}
