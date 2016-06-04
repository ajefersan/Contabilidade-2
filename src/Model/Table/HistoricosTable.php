<?php
namespace App\Model\Table;

use App\Model\Entity\Historico;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Historicos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Movimentacoes
 */
class HistoricosTable extends Table
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

        $this->table('historicos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'users_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Movimentacoes', [
            'foreignKey' => 'historico_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('codigo', 'create')
            ->notEmpty('codigo')
            ->add('codigo', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('nome', 'create')
            ->notEmpty('nome');

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
        $rules->add($rules->isUnique(['codigo']));
        $rules->add($rules->existsIn(['users_id'], 'Users'));
        return $rules;
    }

    public function isOwnedBy($historicoId, $userId)
    {
        return $this->exists(['id' => $historicoId, 'users_id' => $userId]);
    }

    public function findUserHistoricos(Query $query, array $options)
    {
        $user_id = $options['user_id'];
        return $query->where(['users_id' => $user_id]);
    }

    public function getHistoricosFormatados($user_id)
    {
        return $this->find('list', [
            'conditions' => ['Historicos.users_id' => $user_id],
            'keyField' => 'id',
            'valueField' => function($e){
                return $e->get('codigo') . ' - ' . $e->get('nome');
            }
        ]);
    }
}
