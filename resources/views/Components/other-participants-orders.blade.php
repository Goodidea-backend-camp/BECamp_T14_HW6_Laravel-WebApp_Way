<div class="menu-section">
    <h2 class="menu-title">其他人的訂單</h2>
    <table class="menu-table">
        <thead>
            <tr>
                <th>使用者名稱</th>
                <th>品項名稱</th>
                <th>數量</th>
                <th>總價格</th>
                <th>是否已付款</th>
                <th>備註</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($otherParticipantsRecords as $record)
            <tr>
                <td class="menu-name">{{ $record['user_name'] }}</td>
                <td class="menu-name">{{ $record['product_name'] }}</td>
                <td class="menu-property">{{ $record['number'] }}</td>
                <td class="menu-price">$ {{ $record['total_price'] ?? '無資料' }}</td>
                <td>{{ $record['is_paid'] ? '是' : '否' }}</td>
                <td class="menu-property">{{ $record['description'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>