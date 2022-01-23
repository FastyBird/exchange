# Quick start

The purpose of this plugin is to provide unified interface for data exchange consumers and create data exchange
publishers proxy.

## Installation

The best way to install **fastybird/exchange** is using [Composer](http://getcomposer.org/):

```sh
composer require fastybird/exchange
```

After that, you have to register extension in *config.neon*.

```neon
extensions:
    fbExchange: FastyBird\Exchange\DI\ExchangeExtension
```

## Creating custom publisher

If some service of your module have to publish messages to data exchange for other modules, you could just
implement `FastyBird\Exchange\Publisher\IPublisher` interface and register your publisher as service

```php
namespace Your\CoolApp\Publishers;

use FastyBird\Exchange\Publisher\IPublisher;
use FastyBird\Metadata\Types;
use Nette\Utils;

class ModuleDataPublisher implements IPublisher
{

    public function publish(
        $origin,
        Types\RoutingKeyType $routingKey,
        ?Utils\ArrayHash $data
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

use FastyBird\Exchange\Publisher\IPublisher;
use Nette\Utils;

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
            $origin,
            $routingKey,
            Utils\ArrayHash::from([
                'key' => 'value',
            ])
        );
    }
}
```

And that is it, global publisher will call all your publishers and publish message to all your systems.

## Custom message consumer

One part is done, message is published. Now have to be consumed. Message consuming process is in your hand, but this
extension have prepared an interface for your consumers.

Your consumer could look like this:

```php
namespace Your\CoolApp\Publishers;

use FastyBird\Exchange\Consumer\IConsumer;
use FastyBird\Metadata\Types;
use Nette\Utils;

class DataConsumer implements IConsumer
{

    public function consume(
		$origin,
		Types\RoutingKeyType $routingKey,
		?Utils\ArrayHash $data
    ) : void {
        // Do you data processing logic here 
    }

}
```

***
Homepage [https://www.fastybird.com](https://www.fastybird.com) and
repository [https://github.com/FastyBird/exchange](https://github.com/FastyBird/exchange).
