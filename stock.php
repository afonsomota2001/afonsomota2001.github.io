<?php
require 'connection.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <style>
      table {
        width: 100%;
        border-collapse: collapse;
      }

      th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
      }

      th {
        background-color: #f2f2f2;
      }
    </style>
  </head>
  <body>
    <?php
    require 'connection.php';

    $query = "SELECT medications.medication_id, medications.name, stock.number_of_pills
              FROM medications
              INNER JOIN stock
              ON medications.medication_id = stock.medication_id";
    $result = mysqli_query($conn, $query);
    ?>

    <table>
      <tr>
        <th>Medication ID</th>
        <th>Name</th>
        <th>Number of pills</th>
      </tr>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['medication_id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['number_of_pills']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </body>
</html>

