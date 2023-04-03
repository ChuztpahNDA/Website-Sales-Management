<table class="table">
    <thead>
        <tr>
            <th>URLImages</th>
            <th>nameProduct</th>
            <th>quatity</th>
            <th>priceProduct</th>
            <th>purchaseProduct</th>
            <th>description</th>
        </tr>
    </thead>
    <tbody>
        @if (!empty($products))
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->URLImages }}</td>
                    <td>{{ $product->nameProduct }}</td>
                    <td>{{ $product->quatity }}</td>
                    <td>{{ $product->priceProduct }}</td>
                    <td>{{ $product->purchaseProduct }}</td>
                    <td>{{ $product->description }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
