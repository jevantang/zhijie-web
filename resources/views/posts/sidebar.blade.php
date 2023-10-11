<div class="d-none d-lg-block">
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-lg-0 mb-3 mx-3 mx-lg-0">
        <span class="navbar-brand mb-0 h1 d-lg-none ms-3">{{ fs_db_config('post_name') }}</span>
        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#fresnsMenus" aria-controls="fresnsMenus" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-signpost-2"></i>
        </button>
        <div class="collapse navbar-collapse list-group mt-2 mt-lg-0" id="fresnsMenus">
            {{-- Post Home --}}
            @if (fs_db_config('menu_post_status'))
                <a href="{{ fs_route(route('fresns.post.index')) }}" class="list-group-item list-group-item-action {{ Route::is('fresns.post.index') ? 'active' : '' }}
                    @if (request()->url() === rtrim(fs_route(route('fresns.home')), '/')) active @endif">
                    <img class="img-fluid" src="/assets/ZhijieWeb/images/menu-post-home.png" loading="lazy" width="36" height="36">
                    {{ fs_db_config('menu_post_name') }}
                </a>
            @endif

            {{-- Post List by Follow --}}
            @if (fs_api_config('view_posts_by_follow_object'))
                <a href="{{ fs_route(route('fresns.follow.all.posts')) }}" class="list-group-item list-group-item-action {{ Route::is('fresns.follow.all.posts') ? 'active' : '' }}">
                    <img class="img-fluid" src="/assets/ZhijieWeb/images/menu-following.png" loading="lazy" width="36" height="36">
                    {{ fs_db_config('menu_follow_all_posts') }}
                </a>
            @endif
        </div>
    </nav>

    <div class="d-grid gap-2 mb-3">
        @if (fs_db_config('zhijie_quick_publish'))
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#createModal" @if (!fs_user()->check()) disabled @endif><i class="bi bi-plus-circle-dotted"></i> {{ fs_db_config('publish_post_name') }}</button>
        @else
            <a class="btn btn-outline-primary" role="button" href="{{ fs_route(route('fresns.editor.index', ['type' => 'post'])) }}"><i class="bi bi-plus-circle-dotted"></i> {{ fs_db_config('publish_post_name') }}</a>
        @endif
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header fw-medium">{{ fs_db_config('menu_post_list_name') }}</div>
        <ul class="list-group list-group-flush">
            @foreach(fs_index_list('posts') as $topPost)
                <a href="{{ fs_route(route('fresns.post.detail', ['pid' => $topPost['pid']])) }}" class="list-group-item list-group-item-action">
                    {{ $topPost['title'] ?? Str::limit(strip_tags($topPost['content']), 80) }}
                </a>
            @endforeach
        </ul>
    </div>
</div>
