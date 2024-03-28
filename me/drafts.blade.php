@extends('commons.fresns')

@section('title', fs_config('channel_me_drafts_name'))

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-lg-3">
                @include('me.sidebar')
            </div>

            {{-- Draft List --}}
            <div class="col-md-8 col-lg-6 pt-4 pt-lg-0">
                <div class="card">
                    {{-- Menus --}}
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            {{-- posts --}}
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'post') active @endif" href="{{ fs_route(route('fresns.me.drafts', ['type' => 'posts'])) }}">
                                    {{ fs_config('post_name') }}

                                    @if (fs_user_overview('draftCount.posts') > 0)
                                        <span class="badge bg-danger">{{ fs_user_overview('draftCount.posts') }}</span>
                                    @endif
                                </a>
                            </li>
                            {{-- comments --}}
                            <li class="nav-item">
                                <a class="nav-link @if ($type == 'comment') active @endif" href="{{ fs_route(route('fresns.me.drafts', ['type' => 'comments'])) }}">
                                    {{ fs_config('comment_name') }}

                                    @if (fs_user_overview('draftCount.comments') > 0)
                                        <span class="badge bg-danger">{{ fs_user_overview('draftCount.comments') }}</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- Draft List --}}
                    <div class="card-body">
                        @component('components.editor.draft-list', [
                            'type' => $type,
                            'drafts' => $drafts,
                        ])@endcomponent
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
