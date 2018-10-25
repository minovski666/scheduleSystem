<?php

class Database
{
    private $database_server = "localhost";
    private $database_userName = "root";
    private $database_pass = "";
    private $database_name = "timesheet";
    private $connection = "";

    public function __construct()
    {

        $this->connection = new PDO("mysql:host=" . $this->database_server . ";dbname=" . $this->database_name . "", $this->database_userName, $this->database_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
        //$this->connection = new mysqli($this->database_server,$this->database_userName,$this->database_pass,$this->database_name);

    }



    public function exeQuery($sql)
    {
        $con = $this->connection;
        $con->exec($sql);//execute query
        //$con->query($sql);//execute query
    }

    public function deleteINT($table_name, $pk, $pk_value)
    {

        //DELETE
        $sql = "DELETE from " . $table_name . " WHERE " . $pk . " = " . $pk_value;
        $this->exeQuery($sql);
    }

    public function deleteSTR($table_name, $pk, $pk_value)
    {
        //DELETE
        $sql = "DELETE from " . $table_name . " WHERE " . $pk . " LIKE \"" . $pk_value . "\"";
        $this->exeQuery($sql);
    }

    public function deleteAllRecords($table_name)
    {
        //DELETE
        $sql = "DELETE from " . $table_name;
        $this->exeQuery($sql);
    }

    public function dropTable($table_name)
    {
        //DELETE
        $sql = "DROP table " . $table_name;
        $this->exeQuery($sql);
    }

    public function editINT($table_name, $column_value, $pk, $pk_value)
    {

        //UPDATE
        $sql = "UPDATE " . $table_name . " SET " . $column_value . " WHERE " . $pk . " = " . $pk_value;
        $this->exeQuery($sql);
    }

    public function editSTR($table_name, $column_value, $pk, $pk_value)
    {
        //UPDATE
        $sql = "UPDATE " . $table_name . " SET " . $column_value . " WHERE " . $pk . " LIKE \"" . $pk_value . "\"";
        $this->exeQuery($sql);
    }

    public function insert($table_name, $column_name, $column_value)
    {
        //INSERT
        $sql = "INSERT INTO " . $table_name . " ( " . $column_name . " ) VALUES ( " . $column_value . " )";
        $this->exeQuery($sql);
    }

}

?>