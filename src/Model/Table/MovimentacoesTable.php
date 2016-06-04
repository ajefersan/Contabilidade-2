<?php
namespace App\Model\Table;

use App\Model\Entity\Movimentaco;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Movimentacoes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Contas
 * @property \Cake\ORM\Association\BelongsTo $Historicos
 */
class MovimentacoesTable extends Table
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

        $this->table('movimentacoes');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Contas', [
            'foreignKey' => 'conta_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Historicos', [
            'foreignKey' => 'historico_id',
            'joinType' => 'INNER'
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
            ->numeric('valor')
            ->requirePresence('valor', 'create')
            ->notEmpty('valor');

        $validator
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            ->dateTime('data')
            ->requirePresence('data', 'create')
            ->notEmpty('data');

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
        $rules->add($rules->existsIn(['conta_id'], 'Contas'));
        $rules->add($rules->existsIn(['historico_id'], 'Historicos'));
        return $rules;
    }

    public function isOwnedBy($movimentacoes_id, $userId)
    {
        $movimentacao = $this->findById($movimentacoes_id)->first();

        return $this->Contas->exists(['id' => $movimentacao->conta_id, 'users_id' => $userId]);
    }

    public function findUserMovimentacoes(Query $query, array $options)
    {
        $user_id = $options['user_id'];

        return $query->where(['Contas.users_id' => $user_id]);
    }
}
