{{--remarks modal--}}
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{-- <form action="{{ route('task.store_remarks') }}" method="POST" enctype="multipart/form-data"> --}}
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="exampleModalLabel">Remarks</h3>

                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="task_status" id="task_status">
                        <input type="hidden" class="form-control" name="task_id" id="task_id">

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message (optional) :</label>
                            <textarea class="form-control" id="message-text" rows="7" name="remarks"></textarea>
                        </div>


                        <div class="form-group" id="file_upload" style="display: none;">
                            <label for="message-text" class="col-form-label">File: (optional) :</label>
                            <input type="file" class="form-control" name="file_upload">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Change Status">
                    </div>
                </form>

            </div>
        </div>
    </div>
