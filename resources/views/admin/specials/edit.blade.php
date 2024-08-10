@extends('admin/body/master')

@section('content')
    <div class="col-md-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Enter Details</h4>
                <p class="card-description"> </p>
                <form action="{{ route('specials.update', $special->id) }}" method="POST" enctype="multipart/form-data"
                    novalidate>
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="name" value="{{ old('name', $special->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Description">{{ old('description', $special->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                            name="price" placeholder="Price" value="{{ old('price', $special->price) }}">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control @error('category') is-invalid @enderror" name="category">
                            <option value="" disabled>Select Category</option>
                            <option value="Breakfast"
                                {{ old('category', $special->category) == 'Breakfast' ? 'selected' : '' }}>Breakfast
                            </option>
                            <option value="Lunch" {{ old('category', $special->category) == 'Lunch' ? 'selected' : '' }}>
                                Lunch</option>
                            <option value="Dinner" {{ old('category', $special->category) == 'Dinner' ? 'selected' : '' }}>
                                Dinner</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                            id="image" accept="image/*" onchange="previewImage(event)">
                        @if ($special->image)
                            <img src="{{ asset('admin/special_images/' . $special->image) }}" alt="{{ $special->title }}"
                                style="display:block; margin-top:10px; max-width:200px;">
                        @endif
                        <img id="imagePreview" src="#" alt="Image Preview"
                            style="display:none; margin-top:10px; max-width:200px;">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="week_start">Week Start</label>
                        <input type="date" class="form-control @error('week_start') is-invalid @enderror"
                            name="week_start" id="week_start" value="{{ old('week_start', $special->week_start) }}"
                            required>
                        @error('week_start')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <button type="button" class="btn btn-dark"
                        onclick="window.location.href='{{ route('specials.index') }}'">Cancel</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('week_start');

        // Disable past dates
        const today = new Date();
        const mondayThisWeek = new Date(today.setDate(today.getDate() - today.getDay() + 1));
        const yyyy = mondayThisWeek.getFullYear();
        const mm = String(mondayThisWeek.getMonth() + 1).padStart(2, '0');
        const dd = String(mondayThisWeek.getDate()).padStart(2, '0');
        const minDate = `${yyyy}-${mm}-${dd}`;

        dateInput.setAttribute('min', minDate);

        // Allow only Mondays
        dateInput.addEventListener('input', function() {
            const selectedDate = new Date(this.value);
            if (selectedDate.getDay() !== 1) {
                alert('Please select a Monday');
                this.value = '';
            }
        });
    });
</script>
