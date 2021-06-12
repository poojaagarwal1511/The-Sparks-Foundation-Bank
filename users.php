<?php
include 'connect.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query);

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    //Conditions
    //For negative value
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Money value cannot be negative !")';
        echo '</script>';
    }
    //Insufficient balance
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Sorry! you have insufficient balance !")';
        echo '</script>';
    }
    //For 0 (zero) value
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Zero value cannot be transferred !')";
         echo "</script>";
     }


    else {
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful !');
                                     window.location='history.php';
                           </script>";
                         }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>SF BANK</title>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
</head>
<body style="background-color:seagreen;">
    <!-- Nav bar -->
    <nav class="navbar py-2 navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SF BANK <img src="logos/p1.jpg" alt="Bank" width="50" height="50"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-8 mb-lg-0">
                    <li class="nav-item py-3">
                        <a class="nav-link" aria-current="page" href="index.php"><strong>Home</strong></a>
                    </li>
                    <li class="nav-item py-3">
                        <a class="nav-link" aria-current="page" href="money.php"><strong>Money Transfer</strong></a>
                    </li>
                    <li class="nav-item py-3">
                        <a class="nav-link" aria-current="page" href="history.php"><strong>Transaction History</strong></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <class class="welcome">
        <h2>
            <img src="logos/pooja2.jpg" alt="Bank" width="75" height="75" style="font-weight: bold;"> <strong>Money
                Transfer</strong>
        </h2>
    </class>

  
    <div class="d-grip gap-2 col-6 mx-auto text-center p-3 mb-2">
        
        <a href="history.php"><button type="button" class="btn btn-dark btn-lg mb-3">Click Here for History</button></a>
    </div>
    </div>

 <!-- Table -->
 <div class="container">
        <h2 class="text-center pt-4" style="color : black;">Customer Details</h2>
            <?php
                include 'connect.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            
            <table class="table table-hover ">
                <thead style="color : white;" class="table-dark">
                <tr style="color : black;" class="table-primary">
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr style="color : white;">
                    <td class=" text-center py-2"><?php echo $rows['id'] ?></td>
                    <td class=" text-center py-2"><?php echo $rows['name'] ?></td>
                    <td class=" text-center py-2"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <h2 class="text-center pt-4" style="color : black;">Caution ! Transaction once processed ,cannot be reverted !</h2>
        <label style="color : black;"><strong>Transfer To:</strong></label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'connect.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label style="color : black;"><strong>Amount:</strong></label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
                <button class="btn btn-outline-dark mb-3" name="submit" type="submit" id="myBtn" ONCLICK="are you sure" >Transfer</button>
<SCRIPT>
tion confirmFunction() {
    if (confirm("Do you want to Proceed") == true) {
        window.location='history.php' 
    } else {
        window.location='index.php'
        
    }func
}
</SCRIPT>
            </div>
        </form>
        
        
    </div>    




    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

   
</body>

</html>