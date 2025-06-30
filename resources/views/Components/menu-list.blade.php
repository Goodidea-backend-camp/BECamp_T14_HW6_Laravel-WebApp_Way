<div class="menu-section">
    <h2 class="menu-title">菜單列表</h2>
    <table class="menu-table">
        <thead>
            <tr>
                <th>品項名稱</th>
                <th>份量</th>
                <th style="text-align: right;">價格</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($storeMenu as $menu)
            <tr>
                <td class="menu-name">{{ $menu['name'] }}</td>
                <td class="menu-property">{{ $menu['property'] }}</td>
                <td class="menu-price">$ {{ $menu['price'] ?? '無資料' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>