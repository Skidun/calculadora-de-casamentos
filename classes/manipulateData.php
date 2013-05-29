<?php

/**
 * @author Wesley S. Araъjo
 * @copyright 2012
 * @description Classe que realiza todos os comandos de SQL no sistema, ele manipula doda operaзгo de banco de dados 
 * extendendo a classe mysqlConn
 */
include_once("mysqlConn.php");

class manipulateData extends mysqlConn{
    
    protected $sql, $table, $fields, $values, $status, $fieldId, $valueId;
    
    public function setTable($t){
        $this->table = $t;
    }
    public function setFields($f){
        $this->fields = $f;
    }
    public function setValues($v){
        $this->values = $v;
    }
    
    public function setFieldId($fieldId){
        $this->fieldId = $fieldId;
    }
    
    public function setValueId($valueId){
        $this->valueId = $valueId;
    }
    
    public function getStatus(){
        return $this->status;
    }
    
    public function insert(){
        $this->sql = "INSERT INTO $this->table($this->fields)VALUES($this->values)";
        if(self::execSql($this->sql)){
            $this->status = "Informaзгo cadastrada com sucesso";
        }
    }
    
    public function update(){
        $this->sql = "UPDATE $this->table SET $this->fields WHERE $this->fieldId = '$this->valueId'";
        if(self::execSql($this->sql)){
            $this->status = "Registro atualizado com sucesso";
        }
    }
    
    public function delete(){
        $this->sql = "DELETE FROM $this->table WHERE $this->fieldId = '$this->valueId'";
        if(self::execSql($this->sql)){
            $this->status = "Excluidas com sucesso";
        }
    }
    
    public function getLastId(){
        $this->sql = "SELECT $this->fieldId FROM $this->table ORDER BY $this->fieldId DESC LIMIT 1";
        $this->query = self::execSql($this->sql);
        $this->result = self::listResult($this->query);
        return $this->result["$this->fieldId"];
    }
    
     public function getDataDuplicate($valorPesquisado){
        $this->sql = "SELECT $this->fieldId FROM $this->table WHERE $this->fieldId = '$valorPesquisado'";
        $this->query = self::execSql($this->sql);
        return self::countResults($this->query);
     }
     
     public function getCountResults(){
        $this->sql = "SELECT $this->fieldId FROM $this->table ORDER BY $this->fieldId";
        $this->query = self::execSql($this->sql);
        return self::countResults($this->query);
        
     }
}


?>