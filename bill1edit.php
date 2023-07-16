<?php
include 'connection.php';
session_start();

  $month = date('m');
  $day = date('d');
  $year = date('Y');
  $today = $year . '-' . $month . '-' . $day;
 //date code is over insert query is started


if (isset($_REQUEST['update'])) {
    

    // $date_Data1 = $_REQUEST['dateData1'];
    $morning_data1 = $_REQUEST['morning_milk1'];
    $eve_data1 = $_REQUEST['eve_milk1'];
    $other_data1 = $_REQUEST['other_milk1'];  
    $id_data1 = $_GET['id'];
    $mainId= $_GET['name'];
    // echo $mainId."kapil data";
    

        $updateData = "UPDATE `customer_data` SET `morning`='$morning_data1',`evening`='$eve_data1',`other`='$other_data1' WHERE `sno`=$id_data1 && `bill_no`= $mainId"; 
            mysqli_query($conn, $updateData);
            // header('Location: bill1.php?id= echo $mainId');
    
  }
  $id_data1 = $_GET['id'];
    // echo "welcome".$id_data1;


    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      // Retrieve the form data
      $username = $_GET['id'];
  
      // Assign the data to session variables
      $_SESSION['id'] = $username;
      // echo  $username."welcomr";
  
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
          <div class="col-3"><a href="bill2.php?id=<?php echo $mainId ?>"><button class="btn btn-warning"> Generate</button></a></div>
        </div>

        <!-- ------form is here------  -->
        <form action="#" method="post">
        <div class="row">
            <!-- <div class="mt-3">
                <input type="date"  value="<?php echo $today; ?>" class="form-control" id="exampleInputPassword1" name="dateData1">
            </div> -->
        </div>
        <div class="row mt-3">
             <?php 
                $id_data1 = $_GET['id'];
                $mainId = $_GET['name'];

             $result1 = mysqli_query($conn, "SELECT * FROM `customer_data` where `sno` =$id_data1 && `bill_no`= $mainId");
                        $i=0;
                        while($row = mysqli_fetch_array($result1)) {
                        ?>
            <div class="d-flex justify-content-between">
                <div class="bill1">
                    <label for="" class="mb-1">Morning</label>
                    <hr class="p-0 m-0">
                    <input type="text" Required name="morning_milk1" id="" value="<?php echo $row['morning'];?>" >
                </div>
                <div class="bill1">
                    <label for="" class="mb-1">Evening</label>
                    <hr class="p-0 m-0">
                    <input type="text" Required name="eve_milk1" id="" value="<?php echo $row['evening'];?>">
                </div>
                <div class="bill1">
                    <label for="" class="mb-1">Other</label>
                    <hr class="p-0 m-0">
                    <input type="text" Required name="other_milk1" id="" value="<?php echo $row['other'];?>">
                </div>
            </div>
            <?php
             }
             ?>
        </div>
        <div class="col-12 mt-3 text-center">
            <button type="submit" class="btn btn-primary" name="update"><i class="bi bi-check2-square"></i> <a href="bill1.php?id=<?php echo $mainId ?>">Update Now</a></button>
        </div>
        </form>

        <hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <!-- <th scope="col">S.no</th> -->
                <th scope="col">Date</th>
                <th scope="col">Total Milk</th>

              </tr>
            </thead>
            <tbody>
            <?php 
             $result = mysqli_query($conn, "SELECT * FROM `customer_data` where `sno` =$id_data1 && `bill_no`= $mainId");
                        $i=0;
                        while($row = mysqli_fetch_array($result)) {
                        ?>
              <tr>
                <!-- <th></th> -->
                <td><?php echo $row['date'];?></td>
                <?php $total_milk1 =  $row['morning']; $total_milk2= $row['evening']; $total_milk3= $row['other'];?>
                <td><?php echo $total_milk1+$total_milk2+$total_milk3 ?> L</td>
                
                
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
