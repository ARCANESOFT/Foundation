<footer class="main-footer">
    <strong>{{ trans('foundation::generals.copyright', ['date' => date('Y'), 'name' => config('app.name')]) }}</strong>
    <div class="pull-right hidden-xs">
        <span class="label label-primary"><b>Version</b> {{ foundation()->version() }}</span>
    </div>
</footer>

