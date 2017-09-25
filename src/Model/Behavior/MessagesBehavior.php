<?php
namespace CakeMojo\Messages\Model\Behavior;

use Cake\Error\ErrorHandler;
use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Core\Exception\Exception;
use Psy\Exception\ErrorException;

/**
 * MessagesBehavior behavior
 */
class MessagesBehavior extends Behavior
{


    protected $_defaultConfig = [
        'table' => 'CakeMojo/Messages.Messages'
    ];

    /**
     * Default configuration.
     * @var $id, I would change this to $foreignKey instead
     * @var array $data, would be better to allow passing entities too
     * -subject
     * -body
     * -model you can to assign table name or get automatically from model
     * @var array
     * @return void
     */
    public function addMessage($id, array $data)
    {
        $config = Hash::merge($this->getConfig(), $data);

        $messagesTable = TableRegistry::get($config['table']);

        $message = $messagesTable->newEntity();

        $message->foreign_key = $id;
        $message->subject = Hash::get($data, 'subject');
        $message->body = Hash::get($data, 'body');

        $message->model = Hash::get($data, 'model', $this->_table->getTable());

        return $messagesTable->save($message);
    }
}
