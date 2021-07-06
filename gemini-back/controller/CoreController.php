<?php


class CoreController
{
    function __construct(){
        echo "CoreController created";

    }

    function load_view($view, $args){
        foreach ($args as $vname => $vvalue) {

            $$vname = $vvalue;
        }
        require_once(__DIR__.'/../view/'.$view.'.php');

    }
}
