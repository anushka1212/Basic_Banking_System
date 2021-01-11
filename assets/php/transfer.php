<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Money Transfer</title>
  <link rel="stylesheet" href="..//CSS/style.css">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* Internal Style sheet */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .wrapper {
      margin: auto;
      margin-top: 170px;
      width: 30%;
      height: 400px;
      box-shadow: 0 27px 87px rgba(256, 256, 256, 5);
      padding: 10px;
      background-color: #fff;
      border-radius: 15px;
      font-family: sans-serif;
    }

    .tab {
      display: inline-block;
      font-family: "Roboto Slab";
    }

    .para {
      margin-left: 15%;
      font-family: "Roboto Slab";
      color: #144686;
    }

    .value {
      margin-left: 15%;
      font-family: "Roboto Slab";
      color: #144686;
    }

    .btn {
      margin-top: 10%;
      padding: 12px 20px;
      border-radius: 10px;
      background: #144686;
      color: #fff;
      font-size: 15px;
      font-family: "Roboto Slab";
      cursor: pointer;
      text-align: center;
    }
  </style>
</head>

<body>
  <!-- Navigation Bar code starts here -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="../../index.html">SBE Bank</a>
    <img src="..//images/logo.png" width="30px" height="30px" alt="">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" href="customers.php">Customer List</a>
          <a class="nav-link" href="customerHistory.php">Transaction History</a>
          <a class="nav-link" href="../../index.html">Home</a>

        </li>
      </ul>
    </div>
  </nav>
  <!-- Navigation Bar code ends here -->
  <div class="wrapper">
    <p>&nbsp</p>
    <p><span class="tab"></span><strong style="margin-left: 35%; font-size : 125%;">Transfer Money</strong></p>
    <div>
      <form method="post" name='tcredit'>
        <p class="para">From - <span class="tab">
            <select style="margin-left:20px;width:200px" name="from" class="form-control" required>
              <option value="" disabled selected>Choose Name</option>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "BankingSystem";
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              $sql = "SELECT * FROM customers ORDER BY Username ASC";
              $result = mysqli_query($conn, $sql);
              if (!$result) {
                echo "Error " . $sql . "<br>" . mysqli_error($conn);
              }
              while ($rows = mysqli_fetch_assoc($result)) {
              ?>
                <option class="table" value="<?php echo $rows['Id']; ?>">

                  <?php echo $rows['Username']; ?> (Balance:
                  <?php echo "Rs. " . $rows['Balance']; ?> )

                </option>
              <?php
              }
              ?>
              </option>
            </select>
        </p>
        <p class="para">To - <span style="margin-left:40px;width:200px;" class="tab">
            <select name="to" class="form-control" required>
              <option value="" disabled selected>Choose Name</option>
              <?php
              $servername = "localhost";
              $username = "root";
              $password = "";
              $dbname = "BankingSystem";
              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);
              // Check connection
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              $sql = "SELECT * FROM customers ORDER BY Username ASC";
              $result = mysqli_query($conn, $sql);
              if (!$result) {
                echo "Error " . $sql . "<br>" . mysqli_error($conn);
              }

              while ($rows = mysqli_fetch_assoc($result)) {
              ?>
                <option class="table" value="<?php echo $rows['Id']; ?>">

                  <?php echo $rows['Username']; ?>

                </option>
              <?php
              }
              ?>
              </option>
            </select>
        </p>
        <label for="Amount" class="value">Amount - <span class="tab"></span></label>


        <input type="number" name="amount" required>
        <div class="text-center">
          <button class="btn" type="submit" name="submit" id="myBtn">Transfer</button>
        </div>
      </form>
    </div>
  </div>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bankingSystem";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if (isset($_POST['submit'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from customers where id=$to";
    $query = mysqli_query($conn, $sql);
    $sql2 = mysqli_fetch_array($query);
    // constraint to check if both the sender and receiver are same
    if ($sql1 == $sql2) {
      echo "<script> alert('Incorrect transaction details');
                      window.location='transfer.php';</script>";
    }
    // constraint to check input of negative value or zero by user
    if (($amount) <= 0) {
      echo '<script type="text/javascript">';
      echo ' alert("Incorrect amount.")';
      echo '</script>';
    }

    // constraint to check insufficient balance.
    else if ($amount > $sql1['Balance']) {
      echo '<script type="text/javascript">';
      echo ' alert("Insufficient Balance.")';
      echo '</script>';
    } else {
      // deducting amount from sender's account
      $newbalance = $sql1['Balance'] - $amount;
      $sql = "UPDATE customers set Balance=$newbalance where Id=$from";
      mysqli_query($conn, $sql);

      // adding amount to reciever's account
      $newbalance = $sql2['Balance'] + $amount;
      $sql = "UPDATE Customers set Balance=$newbalance where Id=$to";
      mysqli_query($conn, $sql);

      $sender = $sql1['Username'];
      $receiver = $sql2['Username'];
      date_default_timezone_set("Asia/Kolkata");
      $t = time();
      $time = (date("Y-m-d H:i:s", $t));
      $sql = "INSERT INTO history VALUES ('" . $sender . "','" . $receiver . "','" . $amount . "','" . $time . "')";
      $query = mysqli_query($conn, $sql);

      if ($query) {
        echo "<script> alert('Transaction Successful');
                      window.location='customerHistory.php';</script>";
      }
      $newbalance = 0;
      $amount = 0;
    }
  }
  ?>
</body>

</html>