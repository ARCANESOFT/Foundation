@extends(arcanesoft\foundation()->template())

<?php /** @var  Arcanesoft\Foundation\Auth\Models\Permission[]|\Illuminate\Database\Eloquent\Collection  $permissions */ ?>

@section('page-title')
    <i class="fas fa-fw fa-user-tag"></i> @lang('Roles') <small>@lang('New Role')</small>
@endsection

@section('content')
    {{ form()->open(['route' => 'admin::auth.roles.store', 'method' => 'POST']) }}
        <div class="row g-4">
            <div class="col-md-4">
                {{-- ROLE --}}
                <div class="card card-borderless shadow-sm">
                    <div class="card-header">@lang('Role')</div>
                    <div class="card-body">
                        {{-- NAME --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">@lang('Name')</label>
                            {{ form()->text('name', old('name'), ['class' => 'form-control'.$errors->first('name', ' is-invalid'), 'required']) }}
                            @error('name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- DESCRIPTION --}}
                        <div>
                            <label for="description" class="form-label">@lang('Description')</label>
                            {{ form()->text('description', old('description'), ['class' => 'form-control'.$errors->first('description', ' is-invalid'), 'required']) }}
                            @error('description')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin::auth.roles.index') }}" class="btn btn-sm btn-light">@lang('Cancel')</a>
                        <button type="submit" class="btn btn-sm btn-primary">@lang('Save')</button>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                {{-- PERMISSIONS --}}
                <div class="card card-borderless shadow-sm">
                    <div class="card-header px-2">@lang('Permissions')</div>
                    <table class="table table-borderless table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="font-weight-light text-uppercase text-muted">#</th>
                                <th class="font-weight-light text-uppercase text-muted">@lang('Group')</th>
                                <th class="font-weight-light text-uppercase text-muted">@lang('Category')</th>
                                <th class="font-weight-light text-uppercase text-muted">@lang('Name')</th>
                                <th class="font-weight-light text-uppercase text-muted">@lang('Description')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <td>
                                    {{ form()->checkbox('permissions[]', $permission->getRouteKey(), in_array($permission->getRouteKey(), old('permissions', []))) }}
                                </td>
                                <td class="small">{{ $permission->group->name }}</td>
                                <td class="small">{{ $permission->category }}</td>
                                <td class="small">{{ $permission->name }}</td>
                                <td class="small">{{ $permission->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">@lang('The list is empty!')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    {{ form()->close() }}
@endsection
