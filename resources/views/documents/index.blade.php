<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents') }}
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
                    <p class="card-text mb-3">Documents and PDF stored in the system</p>
                    <hr>
                    <ul>
                        @foreach($documents as $document)
                        <li><a href="{{route('apparel.preview', $document->document)}}">{{$document->document}}</a>, {{$document->created_at}}</li>
                        
                        @endforeach
                    </ul>


                </div>
            </div>
    </section>
</x-app-layout>