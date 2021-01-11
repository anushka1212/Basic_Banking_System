<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Customers</title>
  <link rel="stylesheet" href="..//CSS/style.css">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
  <style type="text/css">
    /* Internal Style sheet */
    .table-wrapper {
      margin: 10px 70px 70px;
      box-shadow: 0px 35px 50px rgba(0, 0, 0, 0.2);
    }

    .fl-table {
      margin-top: 5%;
      border-radius: 5px;
      font-size: 18px;
      font-weight: normal;
      border: none;
      border-collapse: collapse;
      width: 100%;
      max-width: 100%;
      white-space: nowrap;
      background-color: white;
    }

    .fl-table td,
    .fl-table th {
      text-align: center;
      padding: 8px;
    }

    .fl-table td {
      border-right: 1px solid #f8f8f8;
      font-size: 15px;
    }

    .fl-table thead th {
      color: #ffffff;
      background: #7bb1ca;
    }


    .fl-table thead th:nth-child(odd) {
      color: #ffffff;
      background: #1a4984;
    }

    .fl-table tr:nth-child(even) {
      background: #e6f1f6;
    }

    /* Responsive */

    @media (max-width: 767px) {
      .fl-table {
        display: block;
        width: 100%;
      }

      .table-wrapper:before {
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
      }

      .fl-table thead,
      .fl-table tbody,
      .fl-table thead th {
        display: block;
      }

      .fl-table thead th:last-child {
        border-bottom: none;
      }

      .fl-table thead {
        float: left;
      }

      .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
      }

      .fl-table td,
      .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
      }

      .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
      }

      .fl-table tbody tr {
        display: table-cell;
      }

      .fl-table tbody tr:nth-child(odd) {
        background: none;
      }

      .fl-table tr:nth-child(even) {
        background: transparent;
      }

      .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
      }

      .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
      }

      .fl-table tbody td {
        display: block;
        text-align: center;
      }
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
          <a class="nav-link" href="transfer.php">Transfer Money</a>
          <a class="nav-link" href="../../index.html">Home</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navigation Bar code ends here -->
  <div class="table-wrapper">
    <table class="fl-table">
      <caption align="bottom" style="text-align: center;font-size: x-large;">Transaction History</caption>
      <thead>
        <tr>
          <th>Sender</th>
          <th>Receiver</th>
          <th>Amount</th>
          <th>Date & Time</th>
        </tr>
      </thead>
      <tbody>
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

        //sql query to display 
        $sql = "SELECT * FROM history ORDER BY Datetime DESC;";
        $result = $conn->query($sql);
        error_reporting(0);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            //Output of each row
            echo "<tr><td>" . $row["Sender"] . "</td><td>" . $row["Receiver"] . "</td><td>" . "Rs. " . $row["Amount"] . "</td><td>" . $row["Datetime"] . "</td></tr>";
          }
        } else {
          echo "<h2 style ='color:#1a4984;'>0 results</h3>";
        }
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>