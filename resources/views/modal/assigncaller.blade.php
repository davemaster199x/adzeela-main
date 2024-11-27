<div id="assignCaller_{{ $lead->id }}" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Assign Caller</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body text-left">
                <form action="{{ route('manage.assign.caller') }}" method="post">
                    @csrf
                    <input type="hidden" name="lead_id" value="{{ $lead->id }}" />
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Caller</label>
                            <select name="caller_id" class="form-control select2">
                                @foreach($callers as $caller)
                                <option value="{{ $caller->id }}">{{ $caller->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button type="submit" class="btn btn-success" id="addFreelancerBtn">Assign Caller</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>