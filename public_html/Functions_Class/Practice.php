<?php

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Id</th><th>Email</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$username = "tt74";
$password = "x55StF1y";
$hostname = "sql2.njit.edu";

$dsn = "mysql:host=$hostname;dbname=$username";

try {
	$conn = new PDO($dsn, $username, $password);
	echo "Connected Succesfully<br>";
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id, email FROM accounts LIMIT 5"); 
    $stmt->execute();


    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
} catch(PDOException $e) {
	echo "Connection Failed: <br>" . $e->getMessage();
}
$conn = null;
echo "</table>"
?>

/* Part 3 kind of confused me */

<?php

class User {
  private $name;
  private $email;
  private $password;

public function getName() {
  return $this->name;
}

public function setName($name) {
  $this->name = $name;
}


public function getEmail() {
  return $this->email;
}

public function setEmail($email) {
  $this->email = $email;
}

public function getPassword() {
  return $this->password;
}

public function setPassword($password) {
  $this->password = $password;
}


public function getUser() {
  return "<table border='1'><tr><td>Name:</td><td>".$this->name."</td></tr>"

  ."<tr><td>Email:</td><td>".$this->email."</td></tr>"

  ."<tr><td>Password:</td><td>".$this->password."</td></tr></table>";
}

}
?>