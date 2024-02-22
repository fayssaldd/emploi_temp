<x-layout titre='login'>
    <div style="margin-top: 59px"  style="width: 300px">
        <form action="{{ route('login') }}" method="POST" class=" shadow border p-3 mt-5" >
            @csrf
            <h1>Authentification</h1>
            <hr>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control">
                @error('email')
                <p class="text-danger"> {{ $errors->first('email') }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" value="Se connecter" class="btn btn-primary w-100">
            </div>
        </form>
    </div>    
</x-layout>