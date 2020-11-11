<?php
$connect = mysqli_connect("localhost", "root", "");  
mysqli_select_db($connect, "pokemon");
$output = array();  
$query = "SELECT * FROM mypokemon";  
$result = mysqli_query($connect, $query);  
if(mysqli_num_rows($result) > 0)  
{  
     while($row = mysqli_fetch_array($result))  
     {  
          $output[] = array("Pokemon_ID"=>$row['Pokemon_ID'],"Nickname"=>$row['Nickname']);  
     }  
     echo json_encode($output);  
}  
?>