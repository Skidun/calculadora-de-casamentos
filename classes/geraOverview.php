<?php 
include_once("mysqlConn.php");

class geraOverview extends mysqlConn{
	 private $emailNoiva;
	 
	 public function setEmailNoiva($emailNoiva){
		 $this->emailNoiva = $emailNoiva;
		 }
	 
	 public function geraOverview(){
		 $sql = "SELECT * FROM cn_itens WHERE idNoiva = '$this->emailNoiva'";
		 $query = self::execSql($sql);
		 
		 while ($result = self::listResult($query)){
		 	$idItem			=	$result["idItem"];
		 	$nomeItem		=	$result["nomeItem"];
		 	$orcamentoItem	=	$result["orcamentoItem"];
		 	
		 	$sqlSubItem		=	"SELECT * FROM cn_subitens WHERE idItem = '$idItem'";
		 	$querySubItem	= self::execSql($sqlSubItem);
		 	$resultSubItem	=	self::listResult($querySubItem);

		 	echo '<table class="TabelaItem ligado" rules="all" cellpadding="0" cellspacing="0">
                           <thead>
                              <tr>
                                 <th style="width:33%"><div class="icone-tabela"></div>'.$nomeItem.'</th>
                                 <th style="width:33%">-</th>
                                 <th style="width:33%">-<div class="overview"></div></th>
                              </tr>
                           </thead>
                           <tbody>
                           	 <tr>
                             	<td colspan="3" class="wrap">
                                	<div class="new">
                                	<table>
		 			
		 			';
		 	if(self::countResults($querySubItem >= 1)){
		 		
		 		
		 	}
		 }
		 
	}
}
?>