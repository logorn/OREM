<?php

namespace test\unit\Rizeway\OREM\Config;

use Guzzle\Common\Event;
use Guzzle\Http\Message\Response;
use Rizeway\OREM\Config\Factory as TestedClass;
use atoum;

class Factory extends atoum\test
{
    protected $directory;

    public function beforeTestMethod($method)
    {
        $this->directory = '/tmp/'.uniqid();
        mkdir($this->directory);
    }
    public function testAll()
    {
        $this
            ->if($connection = new \mock\Rizeway\OREM\Connection\ConnectionInterface())
            ->and($object = new TestedClass($this->directory, 'http://toto'))
            ->then
                ->object($object)->isInstanceOf('Rizeway\\OREM\\Config\\Factory')
                ->object($connection = $object->getConnection())->isInstanceOf('Rizeway\\OREM\\Connection\\ConnectionInterface')
                ->array($object->getEntityMappings())->isEqualTo(array())
                ->object($object->getManager())->isInstanceOf('Rizeway\\OREM\\Manager')
                ->exception(function() use($connection) {
                    $connection->getClient()->getEventDispatcher()->dispatch('request.error', new Event(array('response' => new Response(404))));
                })->hasMessage("HTTP/1.1 404 Not Found\r\n\r\n")
        ;
    }

    public function afterTestMethod($method)
    {
        rmdir($this->directory);
    }
}
