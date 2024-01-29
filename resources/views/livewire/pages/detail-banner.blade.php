<div>
    <div class="detail-wrapper">
        <div class="image-wrapper" wire:ignore>
            <img class="w-100" src="{{ \App\CPU\Helpers::getBackendUrl($banner['image']) }}" alt="">
        </div>
        <div class="detail-description p-2">
            <div class="font-description">
                {{ $banner['name'] }}
            </div>
            <div class="font-content mt-2">
                {{ $banner['detail'] }}
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>

</script>
@endpush