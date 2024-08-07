@extends('admin/body/master')

@section('content')
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Enter Details</h4>
                <form action="{{ route('foods.update', $food->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $food->title) }}"
                            placeholder="Title">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" min="0" step="0.01" class="form-control" name="price"
                            value="{{ old('price', $food->price) }}" placeholder="Price">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image">
                        <img src="{{ asset('admin/user_images/' . $food->image) }}" alt="Current Image" width="100">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control large-textarea" name="description" placeholder="Description">{{ old('description', $food->description) }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a href="{{ route('foods.index') }}" class="btn btn-dark">Cancel</a>
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
