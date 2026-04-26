<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HistoSuppArticles Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\HistoSuppArticle newEmptyEntity()
 * @method \App\Model\Entity\HistoSuppArticle newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\HistoSuppArticle> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HistoSuppArticle get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\HistoSuppArticle findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\HistoSuppArticle patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\HistoSuppArticle> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\HistoSuppArticle|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\HistoSuppArticle saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\HistoSuppArticle>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\HistoSuppArticle>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\HistoSuppArticle>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\HistoSuppArticle> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\HistoSuppArticle>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\HistoSuppArticle>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\HistoSuppArticle>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\HistoSuppArticle> deleteManyOrFail(iterable $entities, array $options = [])
 */
class HistoSuppArticlesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('histo_supp_articles');
        $this->setDisplayField('titleart');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('idart')
            ->requirePresence('idart', 'create')
            ->notEmptyString('idart');

        $validator
            ->scalar('titleart')
            ->maxLength('titleart', 255)
            ->requirePresence('titleart', 'create')
            ->notEmptyString('titleart');

        $validator
            ->date('datesupp')
            ->requirePresence('datesupp', 'create')
            ->notEmptyDate('datesupp');

        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
