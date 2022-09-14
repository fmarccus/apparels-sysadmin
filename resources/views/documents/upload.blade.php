<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Documents') }}
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
                    <p class="card-text mb-3">Upload your document(.docx) or pdf file here</p>
                    <hr>
                    <form action="{{route('apparel.documentstore')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Document or PDF File</label>
                            <input type="file" class="form-control shadow-none @error('file') is-invalid @enderror" name="file" id="file">
                            @error('file')
                            <small id="helpId" class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-dark float-end">Submit</button>
                    </form>
                </div>
            </div>
    </section>
</x-app-layout>