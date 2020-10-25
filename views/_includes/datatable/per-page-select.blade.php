<div class="input-group">
    <label class="input-group-text" for="perPage">@lang('Per page')</label>
    {{ form()->select('perPage', $perPageList, $perPage, ['arc:model' => 'perPage', 'class' => 'form-select']) }}
</div>
