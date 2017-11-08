<html>
<body>

<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo ("MySQL - PHP Connect Test <br/>");
$hostname = "localhost";
$username = "cs20120863";
$password = "dbpass";
$dbname = "db20120863";

$connect = new mysqli($hostname, $username, $password)
     or die("DB Connection Failed");
//$result = mysql_select_db($dbname,$connect);

if($connect) {
 echo("MySQL Server Connect Success!");
}
else {
 echo("MySQL Server Connect Failed!");
}

// define variables and set to empty values
$idnumber = $name = $email = $phone = $topping1 = $topping2 = $topping3 =
   $paymethod  = $callfirst = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $idnumber = test_input($_POST["idnumber"]);
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $phone = test_input($_POST["phone"]);

  for($i=0; $i<count($_POST["topping"]); $i++){
    $position = $_POST['topping'];
  }
  $topping1 = $position[0];
  $topping2 = $position[1];
  $topping3 = $position[2];

  $paymethod = test_input($_POST["paymethod"]);
  $callfirst = test_input($_POST["callfirst"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$sql = "INSERT INTO PizzaOrders (idnumber, name, email, phone_number, topping1, topping2, topping3, pay_method, call_first)
VALUES ($idnumber, $name, $email, $phone, $topping1, $topping2, $topping3, $paymethod, $callfirst)";

if ($conn ->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: ". $sql . "<br>" . $conn ->error;
}

$connect->close() ;

?>




</body>
</html>