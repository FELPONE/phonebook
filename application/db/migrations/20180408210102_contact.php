<?php


use Phinx\Migration\AbstractMigration;

class Contact extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $contact = $this->table('contact');
        $contact
            ->addColumn('name', 'string', ['limit' => 20])
            ->addColumn('last_name', 'string', ['limit' => 20])
            ->addColumn('phone_number', 'string', ['limit' => 20])
            ->addColumn('note', 'string', ['limit' => 255,'null' => true])
            ->addColumn('user_id', 'integer', ['null' => false])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime', ['null' => true])
            ->addIndex(['user_id'])
            ->addForeignKey('user_id', 'user', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->create();
    }
}
