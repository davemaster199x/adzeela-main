<div id="addTitle" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Add New Title</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.validator.title.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Title Description</label>
                            <input type="text" class="form-control" name="title_description" required>
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>POS</label>
                            <select name="pos" class="form-control">
                                <option>-- Select POS --</option>
                                <option value="preFix">preFix</option>
                                <option value="postFix">postFix</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button type="submit" class="btn btn-success" id="addUserBtn">Add Title</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>