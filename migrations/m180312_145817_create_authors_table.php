<?php

use yii\db\Migration;

/**
 * Handles the creation of table `authors`.
 */
class m180312_145817_create_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('authors', [
            'id' => $this->primaryKey(),
            'author' => $this->string(),
        ]);
        
        $this->batchInsert('authors', ['author'], [
            ['CrazyNews'],
            ['Чук и Гек'],
            ['CatFuns'],
            ['CarDriver'],
            ['BestPics'],
            ['ЗОЖ'],
            ['Вася Пупкин'],
            ['Готовим со вкусом'],
            ['Шахтёрская Правда'],
            ['FunScience']
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('authors');
    }
}
