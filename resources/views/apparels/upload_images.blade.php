<style>
    .imgPreview img {
        padding: 8px;
        max-width: 250px;
    }
</style>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Images') }}
        </h2>
    </x-slot>
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                @if(session()->has('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'File uploaded successfully.',
                        footer: '<a href="/apparels">Return to inventory</a>'
                    })
                </script>
                @else
                @endif
                <div class="col-sm-7">
                    <a href="{{route('apparel.index')}}" class="btn btn-light fw-bold mb-3">Return to Inventory</a>
                    <p class="card-text mb-3">Upload the images associated to the CSV file you imported</p>
                    <hr>

                    <form class="mt-5" action="{{route('apparel.upload_images')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="imgPreview"> </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="imageFile[]" class="form-label">Upload images used in the CSV file</label>
                                <input type="file" class="form-control shadow-none @error('imageFile[]') is-invalid @enderror" name="imageFile[]" id="images" multiple="multiple">

                                @if (count($errors) > 0)
                                <div class="">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <small id="helpId" class="form-text text-danger">{{$error}}</small>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark float-end">Submit</button>
                    </form>
                </div>
            </div>
    </section>
</x-app-layout>
<script>
    $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
    });
</script>