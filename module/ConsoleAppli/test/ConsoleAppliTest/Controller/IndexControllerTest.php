<?php

namespace ConsoleAppliTest\Controller;

use test\Bootstrap;
use Zend\Mvc\Router\Console\SimpleRouteStack as ConsoleRouter;
use ConsoleAppli\Controller\IndexController;
use Zend\Console\Request;
use Zend\Console\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Console\RouteMatch;
use PHPUnit_Framework_TestCase;

class IndexControllerTest extends PHPUnit_Framework_TestCase {

    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function mySetUp($funcName)
    {
        $serviceManager = Bootstrap::getServiceManager();
        $CRUDFileService = $this->getMockedServiceFunction($funcName);
        $this->controller = new IndexController($CRUDFileService);
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'ConsoleAppli\Controller\IndexController'));
        $this->event      = new MvcEvent();
        $config = $serviceManager->get('Config');
        $configConsole = $config['console'];
        $routerConfig = isset($configConsole['router']) ? $configConsole['router'] : array();
        $options = $routerConfig['routes']['crud']['options'];
        $router = ConsoleRouter::factory($options);
        //    var_dump($router);
        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        //var_dump($this->event);
        $this->controller->setEvent($this->event);
        var_dump($this->controller->getEvent());
        $this->controller->setServiceLocator($serviceManager);
        // var_dump($this->controller);
    }

    private function getMockedServiceFunction($name){ //, $argument) {
        $CRUDFileService = $this->getMockBuilder('ConsoleAppli\Services\CRUDFileService')
                                ->disableOriginalConstructor()
                                ->getMock();
        $CRUDFileService->expects($this->once())
                        ->method($name);
//                        ->with($argument);
        return $CRUDFileService;
    }

//    public function testCatService()
//    {
//        $this->mySetUp('cat');
//    }

    public function testIndexActionCanBeAccessed()
    {
        $this->mySetUp('cat');
        $this->routeMatch->setParam('action', 'redirection');
        $result   = $this->controller->dispatch($this->request);
        $response = $this->controller->getErrorLevel();
        $this->assertEquals(0, $response);

    }
} 