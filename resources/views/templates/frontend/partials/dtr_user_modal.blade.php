<div class="modal fade" id="editUserRemarksModal{{ $record->tme_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('dtr.saveUserRemarks') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tme_id" value="{{ $record->tme_id }}">

            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Edit Your Remarks</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    {{-- User Remarks --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Your Remarks</label>
                        <input type="text" name="tme_remarks" class="form-control"
                            value="{{ old('tme_remarks', $record->tme_remarks) }}">
                    </div>

                    {{-- Upload --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Attach New Photo (optional)</label>
                        <input type="file" name="tme_photo" accept="image/*" class="form-control"
                            onchange="previewImage(this, 'preview_user_{{ $record->tme_id }}')">
                    </div>

                    {{-- Current Image Filename (link) --}}
                    {{-- Current Image Preview and Filename --}}
                    @if (!empty($record->tme_photo))
                        <div class="mb-3">
                            <label class="form-label text-muted">Current Image:</label><br>

                            {{-- Image Preview --}}
                            <a href="{{ asset('images/dtr/' . $record->tme_photo) }}" target="_blank"
                                title="Click to view full image">
                                <img src="{{ asset('images/dtr/' . $record->tme_photo) }}" alt="Uploaded Photo"
                                    style="max-width: 120px; max-height: 100px; border: 1px solid #ddd; border-radius: 4px;">
                            </a>

                            {{-- Filename Link --}}
                            <div class="mt-1">
                                <a href="{{ asset('images/dtr/' . $record->tme_photo) }}" target="_blank"
                                    class="text-decoration-underline text-info small">
                                    {{ basename($record->tme_photo) }}
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- Preview New --}}
                    <div class="mb-3">
                        <label class="form-label text-muted">Preview New Image:</label>
                        <img id="preview_user_{{ $record->tme_id }}" class="img-thumbnail d-none d-block mx-auto"
                            style="max-height: 120px;" alt="New User Photo Preview">
                    </div>
                </div>

                {{-- Footer --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Image Preview Script --}}
<script>
    function previewImage(input, targetId) {
        const file = input.files ? input.files[0] : input;
        const preview = document.getElementById(targetId);

        if (!file || !preview || !file.type.startsWith('image/')) return;

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