<div id="editIndustry_{{ $industry->id }}" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Update Industry</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body text-left">
                <form action="{{ route('admin.validator.industry.update', ['id'=>$industry->id]) }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required value="{{ $industry->name }}">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Industry Group</label>
                            @php
                                $opt = array(
                                    'Group A' => 'Group A',
                                    'Group B' => 'Group B',
                                    'Group C' => 'Group C'
                                );
                            @endphp
                            {{ Form::select('industry_group', $opt, $industry->industry_group, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button type="submit" class="btn btn-success">Update Industry</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>