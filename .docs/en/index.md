# Quick start

The purpose of this extension is to provide unified interface for data exchange consumers and create data exchange publishers proxy.

## Installation

The best way to install **fastybird/application-exchange** is using [Composer](http://getcomposer.org/):

```sh
composer require fastybird/application-exchange
```

After that you have to register extension in *config.neon*.

```neon
extensions:
    fbApplicationExchange: FastyBird\ApplicationExchange\DI\ApplicationExchangeExtension
```

This extension is dependent on other extensions, and they have to be registered too

```neon
extensions:
    ....
    contributeEvents: Contributte\EventDispatcher\DI\EventDispatcherExtension
```

> For information how to configure these extensions please visit their doc pages

## Creating custom publisher

If some service of your application have to publish messages to data exchange, you could just implement `FastyBird\ApplicationExchange\Publisher\IPublisher` interface and register your publisher as service

```php
namespace Your\CoolApp\Publishers;

use FastyBird\ApplicationExchange\Publisher\IPublisher;

class ArticlesPublisher implements IPublisher
{

    public function publish(
        string $origin,
        string $routingKey,
        array $data
    ) : void {
        // Publisher logic here, eg. publish message to RabbitMQ or Redis etc. 
    }

}
```

You could create as many publishers as you need. Publisher proxy then will collect all of them. 

## Publishing message

In your code you could just import one publisher - proxy publisher.

```php
namespace Your\CoolApp\Actions;

use FastyBird\ApplicationExchange\Publisher\IPublisher;

class SomeHandler
{

    /** @var IPublisher */
    private IPublisher $publisher;

    public function __construct(
        IPublisher $publisher
    ) {
        $this->publisher = $publisher;
    }

    public function updateSomething()
    {
        // Your interesting logic here...
        
        $this->publisher->publish(
            'application-domain-as-origin',
            'routing-key',
            [
                'key' => 'value',
            ]
        );
    }
}
```

And that is it, global publisher will call all your publishers and publish message to all your systems.

## Custom message consumer

One part is done, message is published. Now have to be consumed. Message consuming process is in your hand, but this extension have prepared an interface for your consumers.

Your consumer could look like this:

```php
namespace Your\CoolApp\Publishers;

use FastyBird\ApplicationExchange\Consumer\IConsumer;
use Nette\Utils\ArrayHash;

class DataConsumer implements IConsumer
{

    public function consume(
        string $origin,
        string $routingKey,
        ArrayHash $data
    ) : void {
        // Do you data processing logic here 
    }

}
```

## Events

Publisher proxy will fire `FastyBird\ApplicationExchange\Events\MessagePublishedEvent` after all publishers are called. Content of this event contain message *origin*, *routing key* and published *data*.

There is also prepared event for consuming message. In your consumer you could fire `FastyBird\ApplicationExchange\Events\MessageConsumedEvent`

```php
namespace Your\CoolApp\Publishers;

use FastyBird\ApplicationExchange\Events;
use FastyBird\ApplicationExchange\Consumer\IConsumer;
use Nette\Utils\ArrayHash;
use Symfony\Contracts\EventDispatcher;

class DataConsumer implements IConsumer
{

    /** @var EventDispatcher\EventDispatcherInterface */
    private EventDispatcher\EventDispatcherInterface $dispatcher;

    public function consume(
        string $origin,
        string $routingKey,
        ArrayHash $data
    ) : void {
        // Do you data processing logic here

        // Fire event to let other services know, that something was received
        $this->dispatcher->dispatch(new Events\MessageConsumedEvent($origin, $routingKey, $data)); 
    }

}
```

***
Homepage [https://www.fastybird.com](https://www.fastybird.com) and repository [https://github.com/FastyBird/application-exchange](https://github.com/FastyBird/application-exchange).
