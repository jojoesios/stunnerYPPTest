@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

<style>
    .red {
        color: #F54046;
    }

    .blue {
        color: #22A8F5;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3>Lyrics List
                        <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#createModal">
                            Create <span class="fa fa-plus"></span>
                        </button>
                    </h3>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Artist</th>
                                    <th scope="col">Lyrics</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lyrics as $lyric)
                                <tr>
                                    <th scope="row">{{ ucfirst($lyric->title) }}</th>
                                    <td>{{ ucfirst($lyric->artist) }}</td>
                                    <td>{{ substr($lyric->lyrics, 0, 50) }}</td>
                                    <td>{{ $lyric->creator->name }}</td>
                                    <td>
                                        <a href="#" class="edit" data-title="{{ $lyric->title }}" data-artist="{{ $lyric->artist }}" data-lyrics="{{ $lyric->lyrics }}" data-id="{{ $lyric->id }}">
                                            <span class="fa fa-edit blue"></span>
                                        </a>
                                        /
                                        <a href="#" class="delete" data-id="{{ $lyric->id }}">
                                            <span class="fa fa-trash red"></span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Song Lyric</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="createSong">
                    <div class="form-group">
                        <label>Song Title</label>
                        <input type="text" class="form-control" id="songTitle" placeholder="Enter song title" required>
                        <small id="emailHelp" class="form-text text-muted">What is the title?</small>
                    </div>
                    <div class="form-group">
                        <label>Song Artist</label>
                        <input type="text" class="form-control" id="songArtist" placeholder="Enter song artist" required>
                        <small id="emailHelp" class="form-text text-muted">Who made it?</small>
                    </div>
                    <div class="form-group">
                        <label>Song Lyrics</label>
                        <textarea class="form-control" id="songLyrics" rows="3"></textarea>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Song Lyric</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="editSong">
                    <input type="hidden" id="editSongID">
                    <div class="form-group">
                        <label>Song Title</label>
                        <input type="text" class="form-control" id="editSongTitle" placeholder="Enter song title" required>
                        <small id="emailHelp" class="form-text text-muted">What is the title?</small>
                    </div>
                    <div class="form-group">
                        <label>Song Artist</label>
                        <input type="text" class="form-control" id="editSongArtist" placeholder="Enter song artist" required>
                        <small id="emailHelp" class="form-text text-muted">Who made it?</small>
                    </div>
                    <div class="form-group">
                        <label>Song Lyrics</label>
                        <textarea class="form-control" id="editSongLyrics" rows="3"></textarea>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Song Lyric</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="deleteSong">
                    <input type="hidden" id="deleteSongID">
                    <div class="form-group">
                        Are you sure you want to delete this lyric?
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('.table').DataTable({
            responsive: true,
        });

        $('.createSong').on('submit', function(e) {
            e.preventDefault();
            let title = $(this).parent().find('#songTitle').val();
            let artist = $(this).parent().find('#songArtist').val();
            let lyrics = $(this).parent().find('#songLyrics').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax('{{ route("song-lyrics.store") }}', {
                type: 'POST', // http method
                data: {
                    title: title,
                    artist: artist,
                    lyrics: lyrics,
                }, // data to submit
                success: function(data, status, xhr) {
                    location.reload();
                },
                error: function(jqXhr, textStatus, errorMessage) {}
            });
        })

        $('.edit').on('click', function() {
            let title = $(this).data('title');
            let artist = $(this).data('artist');
            let lyrics = $(this).data('lyrics');
            let id = $(this).data('id');

            let modal = $('#editModal');

            modal.find('#editSongTitle').val(title);
            modal.find('#editSongArtist').val(artist);
            modal.find('#editSongLyrics').val(lyrics);
            modal.find('#editSongID').val(id);

            modal.modal('show');
        });

        $('.editSong').on('submit', function(e) {
            e.preventDefault();
            let title = $(this).find('#editSongTitle').val();
            let artist = $(this).find('#editSongArtist').val();
            let lyrics = $(this).find('#editSongLyrics').val();
            let id = $(this).find('#editSongID').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let requestData = {
                title: title,
                artist: artist,
                lyrics: lyrics,
            }
            $.ajax({
                url: document.location.origin + '/song-lyrics/' + id,
                type: 'PUT', // http method
                data: JSON.stringify(requestData), // data to submit
                contentType: "application/json",
                success: function(data, status, xhr) {
                    location.reload();
                },
                error: function(jqXhr, textStatus, errorMessage) {}
            });
        });

        $('.delete').on('click', function() {
            let id = $(this).data('id');

            let modal = $('#deleteModal');
            modal.find('#deleteSongID').val(id);

            modal.modal('show');
        });

        $('.deleteSong').on('submit', function(e) {
            e.preventDefault();
            let id = $(this).find('#deleteSongID').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: document.location.origin + '/song-lyrics/' + id,
                type: 'DELETE', // http method
                contentType: "application/json",
                success: function(data, status, xhr) {
                    location.reload();
                },
                error: function(jqXhr, textStatus, errorMessage) {}
            });
        });

    });
</script>
@endpush