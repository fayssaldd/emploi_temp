<x-layout titre="List Filier">
    @if (session()->has('success'))
    <script>
        swal("{{ session('success') }}","{{  Session::get('message') }}",'success',{
            button:true,
            button:"OK",
            timer:3000,
            dangerMode:true,
        })
    </script>
    @endif
    {{-- <div class="mt-5 mb-3 container d-flex justify-content-between align-items-center"> --}}
    <div class="card mt-5 w-100"  style="margin-top: 7rem !important">
        <div class="card-header container d-flex justify-content-between align-items-center">
            <h1>List filer</h1>
            <a href="{{ route('filier.create') }}" class="btn btn-primary">Ajouter filier</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nom</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filiers as $filier )
                        <tr>
                            <td>{{ $filier->id }}</td>
                            <td>{{ $filier->nom }}</td>
                            <td>
                                <form action="{{ route('filier.destroy',$filier->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf  
                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger" ><i class="fas fa-trash"></i></button>

                                </form>
                                <a href="{{ route('filier.edit',$filier->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        
    {{-- </div> --}}
</x-layout>