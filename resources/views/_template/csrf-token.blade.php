<?php $token = csrf_token() ?>
<meta name="csrf-token" content="{{ $token }}">
<script>
    window.App = {!! json_encode(['csrfToken' => $token]) !!}
</script>
