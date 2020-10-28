<label {{ $attributes->merge(['for' => $for, 'class' => 'form-label font-weight-light text-uppercase text-muted']) }}>{{ $slot->isEmpty() ? $label : $slot }}</label>
