<?php

namespace ivanmijatovic89\ProtoViewGenerator;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class HelloCommand extends Command
{

    protected $name = 'hello';
    protected $description = 'This is my custom hello command';

    public function __construct()
    {
        parent::__construct();
    }

    public function fire()
    {
        

        //$this->info("view");

       

     


    }

   


}
