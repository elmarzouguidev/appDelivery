<div class="col-xl-3 col-lg-4">
    <div class="card">
        <div class="card-body p-4">
            {{-- <div class="search-box">
                <p class="text-muted">Search</p>
                <div class="position-relative">
                    <input type="text" class="form-control rounded bg-light border-light" placeholder="Search...">
                    <i class="mdi mdi-magnify search-icon"></i>
                </div>
            </div> --}}
            <div>
                <ul class="list-unstyled " style="font-size: 16px; ">
                    
                    <li>
                        <a href="{{ route('admin:settings.index') }}" class="py-2 d-block">
                            <i class="bx bx-wrench"></i>
                            Société
                        </a>
                    </li> 
                
                    <li>
                        <a href="{{ route('admin:settings.invoice') }}" class="py-2 d-block">
                            <i class="bx bx-food-menu"></i>
                            Facturation
                        </a>
                    </li>
                    {{--<li>
                        <a href="{{ route('admin:settings.integrations.index') }}" class="py-2 d-block">
                            <i class="bx bx-shape-square"></i>
                            Integrations
                        </a>
                    </li>--}}
                    {{--<li>
                        <a href="javascript: void(0);" class="text-muted py-2 d-block">
                            <i class="mdi mdi-chevron-right me-1"></i> Development <span
                                class="badge badge-soft-success rounded-pill float-end ms-1 font-size-12">04</span>
                        </a>
                    </li>--}}
                </ul>
            </div>

            {{--<div>
                <p class="text-muted">Tags</p>

                <div class="d-flex flex-wrap gap-2 widget-tag">
                    <div><a href="javascript: void(0);" class="badge bg-light font-size-12">Design</a></div>
                    <div><a href="javascript: void(0);" class="badge bg-light font-size-12">Development</a></div>
                    <div><a href="javascript: void(0);" class="badge bg-light font-size-12">Business</a></div>
                    <div><a href="javascript: void(0);" class="badge bg-light font-size-12">Project</a></div>
                    <div><a href="javascript: void(0);" class="badge bg-light font-size-12">Travel</a></div>
                    <div><a href="javascript: void(0);" class="badge bg-light font-size-12">Lifestyle</a></div>
                    <div><a href="javascript: void(0);" class="badge bg-light font-size-12">Photography</a></div>
                </div>
            </div>--}}
        </div>
    </div>
</div>