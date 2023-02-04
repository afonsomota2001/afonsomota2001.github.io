<?php
require 'connection.php';
include 'alert.php';
?>

<!DOCTYPE html>
<html>
<title>Stock</title>
<head>
<h1 style="background-color:DodgerBlue;">STOCK:</h1>

  <style>
    .button {
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 24px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button1 {
  background-color: white; 
  color: black; 
  border: 5px solid #FF3333;
}

.button1:hover {
  background-color: #FF3333;
  color: white;
}

.button3 {
            background-color: white; 
            color: black; 
            border: 5px solid pink;
        }

        .button3:hover {
            background-color: pink;
            color: white;
        }

.square {
      width: 200px;
      height: 200px;
      display: inline-block;
      background-color: lightgray;
      text-align: center;
      vertical-align: middle;
      margin: 10px;
      padding: 20px;
    }
  </style>

<button onclick = "window.location.href='index.html'" class="button button3">Menu </button> 
<button onclick = "window.location.href='introMed.php'" class="button button1">Insert Medication </button> <br>


</head>
<br>
  <table border = 1 cellspacing = 0 cellpadding = 10>
      <tr>
        <td>Medication ID</td>
        <td>Name</td>
        <td>Dose</td>
        <td>Frequency</td>

      </tr>
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT m.medication_id, m.name, m.dose, m.frequency, s.number_of_pills
                              FROM medications m
                              JOIN stock s ON m.medication_id = s.medication_id
                              ORDER BY m.name ASC");
      ?>

      <?php foreach ($rows as $row) : ?>
      <tr>
        <td><?php echo $row["medication_id"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["dose"]; ?></td>
        <td><?php echo $row["frequency"]; ?></td>
        
        <td><?php echo '<a href="infoEditMed.php?medication_id=',$row["medication_id"],'">Edit</a>'; ?></td>

      </tr>
      <?php endforeach; ?>
    </table>
    <br>
<body>
<?php
  require 'connection.php';

  for ($i = 1; $i <= 8; $i++) {
    $query = "SELECT s.deposit_number, m.medication_id, m.name, s.number_of_pills
              FROM stock s
              INNER JOIN medications m ON s.medication_id = m.medication_id
              WHERE s.deposit_number = $i";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);
      $medication_id = $row['medication_id'];
      $name = $row['name'];
      $number_of_pills = $row['number_of_pills'];
      echo "
        <div class='square'>
          <p>Deposit Number: $i</p>
          <p>Medication ID: $medication_id</p>
          <p>Name: $name</p>
          <p>Number of Pills: $number_of_pills</p>
          <p><a href='infoAddMed.php?medication_id=$medication_id'>Add Pills</a></p>
          <p><a href='infoDeleteMed.php?medication_id=$medication_id'>Remove </a></p>
        </div>
      ";
    } else {
      echo "
        <div class='square'>
          <p>Deposit Number: $i</p>
          <p>Empty</p>

        </div>
      ";
    }
  }
?>



</body>
</html>