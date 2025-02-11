<?php

namespace app\models\activerecord;

use app\models\connection\Connection;
use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordExecuteInterface;
use Throwable;

class Update implements ActiveRecordExecuteInterface
{
    private $field;
    private $value;

    public function __construct($field, $value) {
        $this->field = $field;
        $this->value = $value;
    }

    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        try {
            $query = $this->createQuery($activeRecordInterface);
            $connection = Connection::connect();

            $attributes = array_merge($activeRecordInterface->getAttributes(), [
                $this->field => $this->value
            ]);
            $prepare = $connection->prepare($query);
            $prepare->execute($attributes);
            return $prepare->rowCount();          
        } catch (Throwable $th) {
            formatException($th);
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        $sql = "UPDATE {$activeRecordInterface->getTable()} SET ";
        foreach ($activeRecordInterface->getAttributes() as $key => $value) {
            if($key !== "id"){
                $sql .= "{$key}=:{$key},";
            }
        }
        $sql = rtrim($sql,",");
        $sql .= " WHERE {$this->field}=:{$this->field} ";   
        return $sql;     
    }
}