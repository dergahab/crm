<div class="modal fade" id="detaleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detaleModalLabel">Task detal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="deatil-response">
                {{-- @include('admin.pages.task.inc.render') --}}
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-outline-secondary waves-effect waves-light"
                    data-bs-dismiss="modal"> <i class="fas fa-x"></i> Bağla </button>

            </div>
        </div>
    </div>
</div>