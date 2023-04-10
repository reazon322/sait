<?php  
//export.php  
$connect = mysqli_connect("localhost", "root", "", "sait");
$output = '';
mysqli_query($connect, "SET NAMES 'utf8'");
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM list";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>№</th>  
                         <th>name</th>  
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["id"].'</td>  
                         <td>'.$row["name"].'</td>  
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>
