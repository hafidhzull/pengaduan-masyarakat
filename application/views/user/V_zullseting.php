<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>

    </div>

    <div>
        <!-- Content Column -->
        <div class="col-lg mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile Account</h6>
                </div>
                <div class="card-body">

                    <table class="table">

                        <tr>
                            <td>
                                <h6>Nama</h6>
                            </td>
                            <td>
                                <h6>: <?= $user['nama'] ?></h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Username</h6>
                            </td>
                            <td>
                                <h6>: <?= $user['username'] ?></h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>NIK</h6>
                            </td>
                            <td>
                                <h6>: <?= $user['nik'] ?></h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6>Nomor Telepon</h6>
                            </td>
                            <td>
                                <h6>: <?= $user['telpon'] ?></h6>
                            </td>
                        </tr>


                        <td>
                            <br>
                            <!-- Button Edit Profile  -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#setting">
                                Edit Profile
                            </button>


                            <!-- Edit Profile -->
                            <div class="modal fade" id="setting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="<?= base_url('C_zulluser/editprofile') ?>">
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label for="exampleInputEmail1">Nama</label>
                                                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>">
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="exampleInputPassword1">NIK</label>
                                                        <input type="text" class="form-control" id="nik" name="nik" value="<?= $user['nik'] ?>">
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="exampleInputEmail1">Username</label>
                                                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="exampleInputEmail1">Nomor telepon</label>
                                                        <input type="text" class="form-control" id="telepon" name="telpon" value="<?= $user['telpon'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </td>
                        <td> </td>


                    </table>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Reset Password
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="<?= base_url('C_zulluser/resetPassword') ?>">

                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password1" name="password1">
                                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="password2" name="password2">
                                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>') ?>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>

                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <!-- /.container-fluid -->

</div>
</div>
<!-- End of Main Content -->