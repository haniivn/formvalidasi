<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
$usernameErr = $emailErr = $genderErr = "";
$username = $email = $gender = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Username wajib diisi";
  } else {
    $username = test_input($_POST["username"]);
    if (!preg_match("/^[a-z]+[._]+[A-Z]*$/",$username)) {
      $usernameErr = "username beriisi lima karakter pertama huruf kecil dilanjutkan underscore atau titik dan dilanjutkan dua huruf besar!"; 
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email wajib diisi";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Salah format email"; 
    }
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender wajib diisi";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Formulir</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Username: <input type="text" name="username" value="<?php echo $username;?>">
  <span class="error">* <?php echo $usernameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Data:</h2>";
echo $username;
echo "<br>";
echo $email;
echo "<br>";
echo $gender;
?>

</body>
</html>