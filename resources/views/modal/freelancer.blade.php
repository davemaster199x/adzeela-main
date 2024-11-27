<div id="addFreelancer" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Add New Freelancer</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('freelance.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Full Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>E-mail Address</label> <span class="emailchecker"></span>
                            <input type="email" class="form-control" name="email" id="emailchecker" required>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Hire Date</label>
                            <input type="text" class="form-control date" name="hire_date" autocomplete="off"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button type="submit" class="btn btn-success" id="addFreelancerBtn">Add Freelancer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>