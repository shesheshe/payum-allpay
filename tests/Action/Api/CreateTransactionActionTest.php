<?php

use Mockery as m;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\Reply\HttpResponse;
use PayumTW\Allpay\Action\Api\CreateTransactionAction;
use PayumTW\Allpay\Api;
use PayumTW\Allpay\Request\Api\CreateTransaction;

class CreateTransactionActionTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function test_get_transaction_data()
    {
        /*
        |------------------------------------------------------------
        | Set
        |------------------------------------------------------------
        */

        $api = m::mock(Api::class);
        $request = m::mock(CreateTransaction::class);
        $details = new ArrayObject();

        /*
        |------------------------------------------------------------
        | Expectation
        |------------------------------------------------------------
        */

        $request->shouldReceive('getModel')->twice()->andReturn($details);

        $api
            ->shouldReceive('getApiEndpoint')->once()->andReturn('fooApiEndpoint')
            ->shouldReceive('createTransaction')->once()->andReturn([
                'foo' => 'bar',
            ]);

        /*
        |------------------------------------------------------------
        | Assertion
        |------------------------------------------------------------
        */

        $action = new CreateTransactionAction();
        $action->setApi($api);
        try {
            $action->execute($request);
        } catch (HttpResponse $response) {
            $this->assertSame('fooApiEndpoint', $response->getUrl());
            $this->assertSame([
                'foo' => 'bar',
            ], $response->getFields());
        }
    }
}
