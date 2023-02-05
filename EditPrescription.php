<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Insert Medication</title>
  </head>
  <style>
         html,body{
            background-color: #a5b4d63b;
            margin: 0%;
            height: 100%;
          }

        .div{
            background: linear-gradient(#79a5fd, #ff7300);
      }
        form, table {
        display: inline-block;
       vertical-align: top;
      }
</style>
  <body>
  <h1 style="background-color:DodgerBlue;">Prescription:</h1>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">

    <?php echo '<p>User ID: ' . $user_id . '</p>';?>

    <label for="medication_id">Medication Id:</label> <br>
    <input type="text" name="medication_id" id = "medication_id"> <br>
    <br>
    
    <label for="start_date">Start Date:</label><br>
    <input type="date" id="start_date" name="start_date"><br>

    <label for="end_date">End Date:</label><br>
    <input type="date" id="end_date" name="end_date"><br>

    <label for="times_per_day">Times to take a day:</label> <br>
    <input type="text" name="times_per_day" id="times_per_day"> <br>
    
    <label for="hours_to_take">Hours to take:</label> <br>
    <input type="text" name="hours_to_take" id="hours_to_take"> <br>

    <label for="notes">Notes:</label><br>
    <textarea id="notes" name="notes"></textarea><br><br>
         
    <button type = "submit" name = "submit">Submit</button>

    </form>
