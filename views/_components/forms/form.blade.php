<?php
/**
 * @var  string                                 $method
 * @var  string                                 $action
 * @var  string                                 $hasFiles
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 */
?>
<form method="{{ $method !== 'GET' ? 'POST' : 'GET' }}"
      action="{{ $action }}" {!! $hasFiles ? 'enctype="multipart/form-data"' : '' !!} {{ $attributes }}>
    @csrf
    @method($method)

    {{ $slot }}
</form>
