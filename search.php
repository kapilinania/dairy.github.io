<?php
session_start();
  include 'connection.php';
  if ($_SESSION["mobile"]==true) {
   

    // echo "Welcome"." ".$_SESSION["mobile"];
}
else{
    header('location:index.php');
}

  if (isset($_REQUEST['submit'])) {
    $emailId = $_REQUEST['cus_name'];
    $passwordData = $_REQUEST['bill'];
    $result = "INSERT INTO `customer`( `customer_name`, `bill_no`) VALUES ('$emailId','$passwordData')";
    mysqli_query($conn, $result);
 }
 $fetchData = mysqli_query($conn, "SELECT * FROM `customer`");

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="search.css">
    <style>
      .alldata{
        border:none;
      }
    </style>

    <title>Search Bar</title>
  </head>
  <body>
    <div class="container-fluid mx-auto">
      <div class="row">
        <div class="col-md-8 col-12 mt-3">
          <form method="get">
            <div class="row">
              <div class="col-9">
              <input type="search" required name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" id="myInput" placeholder="Search Your Customer">
              </div>
              <div class="col-2">
              <button type="button" class="btn btn-primary">Search</button>
              </div>
            </div>
           
        </form>
        </div>
        <div class="col-md-3 col-12 mt-3">
          <button type="button" class="btn btn-primary customer" data-bs-toggle="modal" data-bs-target="#customerData"><i class="bi bi-person-add"></i> Add Customer</button>
          <button type="button" class="btn btn-warning" ><i class="bi bi-building-fill-add"></i> Customer <b>22</b></button>
          <!-- Modal is here -->
          <div class="modal fade" id="customerData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Enter Your Customer Detail</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="" method="post">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Customer Name</label>
                      <input type="text" Required name="cus_name" class="form-control" id="" aria-describedby="emailHelp">
                      
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Bill No</label>
                      <input type="number" Required name="bill" class="form-control" id="">
                    </div>
                    
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- -----model is closed------ -->
        </div>
      </div>
      <hr>
      <table class="table table-striped">
      
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Bill Number</th>
          </tr>
        </thead>
        
        <tbody>
                                <?php
                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM customer WHERE CONCAT(customer_name, bill_no) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                
                                                <tr>
                                                    
                                                    <td><a href="bill1.php?id=<?= $items['bill_no']; ?>"><?= $items['customer_name']; ?></a></td>
                                                    <td><?= $items['bill_no']; ?></td>

                                                </tr>
                                              
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="3">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>

                            <tbody class="alldata">
                   <?php 
             $result = mysqli_query($conn, "SELECT * FROM `customer`");
                        $i=0;
                        while($row = mysqli_fetch_array($result)) {
                        ?>
            <tr>
                <th><?php echo $row['customer_name'];?></th>
                <th><?php echo $row['bill_no'];?></th>
                
            </tr>
            <?php
                        }
        ?>
        </tbody>
        
      </table>


    </div>


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>