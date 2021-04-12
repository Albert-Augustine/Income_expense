<!DOCTYPE html>
<html>
  <head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
<body>
  <?php
    $conn = mysqli_connect("localhost", "root", "user123", "income_expense");
    $income_sourse = $_POST['income_sourse'];
    $income_amount = $_POST['income_amount'];
    $expense_sourse = $_POST['expense_sourse'];
    $expense_amount = $_POST['expense_amount'];
    $month_name = $_POST['month_name'];
    if (isset($_POST['income_submit'])) {
	    if ($conn->connect_error) {
	        echo("Connection failed");
	    }
      $sql = "INSERT INTO income (income_sourse,income_amount)VALUES ('$income_sourse','$income_amount')";
      if ($conn->query($sql) === TRUE) {
        echo "ok1";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    if (isset($_POST['expense_submit'])) {
      if ($conn->connect_error) {
          echo("Connection failed");
      }
      $sql1 = "INSERT INTO expense (expense_sourse,expense_amount)VALUES ('$expense_sourse','$expense_amount')";
      if ($conn->query($sql1) === TRUE) {
        echo "ok2";
      } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
      }
    }
    if (isset($_POST['month_submit'])) {
      if ($conn->connect_error) {
          echo("Connection failed");
      }
      $result1 = mysqli_query($conn, 'SELECT SUM(income_amount) AS value_sum1 FROM income'); 
      $row1 = mysqli_fetch_assoc($result1); 
      $sum1 = $row1['value_sum1'];
      $result2 = mysqli_query($conn, 'SELECT SUM(expense_amount) AS value_sum2 FROM expense'); 
      $row2 = mysqli_fetch_assoc($result2); 
      $sum2 = $row2['value_sum2'];
      $sum = $sum1-$sum2;
      if ($sum > 0) {
        echo"Expense is ok";
      } else {
        echo"Expense is not ok";
      }
    }
  ?>
  <div>
    <!-- <img src="2.jpg" class="image"> -->
    <div class="main">
      <div class="income_main">
        <p>INCOME DETAIL PAGE</p>
        <form method="post">
          <label>Income Sourse:</label><input type="text" name="income_sourse" value="<?php echo isset(($_POST["income_sourse"])) ? $_POST["income_sourse"] : '' ?>"></span><br><br>
          <label>Income Amount:</label><input type="text" name="income_amount" value="<?php echo isset(($_POST["income_amount"])) ? $_POST["income_amount"] : '' ?>"><br><br>
          <input type="submit" value="Isubmit" name="income_submit">
        </form>
      </div>
      <div class="expense_main">
        <p>EXPENSE DETAIL PAGE</p>
        <form method="post">
          <label>Expense Sourse:</label><input type="text" name="expense_sourse" value="<?php echo isset(($_POST["expense_sourse"])) ? $_POST["expense_sourse"] : '' ?>"></span><br><br>
          <label>Expense Amount:</label><input type="text" name="expense_amount" value="<?php echo isset(($_POST["expense_amount"])) ? $_POST["expense_amount"] : '' ?>"><br><br>
          <input type="submit" value="Esubmit" name="expense_submit">
        </form>
      </div>
    </div>
    <div class="answer">
      <form method="post">
        <!-- <label>Enter the month:</label><input type="text" name="month_name" value="<?php echo isset(($_POST["month_name"])) ? $_POST["month_name"] : '' ?>"></span><br><br> -->
        <input type="submit" value="Msubmit" name="month_submit">
      </form>
    </div>
  </div>
</body>
</html>