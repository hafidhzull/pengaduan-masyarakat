<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

</head>

<body class="bg-gradient-white">



        <!-- Outer Row -->
        <div class="justify-content-center">

            <div class="w-100">

                <div class="vh-100" style="background-color: #39b3b8;">
                    <div class="container  h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-12 col-md-8 col-lg-6 col-xl-6">
                                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                    <div class="card-body p-5 text-center">
                                        
                                        <h1 class="h4 text-light-900 mb-4">Login Admin</h1>
                                        
                                   
                                    </div>

                                    <div>
                                        <?= $this->session->flashdata('message'); ?>
                                    </div>
                                    <div class="card-body">
                                        <form class="user" action="<?= base_url('C_zullauth/login_admin') ?>" method="post">

                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>

                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                                            </div>

                                            <button type="submit" class="btn btn-info btn-user btn-block">
                                                Masuk
                                            </button>

                                        </form>
                                    </div>
                                    <hr>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>