<?php

namespace ConsoleAppli\Controller;

use Zend\Mvc\Controller\AbstractConsoleController;
use ConsoleAppli\Services\CRUDFileService;
use Zend\Stdlib\Exception\InvalidArgumentException;

class IndexController extends AbstractConsoleController {

    protected $CRUDFileService;

    public function __construct(CRUDFileService $CrudFileService)
    {
        $this->setService($CrudFileService);
    }

    public function setService($service)
    {
        if(!($service instanceof CRUDFileService))
        {
            throw new InvalidArgumentException('Bad service given');
        }
        else {$this->CRUDFileService = $service;}
    }


    public function redirectionAction()
    {

        $request = $this->getRequest();
        $what = $request->getParam('what');
        $file = $request->getParam('file');
        //var_dump($this->getEvent());
        $this->CRUDFileService->{$what}($file);

    }
} 