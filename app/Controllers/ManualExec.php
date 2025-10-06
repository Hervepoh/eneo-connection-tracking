<?php

namespace App\Controllers;

class ManualExec extends BaseController
{
    public function index()
    {
       $task =  new Tasks();
       $task->index();
       $task->attachment();
       $task->open();
       return 'end execution'; 
    }
}
