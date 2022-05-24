<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    
    public function beforeFilter(Event $event){
        $user = $this->Auth->user();

        if (!$user) {
            $this->Auth->config('authError', false);
            $this->set('logout', false);
        }else{
            $isAdmin = ($user['role_id'] == '1');
            $idUser = $user['id'];
            $logout = true;

            $this->set(compact('isAdmin', 'idUser', 'logout'));
        }
    }

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'authError' => 'No tiene permiso para realizar la acción solicitada',
            'authenticate' => [
                'Form' => [
                    'finder' => 'auth',
                    'passwordHasher' => [
                        'className' => 'Sha512',
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
    }

    public function isAuthorized($user)
    {
        if ((isset($user['role_id']) && $user['role_id'] == '1') || (in_array($this->request->getParam('action'), ['index', 'view']))) {
            return true;
        }

        return false;
    }
}
