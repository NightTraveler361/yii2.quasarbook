<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 * Has foreign keys to the tables:
 *
 * - `languages`
 * - `authors`
 */
class m180312_153737_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'language_id' => $this->integer(),
            'author_id' => $this->integer(),
            'date' => $this->date(),
            'title' => $this->string(),
            'text' => $this->text(),
            'likes' => $this->integer(),
        ]);

        // creates index for column `language_id`
        $this->createIndex(
            'idx-posts-language_id',
            'posts',
            'language_id'
        );

        // add foreign key for table `languages`
        $this->addForeignKey(
            'fk-posts-language_id',
            'posts',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );

        // creates index for column `author_id`
        $this->createIndex(
            'idx-posts-author_id',
            'posts',
            'author_id'
        );

        // add foreign key for table `authors`
        $this->addForeignKey(
            'fk-posts-author_id',
            'posts',
            'author_id',
            'authors',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `languages`
        $this->dropForeignKey(
            'fk-posts-language_id',
            'posts'
        );

        // drops index for column `language_id`
        $this->dropIndex(
            'idx-posts-language_id',
            'posts'
        );

        // drops foreign key for table `authors`
        $this->dropForeignKey(
            'fk-posts-author_id',
            'posts'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-posts-author_id',
            'posts'
        );

        $this->dropTable('posts');
    }
}
