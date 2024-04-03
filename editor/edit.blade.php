@extends('commons.fresns')

@section('title', fs_lang('editor'))

@section('content')
    <div class="container-fluid">
        <div class="fresns-editor">
            <form action="{{ route('fresns.api.post', ['path' => "/api/fresns/v1/editor/{$type}/draft/{$draft['detail']['did']}"]) }}" method="post" id="fresns-editor">
                <input type="hidden" name="type" value="{{ $type ?? '' }}" />
                <input type="hidden" name="gid" id="editor-group-gid" value="{{ $draft['detail']['group']['gid'] ?? '' }}" />
                {{-- Tip: Publish Permissions --}}
                @if ($configs['publish']['limit']['status'] && $configs['publish']['limit']['isInTime'])
                    @component('components.editor.tip.publish', [
                        'publishConfig' => $configs['publish'],
                    ])@endcomponent
                @endif

                {{-- Tip: Edit Controls --}}
                @if ($draft['editControls']['isEditDraft'] && ! in_array($draft['detail']['state'], [2, 3]))
                    @component('components.editor.tip.edit', [
                        'editControls' => $draft['editControls'],
                    ])@endcomponent
                @endif

                {{-- Tip: Draft under review or published --}}
                @if (in_array($draft['detail']['state'], [2, 3]))
                    <div class="alert alert-warning" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> {{ $draft['detail']['state'] == 2 ? fs_lang('contentEditReviewTip') : fs_lang('contentEditPublishedTip') }}
                    </div>
                @endif

                {{-- Group --}}
                @if ($configs['editor']['group']['status'])
                    @component('components.editor.section.group', [
                        'groupConfig' => $configs['editor']['group'],
                        'did' => $draft['detail']['did'],
                        'group' => $draft['detail']['group'],
                    ])@endcomponent
                @endif

                {{-- Toolbar --}}
                @component('components.editor.section.toolbar', [
                    'type' => $type,
                    'did' => $draft['detail']['did'],
                    'editorConfig' => $configs['editor'],
                ])@endcomponent

                {{-- Content Start --}}
                <div class="editor-box p-3">
                    {{-- Title --}}
                    @if ($configs['editor']['title']['status'] || optional($draft['detail'])['title'])
                        @component('components.editor.section.title', [
                            'titleConfig' => $configs['editor']['title'],
                            'title' => $draft['detail']['title'] ?? '',
                        ])@endcomponent
                    @endif

                    {{-- Content --}}
                    <textarea class="form-control rounded-0 border-0 editor-content" name="content" id="content" rows="15" placeholder="{{ fs_lang('editorContent') }}">{{ $draft['detail']['content'] }}</textarea>

                    {{-- Files --}}
                    @component('components.editor.section.files', [
                        'files' => $draft['detail']['files'],
                    ])@endcomponent

                    {{-- Extends --}}
                    @component('components.editor.section.extends', [
                        'extends' => $draft['detail']['extends'],
                    ])@endcomponent

                    {{-- readConfig --}}
                    @if ($draft['detail']['permissions']['readConfig'] ?? null)
                        @component('components.editor.section.config-read', [
                            'type' => $type,
                            'did' => $draft['detail']['did'],
                            'readConfig' => $draft['detail']['permissions']['readConfig'],
                        ])@endcomponent
                    @endif

                    {{-- commentConfig --}}
                    @if ($draft['detail']['permissions']['commentConfig']['action'] ?? null)
                        @component('components.editor.section.config-action-button', [
                            'type' => $type,
                            'did' => $draft['detail']['did'],
                            'actionButton' => $draft['detail']['permissions']['commentConfig']['action'],
                        ])@endcomponent
                    @endif

                    {{-- associatedUserListConfig --}}
                    @if ($draft['detail']['permissions']['associatedUserListConfig'] ?? null)
                        @component('components.editor.section.config-associated-user-list', [
                            'type' => $type,
                            'did' => $draft['detail']['did'],
                            'associatedUserListConfig' => $draft['detail']['permissions']['associatedUserListConfig'],
                        ])@endcomponent
                    @endif

                    <hr>

                    {{-- Location and Anonymous: Start --}}
                    <div class="d-flex justify-content-between">
                        {{-- Location --}}
                        @if ($configs['editor']['location']['status'])
                            @component('components.editor.section.location', [
                                'type' => $type,
                                'did' => $draft['detail']['did'],
                                'locationConfig' => $configs['editor']['location'],
                                'locationInfo' => $draft['detail']['locationInfo'],
                                'geotag' => $draft['detail']['geotag'],
                            ])@endcomponent
                        @endif

                        {{-- Anonymous --}}
                        @if ($configs['editor']['anonymous'])
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="isAnonymous" value="1" id="isAnonymous" {{ $draft['detail']['isAnonymous'] ? 'checked' : '' }}>
                                <label class="form-check-label" for="isAnonymous">{{ fs_lang('editorAnonymous') }}</label>
                            </div>
                        @endif

                        {{-- Markdown --}}
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="isMarkdown" value="1" id="isMarkdown" {{ $draft['detail']['isMarkdown'] ? 'checked' : '' }}>
                            <label class="form-check-label" for="isMarkdown">{{ fs_lang('editorContentMarkdown') }}</label>
                        </div>
                    </div>
                    {{-- Location and Anonymous: End --}}
                </div>
                {{-- Content End --}}

                {{-- Button --}}
                <div class="editor-submit d-grid">
                    <button type="submit" class="btn btn-success btn-lg my-5 mx-3" {{ in_array($draft['detail']['state'], [2, 3]) ? 'disabled' : ''}}>
                        {{ fs_config("publish_{$type}_name") }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Upload Modal --}}
    <div class="modal fade" id="fresns-upload" tabindex="-1" aria-labelledby="fresns-upload" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ fs_lang('editorUploadTip') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="mt-2" method="post" id="upload-form" multiple="true" enctype="multipart/form-data">
                        <input type="hidden" name="usageType" @if ($type === 'post') value="postDraft" @elseif($type === "comment") value="commentDraft" @endif>
                        <input type="hidden" name="usageFsid" value="{{ $draft['detail']['did'] }}">
                        <input type="hidden" name="type">
                        <input class="form-control" type="file" id="formFile">
                        <label class="form-label mt-3 ms-1 text-secondary text-break fs-7 d-block">{{ fs_lang('editorUploadTipExtensions') }}: <span id="extensions"></span></label>
                        <label class="form-label mt-1 ms-1 text-secondary text-break fs-7 d-block">{{ fs_lang('editorUploadTipMaxSize') }}: <span id="maxSize"></span> MB</label>
                        <label class="form-label mt-1 ms-1 text-secondary text-break fs-7 d-block" id="maxDurationDiv">{{ fs_lang('editorUploadTipMaxDuration') }}: <span id="maxDuration"></span> {{ fs_lang('unitSecond') }}</label>
                        <label class="form-label mt-1 ms-1 text-secondary text-break fs-7 d-block">{{ fs_lang('editorUploadTipMaxNumber') }}: <span id="maxNumber"></span></label>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="ajax-upload">{{ fs_lang('editorUploadButton') }}</button>
                    <div class="progress w-100 d-none" id="upload-progress"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var updateTimer;

            function updateDraft() {
                return new Promise((resolve, reject) => {
                    var jsonData = {};

                    $('#fresns-editor').find('input, select, textarea').each(function() {
                        var name = $(this).attr('name');
                        var value = $(this).val();

                        if ($(this).attr('type') === 'checkbox') {
                            value = $(this).is(':checked') ? value : 0;
                        }

                        jsonData[name] = value;
                    });

                    $.ajax({
                        url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/editor/'.$type.'/draft/'.$draft['detail']['did']]) }}",
                        type: 'PATCH',
                        data: JSON.stringify(jsonData),
                        contentType: 'application/json',
                        success: function (res) {
                            if (res.code != 0) {
                                tips(res.message, res.code);
                            }
                            resolve(res);
                        },
                        error: function (xhr, status, error) {
                            tips(error, xhr.status);
                            reject(error);
                        },
                    });
                });
            };

            function startOrUpdateTimer() {
                if (updateTimer) {
                    clearTimeout(updateTimer);
                }
                updateTimer = setTimeout(function() {
                    updateDraft();
                }, 10000);
            }

            $('.editor-title, .editor-content').on('input', function() {
                startOrUpdateTimer();
            });

            $('.editor-checkbox, .editor-select').on('change', function() {
                updateDraft();
            });

            $('#fresns-editor').submit(function (e) {
                e.preventDefault();

                updateDraft().then(() => {
                    let form = $(this),
                        btn = form.find('button[type="submit"]'),
                        actionUrl = form.attr('action'),
                        methodType = form.attr('method') || 'POST',
                        type = "{{ $type }}",
                        detailURLTemplate = "{{ fs_route(route('fresns.post.detail', ['pid' => 'FresnsPlaceholder'])) }}";

                    if (type == 'comment') {
                        detailURLTemplate = "{{ fs_route(route('fresns.comment.detail', ['cid' => 'FresnsPlaceholder'])) }}";
                    }

                    $.ajax({
                        url: actionUrl,
                        type: methodType,
                        success: function (res) {
                            tips(res.message, res.code);

                            if (res.code == 0) {
                                let fsid = res.data.fsid;
                                let detailURL = detailURLTemplate.replace('FresnsPlaceholder', fsid);

                                window.location.href = detailURL;
                            }
                        },
                        complete: function (e) {
                            btn.prop('disabled', false);
                            btn.find('.spinner-border').remove();
                        },
                    });
                }).catch((error) => {
                    console.error('Failed to update draft', error);
                });
            });
        });

        function addEditorFile(fileInfo) {
            let html;

            if (fileInfo.type === 1) {
                html = `
                <div class="position-relative">
                    <img src="${fileInfo.imageSquareUrl}" class="img-fluid">
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileInfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>`;

                $(".editor-file-image").append(html);
                let imgLength = $(".editor-file-image").find(".position-relative").length
                $(".editor-file-image").removeClass().addClass("editor-file-image editor-file-image-"+ imgLength +" mt-3 clearfix")
            }
            if (fileInfo.type === 2) {
                var videoImage = ''
                if (fileInfo.videoPosterUrl) {
                    videoImage = `<img src="${fileInfo.videoPosterUrl}" class="img-fluid">`
                } else {
                    videoImage = `<svg class="bd-placeholder-img rounded" xmlns="http://www.w3.org/2000/svg" role="img" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect></svg>`
                }
                html = `
                <div class="position-relative">
                    ${videoImage}
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileInfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <button type="button" class="btn btn-light editor-btn-video-play" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('editorVideoPlay') }}" title="{{ fs_lang('editorVideoPlay') }}">
                            <i class="bi bi-play-fill"></i>
                        </button>
                    </div>
                </div>`
                $(".editor-file-video").append(html);
            }
            if (fileInfo.type === 3) {
                html = `
                <div class="position-relative">
                    <audio src="${fileInfo.audioUrl}" controls="controls" preload="meta" controlsList="nodownload" oncontextmenu="return false">
                        Your browser does not support the audio element.
                    </audio>
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileInfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button></div>
                </div>`
                $('.editor-file-audio').append(html);
            }
            if(fileInfo.type === 4) {
                html = `
                <div class="position-relative">
                    <div class="editor-document-box">
                        <div class="editor-document-icon">
                            <i class="bi bi-file-earmark"></i>
                        </div>
                        <div class="editor-document-name text-nowrap overflow-hidden">${fileInfo.name}</div>
                    </div>
                    <div class="position-absolute top-0 end-0 editor-btn-delete">
                        <button type="button" class="btn btn-outline-dark btn-sm rounded-0 border-0" data-fid="${fileInfo.fid}" onclick="deleteFile(this)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ fs_lang('delete') }}" title="{{ fs_lang('delete') }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>`
                $(".editor-file-document").append(html);
            }
        }

        function deleteFile(obj) {
            let fid = $(obj).data('fid');

            $.ajax({
                url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/editor/'.$type.'/draft/'.$draft['detail']['did']]) }}",
                type: "PATCH",
                data: {
                    'deleteFile': fid,
                }
            });

            $(obj).parent().parent().remove();
        }

        function deleteLocation() {
            $.ajax({
                url: "{{ route('fresns.api.patch', ['path' => '/api/fresns/v1/editor/'.$type.'/draft/'.$draft['detail']['did']]) }}",
                type: "PATCH",
                data: {
                    'deleteLocation': 1,
                }
            });

            $('#location-info').hide();
            $('#location-btn').show();
        }

        (function($){
            let fileUploadModal = document.getElementById('fresns-upload');

            fileUploadModal.addEventListener('show.bs.modal', function (event) {
                let button = event.relatedTarget,
                    extensions = $(button).data('extensions'),
                    type = $(button).data('type'),
                    accept = $(button).data('accept'),
                    maxSize = $(button).data('maxsize'),
                    maxDuration = $(button).data('maxduration') ?? 0,
                    maxNumber = $(button).data('maxnumber');

                if ($.inArray(type, ['document', 'image']) >= 0 ) {
                    $("#formFile").attr('multiple', 'multiple')
                } else {
                    $("#formFile").removeAttr('multiple')
                }

                if (maxDuration == 0) {
                    $(this).find("#maxDurationDiv").addClass('d-none');
                } else {
                    $(this).find("#maxDurationDiv").removeClass('d-none');
                }

                $("#formFile").prop('accept', accept)
                $("#extensions").text(extensions);
                $("#maxSize").text(maxSize);
                $("#maxDuration").text(maxDuration);
                $("#maxNumber").text(maxNumber);
                $("#fresns-upload input[name='type']").val(type);
            })

            $(".fresns-sticker").on('click',function (){
                $("#content").trigger('click').insertAtCaret("[" + $(this).attr('value') + "]");
            });

            $("#fresns-upload").on('show.bs.modal', function () {
                $(this).find('#ajax-upload').show().removeAttr("disabled");
                $(this).find('#formFile').val("");
                $(this).find("#upload-progress").addClass('d-none').empty();
            })

            $("#ajax-upload").on('click', function (event) {
                event.preventDefault();
                let obj = $(this),
                    maxSize = $("#maxSize").text() || 0,
                    form = document.getElementById("upload-form"),
                    files = $('#formFile').prop('files');

                if (obj.is(":disabled")) {
                    return;
                }

                if (!files.length) {
                    alert("{{ fs_lang('editorUploadTip') }}");
                    return;
                }

                obj.attr('disabled', true);
                obj.hide();

                // set progress
                progress.init().setParentElement(obj.next('.progress').removeClass('d-none')).work();

                $.each(files, function (index, file) {
                    if (file.size > maxSize * 1024 * 1024) {
                        alert("{{ fs_lang('editorUploadTipMaxSize') }}: " + maxSize + "MB");
                        return false;
                    }

                    let individualForm = new FormData(form);
                    individualForm.append('file', file);

                    $.ajax({
                        url: "{{ route('fresns.api.post', ['path' => '/api/fresns/v1/common/file/upload']) }}",
                        type: "POST",
                        data: individualForm,
                        timeout: 600000,
                        processData: false,
                        contentType: false,
                        enctype: 'multipart/form-data',
                        success: function (resp) {
                            if (resp.code === 0) {
                                addEditorFile(resp.data);
                            } else {
                                tips(resp.message, resp.code);
                            }

                            if (index === files.length - 1) {
                                progress.done();
                                $("#fresns-upload .btn-close").trigger('click');
                                obj.removeAttr('disabled').show();
                            }
                        },
                        error: function (e) {
                            progress.exit();
                            tips(e.responseJSON.message);
                            $("#fresns-upload .btn-close").trigger('click');
                            obj.removeAttr('disabled').show();
                            return false;
                        },
                    });
                });
            });
        })(jQuery);
    </script>
@endpush
