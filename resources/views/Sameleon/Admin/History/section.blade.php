<div class="row">

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-5">Dernier actions</h4>
                <ul class="verti-timeline list-unstyled">

                    @foreach($actions as $action)
                        <li class="event-list active">
                            <div class="event-timeline-dot">
                                <i class="bx bxs-right-arrow-circle font-size-18 bx-fade-right"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <h5 class="font-size-14">{{$action->created_at->format('d-m-Y')}} <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i>
                                    </h5>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                       {{auth()->user()->full_name }} {!!$action->description!!}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                {{--<div class="text-center mt-4"><a href="javascript: void(0);"
                        class="btn btn-primary waves-effect waves-light btn-sm">View More <i
                            class="mdi mdi-arrow-right ms-1"></i></a>
                </div>--}}
            </div>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Historique de connexion</h4>
                <div class="ps-section__footer mb-2">
                    <a class="btn-danger btn-sm" href="#" onclick="document.getElementById('deleteHistory').submit();">
                        Vider La list
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle">Date</th>
                                <th class="align-middle">IP</th>
                                <th class="align-middle">Navigateur</th>
                                <th class="align-middle">System</th>

                            </tr>
                        </thead>
                        <tbody>
                          
                            @if ($connections)
                                
                                <tr style="color: red !important ;font-size: 17px;">
                                    {{-- <td>Lorem</td> --}}
                                    <td style="">{{ $connections->lastLogin->logged_in_at ?? '' }}</td>
                                    <td>

                                        {{ $connections->lastLogin->ip ?? '' }} 

                                        
                                    </td>
                                    <td>

                                        {{ $connections->lastLogin->machine ?? '' }}


                                    </td>
                                    <td>

                                        {{ $connections->lastLogin->system ?? '' }}


                                    </td>
                                </tr>
                            @endif
                            @foreach ($sessionsAll as $session)
                                <tr>

                                    <td style="font-size: 17px;">{{ $session->logged_in_at }}</td>
                                    <td>

                                        {{ $session->ip }}


                                    </td>
                                    <td>

                                        {{ $session->machine }}

                                    </td>
                                    <td>

                                        {{ $session->system }}

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <form action="{{route('admin:history.delete')}}" method="post" hidden id="deleteHistory">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="deleteHistory" value="1">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
