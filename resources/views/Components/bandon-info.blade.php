<style>
    .stores-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .stores-title {
        margin-bottom: 20px;
        color: #333;
    }

    .stores-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .stores-item {
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .store-name {
        font-size: 1.2em;
        margin-bottom: 8px;
    }

    .store-name a {
        color: #2c3e50;
        text-decoration: none;
    }

    .store-name a:hover {
        color: #3498db;
    }

    .store-phone,
    .store-address {
        color: #666;
        margin-top: 5px;
    }

    .pagination-container {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
        margin: 0;
    }

    .page-item {
        margin: 0 2px;
    }

    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        text-decoration: none;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        cursor: auto;
        background-color: #fff;
        border-color: #dee2e6;
    }

    .page-link:hover {
        z-index: 2;
        color: #0056b3;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .no-stores {
        text-align: center;
        color: #666;
        padding: 20px;
    }

    .store-info-section {
        background-color: #f8f9fa;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .store-info-title {
        font-size: 1.8em;
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .store-info-content {
        display: grid;
        gap: 15px;
    }

    .store-info-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .store-info-label {
        font-weight: 600;
        color: #666;
        min-width: 80px;
    }

    .store-info-value {
        color: #333;
    }

    .store-description {
        margin-top: 20px;
        padding: 15px;
        background-color: #fff;
        border-radius: 8px;
        border-left: 4px solid #3498db;
    }

    .menu-section {
        margin-top: 30px;
    }

    .menu-title {
        font-size: 1.5em;
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .menu-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .menu-table th {
        background-color: #f8f9fa;
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
        color: #2c3e50;
        border-bottom: 2px solid #dee2e6;
    }

    .menu-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #dee2e6;
        color: #333;
    }

    .menu-table tr:last-child td {
        border-bottom: none;
    }

    .menu-table tr:hover {
        background-color: #f8f9fa;
    }

    .menu-name {
        font-weight: 500;
        color: #2c3e50;
    }

    .menu-property {
        color: #666;
    }

    .menu-price {
        font-weight: 500;
        color: #e74c3c;
        text-align: right;
    }
</style>

<script>
    @if(session('success'))
    alert("{{ session('success') }}");
    @endif
</script>

@if(isset($stores) && $stores->isNotEmpty())
<div class="stores-container">
    <h1 class="stores-title">商店清單</h1>
    <div class="stores-list">
        @foreach ($stores as $store)
        <a href="/dinbandon/stores/{{ $store->id }}">
            <div class="stores-item">
                <div class="store-name">{{ $store->name }}</div>
                <div class="store-phone">{{ $store->phone }}</div>
                <div class="store-address">{{ $store->address ?? '無資料' }}</div>
            </div>
        </a>
        @endforeach
    </div>
    <div class="pagination-container">
        {{ $stores->links('pagination::bootstrap-4')  }}
    </div>
</div>
@elseif(isset($storeInfo) && isset($menus) && $storeInfo && $menus->isNotEmpty())
<div class="stores-container">
    <div class="store-info-section">
        <h1 class="store-info-title">{{ $storeInfo->name }}</h1>
        <div class="store-info-content">
            <div class="store-info-item">
                <span class="store-info-label">電話：</span>
                <span class="store-info-value">{{ $storeInfo->phone }}</span>
            </div>
            <div class="store-info-item">
                <span class="store-info-label">地址：</span>
                <span class="store-info-value">{{ $storeInfo->address }}</span>
            </div>
            @if($storeInfo->description)
            <div class="store-description">
                <div class="store-info-label">店家介紹：</div>
                <div class="store-info-value">{{ $storeInfo->description }}</div>
            </div>
            @endif
        </div>
    </div>

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
                @foreach ($menus as $menu)
                <tr>
                    <td class="menu-name">{{ $menu->name }}</td>
                    <td class="menu-property">{{ $menu->property }}</td>
                    <td class="menu-price">$ {{ $menu->price ?? '無資料' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<p class="no-stores">目前沒有店家資料</p>
@endif