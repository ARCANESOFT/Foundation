@error($name, $bag)
<span {{ $attributes->merge(['class' => 'invalid-feedback', 'role' => 'alert']) }}>{{ $slot->isEmpty() ? $message : $slot }}</span>
@enderror
