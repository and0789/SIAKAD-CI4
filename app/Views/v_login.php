<div class="login-box">
    <div class="login-logo">
        <a href="<?= base_url('auth') ?>"><b>Login</b>SIAKAD</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Silahkan Login</p>

        <form action="../../index2.html" method="post">
            <div class="form-group has-feedback">
                <input name="username" type="text" class="form-control" placeholder="Username">
                <span class="fa fa-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <select name="level" class="form-control">
                    <option value="">--Level Login--</option>
                    <option value="1">Admin</option>
                    <option value="2">Mahasiswa</option>
                    <option value="3">Dosen</option>
                </select>
            </div>
            <div class="form-group has-feedback">
                <input name="password" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">

                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>



    </div>