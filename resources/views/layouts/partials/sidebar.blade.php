
@if (Auth::user())
    <aside class="main-sidebar">

        <section class="sidebar">

            <div class="user-panel">
                <div class="pull-left image">
                    <img src = "{{ getenv('FILES_STORAGE_SERVER') }}{{ Auth::user()->pic_url }}" class = "img-circle" alt = "{{ Auth::user()->first_name }}" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->first_name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('globals.online') }} ({{ trans('globals.roles.'.Auth::user()->role)  }})</a>
                </div>
            </div>

            <!-- search form (Optional) -->
            {{-- <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="{{ trans('globals.search') }}..."/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
                </div>
            </form> --}}
            <!-- /.search form -->

            <ul class="sidebar-menu">
                <li class="header">{{ trans('globals.menu_header') }}</li>

                <?php $menus = \Menu::sideBar(); ?>

                @foreach($menus as $menu)
                    
                    @if (\Menu::subMenu($menu['id'], $menus))

                        <li class="treeview">
                            <a href = "#" style="text-decoration:none">
                                <i class="{{ $menu['icon'] }}"></i>
                                <span>{{ $menu['text'] }}</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                @foreach(\Menu::subMenu($menu['id'], $menus) as $submenu)
                                    <li><a href="{{ $submenu['route'] }}"><i class="{{ $submenu['icon'] }}"></i> <span>{{ $submenu['text'] }}</span></a></li>
                                @endforeach
                            </ul>
                        </li>

                    @else
                        @if ($menu['parent_id'] == null)
                            <li @if (in_array(strtolower($menu['text']), \Request::segments())) class="active" @endif ><a href="{{ $menu['route'] }}"><i class="{{ $menu['icon'] }}"></i> <span>{{ $menu['text'] }}</span></a></li>
                        @endif
                    @endif 

                @endforeach

            </ul>
        </section>

    </aside>
@endif
