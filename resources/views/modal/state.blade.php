<div id="addState" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Add New State</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.validator.state.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="country_id" value="{{ $country->id }}" />
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Name</label>
                            <input type="text" class="form-control" name="state_name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button type="submit" class="btn btn-success" id="addUserBtn">Add State</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>