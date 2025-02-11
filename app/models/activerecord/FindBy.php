<?php

namespace app\models\activerecord;

use app\models\connection\Connection;
use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordExecuteInterface;

use Throwable;

class FindBy implements ActiveRecordExecuteInterface
{
    private $field;
    private $value;
    private $fields;

    public function __construct($field, $value, $fields = '*') {
        $this->field = $field;
        $this->value = $value;
        $this->fields = $fields;
    }

    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        try {
            $query = $this->createQuery($activeRecordInterface);
            $connection = Connection::connect();
            $prepare = $connection->prepare($query);
            $prepare->execute([
                $this->field => $this->value
            ]);
            return $prepare->fetch();         
        } catch (Throwable $th) {
            formatException($th);
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        $sql = "SELECT {$this->fields} FROM {$activeRecordInterface->getTable()}";
        $sql .= " WHERE {$this->field} = :{$this->field}";
        return $sql;     
    }
}