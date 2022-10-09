<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered border-danger table-hover align-middle table-nowrap table-check">
                        <thead class="table-light">
                            <tr>

                                <th style="width: 20px;" class="align-middle">
                                    <div class="form-check font-size-16">
                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                        <label class="form-check-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th class="align-middle">Position</th>
                                <th class="align-middle">Livreure</th>
                                <th class="align-middle">Total commands Livé <i style="color:blue">Aujourd'hui</i></th>
                                <th class="align-middle">Total chiffre d'affaire <i style="color:blue">Aujourd'hui</i></th>
                                <th class="align-middle">Total commands Livé</th>
                                <th class="align-middle">Total commands Refusé</th>
                                <th class="align-middle">Total chiffre d'affaire</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox"
                                                id="user-{{ $user->id }}">
                                            <label class="form-check-label" for="user-{{ $user->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $loop->index + 1 }}
                                        <p class="text-muted mb-0"></p>
                                    </td>
                                    <td>
                                        {{ $user->full_name }} ({{$user->type}})
                                    </td>
                                    <td>
                                        {{ $user->commands_livred_now }}
                                    </td>
                                    <td>
                                        {{$user->delivery_total_day_chiffre}} DH
                                    </td>
                                    <td>
                                        {{ $user->commands_livred }}
                                    </td>
                                    <td>
                                        {{ $user->commands_refused }}
                                    </td>
                                    <td>
                                        {{$user->delivery_total_chiffre}} DH
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--<div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ $chart->options['chart_title'] }}</h4>

                <div>
                    
                        {!! $chart->renderHtml() !!}
                    
                </div>
                
            </div>
        </div>
    </div>--}}
</div>
