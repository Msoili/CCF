<?php

declare(strict_types=1);

use Migrations\BaseMigration;

class InsertArticles extends BaseMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function up(): void {
        $articles = $this->table('articles');
        $rows = [
            ['title' => 'titre1', 'content' => 'sfdsf'
                . 'dfsdfsd'
                . 'sdfsffs', 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['title' => 'titre2', 'content' => 'content2', 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['title' => 'titre3', 'content' => 'content3', 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['title' => 'titre4', 'content' => 'content4', 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['title' => 'titre5', 'content' => 'content5', 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')]
        ];
        $articles->insert($rows)->saveData();
    }

    public function down(): void {
        $this->execute('DELETE from articles');
    }
}
