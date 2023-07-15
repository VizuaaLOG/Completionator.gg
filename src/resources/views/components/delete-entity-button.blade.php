<form method="post"
      action="{{ $route }}"
      id="delete-form-{{ $uniqId }}"
>
    @method('DELETE')
    @csrf

    <button type="button"
            class="dropdown-item text-danger"
            data-bs-toggle="modal"
            data-bs-target="#delete-modal-{{ $uniqId }}">Delete
    </button>

    @push('modals')
        <div class="modal fade" tabindex="-1" id="delete-modal-{{ $uniqId }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Deleting this record cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No!</button>
                        <button type="button"
                                class="btn btn-danger"
                                onclick="document.getElementById('delete-form-{{ $uniqId }}').submit()"
                        >
                            Confirm Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endpush
</form>
