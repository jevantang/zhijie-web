@extends('commons.fresns')

@section('title', $items['title'] ?? Str::limit(strip_tags($comment['content']), 40))
@section('keywords', $items['keywords'])
@section('description', $items['description'] ?? Str::limit(strip_tags($comment['content']), 140))

@section('content')
    <main class="container-xl">
        <div class="row mt-4 pt-5">
            {{-- Left Sidebar --}}
            <div class="col-lg-3">
                @include('posts.sidebar')
            </div>

            {{-- Middle --}}
            <div class="col-md-8 col-lg-6 pt-4 pt-lg-0">
                <div class="card shadow-sm mb-3">
                    @component('components.comment.detail', compact('comment'))@endcomponent
                </div>

                <article class="card clearfix" id="fresns-list-container">
                    <div class="card-header">
                        <h5 class="mb-0">{{ fs_db_config('comment_name') }}</h5>
                    </div>

                    @foreach($comments as $comment)
                        @component('components.comment.list', [
                            'comment' => $comment,
                            'detailLink' => false,
                            'sectionAuthorLiked' => true,
                        ])@endcomponent

                        <hr>
                    @endforeach
                </article>

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
