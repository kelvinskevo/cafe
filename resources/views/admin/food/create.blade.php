@extends('admin/body/master')

@section('content')
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Enter Details</h4>
                <p class="card-description"> </p>
                <form action="{{ route('foods.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title"
                            value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" min="0" class="form-control" name="price" placeholder="Price"
                            value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*"
                            onchange="previewImage(event)">
                        <img id="imagePreview" src="#" alt="Image Preview"
                            style="display:none; margin-top:10px; max-width:200px;">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" placeholder="Description">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button type="button" class="btn btn-dark"
                        onclick="window.location.href='{{ url('/foods') }}' ">Cancel</button>
                </form>

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
