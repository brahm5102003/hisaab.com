<?php
include 'conn.php';
if (isset($_POST['submit_data'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = ($_POST['pass']);
    $filename = $_FILES['img']['name'];
    $tempname = $_FILES['img']['tmp_name'];
    $folder = "image/" . $filename;
    move_uploaded_file($tempname, $folder);
    // $sql="INSERT INTO `logindata`( `fname`, `lname`, `email`, `pass`) VALUES ('$fname','$lname','$email','$pass')";
    $sql = "INSERT INTO `logindata`(`fname`, `lname`, `email`, `pass`,`img`) VALUES ('$fname','$lname','$email','$pass','$filename')";

    if (mysqli_query($conn, $sql)) {
        // header('Location: login.php');
         echo'<script> window.location.href = "login.php";</script>';
    } else {
        echo "somthing went wrong";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" onsubmit="return validForm()" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <div class="col-12 mb-3 mb-md-0">
                                            <input name="img" class="form-control" id="inputimg" type="file" required/>
                                            <label for="inputimg">Upload your img</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input name="fname" class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" />
                                                    <label for="inputFirstName">First name</label>
                                                    <span id="fnm" class="text-danger">
                                                        <p></p>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input name="lname" class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" />
                                                    <label for="inputLastName">Last name</label>
                                                    <span class="text-danger">
                                                        <p id="lnm"></p>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input name="email" class="form-control" id="inputEmail" type="email" placeholder="name@example.com" autocomplete="off" />
                                            <label for="inputEmail">Email address</label>
                                            <span class="text-danger">
                                                <p id="eml"></p>
                                            </span>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="inputPassword" type="password" placeholder="Create a password" autocomplete="off" />
                                                    <label for="inputPassword">Password</label>
                                                    <span class="text-danger">
                                                        <p id="ps"></p>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input name="pass" class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password" autocomplete="off" />
                                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                                    <span class="text-danger">
                                                        <p id="cps"></p>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button id="register_btn" class="btn btn-primary btn-block" name="submit_data" type="submit">Create Account</button></div>

                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


    <!-- js for form validation -->
    <!-- <script>
   function valid()
   {
    var emailid=document.getElementById("inputEmail").value;

   }
</script> -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



    <script>
        function validForm() {
            var firstname = document.getElementById("inputFirstName").value;
            var lastname = document.getElementById("inputLastName").value;
            var email = document.getElementById("inputEmail").value;
            var psw = document.getElementById("inputPassword").value;
            var cpsw = document.getElementById("inputPasswordConfirm").value;
            const spchar = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
            const emlsymble = /[`!#$%^&*()_+\-=\[\]{};':"\\|,<>\/?~]/;
            document.getElementById("fnm").innerHTML = "";
            document.getElementById("lnm").innerHTML = "";
            document.getElementById("eml").innerHTML = "";
            document.getElementById("ps").innerHTML = "";
            document.getElementById("cps").innerHTML = "";

            if (firstname == "") {
                document.getElementById("fnm").innerHTML = "Please enter name*";
                return false;
            } else if (spchar.test(firstname)) {
                document.getElementById("fnm").innerHTML = "Only characters allows*";
                return false;
            } else if (!isNaN(firstname)) {
                document.getElementById("fnm").innerHTML = "Only characters allows*";
                return false;
            } else if (lastname == "") {
                document.getElementById("lnm").innerHTML = "Please enter name*";
                return false;
            } else if (spchar.test(lastname)) {
                document.getElementById("lnm").innerHTML = "Only characters allows*";
                return false;
            } else if (!isNaN(lastname)) {
                document.getElementById("lnm").innerHTML = "Only characters allows*";
                return false;
            } else if (email == "") {
                document.getElementById("eml").innerHTML = "Please enter email*";
                return false;
            } else if (emlsymble.test(email)) {
                document.getElementById("eml").innerHTML = "Email format is not valid*";
                return false;
            } else if (psw == "") {
                document.getElementById("ps").innerHTML = "Please enter passwword*";
                return false;
            } else if (psw.length < 5) {
                document.getElementById("ps").innerHTML = "Password lenght must be atlest 5 character*";
                return false;
            } else if (psw.length > 15) {
                document.getElementById("ps").innerHTML = "Password length is geater then 15 character*";
                return false;
            } else if (cpsw == "") {
                document.getElementById("cps").innerHTML = "Please enter passwword*";
                return false;
            } else if (psw != cpsw) {
                document.getElementById("cps").innerHTML = "Password does not match*";
                return false;
            }
        }

        $(document).ready(function() {
            $("#inputEmail").on("input", function() {
                var inputemail = $('#inputEmail').val();
                $.ajax({
                    type: "post",
                    url: "code.php",
                    data: {
                        'register_email_check': true,
                        'inputemail': inputemail,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#eml').html(data);
                        if (data.trim() !== '') {
                            $('#register_btn').prop('disabled', true);

                        } else {
                            $('#register_btn').prop('disabled', false);
                        }
                    }
                });
            });
        });
    </script>


</body>

</html>