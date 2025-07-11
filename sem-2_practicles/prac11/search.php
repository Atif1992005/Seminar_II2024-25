<?php
$con = mysqli_connect("localhost", "root", "", "student");
if (!isset($con)) {
    echo "Error:" . mysqli_error($con);
}
?>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $rollno=intval($_POST["rollno"]);
    $query="SELECT rollno,name,class,prnno FROM student where  rollno=".$rollno."";
   $result= mysqli_query($con,$query);

   echo "<table  border='1' cellpadding='5'>
        <tr>
            <th>Roll no</th>
            <th>Name</th>
            <th>class</th>
            <th>PRN no</th>
        </tr>";
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>" . $row['rollno'] . "</td>
             <td>" . $row['name'] . "</td>
            <td>" . $row['class'] . "</td>
            <td>" . $row['prnno'] . "</td>
            </tr>
            ";        }
    } else {
        echo "0 results";
    }

    
    }
    echo"</table>";

mysqli_close($con);
?>
