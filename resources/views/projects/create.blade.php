@extends('layouts.master')
@section('heading')
{{ __('Create project') }} <span class="small">{{ $client ? '(' . $client->company_name . ')' : '' }}</span>
@stop

@section('content')

<div class="row">
    <form action="{{ route('projects.store') }}" method="POST" id="createProjectForm">
        <div class="col-sm-8">
            <div class="tablet">
                <div class="tablet__body">
                    <div class="form-group">
                        <label for="title" class="control-label thin-weight">@lang('Title')</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label thin-weight">@lang('Description')</label>
                        <textarea name="description" id="description" cols="50" rows="10"
                            class="form-control"></textarea>
                    </div>
                </div>
            </div>
            @if (Entrust::can('project-upload-files') && $filesystem_integration)
            <div class="tablet">
                <div class="tablet__body">
                    <label class="control-label">@lang('Files')</label>
                    <div class="dropzone dz-default dz-message" id="dropzone-images">
                        <span>@lang('Drop files here or click to upload')</span>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-sm-4">
            <div class="tablet">
                <div class="tablet__body">
                    <div class="form-group">
                        <label for="user_assigned_id" class="control-label thin-weight">@lang('Assign user')</label>
                        <select name="user_assigned_id" id="user_assigned_id" class="form-control">
                            @foreach ($users as $user => $userK)
                            <option value="{{ $user }}">{{ $userK }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="flag" class="control-label thin-weight">Division</label>
                        <select name="flag" id="flag" class="form-control">
                            @foreach ($getDiv as $i)
                            <option value="{{ $i->id }}">{{ $i->division }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="display:none;">
                        @if (Request::get('client') != '' || $client)
                        <input type="hidden" name="client_external_id"
                            value="{!! Request::get('client') ?: $client->external_id !!}">
                        @else
                        <label for="client_external_id" class="control-label thin-weight">@lang('Assign
                            client')</label>
                        <select name="client_external_id" id="client_external_id" data-container="body"
                            data-live-search="true" data-style-base="form-control" data-style="" data-width="100%">
                            @if ($clients->isEmpty())
                            <option value="" default></option>
                            <option value="new_client">+ @lang('Create New Client')</option>
                            @endif
                            @foreach ($clients as $client => $clientK)
                            <option value="{{ $client }}">{{ $clientK }}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>

                    <div class="form-group" style="display:none;">
                        <label for="deadline" class="control-label thin-weight">@lang('Deadline')</label>
                        <input type="text" id="deadline" name="deadline" class="form-control">
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="status" class="control-label thin-weight">@lang('Status')</label>
                        <select name="status_id" id="status" class="form-control">
                            @foreach ($statuses as $status => $statusK)
                            <option value="{{ $status }}">{{ $statusK }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="submit" class="btn btn-md btn-brand movedown" id="createProject"
                            value="{{ __('Create project') }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="alert alert-danger title-alert" style="display: none;">
    {{ __('Title is required') }}
</div>
<div class="alert alert-danger description-alert" style="display: none;">
    {{ __('Description is required') }}
</div>
<div class="alert alert-danger client-alert" style="display: none;">
    {{ __('Client is required') }}
</div>
@stop

@push('scripts')
<script type="text/javascript" src="{{ asset('assets/js/summernote-file.js') }}"></script>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function () {
        $('#client_external_id').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            var value = $("#client_external_id").val();
            if (value == "new_client") {
                window.location.href = "/clients/create"
            }
        });

        $('#client_external_id').selectpicker()
        $('#description').summernote({
            toolbar: [
                ['fontsize', ['fontsize']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen']]
            ],
            height: 300,
            disableDragAndDrop: true,
            callbacks: {
                onFileUpload: function (file) {
                    myOwnCallBack(file[0]);
                },
            },
        });

        function myOwnCallBack(file) {
            let data = new FormData();
            data.append("file", file);
            $.ajax({
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: `http://127.0.0.1:8000/uploadFile`,
                cache: false,
                contentType: false,
                processData: false,
                xhr: function () { //Handle progress upload
                    let myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload) myXhr.upload.addEventListener('progress',
                        progressHandlingFunction, false);
                    return myXhr;
                },
                success: function (reponse) {
                    if (reponse.status === true) {
                        let listMimeImg = ['image/png', 'image/jpeg', 'image/webp', 'image/gif',
                            'image/svg'
                        ];
                        let listMimeAudio = ['audio/mpeg', 'audio/ogg'];
                        let listMimeVideo = ['video/mpeg', 'video/mp4', 'video/webm'];
                        let elem;

                        if (listMimeImg.indexOf(file.type) > -1) {
                            //Picture
                            $('.summernote').summernote('editor.insertImage', reponse.filename);
                        } else if (listMimeAudio.indexOf(file.type) > -1) {
                            //Audio
                            elem = document.createElement("audio");
                            elem.setAttribute("src", reponse.filename);
                            elem.setAttribute("controls", "controls");
                            elem.setAttribute("preload", "metadata");
                            $('.summernote').summernote('editor.insertNode', elem);
                        } else if (listMimeVideo.indexOf(file.type) > -1) {
                            //Video
                            elem = document.createElement("video");
                            elem.setAttribute("src", reponse.filename);
                            elem.setAttribute("controls", "controls");
                            elem.setAttribute("preload", "metadata");
                            $('.summernote').summernote('editor.insertNode', elem);
                        } else {
                            //Other file type
                            elem = document.createElement("a");
                            let linkText = document.createTextNode(file.name);
                            elem.appendChild(linkText);
                            elem.title = file.name;
                            elem.href = reponse.filename;
                            $('.summernote').summernote('editor.insertNode', elem);
                        }
                    }
                }
            });
        }

        function progressHandlingFunction(e) {
            if (e.lengthComputable) {
                //Log current progress
                console.log((e.loaded / e.total * 100) + '%');

                //Reset progress on complete
                if (e.loaded === e.total) {
                    console.log("Upload finished.");
                }
            }
        }

        $('#deadline').pickadate({
            hiddenName: true,
            format: "{{ frontendDate() }}",
            formatSubmit: 'yyyy/mm/dd',
            closeOnClear: false,
        });
        myDropzone = null;
        @if (Entrust:: can('project-upload-files') && $filesystem_integration)
    var myDropzone = new Dropzone("#createProjectForm", {
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 5,
        maxFiles: 50,
        maximumImageFileSize: 1000 * 1024,
        addRemoveLinks: true,
        previewsContainer: "#dropzone-images",
        clickable: '#dropzone-images',
        paramName: 'images',
        acceptedFiles: `image/*, application/pdf,
                application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
                application/vnd.openxmlformats-officedocument.spreadsheetml.template,
                application/vnd.openxmlformats-officedocument.presentationml.template,
                application/vnd.openxmlformats-officedocument.presentationml.slideshow,
                application/vnd.openxmlformats-officedocument.presentationml.presentation,
                application/vnd.openxmlformats-officedocument.presentationml.slide,
                application/vnd.openxmlformats-officedocument.wordprocessingml.document,
                application/vnd.openxmlformats-officedocument.wordprocessingml.template,
                application/vnd.ms-excel.addin.macroEnabled.12,
                application/vnd.ms-excel.sheet.binary.macroEnabled.12,
                application/vnd.ms-powerpoint,.pptx,
                text/rtf, text/plain,audio/*, video/*, .csv, .doc,.xls, .ppt`,
    });

    myDropzone.on("success", function (file, response) {
        window.location.href = ("/projects/" + response.project_external_id)
    });

    myDropzone.on("processing", function (file, response) {
        $('input[type="submit"]').attr("disabled", true);
    });
    myDropzone.on("error", function (file, response) {
        $('input[type="submit"]').attr("disabled", false);
    });
    @endif
    $('input[type="submit"]').on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        if (myDropzone != null && myDropzone.getQueuedFiles().length > 0) {
            myDropzone.processQueue();
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route('projects.store') }}',
                data: $("#createProjectForm").serialize(),
                success: function (response) {
                    window.location.href = ("/projects/" + response.project_external_id)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.responseJSON.errors.title != undefined) {
                        $('.title-alert').show();
                    } else {
                        $('.title-alert').hide();
                    }
                    if (jqXHR.responseJSON.errors.description != undefined) {
                        $('.description-alert').show();
                    } else {
                        $('.description-alert').hide();
                    }
                    if (jqXHR.responseJSON.errors.client_external_id != undefined) {
                        $('.client-alert').show();
                    } else {
                        $('.client-alert').hide();
                    }

                }
            });
        }

    });

        });
</script>
@endpush