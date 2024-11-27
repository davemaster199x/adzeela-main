<div id="editTitle_{{ $title->id }}" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h4 class="modal-title">Edit Title</h4>
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
            </div>
            <div class="modal-body text-left">
                <form action="{{ route('admin.validator.title.update', ['id'=>$title->id]) }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>Title Description</label>
                            <input type="text" class="form-control" name="title_description" required value="{{ $title->title_description }}">
                        </div>
                        <div class="form-group col-md-12 col-xs-12">
                            <label>POS</label>
                            @php
                                $opt = array(
                                    'preFix' => 'preFix',
                                    'postFix' => 'postFix'
                                );
                            @endphp
                            {{ Form::select('pos', $opt, $title->pos, array('class' => 'form-control')) }}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-xs-12">
                            <div class="clearfix text-right mt-3">
                                <button type="submit" class="btn btn-success">Update Title</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>