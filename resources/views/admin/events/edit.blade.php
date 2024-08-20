@extends('admin/body/master')

@section('content')
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Enter Details</h4>
                <p class="card-description"> </p>
                <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            placeholder="Title" value="{{ old('title', $event->title) }}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                            placeholder="date" value="{{ old('date', $event->date) }}">
                        @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="text" class="form-control @error('time') is-invalid @enderror" name="time"
                            id="time" placeholder="HH:MM"
                            value="{{ old('time', $event->time ? date('H:i', strtotime($event->time)) : '') }}"
                            pattern="[0-2][0-9]:[0-5][0-9]" title="Enter time in HH:MM format">
                        @error('time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                            id="image" accept="image/*" onchange="previewImage(event)">
                        <img id="imagePreview" src="{{ $event->image ? asset('admin/event_images/' . $event->image) : '' }}"
                            alt="Image Preview" style="display:block; margin-top:10px; max-width:200px;">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Description</label>
                        <textarea class="form-control large-textarea @error('description') is-invalid @enderror" name="description"
                            placeholder="Enter description">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <button type="button" class="btn btn-dark"
                        onclick="window.location.href='{{ url('/events') }}'">Cancel</button>
                </form>


                <style>
                    .form-control,
                    .form-control:focus,
                    .form-control:active,
                    .form-control:hover {
                        color: white !important;
                        background-color: #333 !important;
                        /* Optional: change background color for better contrast */
                    }

                    .form-control::placeholder {
                        color: rgba(255, 255, 255, 0.7) !important;
                    }

                    .large-textarea {
                        height: 100px;
                        /* Adjust the height as needed */
                    }
                </style>

                <script>
                    function previewImage(event) {
                        var reader = new FileReader();
                        reader.onload = function() {
                            var output = document.getElementById('imagePreview');
                            output.src = reader.result;
                            output.style.display = 'block';
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>


            </div>
        </div>
    </div>
@endsection
