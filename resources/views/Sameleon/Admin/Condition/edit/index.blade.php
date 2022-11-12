@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Condition.__title')

        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="post" action="{{ route('admin:conditions.update',$condition->uuid) }}">
                    @csrf
                    <div class="row mb-4">
                        <label for="type" class="col-form-label col-lg-2">Type *</label>
                        <div class="col-lg-10">
                            <select name="type" class="form-control select2-templating @error('type') is-invalid @enderror" required>
                                <option value="">Choisir le type</option>
                                <option {{$condition->type =="global" ?'selected':''}}    value="global">Géneral</option>
                                <option {{$condition->type =="produits" ?'selected':''}}  value="produits">Produits</option>
                                <option {{$condition->type =="factures" ?'selected':''}}  value="factures">Factures</option>
                                <option {{$condition->type =="commands" ?'selected':''}}  value="commands">Commands</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="title" class="col-form-label col-lg-2">Titre *</label>
                        <div class="col-lg-10">
                            <input id="title" name="title" type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{$condition->title}}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="description" class="col-form-label col-lg-2">Description </label>
                        <div class="col-lg-10">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="12">{{$condition->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-lg-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('css')

@endsection

@push('scripts')

    <script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>

    <script src="{{ asset('js/pages/form-editor.js') }}"></script>
@endpush