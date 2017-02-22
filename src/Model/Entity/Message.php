<?php
namespace CakeMojo\Messages\Model\Entity;

use Cake\ORM\Entity;

/**
 * Message Entity
 *
 * @property string $id
 * @property string $model
 * @property string $foreign_key
 * @property string $subject
 * @property string $body
 * @property \Cake\I18n\Time $read_date
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Message extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
