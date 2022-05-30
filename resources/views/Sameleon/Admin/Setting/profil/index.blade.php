@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @include('Sameleon.Admin.Setting.__section_title')

        @include('Sameleon.Admin.Setting.profil.profile')

        @include('Sameleon.Admin.Setting.profil.password')

        @include('Sameleon.Admin.Setting.profil.bank')

        @if (auth()->user()->hasRole('Client') && $user->type == 'entreprise')
            @php
                $company =
                    auth()
                        ->user()
                        ->company()
                        ->first();
            @endphp

            @include('Sameleon.Admin.Setting.profil.company', [
                'company' => $company,
            ])
        @endif

    </div>
@endsection
