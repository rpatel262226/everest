<?php
use yii\db\Schema;
use yii\db\Migration;



/**
 * Class m240605_181043_add_jobs_table
 */
class m240605_181043_add_jobs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("jobs", [
            "id" => Schema::TYPE_PK,
            "name" => Schema::TYPE_STRING,
            "applied_position" => Schema::TYPE_STRING,
            "email" => Schema::TYPE_STRING,
            "phone_number" => Schema::TYPE_STRING,
            "gender" => Schema::TYPE_STRING,
            "uploadResume" => Schema::TYPE_TEXT,
            "profile_img" => Schema::TYPE_TEXT,
            "coverLetter" => Schema::TYPE_TEXT,
            "address" => Schema::TYPE_TEXT,
            "cc_name" => Schema::TYPE_STRING,
            "cc_ctc" => Schema::TYPE_INTEGER,
            "cc_total_exp" => Schema::TYPE_INTEGER,
            "cc_notice_period" => Schema::TYPE_INTEGER,
            "total_exp" => Schema::TYPE_INTEGER,
            "skill" => Schema::TYPE_TEXT,
            "created_at" => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT NULL',
            "updated_at" =>  Schema::TYPE_TIMESTAMP . ' NOT NULL DEFAULT CURRENT_TIMESTAMP'
         ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('jobs');         
        // echo "m240605_181043_add_jobs_table cannot be reverted.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240605_181043_add_jobs_table cannot be reverted.\n";
         $this->dropTable('jobs');

        return false;
    }
    */
}
