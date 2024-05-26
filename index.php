<?php
session_start();
include 'conn.php';
include 'assets/func.php';
$all_user_data_array=[];
$grand_total=0;



$fetch_user_data12=mysqli_query($conn,"SELECT * FROM `logindata` WHERE `access`='1'");
while($user_data_row=mysqli_fetch_assoc($fetch_user_data12))
{
    array_push($all_user_data_array,$user_data_row);
}
// var_dump($all_user_data_array);
// exit();



// session_unset();
if (!isset($_SESSION['email'])) {
    echo '<script> window.location.href = "login.php";</script>';
}

// if (!isset($_SESSION['email'])) {
//     header('location: index.php');
// }
$sql = "SELECT * FROM `rasan` ORDER BY rasan_id DESC";
$result = mysqli_query($conn, $sql);
$sno = 1;
$profile_fetch_sql = "SELECT `log_id`,`fname`, `img`,`access` FROM `logindata` WHERE email='$_SESSION[email]'";
$pr_fetch_result = mysqli_query($conn, $profile_fetch_sql);
$profile_data_row = mysqli_fetch_assoc($pr_fetch_result);
if ($profile_data_row['access'] == 0) {
    // header('location: login.php');
    echo '<script> window.location.href = "login.php";</script>';
}

if (isset($_POST['add_rasan'])) {
    $rasan = $_POST['rasan'];
    $price = $_POST['price'];
    $user = $profile_data_row['log_id'];
    date_default_timezone_set('Asia/Kolkata');
    $date = date('d-m-y || h:i:a');
    // $date=date("h:i:sa").date("d/m/Y");
    echo $rasan;

    // $filename = $_FILES['img']['name'];
    // $tempname = $_FILES['img']['tmp_name'];
    // $folder = "image/" . $filename;
    // move_uploaded_file($tempname, $folder);
    $sql = "INSERT INTO `rasan` (`rasan_data`, `price`, `add_date`, `add_by`) VALUES ('$rasan','$price','$date','$user')";

    mysqli_query($conn, $sql);
    // mysqli_close($conn);
    // header("Location: index.php");
    echo '<script> window.location.href = "index.php";</script>';
    // exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== BOXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css">

    <title>Er-rona</title>

    <style>
        #home {
            margin-top: 55px;
        }

        .action {
            text-align: center;
            margin-bottom: 30px;
        }

        .action__upload-btn {
            border: 0;
            width: 150px;
            color: #fff;
        }

        .action__upload-btn:hover {
            cursor: pointer;
        }

        .action__hiddenField {
            display: none;
        }

        .profile-image {
            border: 1px solid #ccc;
            width: 15 px;
            margin: 0 auto;
            /* z-index: 2; */
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .profile-image__item {
            width: 100%;
            display: block;
        }

        .edit_img_box {
            position: relative;
        }

        .edit_img_box .icon-box {
            z-index: 3;
            position: absolute;
            top: 2px;
            right: 160px;
            background-color: white;
            border-radius: 8px;
            padding: 2px 4px;
            border: 1px solid black;
        }

        body {
            background-color: #E9E9E9;
        }

        #home {
            margin-top: 100px !important;
        }
       
    </style>

</head>

