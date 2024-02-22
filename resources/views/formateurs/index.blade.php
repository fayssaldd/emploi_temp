<x-layout titre="List Formateurs">
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
            <h1>List Formateurs</h1>
            <a href="{{ route('formateurs.create') }}" class="btn btn-outline-primary">Ajouter Formateur</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formateurs as $formateur )
                        <tr>
                            <td>{{ $formateur->id }}</td>
                            <td>{{ $formateur->nom }}</td>
                            <td>{{ $formateur->prenom }}</td>
                            <td>{{ $formateur->type }}</td>
                            <td>
                                <form action="{{ route('formateurs.destroy',$formateur->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf  
                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger" ><i class="fas fa-trash"></i></button>
                                </form>
                                <a href="{{ route('formateurs.edit',$formateur->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('seances.print_formateur_emploi',$formateur->id) }}" class="btn btn-success"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        
    {{-- </div> --}}
</x-layout>