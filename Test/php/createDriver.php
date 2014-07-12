<?php

/**
 * @author Juan Camilo Varela López
 */

header('Content-type: application/json');
include("connection.php");

$connection = new Connection();

/*
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$id = $request->id;
$name = $request->name;
*/

//var_dump($_POST);
if ($_POST) {
$id=$_POST['id'];
$name=$_POST['name'];
$lastname=$_POST['lastname'];
$rh= $_POST['rh'];
$active =$_POST['active'];
$password =$_POST['password'];
$phone =$_POST['phone'];

insertDriver();

} else
{
    validateData();
}

function validateData()
{
$validation = array();

$validation['status']="false";
$validation['errors']['id'][]= 'El campo id es requerido'; 
$validation['errors']['name'][]= 'El campo name es requerido'; 
$validation['errors']['lastname'][]= 'El campo lastname es requerido.'; 
$validation['errors']['rh'][]= 'El campo rh es requerido.'; 
$validation['errors']['active'][]= 'El campo active es requerido.'; 
$validation['errors']['password'][]= 'El campo password es requerido.'; 
$validation['errors']['phone'][]= 'El campo phone es requerido.'; 

echo (json_encode($validation));
}

function insertSuccess()
{
$success = array();

$success['status']="true";
$success['person']['id'][]="'".$id."'" ; 
$success['person']['name'][]= "'".$name."'"; 
$success['person']['lastname'][]= "'".$lastname."'"; 
$success['person']['rh'][]= "'".$rh."'"; 
$success['person']['active'][]=1; 
$success['person']['password'][]= "'".$password."'"; 
$success['person']['phone'][]="'".$phone."'" ; 

echo (json_encode($success));
}


function insertDriver(){

  if(validateNumeric($id)&&validateString($name)&&validateString($lastname)&&validateRH($rh)
  	 &&validateNumeric($password)&&validateNumeric($phone)&&($active==TRUE || $active==FALSE)){

      $insertDriver = "INSERT INTO person VALUES 
                     (".$id.", '".$name."', '".$lastname."', '".$rh."', ".$active.", ".$password.", ".$phone.");";

       $query = $connection->executeQuery($insertDriver);
       if($query)
          insertSuccess();
   }
  else 
      validateData();

}

function validateNumeric($value){
if(preg_match("/^([0-9])+$/",$value)) 
  { 
	return TRUE; 
   }
 return FALSE;
}

function validateString($string)
{
if(preg_match("/^([a-z])+$/",strtolower($string))) 
  { 
	return TRUE; 
  }
 return FALSE;
}


function validateRH($string)
{
if(preg_match("/^(O|(A?B?))(\+|-)$/",$string)) 
  { 
	return TRUE; 
  }
 return FALSE;
}



?>