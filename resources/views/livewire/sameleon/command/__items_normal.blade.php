@foreach ($command->items as $item)
    <p class="text-strong mb-0">
        <strong>{{ $item->product }}</strong>
    </p>

    <div>

        <p class="text-muted mb-0">{{ $item->prix_uni }} (DH) x
            {{ $item->quantity }}
        </p>
        
        <p class="text-muted mb-0">
            {{ $item->designation }}
        </p>
        @if ($item->is_out)
            {{-- <p style="color:red">rupture de stock</p> --}}

            <a class="btn btn-primary btn-sm" href="{{ route('admin:stock.index', ['isOut' => $item->uuid]) }}">
                augmenter le stock
            </a>
        @endif
    </div>
    <hr>
@endforeach
