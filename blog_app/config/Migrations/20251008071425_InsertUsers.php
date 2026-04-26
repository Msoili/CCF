<?php

declare(strict_types=1);

use Migrations\BaseMigration;

class InsertUsers extends BaseMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function up(): void {
        $users = $this->table('users');
        $rows = [
            ['name' => 'name1', 'username' => 'username1', 'lastname' => 'lastname1', 'age' => 12, 'password' => 'password1', 'email' => 'name@gmail.com', 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['name' => 'name2', 'username' => 'username2', 'lastname' => 'lastname2', 'age' => 13, 'password' => 'password2', 'email' => 'name@gmail.com', 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['name' => 'name3', 'username' => 'username3', 'lastname' => 'lastname3', 'age' => 14, 'password' => 'password3', 'email' => 'name@gmail.com', 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['name' => 'name4', 'username' => 'username4', 'lastname' => 'lastname4', 'age' => 15, 'password' => 'password4', 'email' => 'name@gmail.com', 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
            ['name' => 'name5', 'username' => 'username5', 'lastname' => 'lastname5', 'age' => 16, 'password' => 'password5', 'email' => 'name@gmail.com', 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s')],
        ];
        $users->insert($rows)->saveData();
    }

    public function down(): void {
        $this->execute('DELETE from users');
    }
}
