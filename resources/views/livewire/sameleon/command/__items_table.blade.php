<div class="table-responsive">
    <table class="table table-bordered mb-0">
        @foreach ($command->items as $item)
        <thead>
            
                <tr class="text-center">
                    <th colspan="3">{{ $item->product }}</th>
                </tr>
                <tr>
                    <th scope="col">Prix</th>
                    <th scope="col">Qté</th>
                    <th scope="col">Designation</th>
                </tr>
            
        </thead>
       
        <tbody>
            
                <tr>
                    <td>{{ $item->prix_uni }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td> {{ $item->designation }}</td>
                </tr>
           
        </tbody>
        @endforeach
    </table>
</div>
