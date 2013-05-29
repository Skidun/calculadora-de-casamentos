<?php

/**
 * @author Wesley S. Araújo
 * @copyright 2012
 * @version 1.0
 * @description Classe que faz a conexão com o banco de dados.
 * Essa é uma classe abstrata por tanto ela só pode ser utilizada por classes que a extenderão
 */

abstract class mysqlConn{
    
        protected $host, $db, $user, $pass, $connDb, $sql, $query,  $result, $status, $count, $error;
        //Método que inicializa automaticamente as variáveis de conexão a partir na instanciação da classe no objeto
        public function __construct(){
            $this->host = "localhost";
            $this->user = "root";
            $this->pass = "";
            $this->db   = "dbcurso";
            self::connect();//Executa a classe de conexão automáticamente     
        }
        //Método que seleciona o banco de dados
        protected function connect(){
            $this->connDb = @mysql_connect($this->host, $this->user, $this->pass) or die ("Erro ao acessar o banco de dados" .mysql_error());
            $this->db     = @mysql_select_db($this->db) or die ("<strong>Erro ao selecionar Banco de Dados</strong><br />".mysql_error());
        }
        //Execulta a consulta no banco de dados
        protected function execSql($sql){
            $this->query = mysql_query($sql) or die ("Erro ao executar a Query $sql<br />".mysql_error());
            return $this->query;
         }
        //Método que executa e lista os resultados da consutla SQL
        protected function listResult($query){
            $this->result = mysql_fetch_assoc($query);
            return $this->result;
        }
        //Método que executa a quantidade de resultados encontrado na consulta SQL Query
        protected function countResults($query){
            $this->count = mysql_num_rows($query);
            return $this->count;
        }
}        

?>