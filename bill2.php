<?php
error_reporting(0);
session_start();
include 'connection.php';
if (isset($_REQUEST['submit'])) {
    $priceData = $_REQUEST['price'];
    $start_date =  $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];

  //   $query = "SELECT * FROM customer_data WHERE date >= '$start_date' AND date <= '$end_date'";
  //  $result = mysqli_query($conn, $query);
    
  //   $row = mysqli_fetch_array($result);
     


}
 $_SESSION['bhav']=  $priceData;




$idDatamain = $_GET['id'];
$counter = 1;


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Second Bill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

  
    

    <style>
      .count_data{
        border:0px solid red;
        font-size:30px;
        text-align:center;
        width:100%;
        height:100px;
        padding-top:25px;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row mt-2">
          <div class="col-8 pt-2"> <?php echo $_SESSION["mobile"]; ?></div>
          <div class="col-3"> Bill&nbsp;No:&nbsp;<?php echo  $idDatamain ?></div>
        </div>

        <div class="row mt-3">
          <form action="" method="post">
            <div class="d-flex justify-content-between">
                
                <div class="bill1">
                    <label for="" class="mb-1"> Amount</label>
                    <hr class="p-0 m-0">
                    <!-- <input type="number" name="final_amount" id="" value=" <?php echo  $_SESSION['data'] ?>" > -->
                     <div class="count_data"><?php echo  $_SESSION['data']* $_SESSION['bhav'];  ?>₹</div>
                </div>
                <div class="bill1">
                    <label for="" class="mb-1">Price</label>
                    <hr class="p-0 m-0">
                    <input type="number" name="price" id="" value="50" >
                </div>
                <div class="bill1">
                    <label for="" class="mb-1">Select Date</label>
                    <hr class="p-0 m-0">
                   <div class="date_area">
                    <div class="date_first"><input type="date" name="start_date"></div>
                    <div>To</div>
                   <div class="date_second"><input type="date" name="end_date"></div>
                   </div>
                </div>
                
            </div>
            <div class="col-12 mt-3 text-center">
              <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-check2-square"></i> Result</button>
    <button type="button" class="btn btn-warning" id="shareButton">Print Now</button>

            </div>
        </div>
        </form>
        <hr>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Total Milk</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            $idDatamain = $_GET['id'];
            

             $query = "SELECT * FROM customer_data WHERE date >= '$start_date' AND date <= '$end_date' && bill_no=$idDatamain";
             $result = mysqli_query($conn, $query);
                        $i=0;
                        $countData=0;
                        while($row = mysqli_fetch_array($result)) {
                          $total_milk1 =  $row['morning']; $total_milk2= $row['evening']; $total_milk3= $row['other'];
                          $mainCount = $total_milk1+$total_milk2+$total_milk3;
                          $countData += $mainCount;

                

                        ?>
              <tr>
                <td><?php echo $row['date'];?> </td>
                <?php $total_milk1 =  $row['morning']; $total_milk2= $row['evening']; $total_milk3= $row['other'];?>
                <td><?php echo $total_milk1+$total_milk2+$total_milk3 ?> L</td>
              </tr>
              <?php
              // $i++;   not use this 
                        }
                        $_SESSION['data'] = $countData;
              ?>
              
            </tbody>
          </table>
          
    </div>
    <a href="logout.php"><button class="btn btn-danger" type="submit">logout</button></a>
    <a href="search.php"><button class="btn btn-primary" type="submit">Home Page</button></a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
    <script>
        // Add a click event listener to the "Share" button
document.getElementById('shareButton').addEventListener('click', function() {
    // Get the entire document body
    var element = document.body;

    // Set the options for PDF generation
    var options = {
        filename: 'page.pdf',
        image: { type: 'jpeg', quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'pt', format: 'a4', orientation: 'portrait' }
    };

    // Use html2pdf to generate the PDF
    html2pdf().set(options).from(element).save();
});
    </script>
  </body>
</html>