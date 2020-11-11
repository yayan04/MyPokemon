<?php 

// $connect = mysqli_connect("localhost", "root", ""); 

// mysqli_query($connect, "INSERT INTO 'mypokemon'('Pokemon_ID','Name','Nickname')
//     VALUES (".$pId.",'".$pName."','".$pNickname."') ");

$connect = mysqli_connect("localhost", "root", "");  
mysqli_select_db($connect, "pokemon");
$data = json_decode(file_get_contents("php://input"));  

$pId = $data->Pokemon_ID;
$pName = $data->Name;
$pNickname = $data->Nickname;

    //  $first_name = mysqli_real_escape_string($connect, $data->firstname);       
    //  $last_name = mysqli_real_escape_string($connect, $data->lastname);  
     $query =  "INSERT INTO mypokemon(Pokemon_ID,Pokemon_Name,Nickname) VALUES ($pId,'$pName','$pNickname') ";  
     if(mysqli_query($connect, $query))  
     {  
          echo "Data Inserted...";  
     }  
     else  
     {  
          echo 'Error';  
          echo $pId, $pName, $pNickname;
     }  
?>