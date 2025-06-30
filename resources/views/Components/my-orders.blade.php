<div class="menu-section">
    <h2 class="menu-title">我的訂購</h2>
    <table class="menu-table">
        <thead>
            <tr>
                <th>品項名稱</th>
                <th>數量</th>
                <th>總價格</th>
                <th>是否已付款</th>
                <th>備註</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($userOrder['myOrderRecords']) && $userOrder['myOrderRecords']->isNotEmpty())
            @foreach ($userOrder['myOrderRecords'] as $record)
            <tr>
                <td class="menu-name">{{ $record['product_name'] }}</td>
                <td class="menu-property">{{ $record['number'] }}</td>
                <td class="menu-price">$ {{ $record['total_price'] ?? '無資料' }}</td>
                <td>{{ $record['is_paid'] ? '是' : '否' }}</td>
                <td class="menu-property">{{ $record['description'] }}</td>
                <td>
                    <button>編輯</button>
                    <form action="/orders/{{ $record['id'] }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('確定要刪除這筆訂單嗎？')">刪除</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" style="text-align: center;">目前沒有您的訂單</td>
            </tr>
            @endif
        </tbody>
    </table>
    <h3>新增訂單</h3>
    <form>
        <label for="product_name">品項名稱:</label><br>
        <select id="product_name" name="product_name">
            @if(isset($storeMenu) && $storeMenu->isNotEmpty())
            @foreach ($storeMenu as $menu)
            <option value="{{ $menu['name'] }}">{{ $menu['name'] }}</option>
            @endforeach
            @else
            <option value="">無可用菜單</option>
            @endif
        </select><br>
        <label for="product_property">份量:</label><br>
        <select id="product_property" name="product_property">
            <option value="">請先選擇品項</option>
        </select><br>
        <label for="number">數量:</label><br>
        <input type="number" id="number" name="number" value="1" min="1"><br>
        <div>
            <label for="price_display">單價:</label> <span id="price_display"></span>
            <label for="total_price_display" style="margin-left: 20px;">總金額:</label> <span id="total_price_display"></span>
        </div><br>
        <label for="description">備註:</label><br>
        <textarea id="description" name="description"></textarea><br>
        <input type="submit" value="送出">
    </form>

    <script>
        const storeMenuData = <?php echo json_encode($storeMenu); ?>;
    </script>
    <script src="{{ asset('js/bandon-order.js') }}"></script>
</div>