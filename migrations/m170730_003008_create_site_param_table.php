<?php

use yii\db\Migration;

/**
 * Handles the creation of table `site_param`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 */
class m170730_003008_create_site_param_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('site_param', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
            'active' => $this->smallInteger(1),
            'type' => $this->integer(),
            'sort_order' => $this->integer(),
            'create_time' => $this->integer()->notNull(),
            'update_time' => $this->integer(),
            'creator_id' => $this->integer()->notNull(),
            'updater_id' => $this->integer(),
        ], $tableOptions);

        // creates index for column `creator_id`
        $this->createIndex(
            'idx-site_param-creator_id',
            'site_param',
            'creator_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-site_param-creator_id',
            'site_param',
            'creator_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `updater_id`
        $this->createIndex(
            'idx-site_param-updater_id',
            'site_param',
            'updater_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-site_param-updater_id',
            'site_param',
            'updater_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-site_param-creator_id',
            'site_param'
        );

        // drops index for column `creator_id`
        $this->dropIndex(
            'idx-site_param-creator_id',
            'site_param'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-site_param-updater_id',
            'site_param'
        );

        // drops index for column `updater_id`
        $this->dropIndex(
            'idx-site_param-updater_id',
            'site_param'
        );

        $this->dropTable('site_param');
    }
}
