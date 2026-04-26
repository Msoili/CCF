<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AlterArticlesAddFkUsers extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function up(): void
    {
        $table = $this->table('articles');
        $table->addColumn('user_id', 'integer', [            
            'null' => false,
            'default' => 1
        ]);
        $table->update();
        
        $this->execute(
           'UPDATE articles SET user_id = (SELECT id from users LIMIT 1)');
    
        $table2 = $this->table('articles');
        $table2->addForeignKey('user_id', 'users', 'id');
        $table2->update();
        
    }
    
    public function down(): void
    {
        $table = $this->table('articles');
        $table->dropForeignKey('user_id');
        $table->removeColumn('user_id');
        $table->update();
    }
    
}
