<div id="updateSchedule_{{ $schedule->id }}" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Update Schedule</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body text-left">
                <form method="post" class="update_schedule_form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Date</label>
                            <input type="text" class="date form-control sc_date" name="date" value="{{ $schedule->date }}">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Time</label>
                            <input type="text" class="time form-control sc_time" name="date" value="{{ $schedule->time }}">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button data-id="{{ $schedule->id }}" type="button" class="btn btn-success update_schedule">Update Schedule</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>