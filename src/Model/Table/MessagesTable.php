<?php
namespace CakeMojo\Messages\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Messages Model
 *
 * @method \App\Model\Entity\CmMessage get($primaryKey, $options = [])
 * @method \App\Model\Entity\CmMessage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CmMessage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CmMessage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CmMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CmMessage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CmMessage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MessagesTable extends Table
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

        $this->setTable('cm_messages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('model', 'create')
            ->notEmpty('model');

        $validator
            ->requirePresence('foreign_key', 'create')
            ->notEmpty('foreign_key');

        $validator
            ->requirePresence('subject', 'create')
            ->notEmpty('subject');

        $validator
            ->allowEmpty('body');

        $validator
            ->dateTime('read_date')
            ->allowEmpty('read_date');

        return $validator;
    }

    /**
     * {@inheritDoc}
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add(
            function ($entity, $options) {
                $foreignRecordData = $entity->extract(['model', 'foreign_key']);
                if (count($foreignRecordData) < 2) {
                    return false;
                }

                return TableRegistry::get($entity->model)->exists(['id' => $entity->foreign_key]);
            },
            'existForeignRecord',
            [
                'errorField' => 'foreign_key',
                'message' => __('Foreign record not found'),
            ]
        );

        return $rules;
    }
}
