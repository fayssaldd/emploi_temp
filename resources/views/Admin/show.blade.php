<x-layout titre="Admin">
    <table class="table table-bordered" style="margin-top: 7rem">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Date de Naissance</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->nom }}</td>
                <td>{{ $admin->prenom }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->dateNaissance }}</td>
                <td><a href="{{ route('admins.edit',$admin->id) }}" class="btn btn-success"><i class="fa fa-edit"></i></a></td>
            </tr>
        </tbody>
    </table>
</x-layout>
