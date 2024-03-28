@extends('commons.fresns')

@section('title', fs_config('channel_following_comments_name'))

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-lg-3">
                @include('posts.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-md-8 col-lg-6 pt-4 pt-lg-0">
                {{-- Comment List --}}
                <article class="card clearfix" id="fresns-list-container">
                    @foreach($comments as $comment)
                        @component('components.comment.list', [
                            'comment' => $comment,
                            'detailLink' => true,
                            'sectionAuthorLiked' => false,
                        ])@endcomponent

                        @if (! $loop->last)
                            <hr>
                        @endif
                    @endforeach
                </article>

                {{-- Pagination --}}
                <div class="my-3 table-responsive">
                    {{ $comments->links() }}
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="col-md-4 col-lg-3">
                @include('commons.sidebar')
            </div>
        </div>
    </main>
@endsection