<body>
    <!--=============== HEADER ===============-->
    <header class="header" id="header">
        <nav class="nav container">
            <div class="mx-2">
                <h3 class="nav__logo" style="text-transform: capitalize;"><?php echo $profile_data_row['fname']; ?></h3>
            </div>

            <div class="nav__menu" id="nav-menu">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="ad_rasan_btn addbtn_raise"><i class="fa fa-plus" aria-hidden="true"></i></button>
                <ul class="nav__list" style="padding-left: 0px;">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">
                            <i class='bx bx-home-alt nav__icon'></i>
                            <span class="nav__name">Rasan</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#about" class="nav__link">
                            <i class='bx bx-user nav__icon'></i>
                            <span class="nav__name">Members</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#hisaaab" class="nav__link">
                            <i class='bx bx-book-alt nav__icon'></i>
                            <span class="nav__name">Hisaab</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#portfolio" class="nav__link">
                            <i class='bx bx-briefcase-alt nav__icon'></i>
                            <span class="nav__name">Portfolio</span>
                        </a>
                    </li>

                    <li class="nav__item">
                        <a href="#contactme" class="nav__link">
                            <i class='bx bx-message-square-detail nav__icon'></i>
                            <span class="nav__name">Contactme</span>
                        </a>
                    </li>
                    <!-- <li class="nav__item">
                        <a href="#contactme" class="nav__link">
                            
                            <img style="width:40px; height:40px; object-fit:cover;" src="image/<?php echo $profile_data_row['img']; ?>" alt="img" class="nav__img1">
                        </a>
                    </li> -->
                </ul>
            </div>

            <img style="width:40px; height:40px; object-fit:cover;" src="image/<?php echo $profile_data_row['img']; ?>" alt="img" class="nav__img">
        </nav>
    </header>

    <main>
        <!--=============== HOME ===============-->
        <section id="home">
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add your Rasan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Rasan</label>
                                    <input type="text" name="rasan" class="form-control" id="exampleInputEmail1" required>
                                    <div id="emailHelp" class="form-text">use comma in between multiple data
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Total Price</label>
                                    <input type="number" name="price" class="form-control" id="exampleInputPassword1" required>
                                </div>
                                <!--<div class="mb-3 edit_img_box">-->

                                <!--    <div class="icon-box">-->
                                <!--        <i class="fa fa-pencil-square-o" aria-hidden="true">Add img</i>-->
                                <!--    </div>-->
                                <!--    <div class="action">-->
                                <!--        <input type="file" capture="environment"  name="img" id="img-selector" class="action__hiddenField" required>-->
                                <!--    </div>-->
                                <!--    <div class="profile-image action__upload-btn">-->
                                <!--        <img class="profile-image__item"  src="assets/img/dummy.jpg" alt="img">-->
                                <!--    </div>-->
                                <!--</div>-->


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" name="add_rasan">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <h2 class="section__title">Home</h2> -->
            <div class="container">
                <div class="row desktop_add_btn_row">
                    <div class="text-end my-2">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="ad_rasan_btn2 addbtn_raise"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>

                <div class="card mb-4">

                    <div class="card-header">
                        <i class="fa fa-table" aria-hidden="true"></i>
                        Rasan Table
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Sno</th>
                                    <th>Rasan</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Paid by</th>


                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sno</th>
                                    <th>Rasan</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Paid by</th>

                                </tr>
                            </tfoot>
                            <tbody>

                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $data=getuser($row['add_by']);
                                ?>
                                    <tr>
                                        <td><?php echo $sno; ?></td>
                                        <td><?php echo $row['rasan_data']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><?php echo $row['add_date']; ?></td>
                                        <td><?php echo $data['fname']; ?></td>
                                        <!--<td>-->
                                        <!--<img style="max-width: 50px; max-height:50px; object-fit:cover;" src="image/<?php echo $row['pr_img']; ?>" alt="img">-->
                                        <!--</td>-->
                                    </tr>
                                <?php $sno++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!--=============== ABOUT ===============-->
        <section class=" section section__height" id="about">
            <div class="container">
                <div class="row user_heading">
                    <h2>All Members</h2>
                </div>
                <?php
                $sql_fetch_user = mysqli_query($conn, "SELECT * FROM `logindata` WHERE `access`='1'");
                while ($alluser_data = mysqli_fetch_assoc($sql_fetch_user)) {
                ?>
                    <div class="row mb-4">
                        <div class="col-8">
                            <h5><?php echo $alluser_data['fname'] . " " . $alluser_data['lname']; ?></h5>
                        </div>
                        <div class="col-4  text-end"><img style="width:50px; height:50px; object-fit:cover;" src="image/<?php echo $alluser_data['img']; ?>" alt="img"></div>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>

        <!--=============== SKILLS ===============-->
        <section class=" section section__height" id="hisaaab">
            <div class="container">
                <div class="row">
                    <div class="col-12 table_div mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Member Name</th>
                                    <th scope="col">Total spent</th>
                                    <th scope="col">You Pay</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($all_user_data_array as $user)
                                {
                                    $total_pay=0;
                                    $sql_to_fetch_total_pay=mysqli_query($conn,"SELECT `price` FROM `rasan` WHERE `add_by`='$user[log_id]'");
                                    while($row_total_pr=mysqli_fetch_assoc($sql_to_fetch_total_pay))
                                    {
                                        $total_pay+=$row_total_pr['price'];
                                    }
                                    $user_total = array("$user[log_id]"=>"$total_pay");
                                    $grand_total+=$total_pay;
                                ?>
                                <tr>
                                    <th scope="row">1</th>
                                    <th ><?php echo "$user[fname]$user[lname]";  ?></th>
                                    <td ><?php echo $total_pay; ?></td>
                                    <td >1</td>
                                </tr>
                                <?php 
                                
                                }
                                ?>
                                
                                <tr>
                                    <th scope="row">3</th>
                                    <td >Grant Total</td>
                                    <td><?php echo $grand_total; ?></td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!--=============== PORTFOLIO ===============-->
        <section class=" section section__height" id="portfolio">
            <h2 class="section__title">Coming soon</h2>
        </section>

        <!--=============== CONTACTME ===============-->
        <section class=" section section__height" id="contactme">
            <h2 class="section__title">Coming soon</h2>
        </section>
    </main>


    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/datatables-simple-demo.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script>
        // No hacer caso a la línea del FileReader, como en el mago de oz con el tipo de la cortina :)
        const fr = new FileReader();

        // Caso a partir de aquí :)
        const uploadBtn = document.querySelector('.action__upload-btn');
        const fileField = document.querySelector('#img-selector');
        const profileImage = document.querySelector('.profile-image__item');

        function getImage(e) {
            var myFile = e.currentTarget.files[0];
            fr.addEventListener('load', writeImage);
            fr.readAsDataURL(myFile);
        }

        function writeImage() {
            profileImage.src = fr.result;
        }

        function fakeFileClick() {
            fileField.click();
        }

        fileField.addEventListener('change', getImage);
        uploadBtn.addEventListener('click', fakeFileClick);
    </script>
</body>

</html>