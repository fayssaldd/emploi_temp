<x-layout titre="modifier admin">
    <form action="{{ route('admins.update',$admin->id) }}" method="POST" class="shadow border p-3" style="margin-top: 7rem;width: 530px;">
        @method('put')
        @csrf
        <div class="d-flex justify-content-between align-items-center">
            <h1>Modifier Admin</h1>
            <a href="{{ route('admins.show',$admin->id) }}" class="btn btn-outline-success">Annuler</a>    
        </div>
        <hr>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input value="{{ old('nom',$admin->nom) }}" type="text" name="nom" id="nom" class="form-control">
            @error('nom')
                <p class="text-danger"> {{ $errors->first('nom') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input value="{{ old('prenom',$admin->prenom) }}" type="text" name="prenom" id="prenom" class="form-control">
            @error('prenom')
                <p class="text-danger"> {{ $errors->first('prenom') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input value="{{ old('email',$admin->email) }}" type="text" name="email" id="email" class="form-control">
            @error('email')
                <p class="text-danger"> {{ $errors->first('email') }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input value="{{ old('password') }}" type="password" name="password" id="password" class="form-control">
            @error('password')
                <p class="text-danger"> {{ $errors->first('password') }}</p>
            @enderror
        </div>
        <div class="form-group">
           <input type="submit" class="btn btn-primary" value="Modifer">
        </div>
    </form>
</x-layout>