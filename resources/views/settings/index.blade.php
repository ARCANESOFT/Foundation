@section('header')
    <i class="fa fa-fw fa-wrench"></i> Settings <small>Generals</small>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="row">
                <div class="col-sm-6 col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="box-title">
                                <i class="fa fa-fw fa-gear"></i> System
                            </h2>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Base URL</th>
                                        <td>
                                            <span class="label label-primary">{{ config('app.url') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 150px;">Default Locale</th>
                                        <td>
                                            <span class="label label-primary">{{ strtoupper(config('app.locale')) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Timezone</th>
                                        <td>
                                            <span class="label label-primary">{{ config('app.timezone') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Debug Mode</th>
                                        <td>
                                            @if (config('app.debug', false))
                                                <span class="label label-warning">Enabled</span>
                                            @else
                                                <span class="label label-success">Disabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Maintenance Mode</th>
                                        <td>
                                            @if (app()->isDownForMaintenance())
                                                <span class="label label-warning">Enabled</span>
                                            @else
                                                <span class="label label-success">Disabled</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>ARCANESOFT</th>
                                        <td>
                                            <span class="label label-primary">version {{ foundation()->version() }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="box-title">
                                <i class="fa fa-fw fa-envelope"></i> Mail
                            </h2>
                        </div>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th style="width: 150px;">Driver</th>
                                        <td>
                                            <span class="label label-primary">
                                                {{ strtoupper(config('mail.driver')) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Host Address</th>
                                        <td>
                                            <span class="label label-primary">
                                                {{ strtoupper(config('mail.host')) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>PORT</th>
                                        <td>
                                            <span class="label label-primary">
                                                {{ strtoupper(config('mail.port')) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>From Address</th>
                                        <td>
                                            <span class="label label-primary">
                                                <?php
                                                $fromName  = config('mail.from.name');
                                                $fromEmail = config('mail.from.email');
                                                ?>
                                                {{ $fromName or 'null' }} - {{ $fromEmail or 'null' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Encryption</th>
                                        <td>
                                            <span class="label label-primary">
                                                {{ strtoupper(config('mail.encryption')) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @if (config('mail.driver') === 'sendmail')
                                        <tr>
                                            <th>Sendmail path</th>
                                            <td>
                                                <span class="label label-primary">{{ config('mail.sendmail') }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">
                        <i class="fa fa-fw fa-building"></i> Company details
                    </h2>
                    <div class="box-tools">
                        <a href="" class="btn btn-xs btn-warning" data-toggle="tooltip" data-original-title="Edit">
                            <i class="fa fa-fw fa-pencil"></i>
                        </a>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 100px;">Name</th>
                                <td>Company name</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>Company address</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>Company email</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>Company phone</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>Company mobile phone</td>
                            </tr>
                            <tr>
                                <th>Coordinate</th>
                                <td>Company geo coordinate</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
@endsection

@section('scripts')
@endsection
