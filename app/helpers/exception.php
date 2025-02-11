<?php

function formatException(Exception $e) 
{
    var_dump("Erro no arquivo {$e->getFile()} na linha {$e->getLine()}: {$e->getMessage()}");    
}