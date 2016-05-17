<?php

function print_array($array)
{
	echo "<pre>";
	 print_r($array);
	echo "</pre>";
}

  function insert($table, array $data)
 {
 	  // builds  query statement
 	  $fields = '';

      $values = '';

    foreach ($data as $key => $value) 
    {
       $fields .= '`'.$key.'`,';
       if(is_numeric($value))
        $values .= $value.',';
      else
        $values .= "'".$value."',";
    }    

    $fields = rtrim($fields, ',');
    $values = rtrim($values, ',');

    $sql = 'INSERT INTO '.'`'.$table.'` '.'('.$fields.') VALUES ('.$values.')';

    // runs the query against database
    $query_run = mysql_query($sql);

    if ($query_run) 
    {
      return true;
    }
    else
    {
       return false;
    }
       
     
 } //end of insert function

#use case
 /*insert('users',[
 	   'fname'=>'william',
 	   'lname'=>'agyapong',
 	   'username'=>'willisco'
 	]);*/

 function select($sql)
 {
    $results = [];

    if($queryrun = mysql_query($sql))
    {
      while($sqlresult = mysql_fetch_assoc($queryrun))
      {

        $results[] = $sqlresult;
      }

    }
    else{
      return "Please make sure to enter the right query statement";
    }
    return $results;
 }

 function update( $table, $id, array $data)
 {
    $fieldsValues ="";
    foreach($data as $filed =>$value)
    {
       $fieldsValues .= '`'.$filed.'`='."'$value',";
    }

    $fieldsValues = rtrim($fieldsValues,",");

    $sql = "UPDATE ". '`'.$table.'` '. "SET ".$fieldsValues." WHERE `id`=".$id;

    if(mysql_query($sql))
    {
      return true;
    }
 }
?>