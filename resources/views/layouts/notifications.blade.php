<li class="dropdown notifications-menu">
    <!-- Menu toggle button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        {{--                            <span class="label label-warning">10</span>--}}
    </a>
    <ul class="dropdown-menu">
        <li class="header">Novedades</li>
        <li>
            <!-- Inner Menu: contains the notifications -->
            <ul class="menu">
                <li><!-- start notification -->
                    @foreach ($notification_titles as $title)
                        <a href="#">
                            {{--                                            <i class="fa fa-asterisk text-aqua"></i> Nuevo Layout--}}
                            <i class="fa fa-asterisk text-aqua"></i>{{ $title }}
                        </a>
                    @endforeach

                </li>
                <!-- end notification -->
            </ul>
        </li>
        {{--                            <li class="footer"><a href="#">View all</a></li>--}}
    </ul>
</li>
