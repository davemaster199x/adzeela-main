<div id="addCompany" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Add New Company</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('company.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Company Name</label>
                            <input type="text" class="form-control" name="company_name" required>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Industry</label>
                            <input type="text" class="form-control" name="industry" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Number of Employees</label>
                            <input type="text" class="form-control" name="num_of_employees" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Company Site</label>
                            <input type="text" class="form-control companySite" name="company_site" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Short Company Site</label>
                            <input type="text" class="form-control shortCompanySite" name="short_company_site" readonly>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Company Phone 1</label>
                            <input type="text" class="form-control" name="company_phone" required>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Company Phone 2</label>
                            <input type="text" class="form-control" name="company_phone_2" required>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>LinkedIn URL</label>
                            <input type="text" class="form-control" name="linkedin_url" required>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Street Address</label>
                            <input type="text" class="form-control" name="street_address" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button type="submit" class="btn btn-success">Add Company</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>