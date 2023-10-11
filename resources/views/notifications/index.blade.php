@extends('commons.fresns')

@section('title', fs_db_config('menu_notifications'))

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-lg-3">
                @include('account.sidebar')
            </div>

            {{-- Notification List --}}
            <div class="col-sm-9">
                <div class="card">
                    {{-- Menus --}}
                    @if (fs_db_config('zhijie_notifications', []))
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                {{-- all notifications --}}
                                <li class="nav-item">
                                    <a class="nav-link @if (empty($types)) active @endif" href="{{ fs_route(route('fresns.notifications.index')) }}">
                                        {{ fs_db_config('menu_notifications_all') }}
                                        @if (fs_user_panel('unreadNotifications.all') > 0)
                                            <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.all') }}</span>
                                        @endif
                                    </a>
                                </li>

                                {{-- system notifications --}}
                                @if (in_array('systems', fs_db_config('zhijie_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if ($types == 1) active @endif" href="{{ fs_route(route('fresns.notifications.index', ['types' => 1])) }}">
                                            {{ fs_db_config('menu_notifications_systems') }}
                                            @if (fs_user_panel('unreadNotifications.systems') > 0)
                                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.systems') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- recommend notifications --}}
                                @if (in_array('recommends', fs_db_config('zhijie_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if ($types == 2) active @endif" href="{{ fs_route(route('fresns.notifications.index', ['types' => 2])) }}">
                                            {{ fs_db_config('menu_notifications_recommends') }}
                                            @if (fs_user_panel('unreadNotifications.recommends') > 0)
                                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.recommends') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- like notifications --}}
                                @if (in_array('likes', fs_db_config('zhijie_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if ($types == 3) active @endif" href="{{ fs_route(route('fresns.notifications.index', ['types' => 3])) }}">
                                            {{ fs_db_config('menu_notifications_likes') }}
                                            @if (fs_user_panel('unreadNotifications.likes') > 0)
                                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.likes') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- dislike notifications --}}
                                @if (in_array('dislikes', fs_db_config('zhijie_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if ($types == 4) active @endif" href="{{ fs_route(route('fresns.notifications.index', ['types' => 4])) }}">
                                            {{ fs_db_config('menu_notifications_dislikes') }}
                                            @if (fs_user_panel('unreadNotifications.dislikes') > 0)
                                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.dislikes') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- follow notifications --}}
                                @if (in_array('follows', fs_db_config('zhijie_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if ($types == 5) active @endif" href="{{ fs_route(route('fresns.notifications.index', ['types' => 5])) }}">
                                            {{ fs_db_config('menu_notifications_follows') }}
                                            @if (fs_user_panel('unreadNotifications.follows') > 0)
                                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.follows') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- block notifications --}}
                                @if (in_array('blocks', fs_db_config('zhijie_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if ($types == 6) active @endif" href="{{ fs_route(route('fresns.notifications.index', ['types' => 6])) }}">
                                            {{ fs_db_config('menu_notifications_blocks') }}
                                            @if (fs_user_panel('unreadNotifications.blocks') > 0)
                                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.blocks') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- mention notifications --}}
                                @if (in_array('mentions', fs_db_config('zhijie_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if ($types == 7) active @endif" href="{{ fs_route(route('fresns.notifications.index', ['types' => 7])) }}">
                                            {{ fs_db_config('menu_notifications_mentions') }}
                                            @if (fs_user_panel('unreadNotifications.mentions') > 0)
                                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.mentions') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- comment notifications --}}
                                @if (in_array('comments', fs_db_config('zhijie_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if ($types == 8) active @endif" href="{{ fs_route(route('fresns.notifications.index', ['types' => 8])) }}">
                                            {{ fs_db_config('menu_notifications_comments') }}
                                            @if (fs_user_panel('unreadNotifications.comments') > 0)
                                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.comments') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif

                                {{-- quote notifications --}}
                                @if (in_array('quotes', fs_db_config('zhijie_notifications', [])))
                                    <li class="nav-item">
                                        <a class="nav-link @if ($types == 9) active @endif" href="{{ fs_route(route('fresns.notifications.index', ['types' => 9])) }}">
                                            {{ fs_db_config('menu_notifications_quotes') }}
                                            @if (fs_user_panel('unreadNotifications.quotes') > 0)
                                                <span class="badge bg-danger">{{ fs_user_panel('unreadNotifications.quotes') }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    @endif

                    {{-- List of notices --}}
                    <div class="card-body">
                        @if ($notifications->isEmpty())
                            {{-- No Notification --}}
                            <div class="text-center my-5 text-muted fs-7">
                                <i class="bi bi-chat-square"></i> {{ fs_lang('listEmpty') }}
                            </div>
                        @else
                            {{-- Read Button --}}
                            @if ($types)
                                <div class="border-bottom text-center py-3">
                                    <form class="api-request-form" action="{{ route('fresns.api.message.mark.as.read', ['type' => 'notification']) }}" method="put">
                                        @csrf
                                        <input type="hidden" name="type" value="all"/>
                                        <input type="hidden" name="notificationType" value="{{ $types }}"/>
                                        <input type="hidden" name="notificationIds" value=""/>
                                        <button class="btn btn-success btn-sm" type="submit">{{ fs_lang('notificationMarkAllAsRead') }}</button>
                                    </form>
                                </div>
                            @endif

                            {{-- Notification List --}}
                            <ul class="list-group list-group-flush border-bottom" id="notifications">
                                @foreach($notifications as $notification)
                                    @component('components.message.notification', compact('notification'))@endcomponent
                                @endforeach
                            </ul>

                            {{-- Notification List-Pagination --}}
                            <div class="my-3 table-responsive">
                                {{ $notifications->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#notifications > li').click(function (event) {
                event.preventDefault();

                const id = $(this).data('id');
                const type = $(this).data('type');
                const status = $(this).data('status');

                let targetUrl = $(event.target).attr('href');
                let tagName = $(event.target).prop('tagName');
                if (tagName == 'IMG' || tagName == 'DIV') {
                    tagName = 'A';
                    targetUrl = $(event.target).parent().attr('href');
                }

                console.log(id, type, targetUrl, tagName);

                if (status) {
                    if(targetUrl) {
                        window.location.href = targetUrl;
                    }
                    return;
                }

                $.ajax({
                    url: "{{ route('fresns.api.message.mark.as.read', ['type' => 'notification']) }}",
                    type: "PUT",
                    data: {
                        type: "choose",
                        notificationType: type,
                        notificationIds: id
                    },
                    success: (resp) => {
                        if (resp.code != 0) {
                            tips(resp.message, resp.code);
                        }

                        if (targetUrl) {
                            window.location.href = targetUrl;
                        }

                        $(this).find('#badge-' + id).remove();
                    },
                });
            });
        });
    </script>
@endpush
