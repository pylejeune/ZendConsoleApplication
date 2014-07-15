<?php

namespace ConsoleAppli\Factories;

use ConsoleAppli\Services\CRUDFileService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class CRUDFileServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $sm)
    {
        $console = $sm->get('console');
        $CRUDFileService = new CRUDFileService($console);
        return $CRUDFileService;
    }
} 