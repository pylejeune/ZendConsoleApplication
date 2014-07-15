<?php

namespace ConsoleAppli\Services;

use Zend\Console\Adapter\AdapterInterface as Console;

class CRUDFileService {

    protected $console;

    public function __construct(Console $console)
    {
        $this->console = $console;
    }

    public function rm($filepath)
    {
        if(file_exists($filepath)) //AND fileperms($this->filepath) == 777)
        {
            unlink($filepath);
        }
        else{throw new Exception("File doesn't exist");}

    }

    public function cat($filepath)
    {
        if(file_exists($filepath)){

            if(is_readable($filepath)){
                $display = file_get_contents($filepath);
                $this->console->write(" ---> \n $display \n <---\n");
            }
            else{throw new Exception("File isn't readable");}

        }
        else{throw new Exception("File doesn't exist");}

    }


   public function touch($filepath)
   {
       $bool = touch($filepath);
       if($bool === FALSE){
           throw new Exception("File cannot be created");
       }

   }

} 