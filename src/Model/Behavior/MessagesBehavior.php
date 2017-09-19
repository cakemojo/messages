<?php
namespace CakeMojo\Messages\Model\Behavior;

use Cake\Datasource\RepositoryInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * MessagesBehavior behavior
 */
class MessagesBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [

    ];

    public function addMessage($id, array $data){
        $messagesTable = TableRegistry::get('CakeMojo/Messages.Messages');

        $message = $messagesTable->newEntity();

        $message->id = $id;
        $message->subject = $data['subject'];
        $message->body = $data['body'];
        $message->model = empty($data['model']) ? $data['model'] = $messagesTable->getTable() : $data['model'];

        return $messagesTable->save($message);

    }
}
