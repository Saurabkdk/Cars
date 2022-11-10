<?php

namespace classes;

class DatabaseController
{
    private $dbConnection;
    private $tableName;
    private $tablePrimaryKey;
    private $entityClass;
    private $entityConstructorTable;

    public function __construct($dbConnection, $tableName, $tablePrimaryKey, $entityClass = "stdClass", $entityConstructorTable = []){
        $this->dbConnection = $dbConnection;
        $this->tableName = $tableName;
        $this->tablePrimaryKey = $tablePrimaryKey;
        $this->entityClass = $entityClass;
        $this->entityConstructorTable = $entityConstructorTable;
    }

    public function getAll(){
        $getALl = $this->dbConnection->prepare('SELECT * FROM ' . $this->tableName);
        $getALl->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructorTable);
        $getALl->execute();
        return $getALl->fetchAll();
    }

    public function getOne($attribute, $attributeValue){
        $getOne = $this->dbConnection->prepare('SELECT * FROM ' . $this->tableName . ' WHERE ' . $attribute . ' = :value');
        $getOne->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructorTable);
        $getOneValue = [
            'value' => $attributeValue
        ];
        $getOne->execute($getOneValue);
        return $getOne->fetchAll();
    }

    public function getOneArr($attribute, $attributeValue){
        $getOne = $this->dbConnection->prepare('SELECT * FROM ' . $this->tableName . ' WHERE ' . $attribute . ' = :value');
        $getOneValue = [
            'value' => $attributeValue
        ];
        $getOne->execute($getOneValue);
        return $getOne->fetchAll();
    }

    public function addData($data){
        $dataKeys = array_keys($data);
        $attribute = implode(', ', $dataKeys);
        $attributeValues = implode(', :', $dataKeys);
        $addData = $this->dbConnection->prepare('INSERT INTO ' . $this->tableName . ' (' . $attribute . ') VALUES (:' . $attributeValues . ')');
        $addData->execute($data);
    }

    public function updateData($data){
        $updateQuery = 'UPDATE ' . $this->tableName . ' SET ';
        $queryParams = [];
        foreach ($data as $dataKey=>$datum){
            $queryParams[] = $dataKey . '= :' . $dataKey;
        }
        $updateQuery .= implode(', ', $queryParams);
        $updateQuery .= ' WHERE ' . $this->tablePrimaryKey . ' = :tablePrimaryKey';
        $data['tablePrimaryKey'] = $data[$this->tablePrimaryKey];
        $updateData = $this->dbConnection->prepare($updateQuery);
        $updateData->execute($data);
    }

    public function saveData($data){
        try {
            $this->addData($data);
        }
        catch (\Exception $exception){
            $this->updateData($data);
        }
    }

    public function deleteData($attributeValue){
        $deleteData = $this->dbConnection->prepare('DELETE FROM ' . $this->tableName . ' WHERE ' . $this->tablePrimaryKey . '= :value');
        $deleteDataValue = [
            'value' => $attributeValue
        ];
        $deleteData->execute($deleteDataValue);
    }

    public function findLastId(){
//        return $this->dbConnection->lastInsertId();

        $lastId = $this->dbConnection->prepare('SELECT ' . $this->tablePrimaryKey . ' FROM ' . $this->tableName .' ORDER BY ' . $this->tablePrimaryKey . ' DESC LIMIT 1');
        $lastId->execute();

        return $lastId->fetch();
    }

}