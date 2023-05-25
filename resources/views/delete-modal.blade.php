<div class="modal fade" tabIndex="-1" id="delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">{{ $delete_title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>{{ $delete_message }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type='submit' class="btn btn-primary btn-sm">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>