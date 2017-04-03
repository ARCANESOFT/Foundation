<div class="box">
    <div class="box-header with-border">
        <h2 class="box-title">PHP Extensions</h2>
    </div>
    <div class="box-body">
        @foreach(get_loaded_extensions() as $extension)
            <span class="label label-default">{{ $extension }}</span>
        @endforeach
    </div>
</div>
