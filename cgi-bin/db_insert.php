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

$connect = new mysqli($hostname, $username, $password, $dbname)
     or die("DB Connection Failed");
//$result = mysql_select_db($dbname,$connect);

if($connect) {
 echo("MySQL Server Connect Success!<br />");
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

  // 토핑이 여러개 들어갔으면 따로따로 저장
  if (isset($_POST['topping'])) {
    $toppings = $_POST['topping'];

    for($i=0; $i<3; $i++) {
      if (isset($toppings[$i])) {
        $position[$i] = $toppings[$i];
      } else {
        $position[$i] = "Nothing";
      }
    }
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

if ($connect ->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: ". $sql . "<br>" . $connect ->error;
}

$connect->close() ;

?>




</body>
</html>
