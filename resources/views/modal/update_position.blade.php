<div id="updatePosition_{{ $position->id }}" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Update Position</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body text-left">
                <form method="post" class="update_position_form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Company</label>
                            {{ Form::select('company', $companies, $position->company_id, array('class' => 'form-control select2 company')) }}
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Position</label>
                            <input type="text" class="form-control position_name" name="position_name" value="{{ $position->position_name }}">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>From Date</label>
                            <input type="text" class="date form-control from_date" name="from_date" value="{{ $position->from_date }}" autocomplete="off">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>To Date</label>
                            <input type="text" class="date form-control to_date" name="to_date" value="{{ $position->to_date }}" autocomplete="off">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button data-id="{{ $position->id }}" type="button" class="btn btn-success update_position">Update Position</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>