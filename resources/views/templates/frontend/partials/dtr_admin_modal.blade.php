<div class="modal fade" id="editAdminRemarksModal{{ $record->tme_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('dtr.saveAdminRemarks') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tme_id" value="{{ $record->tme_id }}">

            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Edit Admin Remarks</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- Admin Remarks --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Admin Remarks</label>
                        <input type="text" name="tme_admin_remarks" class="form-control"
                            value="{{ old('tme_admin_remarks', $record->tme_admin_remarks) }}">
                    </div>

                    {{-- Upload New Photo --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Attach New Photo (optional)</label>
                        <input type="file" name="tme_admin_photo" accept="image/*" class="form-control"
                            onchange="previewImage(this, 'preview_admin_{{ $record->tme_id }}')">
                    </div>

                    {{-- Existing Photo Filename (as link) --}}
                    @php
                        $adminPhoto = $record->tme_admin_photo ?? null;
                        $adminPhotoUrl = $adminPhoto ? asset('images/dtr/' . $adminPhoto) : null;
                        $adminPhotoPath = public_path('images/dtr/' . $adminPhoto);
                    @endphp

                    @if (!empty($adminPhoto) && file_exists($adminPhotoPath) && !is_dir($adminPhotoPath))
                        <div class="mb-3">
                            <label class="form-label text-muted">Current Photo:</label><br>
                            <a href="{{ $adminPhotoUrl }}" target="_blank"
                                class="text-decoration-underline text-info small">
                                {{ basename($adminPhoto) }}
                            </a>
                        </div>
                    @endif

                    {{-- Preview New Image (client-side) --}}
                    <div class="mb-3">
                        <label class="form-label text-muted">Preview New Image:</label>
                        <img id="preview_admin_{{ $record->tme_id }}" class="img-thumbnail d-none d-block mx-auto"
                            style="max-height: 120px;" alt="New Admin Photo Preview">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Remove full photo preview outside the modal --}}
{{-- Removed: old preview section showing uploaded admin photo --}}

<script>
    function previewImage(input, targetId) {
        const file = input.files?.[0];
        const preview = document.getElementById(targetId);

        if (!file || !file.type.startsWith('image/') || !preview) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const img = new Image();
            img.onload = function () {
                const canvas = document.createElement('canvas');
                const MAX_WIDTH = 500;
                const scale = MAX_WIDTH / img.width;

                canvas.width = MAX_WIDTH;
                canvas.height = img.height * scale;

                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                const compressed = canvas.toDataURL('image/jpeg', 0.8);
                preview.src = compressed;
                preview.classList.remove('d-none');
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>