<?php

$key     = notification()->getName();
$status  = session()->get("$key.status",  'info');
$title   = session()->get("$key.title",   'Notification !');
$message = session()->get("$key.message", 'This is an info notification !');

switch ($status) {
    case 'success':
        $status = 'success';
        $icon   = 'fa fa-check';
        break;

    case 'danger':
        $status = 'danger';
        $icon   = 'fa fa-ban';
        break;

    case 'warning':
        $status = 'warning';
        $icon   = 'fa fa-warning';
        break;

    case 'info':
    default:
        $status = 'info';
        $icon   = 'fa fa-info';
        break;
}
?>

<div class="alert alert-dismissible alert-{{ $status }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon {{ $icon }}"></i> {{ $title }}</h4>
    {{ $message }}
</div>

