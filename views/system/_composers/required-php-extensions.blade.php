<div class="card card-borderless shadow-sm">
    <div class="card-header px-2 font-weight-light text-uppercase text-muted">
        @lang('Required PHP Extensions')
    </div>
    <table class="table table-borderless mb-0">
        @foreach($requiredPhpExtensions as $extension => $loaded)
        <tr>
            <td class="text-monospace text-muted small">{{ $extension }}</td>
            <td class="text-right">
                @if ($loaded)
                    <span class="badge border border-success text-success">
                        <i class="fas fa-fw fa-check"></i>
                    </span>
                @else
                    <span class="badge border border-danger text-danger">
                        <i class="fas fa-fw fa-times"></i>
                    </span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
</div>
