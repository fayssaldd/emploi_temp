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
            <h1>List groupes</h1>
            <a href="{{ route('groups.create') }}" class="btn btn-primary">Ajouter Groups</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Nom</th>
                        <th>filiere</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group )
                        <tr>
                            <td>{{ $group->id }}</td>
                            <td>{{ $group->nom }}</td>
                            <td>{{ $group->filiere->nom }}</td>
                            <td>
                                <form action="{{ route('groups.destroy',$group->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf  
                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger" ><i class="fas fa-trash"></i></button>
                                </form>
                                <a href="{{ route('groups.edit',$group->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                <a href="{{ route('seances.print_groupe_emploi',$group->id) }}" class="btn btn-success"><i class="fas fa-print"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        
    {{-- </div> --}}
</x-layout>