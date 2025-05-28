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
</style>

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
@else
<p class="no-stores">目前沒有店家資料</p>
@endif