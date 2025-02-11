<?php

namespace app\models\activerecord;

use app\interfaces\ActiveRecordInterface;
use app\interfaces\ActiveRecordExecuteInterface;
use app\models\connection\Connection;

use Exception;
use Throwable;

class FindAll implements ActiveRecordExecuteInterface
{
    private $where;
    private $limit;
    private $offset;
    private $fields;

    public function __construct($where = [], $limit = "", $offset = "", $fields = '*') {
        $this->where = $where;
        $this->limit = $limit;
        $this->offset = $offset;
        $this->fields = $fields;
    }

    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        try {
            $query = $this->createQuery($activeRecordInterface);

            $connection = Connection::connect();
            $prepare = $connection->prepare($query);
            $prepare->execute($this->where);
            return $prepare->fetchAll();                    
            
        } catch (Throwable $th) {
            formatException($th);
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        if(count($this->where) > 1){
            throw new Exception('WHERE deve conter apenas um elemento');
        }

        $where = array_keys($this->where);

        $sql = "SELECT {$this->fields} FROM {$activeRecordInterface->getTable()}";
        $sql .= (!$this->where) ? '' : " WHERE {$where[0]} = :{$where[0]}";
        $sql .= (!$this->limit) ? '' : " LIMIT {$this->limit}";
        $sql .= ($this->offset != '') ? " OFFSET {$this->offset}" : '';
        return $sql;     
    }
}