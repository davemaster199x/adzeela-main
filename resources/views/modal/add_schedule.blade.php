<div id="addSchedule" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Add Schedule</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body text-left">
                <form method="post" class="add_schedule_form">
                    @csrf
                    <input type="hidden" class="as_id" value="{{ $lead->id }}" />
                    <input type="hidden" class="as_assign_id" value="{{ $assign->caller_id }}" />
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Date</label>
                            <input type="text" class="date form-control as_date" name="date">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Time</label>
                            <input type="text" class="time form-control as_time" name="time">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button type="button" class="btn btn-success add_schedule">Add Schedule</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>