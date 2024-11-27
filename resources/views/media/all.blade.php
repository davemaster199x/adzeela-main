@extends('layouts.app')
@section('content')
    @include('global.topnav')
    @include('global.sidemenu')
    <div id="wrapper">
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Adzeela</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <h4 class="page-title">
                            All Media
                            @if (isset($title))
                                > <span>{{ $title }}</span>
                            @endif
                        </h4>
                    </div>
                </div>
            </div>
            <div class="d-none">
                <input type="input" name="folderInput" id="folderInput"
                    value="{{ isset($ownerRecord) ? $ownerRecord->id : '' }}">
            </div>

            <div class="content">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <div class="pr-3">
                                    <label for="search">Search</label>
                                    <input type="text" class="form-control mr-3" name="search" id="search"
                                        style="width: 100%;" onblur="search()">
                                </div>
                                <div class="pr-3">
                                    <label for="sortBy">Sort By</label>
                                    <select class="form-control" id="sortBy" onchange="search()">
                                        <option value=""></option>
                                        <option value="name">By Name</option>
                                        <option value="type">By Type</option>
                                        <option value="size">By Size</option>
                                    </select>
                                </div>
                                <div class="pr-3" style="margin-top: 30px; ">
                                    <div>
                                        <i class="mdi mdi-apps"
                                            style="font-size: 35px; color: white; background-color: #A72DCB;border-radius: 5px"></i>
                                    </div>
                                </div>
                                @if (request()->has('search') && request()->has('filter_by'))
                                    <div class="pr-3" style="cursor: pointer">
                                        <a onclick="clearFilter()">
                                            <i class="mdi mdi-close-circle "
                                                style="cursor: pointer; font-size: 20px; margin-right: 5px"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="float-right" style="margin-top: 30px">
                            <div class="form-group flex w-100">
                                @if (!isset($ownerRecord))
                                    <label for="folder" class="btn btn-primary" style="margin-right: 5px">
                                        <input id="folder" type="button" name="folder" class="form-control"
                                            style="display:none" data-toggle="modal" data-target="#addEditFolder">
                                        New Folder
                                    </label>
                                @endif
                                <label for="fileinput" class="btn btn-primary">
                                    @if (isset($title))
                                        <input id="fileinput" type="file" name="fileinput" class="form-control"
                                            style="display:none"
                                            accept="{{ (isset($title) && $title == 'Images'
                                                    ? 'image/png, image/jpeg'
                                                    : $title == 'Videos')
                                                ? 'video/mp4,video/x-m4v,video/*'
                                                : 'video/mp4,video/x-m4v,video/*,image/png,image/jpeg' }}">
                                    @else
                                        {{-- All --}}
                                        <input id="fileinput" type="file" name="fileinput" class="form-control"
                                            style="display:none"
                                            accept="video/mp4,video/x-m4v,video/*,image/png,image/jpeg">
                                    @endif
                                    Upload
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            {{-- <th><input type="checkbox" id="selectAll" name="selectAll" /></th> --}}
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($folders) && count($folders) > 0 && !isset($ownerRecord))
                            @foreach ($folders as $key => $folder)
                                <tr>
                                    <td>
                                        <i class="mdi mdi-folder" style="font-size: 30px"></i>
                                    </td>
                                    <td>
                                        <a href="{{ url('media/folder/' . $folder->id) }}">{{ $folder->name }}</a>
                                    </td>
                                    <td>Folder</td>
                                    <td>{{ $folder->created_at }}</td>
                                    <td>{{ $folder->size }}</td>
                                    <td>
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical" style="font-size: 20px"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item"
                                                href="{{ url('media/folder/' . $folder->id) }}">View</a>
                                            <a class="dropdown-item" href="#"
                                                onclick="editFolder({{ $folder }})">Edit</a>
                                            <a class="dropdown-item" onclick="deleteFolder({{ $folder->id }})">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        @if (count($medias) == 0)
                            @if (!isset($folders))
                                <tr>
                                    <td>Empty Data</td>
                                </tr>
                            @endif
                        @else
                            @foreach ($medias as $key => $media)
                                <tr>
                                    <td>
                                        {{-- <img src="{{ asset('storage/app/uploads/2024-05-21-13-21-06.jpg') }}" /> --}}
                                        @if ($media->type == 'image')
                                            <img src="{{ Storage::url($media->location) }}" width="45px" height="45px">
                                        @elseif($media->type == 'video')
                                            <video src="{{ Storage::url($media->location) }}" disabled width="45px"
                                                height="45px">
                                                <p>Your browser does not support the video tag.</p>
                                            </video>
                                        @endif
                                    </td>
                                    <td>{{ $media->name }}</td>
                                    <td>{{ $media->type }}</td>
                                    <td>{{ $media->created_at }}</td>
                                    <td>{{ $media->size }}</td>
                                    <td>
                                        <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical" style="font-size: 20px"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a onclick="viewMedia({{ $media }}, '{{ Storage::url($media->location) }}')"
                                                class="dropdown-item" href="#">View</a>
                                            <a class="dropdown-item" onclick="editMedia({{ $media }})">Edit</a>
                                            <a onclick="deleteMedia('{{ url('media/' . $media->id) }}')"
                                                class="dropdown-item">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                {{-- Paginate --}}
                <div class="float-right">
                    {{ $medias->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <!-- View Media Modal -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">View</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="align-content: center">
                        <img id="viewImg" src="" alt="" width="300px" height="300px">
                        <video id="viewVid" src="" width="100%" height="100%" controls>
                            <source id="vidSource" src="" type="video/mp4">
                            <p>Your browser does not support the video tag.</p>
                        </video>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Spinner modal --}}
        <div class="modal fade" id="spinner" tabindex="-1" role="dialog" aria-labelledby="spinnerModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body" style="align-content: center">
                        <div style="display: flex; justify-content: center;">
                            <div style="text-align: center;">
                                <div class="lds-dual-ring"></div>
                                <p id="spinner-content">
                                    Uploading
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add  & Edit folder modal form --}}
        <div class="modal fade" id="addEditFolder" tabindex="-1" role="dialog" aria-labelledby="addEditFolderLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Add Folder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="align-content: center">
                        <form id="addEditFolderForm" action="">
                            <div class="form-group">
                                <label for="folderName">Folder Name</label>
                                <input type="text" class="form-control" name="folderName" id="folderName">
                            </div>
                            <p id="folderError" class="text-danger"></p>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="addEditFolder()">Submit</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Media --}}
        <div class="modal fade" id="editMedia" tabindex="-1" role="dialog" aria-labelledby="editMediaLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Edit Media</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="align-content: center">
                        <form id="addFolderForm" action="">
                            <div class="form-group">
                                <label for="mediaName">Name</label>
                                <input type="text" class="form-control" name="mediaName" id="mediaName">
                                <p id="mediaNameError" class="text-danger"></p>
                            </div>
                            @if (isset($folders) && count($folders) > 0)
                                <div class="form-group">
                                    <label for="mediaFolder">Folder</label>
                                    <select class="form-control" id="mediaFolder" name="mediaFolder">
                                        <option value=""></option>
                                        @foreach ($folders as $key => $media)
                                            <option value="{{ $media->id }}">{{ $media->name }}</option>
                                        @endforeach
                                    </select>
                                    <p id="mediaFolderError" class="text-danger"></p>
                                </div>
                            @endif
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="globalMedia = null">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="updateMedia()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var globalFolder;
        var globalMedia;

        $(document).ready(function() {
            var url = new URL(window.location.href);
            var search = url.searchParams.get('search');
            var sort_by = url.searchParams.get('sort_by');

            console.log('search', search, sort_by)

            if (search) {
                $('#search').val(search);
            }

            if (sort_by) {
                $('#sortBy').val(sort_by);
            }
        });

        window.clearFilter = function clearFilter(url) {
            // window.location.href = '<?php echo url('/media'); ?>?'
            var route = "{{ Request::url() }}";
            console.log(route)
        }

        window.search = function search() {
            var url = new URL(window.location.href);
            console.log('search', $('#search').val())
            console.log('sort_by', $('#sortBy').val())

            var search = url.searchParams.get('search');
            var sort_by = url.searchParams.get('sort_by');

            // to prevent multiple calls
            if (search == $('#search').val() && sort_by == $('#sortBy').val()) {
                return;
            }

            var payload = {
                search: $('#search').val(),
                sort_by: $('#sortBy').val(),
            }

            var route = "{{ Request::url() }}";
            window.location.href = '{{ Request::url() }}?' + $.param(payload);
        }

        // upload file
        $("#fileinput").change(function(event) {
            var folder = $('#folderInput').val();
            var myFile = event.target.files[0];
            var formData = new FormData();
            formData.append("file", myFile);
            formData.append("folder_id", folder);
            $('#spinner').modal('show');

            $.ajax({
                method: 'POST',
                url: "<?php echo url('/media/upload'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                success: function(response) {
                    console.log('response', response)

                    if (response == 'Invalid file type') {
                        alert('Invalid file type');
                    } else if (response == 'File too large') {
                        alert('File too large');
                    } else {
                        $("#fileinput").val(null);
                        $('#spinner').modal('hide');
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error');
                    $('#spinner').modal('hide');
                    console.error(error);
                }
            });
        });

        window.deleteMedia = function deleteMedia(url) {
            var next = confirm("Are you sure you want to delete it?");
            console.log('test', url, next);

            if (next) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function(response) {
                        console.log('response:', response);
                        window.location.reload();
                    },
                    error: function(data) {
                        alert('Error');
                        console.log('Error:', data);
                    }
                })
            }
        }

        window.viewMedia = function viewMedia(media, url) {
            // Trigger the modal when the button is clicked
            if (media.type == 'image') {
                $('#viewImg')
                    .attr('src', url)
                    .attr('style', 'display: block');
                $('#viewVid').css('display', 'none');
            } else {
                $('#viewVid').attr('src', url).attr('style', 'display: block');
                $('#viewImg').css('display', 'none');
            }
            $('#viewModal').modal('show');
        }

        window.editMedia = function editMedia(media) {
            console.log('media', media)
            globalMedia = media;
            $('#mediaName').val(media.name);
            $('#mediaFolder').val(media?.folder?.id);
            $('#editMedia').modal('show');
        }

        window.updateMedia = function updateMedia(media) {
            var payload = {
                name: $('#mediaName').val(),
                folder_id: $('#mediaFolder').val()
            };

            if (payload?.name == globalMedia?.name && payload?.folder_id == globalMedia?.folder?.id) {
                $('#editMedia').modal('hide');
            }

            console.log('updateMedia', payload);
            $.ajax({
                url: "<?php echo url('/media/" + globalMedia.id + "'); ?>",
                method: 'POST',
                data: payload,
                success: function(response) {
                    $('#editMedia').modal('hide');
                    window.location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var errorMessage = jqXHR.responseJSON.errors
                    console.log('errorMessage', errorMessage)

                    if (errorMessage.name) {
                        $('#mediaNameError').text(errorMessage.name);
                    }

                    if (errorMessage.folder_id) {
                        $('#mediaFolderError').text(errorMessage.folder_id);
                    }
                }
            });
        }

        window.addEditFolder = function addEditFolder() {
            $('#folderError').text(''); // reset the error message
            payload = {
                name: $('#folderName').val()
            }
            if (payload.name == globalFolder?.name) {
                $('#addEditFolder').modal('hide');
                return;
            }

            var url = globalFolder ? "<?php echo url('/media/folder/" + globalFolder.id + "'); ?>" : "<?php echo url('/media/folder'); ?>"

            $.ajax({
                url: url,
                method: 'GET',
                data: payload,
                success: function(response) {
                    window.location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    var errorMessage = jqXHR.responseJSON.errors
                    console.log('errorMessage', errorMessage)

                    if (errorMessage.name) {
                        $('#folderError').text(errorMessage.name);
                    }
                }
            });
        }

        window.deleteFolder = function deleteFolder(id) {
            var next = confirm("Are you sure you want to delete it?");
            console.log('deleteFolder', id);

            if (next) {
                $.ajax({
                    url: "<?php echo url('/media/folder/" + id + "'); ?>",
                    type: 'DELETE',
                    success: function(response) {
                        console.log('response:', response);
                        window.location.reload();
                    },
                    error: function(data) {
                        alert('Error');
                        console.log('Error:', data);
                    }
                })
            }
        }

        window.editFolder = function editFolder(folder) {
            globalFolder = folder;
            $('#folderName').val(folder.name);
            $('#addEditFolder').modal('show');
        }
    </script>
@endpush

<style>
    .flex {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between
    }

    .lds-dual-ring {
        /* change color here */
        color: #1c4c5b
    }

    .lds-dual-ring,
    .lds-dual-ring:after {
        box-sizing: border-box;
    }

    .lds-dual-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
    }

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 8px;
        border-radius: 50%;
        border: 6.4px solid currentColor;
        border-color: currentColor transparent currentColor transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
