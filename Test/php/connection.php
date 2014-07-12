<?php 

/**
 * @author Juan Camilo Varela López
 */

class Connection{


  private $connection; 


  public function Connection(){ 
    if(!isset($this->connection)){
      $this->connection = (mysql_connect("localhost","root",""))
        or die(mysql_error());
      mysql_select_db("dbcitytaxi",$this->connection) or die(mysql_error());
    }
  }

  public function executeQuery($userQuery){ 
   
    $resultado = mysql_query($userQuery,$this->connection);
    if(!$resultado){ 
      echo ("Error: " . mysql_error());
      exit;
    }
    return $resultado;
  }

  
  public function closeSesion()
  {
  	mysql_close($this->connection);
  }

}?>