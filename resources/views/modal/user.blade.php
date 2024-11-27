<div id="addUser" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Add New User</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.user.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <h5>Basic Information</h5>
                            <hr>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>E-mail Address</label> <span class="emailcheck"></span>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <h5>Account Information</h5>
                            <hr>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Username</label> <span class="usernamecheck"></span>
                            <input type="text" class="form-control" id="username" name="username" required />
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Password</label> <span class="passwordconfirm"></span>
                            <input type="password" class="form-control" name="password" id="pass" required minlength="8"/>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPass" minlength="8"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button type="submit" class="btn btn-success" id="addUserBtn">Add User</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>