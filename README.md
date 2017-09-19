# CakeMojo/Messages plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require CakeMojo/Messages
```

First add the plugin in you bootstrap file

```
config/bootstrap.php

Plugin::load('CakeMojo/Messages');
```

Later you can load the behavior in your model

```
src/Model/Table/ANY-TABLE.php

$this->addBehavior('CakeMojo/Messages.Messages');
```

###Example

* Use the behavior in your afterSave function

```
public function afterSave(Event $event, EntityInterface $entity, $options)
    {
        return $this->addMessage($entity->id, [
            'subject' => 'This is the subject',
            'body' => 'This is the body' .
                $entity->first_name . ' ' . $entity->last_name .
                ' the message has been sended to ' . $entity->email
        ]);

    }

```