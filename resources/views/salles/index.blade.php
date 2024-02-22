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
            <h1>List Salles</h1>
            <a href="{{ route('salles.create') }}" class="btn btn-primary">Ajouter Salle</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td></td>
                        <th>#ID</th>
                        <th>Nom</th>
                        <th>description</th>
                        <th>espace</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('salles.deleteMultiple') }}" method="post">
                        @csrf
                        @foreach ($salles as $salle )
                        <tr>
                            <td class="text-center">
                                <input class="btn btn-check"  type="checkbox" name="ids_salles[]" value="{{ $salle->id }}">
                            </td>
                            <td>{{ $salle->id }}</td>
                            <td>{{ $salle->nom }}</td>
                            <td>{{ $salle->description }}</td>
                            <td>{{ $salle->espace }}</td>
                            <td>
                                {{-- <form action="{{ route('salles.destroy',$salle->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf  
                                    <input onclick="return confirm('Are you sure?')" type="submit" value="Supprimer" class="btn btn-danger">
                                </form> --}}
                                <a href="{{ route('salles.edit',$salle->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                        <tr class=" bg-light" style="position: sticky !important;bottom:0;">
                            <td colspan="6">
                                <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger" ><i class="fas fa-trash"></i></button>
                                Supprimer les element selectionnez
                                
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
    </div>
        
    {{-- </div> --}}
</x-layout>