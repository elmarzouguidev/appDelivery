<div class="row mb-4">
    <label for="name" class="col-form-label col-lg-2">Nom *</label>
    <div class="col-lg-10">
        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
            value="{{$group->name}}" required>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-4">

    <label class="form-label col-lg-2">Responsable *</label>
    <div class="col-lg-10">
        <select name="admin" class="form-control @error('admin') is-invalid @enderror" required>
            <option value="">Choisir le Responsable</option>
            @foreach ($admins as $admin)
                <option {{$group->user_id == $admin->id ? 'selected' : ''}} value="{{ $admin->id }}">{{ $admin->full_name }}</option>
            @endforeach
        </select>
        @error('admin')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

</div>
<div class="row mb-4">
    <label for="description" class="col-form-label col-lg-2">Description </label>
    <div class="col-lg-10">
        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="10"
            rows="10">{{$group->description}}</textarea>

        @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
