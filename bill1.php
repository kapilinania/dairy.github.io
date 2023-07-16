<?php
session_start();
include 'connection.php';
  if(isset($_GET['id'])){
    $id_data = $_GET['id'];  
  }
  $month = date('m');
  $day = date('d');
  $year = date('Y');
  $today = $year . '-' . $month . '-' . $day;
 //date code is over insert query is started
 if (isset($_POST['submit'])) {
  $dateData = $_REQUEST['dateData'];
  $morning_data = $_REQUEST['morning_milk'];
  $eve_data = $_REQUEST['eve_milk'];
  $other_data = $_REQUEST['other_milk'];
  $id_data1 = $_GET['id'];  
  $userbill = $id_data1;
  $userData = "INSERT INTO `customer_data`(`sno`, `date`, `morning`, `evening`, `other`,`bill_no`) VALUES ('','$dateData','$morning_data','$eve_data','$other_data','$userbill')";
  mysqli_query($conn, $userData);
}

$id_data1 = $_GET['id'];
// echo "welcome".$id_data1;


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  // Retrieve the form data
  $username = $_GET['id'];

  // Assign the data to session variables
  $_SESSION['id'] = $username;
  
}
// echo  $username."kapil";


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>first Bill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body>
    <div class="container-fluid">
        <div class="row mt-2">
          <div class="col-8 pt-2">Welcome <?php echo $_SESSION["mobile"]; ?></div>
          <div class="col-3"><a href="bill2.php?id=<?php echo $id_data1?>"><button class="btn btn-warning"> Generate</button></a></div>
        </div>

        <!-- ------form is here------  -->
        <form action="#" method="post">
        <div class="row">
            <div class="mt-3">
                <input type="date" required  value="<?php echo $today; ?>" class="form-control" id="exampleInputPassword1" name="dateData">
            </div>  
        </div>
   
        
        <div class="row mt-3">
            <div class="d-flex justify-content-between">
                <div class="bill1">
                    <label for="" class="mb-1">Morning</label>
                    <hr class="p-0 m-0">
                    <input type="text" Required name="morning_milk" id="" value="" placeholder="0L">
                </div>
                <div class="bill1">
                    <label for="" class="mb-1">Evening</label>
                    <hr class="p-0 m-0">
                    <input type="text" Required name="eve_milk" id="" value="" placeholder="0L">
                </div>
                <div class="bill1">
                    <label for="" class="mb-1">Other</label>
                    <hr class="p-0 m-0">
                    <input type="text" Required name="other_milk" id="" value="" placeholder="0L">
                </div>
            </div>
        </div>
        <div class="col-12 mt-3 text-center">
          <button type="submit" class="btn btn-primary" name="submit"><i class="bi bi-check2-square"></i> Update Now</button>
        </div>
        </form>

        <hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Total Milk</th>
                <th scope="col">Action</th>

              </tr>
            </thead>
            <tbody>
            <?php 
            
             $id_data1 = $_GET['id'];
             $result = mysqli_query($conn, "SELECT * FROM `customer_data` where `bill_no` = $id_data1 ");
                        $i=0;
                        while($row = mysqli_fetch_array($result)) {
                        ?>
              <tr>
                <td><?php echo $row['date'];?></td>
                <?php $total_milk1 =  $row['morning']; $total_milk2= $row['evening']; $total_milk3= $row['other'];?>
                <td><?php echo $total_milk1+$total_milk2+$total_milk3 ?> L</td>
                <td>
                 <a href="bill1edit.php?id=<?php echo $row['sno']?> & name=<?php echo $row['bill_no']?>">
                   <button type="button" class="btn btn-primary">Edit</button>
                  </a>
                </td>
              </tr> 
            </tbody>
            <?php
             }
             ?>
          </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
  </body>
</html>