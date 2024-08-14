<?php
require_once __DIR__ . '/HelperTrait.php';
$basePasth = realpath('.').'/config/config.php';
require_once $basePasth;

abstract class Model
{
    use HelperTrait;
    public $dbConnection;
    public $table;
    public $getMethodSql;
    public $getMethodExecuteArray = [];
    public $getMethodWhereCount = 0;
    public $getMethodOrWhereCount = 0;

    private $selectFields  = '*';


    public function __construct()
    {
        $this->dbConnection();
        $this->setTable();
    }

    protected function dbConnection()
    {
        try {
            $this->dbConnection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

    protected function setTable()
    {
        if (is_null($this->table)) {
            $className = strtolower(__CLASS__);
            $this->table =  $this->singularToPlural($className);
        }
    }


    public function all()
    {
        $sql = "SELECT * FROM $this->table";
        $run = $this->dbConnection->prepare($sql);
        $run->execute();
        return $run->fetchAll(PDO::FETCH_OBJ);
    }

    public function find($id)
    {
        $sql = "SELECT $this->selectFields FROM $this->table WHERE id = :id LIMIT 1";
        $run = $this->dbConnection->prepare($sql);
        $run->execute([':id' => $id]);
        return $run->fetch(PDO::FETCH_OBJ);
    }

    public function paginate($limit)
    {
        $currentPage  = @$_GET['page'] ?? 0;
        $offset  = $limit * $currentPage;

        $executeData = [
            ':lmt' => (int) $limit,
            ':fff' => (int) $offset,
        ];

        
      
        $sql = "SELECT $this->selectFields FROM $this->table LIMIT :lmt OFFSET :ff";

        $run = $this->dbConnection->prepare($sql);
        $run->execute($executeData);
        return $run->fetchAll(PDO::FETCH_OBJ);
    }

    public function select(...$fields)
    {
        if (count($fields) > 0) {
            $this->selectFields = implode(',', $fields);
        }
        return $this;
    }

    public function where($column, $operator, $value)
    {

        $tokens = $column . $this->guidv4();

        $contWhere = ++$this->getMethodWhereCount;
        if ((int) $value != $value) {
            $value = "'$value'";
        }
        if ($contWhere == 1) {
            $this->getMethodSql = " WHERE $column $operator :$tokens";
        } else {
            $this->getMethodSql .= " AND  $column $operator :$tokens";
        }
        $this->getMethodExecuteArray[$tokens] = $value;

        return $this;
    }

    public function orWhere($column, $operator, $value)
    {
        $tokens = $column . $this->guidv4();

        if ((int) $value != $value) {
            $value = "'$value'";
        }

        if ($this->getMethodWhereCount < 1) {
            $this->getMethodSql .= " WHERE  $column $operator :$tokens";
        } else {
            $this->getMethodSql .= " OR  $column $operator :$tokens";
        }
        $this->getMethodExecuteArray[$tokens] = $value;

        return $this;
    }

    public function get()
    {
        $mainSql = "SELECT  $this->selectFields FROM $this->table";
        if (!empty($this->getMethodSql)) {
            $mainSql .= $this->getMethodSql;
        }
        $run = $this->dbConnection->prepare($mainSql);
        if (count($this->getMethodExecuteArray) > 0) {
            $run->execute($this->getMethodExecuteArray);
        } else {
            $run->execute();
        }
        return $run->fetchAll(PDO::FETCH_OBJ);
    }


    public function delete()
    {
        $mainSql = "DELETE  FROM $this->table";
        if (!empty($this->getMethodSql)) {
            $mainSql .= $this->getMethodSql;
        }
        $run = $this->dbConnection->prepare($mainSql);
        if (count($this->getMethodExecuteArray) > 0) {
            $run->execute($this->getMethodExecuteArray);
        } else {
            $run->execute();
        }
        if ($run->rowCount() > 0) {
            return 1;
        }
        return 0;
    }

    public function create($data){
        $mainSql = "INSERT INTO  $this->table  SET ";
        $dataTokens = array_keys($data);
        $tokens = [];
        $executeData = [];
        foreach($dataTokens as $value){
            $tokenVal = ":$value".$this->guidv4();
            $tokens[] = "$value = $value";
            $executeData[$tokenVal]= $data[$value];
        }
        $mainSql.=implode(',',$tokens);
        $run = $this->dbConnection->prepare($mainSql);
        $run->execute($data);
        if ($run->rowCount() > 0) {
            return 1;
        }
        return 0;

    }


    public function update($data){
       
        $mainSql = "UPDATE $this->table  SET ";
        $generateSqlPrepareToken = $this->generateSqlPrepareToken($data);
        $mainSql.=$generateSqlPrepareToken['sqlTokens'];

        if (!empty($this->getMethodSql)) {
            $mainSql .= $this->getMethodSql;
        }

       try{
       
        $run = $this->dbConnection->prepare($mainSql);
        $executeDataArray = array_merge($this->getMethodExecuteArray,$generateSqlPrepareToken['executeData']);
        
        $run->execute($executeDataArray);
        return $run->rowCount();
        
       }catch(Exception $e){
        return 0 ;
       }

    }

    private function generateSqlPrepareToken($data){
        $dataTokens = array_keys($data);
        $tokens = [];
        $executeData = [];
        foreach($dataTokens as $value){
            $tokenVal = ":$value".$this->guidv4();
            $tokens[] = "$value = $tokenVal";
            $executeData[$tokenVal]= $data[$value];
        }
        // =implode(',',$tokens);

        return [
            'executeData'=>$executeData,
            'sqlTokens'=>implode(',',$tokens),
        ];
    }

}
