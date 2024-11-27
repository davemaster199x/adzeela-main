<div id="addIndustry" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Add New Industry</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.validator.industry.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Industry Group</label>
                            <select name="industry_group" class="form-control">
                                <option>-- Select Group --</option>
                                <option value="Group A">Group A</option>
                                <option value="Group B">Group B</option>
                                <option value="Group C">Group C</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button type="submit" class="btn btn-success" id="addUserBtn">Add Industry</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>