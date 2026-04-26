<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class CreateArticlesTags extends BaseMigration
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
        $this->execute(
            'CREATE TABLE articles_tags (
                article_id INT NOT NULL,
                tag_id INT NOT NULL,
                priority INT NOT NULL CHECK (priority BETWEEN 1 AND 5),
                PRIMARY KEY (article_id, tag_id),
                FOREIGN KEY (tag_id) REFERENCES tags(id),
                FOREIGN KEY (article_id) REFERENCES articles(id)
            );'
        );
    }
    
    public function down(): void
    {
        $this->execute(
            'DROP table articles_tags;'
        );
    }
}
