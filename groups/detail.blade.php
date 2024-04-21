@extends('commons.fresns')

@section('title', $items['title'] ?? $group['name'])
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? $group['description'])

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm mt-4 mt-lg-0">
                    @component('components.group.detail', compact('group'))@endcomponent
                </div>

                <div class="d-none d-lg-block">
                    <div class="d-grid gap-2 mt-4">
                        @if (fs_config('zhijie_quick_publish'))
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#createModal" @if (!fs_user()->check()) disabled @endif><i class="bi bi-plus-circle-dotted"></i> {{ fs_config('publish_post_name') }}</button>
                        @else
                            <a class="btn btn-outline-primary" role="button" href="{{ route('fresns.editor.post') }}"><i class="bi bi-plus-circle-dotted"></i> {{ fs_config('publish_post_name') }}</a>
                        @endif
                    </div>
                </div>

                {{-- extensions --}}
                <div class="clearfix mb-4">
                    @foreach($items['extensions'] as $extension)
                        <div class="float-start mb-3" style="width:20%">
                            <a class="text-decoration-none" data-bs-toggle="modal" href="#fresnsModal"
                                data-title="{{ $extension['name'] }}"
                                data-url="{{ $extension['appUrl'] }}"
                                data-post-message-key="fresnsGroupExtension">
                                <div class="position-relative mx-auto" style="width:52px">
                                    <img src="{{ $extension['icon'] }}" loading="lazy" class="rounded" height="52">
                                    @if ($extension['badgeType'])
                                        <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1">
                                            {{ $extension['badgeType'] == 1 ? '' : $extension['badgeValue'] }}
                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    @endif
                                </div>
                                <p class="mt-1 mb-0 fs-7 text-center text-nowrap">{{ $extension['name'] }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Middle --}}
            <div class="col-md-8 col-lg-6">
                {{-- Sticky Posts --}}
                @if (fs_sticky_posts($group['gid']))
                    <div class="list-group mb-3">
                        @foreach(fs_sticky_posts($group['gid']) as $sticky)
                            @component('components.post.sticky', compact('sticky'))@endcomponent
                        @endforeach
                    </div>
                @endif

                {{-- Post List --}}
                <div class="clearfix">
                    {{-- Can View Content --}}
                    @if ($group['canViewContent'] && $type == 'posts')
                        {{-- List --}}
                        <div class="clearfix" id="fresns-list-container">
                            @foreach($posts as $post)
                                @component('components.post.list', compact('post'))@endcomponent
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        @if ($posts->isEmpty())
                            {{-- No Post --}}
                            <div class="text-center my-5 text-muted fs-7"><i class="bi bi-card-list"></i> {{ fs_lang('listEmpty') }}</div>
                        @else
                            {{-- Pagination --}}
                            <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                                {{ $posts->links() }}
                            </div>

                            {{-- Ajax Footer --}}
                            @include('commons.ajax-footer')
                        @endif
                    @else
                        <div class="text-center py-5 text-danger">
                            <i class="bi bi-info-circle"></i> {{ fs_lang('contentGroupTip') }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-md-4 col-lg-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
