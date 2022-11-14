<?php

//namespace for the class
namespace classes;

//class for database controller
class DatabaseController
{
    //initializing private variables needed
    private $dbConnection;
    private $tableName;
    private $tablePrimaryKey;
    private $entityClass;
    private $entityConstructorTable;

    //creating a constructor of the class
    public function __construct($dbConnection, $tableName, $tablePrimaryKey, $entityClass = "stdClass", $entityConstructorTable = []){
        //assigning values to the respective class variables
        $this->dbConnection = $dbConnection;
        $this->tableName = $tableName;
        $this->tablePrimaryKey = $tablePrimaryKey;
        $this->entityClass = $entityClass;
        $this->entityConstructorTable = $entityConstructorTable;
    }

    //function to get all the records from the table
    public function getAll(){
        //preparing the sql query to be executed
        $getALl = $this->dbConnection->prepare('SELECT * FROM ' . $this->tableName);

        //setting how the data is to be fetched
        $getALl->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructorTable);

        //execution of the query
        $getALl->execute();

        //return all the record fetched from the table
        return $getALl->fetchAll();
    }

    //function to get one particular row from the table
    public function getOne($attribute, $attributeValue){
        $getOne = $this->dbConnection->prepare('SELECT * FROM ' . $this->tableName . ' WHERE ' . $attribute . ' = :value');
        $getOne->setFetchMode(\PDO::FETCH_CLASS, $this->entityClass, $this->entityConstructorTable);
        $getOneValue = [
            'value' => $attributeValue
        ];
        $getOne->execute($getOneValue);
        return $getOne->fetchAll();
    }

    //function to get a particular record in form of an array
    public function getOneArr($attribute, $attributeValue){
        //preparing the sql query to be executed
        $getOne = $this->dbConnection->prepare('SELECT * FROM ' . $this->tableName . ' WHERE ' . $attribute . ' = :value');

        //value needed in the query
        $getOneValue = [
            'value' => $attributeValue
        ];

        //execution of the query
        $getOne->execute($getOneValue);

        //return all the record fetched from the table
        return $getOne->fetchAll();
    }

    //function to insert record into the table
    public function addData($data): void
    {
        //get the keys from the array passed as argument
        $dataKeys = array_keys($data);

        //combining the keys as required
        $attribute = implode(', ', $dataKeys);

        //combining the keys as required
        $attributeValues = implode(', :', $dataKeys);

        ////preparing the sql query to be executed
        $addData = $this->dbConnection->prepare('INSERT INTO ' . $this->tableName . ' (' . $attribute . ') VALUES (:' . $attributeValues . ')');

        //execution of the query
        $addData->execute($data);
    }

    //function to update a record in the table
    public function updateData($data): void
    {
        //building the sql query
        $updateQuery = 'UPDATE ' . $this->tableName . ' SET ';

        //creating an array
        $queryParams = [];

        //loop to add data into the array
        foreach ($data as $dataKey=>$datum){
            $queryParams[] = $dataKey . '= :' . $dataKey;
        }

        //combining the array elements as required
        $updateQuery .= implode(', ', $queryParams);

        //completing of the sql query
        $updateQuery .= ' WHERE ' . $this->tablePrimaryKey . ' = :tablePrimaryKey';
        $data['tablePrimaryKey'] = $data[$this->tablePrimaryKey];

        //preparing the sql query to be executed
        $updateData = $this->dbConnection->prepare($updateQuery);

        //execution of the query
        $updateData->execute($data);
    }

    //function to either save or update
    public function saveData($data): void
    {
        //try catch block
        try {
            //attempt to insert record
            $this->addData($data);
        }
        catch (\Exception $exception){
            //in case error while adding, update record
            $this->updateData($data);
        }
    }

    //function to delete record from the table
    public function deleteData($attributeValue): void
    {
        //preparing the sql query to be executed
        $deleteData = $this->dbConnection->prepare('DELETE FROM ' . $this->tableName . ' WHERE ' . $this->tablePrimaryKey . '= :value');

        //value needed in the sql query
        $deleteDataValue = [
            'value' => $attributeValue
        ];

        //execution of the query
        $deleteData->execute($deleteDataValue);
    }

    //function to find the last id of a record
    public function findLastId(){

        //preparing the sql query to be executed
        $lastId = $this->dbConnection->prepare('SELECT ' . $this->tablePrimaryKey . ' FROM ' . $this->tableName .' ORDER BY ' . $this->tablePrimaryKey . ' DESC LIMIT 1');

        //execution of the query
        $lastId->execute();

        //returning the id fetched
        return $lastId->fetch();
    }

}