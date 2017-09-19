<?php
namespace CakeMojo\Messages\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;

/**
 * MessagesBehavior behavior
 */
class MessagesBehavior extends Behavior
{

    /**
     * Default configuration.
     * @var id //of the table for pass like foreign key
     * @array data
     * -subject
     * -body
     * -model //you can to assign table name or get automatically from model
     * @var array
     */
    protected $_defaultConfig = [
        'subject' => 'Message subject',
        'body' => 'This is the body'
    ];

    public function addMessage($id, array $data){
        $config = $this->_defaultConfig;
        Hash::merge($config, $data);

        $messagesTable = TableRegistry::get('CakeMojo/Messages.Messages');

        $message = $messagesTable->newEntity();

        $message->foreign_key = $id;
        $message->subject = $data['subject'];
        $message->body = $data['body'];
        $message->model = empty($data['model']) ? $data['model'] = $this->_table->getTable() : $data['model'];

        return $messagesTable->save($message);

    }
}
