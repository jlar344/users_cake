<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('role_id')
            ->requirePresence('role_id', 'create')
            ->notEmptyString('role_id', 'Debe de seleccionar algún perfil antes de guardar la información del usuario');

        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->requirePresence('username', 'create')
            ->add('username', 'custom', [
                'rule' => function($username, $ctx){
                    $txt = [];

                    if(!$username){
                        return 'Verifique que el nombre de usuario no esté vacío';
                    }

                    if(strlen($username) < 6){
                        $txt[] = 'Asegúrese de al menos tener 5 caracteres su nommbre de usuario';
                    }

                    if($txt){
                        return implode(' | ', $txt);
                    }

                    return true;
                }
            ]);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->add('password', 'custom', [
                'rule' => function($pass, $ctx){
                    $txt = [];

                    if(!$pass){
                        return 'La contraseña no puede estar vacía';
                    }

                    if(strlen($pass) < 6){
                        $txt[] = 'Debe de contener al menos 6 caracteres';
                    }

                    if (!preg_match('@[A-Z]@', $pass)) {
                        $txt[] = 'Debe de contener al menos un caracter en mayúscula';
                    }

                    if (!preg_match('@[a-z]@', $pass)) {
                        $txt[] = 'Debe de contener al menos un caracter en minúscula';
                    }

                    if (!preg_match('@[0-9]@', $pass)) {
                        $txt[] = 'Debe de contener al menos un número';
                    }

                    if (!preg_match('@[^\w]@', $pass)) {
                        $txt[] = 'Debe de contener al menos un caracter especial';
                    }

                    if($txt){
                        return implode(' | ', $txt);
                    }

                    return true;
                },
                'message' => 'La contraseña no puede estar vacía'
            ])
            ->allowEmptyString('password');

        $validator
            ->sameAs('confirm_password', 'password', 'La contraseña no coincide, intente nuevamente')
            ->allowEmptyString('confirm_password');

        $validator
            ->scalar('fullname')
            ->maxLength('fullname', 255)
            ->requirePresence('fullname', 'create')
            ->add('fullname', 'custom', [
                'rule' => function($name, $ctx){
                    $txt = [];

                    if(!$name){
                        return 'El nombre no puede estar vacía';
                    }

                    if(count(explode(' ',$name)) < 2){
                        $txt[] = 'Asegúrese de al menos escribir un nombre y un apellido';
                    }

                    if($txt){
                        return implode(' | ', $txt);
                    }

                    return true;
                }
            ]);

        $validator
            ->boolean('active')
            ->allowEmptyString('active');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username'], 'El nombre de usuario no está disponible, intente con otro'));
        $rules->add($rules->existsIn(['role_id'], 'Roles'));

        return $rules;
    }

    public function findAuth(Query $query, array $options)
    {
        $query
            ->select(['id', 'username', 'role_id', 'password'])
            ->where(['Users.active' => 1]);

        return $query;
    }

    public function isOwnedBy($userIdEdit, $userId)
    {
        return $this->exists(['id' => $userIdEdit, 'id' => $userId]);
    }

    public function searchDataUser($term){

        if($term){
            if(preg_match('/^activ|^desact/', $term)){
                $term = preg_match('/^activ/', $term) ? '1':'0';
                $where = ['active' => $term];
            }else{
                $where['OR'] = [
                    'username LIKE "%'.$term.'%"',
                    'fullname LIKE "%'.$term.'%"',
                    'Roles.name LIKE "%'.$term.'%"',
                ];
            } 

            $query = $this->find()->where($where)->contain(['Roles'])->select(['id', 'username', 'Roles.name', 'fullname', 'active']);
        }else{
            $query = $this;
        }
        

        return $query;
    }
}
