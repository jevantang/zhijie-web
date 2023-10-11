@extends('commons.fresns')

@php
    $title = $location['poi'] ? $location['poi'].' - ' : '';
@endphp

@section('title', $title.fs_db_config('menu_location_posts'))

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-lg-3">
                @include('posts.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-md-8 col-lg-6 pt-4 pt-lg-0">
                {{-- Location Info --}}
                <div class="alert alert-primary" role="alert">
                    <i class="bi bi-geo-alt-fill"></i> {{ $location['poi'] ?? $location['latitude'].' / '.$location['longitude'] }}
                </div>

                {{-- Switch Content --}}
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ fs_route(route('fresns.post.location', $encode)) }}">{{ fs_db_config('post_name') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ fs_route(route('fresns.comment.location', $encode)) }}">{{ fs_db_config('comment_name') }}</a>
                    </li>
                </ul>

                {{-- Post List --}}
                <div class="card clearfix" id="fresns-list-container">
                    @foreach($posts as $post)
                        @component('components.post.list', compact('post'))@endcomponent

                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="px-3 me-3 me-lg-0 mt-4 table-responsive d-none">
                    {{ $posts->links() }}
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-md-4 col-lg-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
