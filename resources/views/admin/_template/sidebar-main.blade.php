<aside class="main-sidebar">
    <section class="sidebar">
        @if (false)
            {{-- Sidebar user panel --}}
            <div class="user-panel">
                <div class="pull-left image">
                    {{ html()->image('http://placehold.it/160x160', 'User Image', ['class' => 'img-circle']) }}
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <a href="#">
                        <i class="fa fa-circle text-success"></i> Online
                    </a>
                </div>
            </div>
            {{-- Search form --}}
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    {{ Form::text('q', old('q', null), ['class' => 'form-control', 'placeholder' => 'Search&hellip;']) }}
                    <div class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        @endif

        {{ sidebar()->render('foundation::admin._includes.sidebar') }}
    </section>
</aside>
