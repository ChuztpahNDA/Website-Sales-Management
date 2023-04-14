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
            <tr>
                <td>{{ $products['URLImages'] }}</td>
                <td>{{ $products['nameProduct'] }}</td>
                <td>{{ $products['quatity'] }}</td>
                <td>{{ $products['priceProduct'] }}</td>
                <td>{{ $products['purchaseProduct'] }}</td>
                <td>{{ $products['description'] }}</td>
            </tr>
        @endif
    </tbody>
</table>
