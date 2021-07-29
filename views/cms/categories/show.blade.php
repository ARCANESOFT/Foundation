@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="fas fa-fw fa-language"></i> @lang('Languages') <small>@lang("Language's details")</small>
@endsection

<?php /** @var  Arcanesoft\Foundation\Cms\Models\Language|mixed  $language */ ?>

@section('content')
    <div class="row g-4">
        <div class="col-lg-5">
            <x-arc:card>
                <x-arc:card-body class="d-flex justify-content-center">
                    <div class="avatar avatar-xxl rounded-circle bg-light">
                        <img src="{{ $language->avatar }}" alt="{{ $language->full_name }}">
                    </div>
                </x-arc:card-body>
                <x-arc:card-table>
                    <tbody>
                        <tr>
                            <x-arc:table-th label="Full Name"/>
                            <td class="text-end small">{{ $language->full_name }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Email"/>
                            <td class="text-end small">
                                {{ $language->email }}
                                @if ($language->hasVerifiedEmail())
                                    <i class="far fa-check-circle text-primary" data-toggle="tooltip" title="@lang('Verified')"></i>
                                @endif
                            </td>
                        </tr>
                        @if ($language->hasVerifiedEmail())
                        <tr>
                            <x-arc:table-th label="Email Verified at"/>
                            <td class="text-muted text-end small">{{ $language->email_verified_at }}</td>
                        </tr>
                        @endif
                        <tr>
                            <x-arc:table-th label="Status"/>
                            <td class="text-end">
                                @if ($language->isActive())
                                    <span class="badge border border-success text-muted">
                                        <i class="fas fa-fw fa-check text-success"></i> @lang('Activated')
                                    </span>
                                @else
                                    <span class="badge border border-secondary text-muted">
                                        <i class="fas fa-fw fa-ban text-secondary"></i> @lang('Deactivated')
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Last Activity"/>
                            <td class="text-end text-muted small">{{ $language->last_activity }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Created at"/>
                            <td class="text-end text-muted small">{{ $language->created_at }}</td>
                        </tr>
                        <tr>
                            <x-arc:table-th label="Updated at"/>
                            <td class="text-end text-muted small">{{ $language->updated_at }}</td>
                        </tr>
                        @if ($language->trashed())
                            <tr>
                                <x-arc:table-th label="Deleted at"/>
                                <td class="font-weight-light text-uppercase text-muted">@lang('Deleted at')</td>
                                <td class="text-end text-muted small">{{ $language->deleted_at }}</td>
                            </tr>
                        @endif
                    </tbody>
                </x-arc:card-table>
                <x-arc:card-footer class="d-flex justify-content-end">
                    {{-- UPDATE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('update'), [$language])
                        <a href="{{ route('admin::cms.languages.edit', [$language]) }}"
                           class="btn btn-sm btn-secondary">@lang('Edit')</a>
                    @endcan

                    {{-- IMPERSONATE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('impersonate'), [$language])
                        <a href="{{ route('admin::cms.languages.impersonate', [$language]) }}"
                           class="btn btn-sm btn-secondary ms-2">@lang('Impersonate')</a>
                    @endcan

                    {{-- ACTIVATE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('activate'), [$language])
                        <button class="btn btn-sm btn-secondary ms-2"
                                onclick="ARCANESOFT.emit('cms::languages.activate')">@lang('Activate')</button>
                    @endcan

                    {{-- DEACTIVATE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('deactivate'), [$language])
                        <button class="btn btn-sm btn-secondary ms-2"
                                onclick="ARCANESOFT.emit('cms::languages.deactivate')">@lang('Deactivate')</button>
                    @endcan

                    {{-- RESTORE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('restore'), [$language])
                        <button class="btn btn-sm btn-secondary ms-2"
                                onclick="ARCANESOFT.emit('cms::languages.restore')">@lang('Restore')</button>
                    @endcan

                    {{-- DELETE --}}
                    @can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('delete'), [$language])
                        <button class="btn btn-sm btn-danger ms-2"
                                onclick="ARCANESOFT.emit('cms::languages.delete')">@lang('Delete')</button>
                    @endcan
                </x-arc:card-footer>
            </x-arc:card>
        </div>
        <div class="col-lg-7">
            @if ($language->linkedAccounts->isNotEmpty())
                <x-arc:card>
                    <x-arc:card-header>@lang('Linked Accounts')</x-arc:card-header>
                    <x-arc:card-table>
                        <thead>
                            <tr>
                                <x-arc:table-th label="Provider"/>
                                <x-arc:table-th label="Created at" class="text-center"/>
                                <x-arc:table-th label="Updated at" class="text-center"/>
                                <x-arc:table-th label="Actions" class="text-end"/>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($language->linkedAccounts as $linkedAccount)
                            <tr>
                                <td>{{ $linkedAccount->name }}</td>
                                <td class="small text-muted text-center">{{ $linkedAccount->created_at }}</td>
                                <td class="small text-muted text-center">{{ $linkedAccount->updated_at }}</td>
                                <td class="text-end"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-arc:card-table>
                </x-arc:card>
            @endif
        </div>
    </div>
@endsection

{{-- ACIVATE MODAL --}}
@can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('activate'), [$language])
    @push('modals')
        <x-arc:modal-action
            type="activate"
            action="{{ route('admin::cms.languages.activate', [$language]) }}" method="PUT"
            title="Activate Language" body="Are you sure you want to activate this user ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let activateModal = components.modal('div#activate-modal')
            let activateForm  = components.form('form#activate-form')

            ARCANESOFT.on('cms::languages.activate', () => {
                activateModal.show()
            });

            activateForm.onSubmit('PUT', () => {
                activateModal.hide()
                location.reload()
            })
        </script>
    @endpush
@endcan

{{-- DEACIVATE MODAL --}}
@can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('deactivate'), [$language])
    @push('modals')
        <x-arc:modal-action
            type="deactivate"
            action="{{ route('admin::cms.languages.deactivate', [$language]) }}" method="PUT"
            title="Deactivate Language" body="Are you sure you want to deactivate this user ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let deactivateModal = components.modal('div#deactivate-modal')
            let deactivateForm  = components.form('form#deactivate-form')

            ARCANESOFT.on('cms::languages.deactivate', () => {
                deactivateModal.show()
            });

            deactivateForm.onSubmit('PUT', () => {
                deactivateModal.hide()
                location.reload()
            })
        </script>
    @endpush
@endcan

{{-- DELETE MODAL --}}
@can(Arcanesoft\Foundation\Cms\Policies\LanguagesPolicy::ability('delete'), [$language])
    @push('modals')
        <x-arc:modal-action
            type="delete"
            action="{{ route('admin::cms.languages.delete', [$language]) }}" method="DELETE"
            title="Delete Language"
            body="Are you sure you want to delete this user ?"
        />
    @endpush

    @push('scripts')
        <script defer>
            let deleteModal = components.modal('div#delete-modal')
            let deleteForm  = components.form('form#delete-form')

            ARCANESOFT.on('cms::languages.delete', () => {
                deleteModal.show()
            })

            deleteForm.onSubmit('DELETE', () => {
                deleteModal.hide()
                @if ($language->trashed())
                location.replace("{{ route('admin::cms.languages.index') }}")
                @else
                location.reload()
                @endif
            })
        </script>
    @endpush
@endcan

