<input
    type="password"
    name="{{ $name }}"
    id="{{ $id }}"
    {{ $attributes->merge(['class' => 'form-control']) }}
/>
@error($name)
<span class="invalid-feedback" role="alert">{{ $message }}</span>
@enderror
