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
                                <th class="align-middle">livreure</th>
                                <th class="align-middle">Total commands Livé</th>
                                <th class="align-middle">Date</th>
                                <th class="align-middle">Total</th>
                                <th class="align-middle">Action</th>
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
                                        {{ $user->full_name }}
                                        <p class="text-muted mb-0"></p>
                                    </td>
                                    <td>
                                        100
                                    </td>
                                    <td>
                                        22-07-2022
                                    </td>
                                    <td>
                                        1800DH
                                    </td>
                                    <td>
                                        <div class="d-flex gap-3">

                                            <a href="#" class="text-danger" onclick="
                                                var result = confirm('Are you sure you want to delete this product ?');

                                                if(result){
                                                    event.preventDefault();
                                                    document.getElementById('delete-metric-{{ $user->uuid }}').submit();
                                                }">
                                                <i class="mdi mdi-delete font-size-18"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <form id="delete-metric-{{ $user->uuid }}" method="post"
                                        action="{{ $user->delete_url }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="metricId" value="{{ $user->uuid }}">
                                    </form>
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
