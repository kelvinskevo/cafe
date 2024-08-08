@extends('admin/body/master')

@section('content')
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Enter Details</h4>
                <p class="card-description"> </p>
                <form action="{{ route('chefs.update', $chef->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Name" value="{{ old('name', $chef->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control @error('role') is-invalid @enderror" name="role"
                            placeholder="Role" value="{{ old('role', $chef->role) }}">
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                            id="image" accept="image/*" onchange="previewImage(event)">
                        <img id="imagePreview" src="{{ asset('admin/chefs_images/' . $chef->image) }}" alt="Image Preview"
                            style="display:block; margin-top:10px; max-width:200px;">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="url" class="form-control @error('facebook') is-invalid @enderror" name="facebook"
                            placeholder="Facebook URL" value="{{ old('facebook', $chef->facebook) }}">
                        @error('facebook')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="twitter">Twitter</label>
                        <input type="url" class="form-control @error('twitter') is-invalid @enderror" name="twitter"
                            placeholder="Twitter URL" value="{{ old('twitter', $chef->twitter) }}">
                        @error('twitter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="google_plus">Google Plus</label>
                        <input type="url" class="form-control @error('google_plus') is-invalid @enderror"
                            name="google_plus" placeholder="Google Plus URL"
                            value="{{ old('google_plus', $chef->google_plus) }}">
                        @error('google_plus')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <button type="button" class="btn btn-dark"
                        onclick="window.location.href='{{ url('/chefs') }}'">Cancel</button>
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
