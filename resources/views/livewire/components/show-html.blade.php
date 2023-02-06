<div>
    <div class="m-5 overflow-y-auto h-96 bg-gray-100 bg-opacity-70 p-5 rounded-md">
        <p class=" text-sm text-gray-600">
            {!! $html !!}
            <div id="htmlsignatures">
                {!! Str::replace('&nbsp;','<br>', $document->sign_html) !!}
            </div>
        </p>
    </div>
</div>

@push('js')
@endpush
