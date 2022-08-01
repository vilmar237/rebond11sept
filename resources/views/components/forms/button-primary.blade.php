<button type="button" @if ($disabled) disabled @endif {{ $attributes->merge(['class' => 'btn-primary rounded f-14 p-2']) }}>
    @if ($icon != '')
        
    @endif
    {{ $slot }}
</button>

@include('sections.password-autocomplete-hide')
