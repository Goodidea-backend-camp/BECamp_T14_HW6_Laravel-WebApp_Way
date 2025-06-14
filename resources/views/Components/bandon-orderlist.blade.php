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

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        border-radius: 8px;
        position: relative;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: black;
    }

    .modal-iframe {
        width: 100%;
        height: 500px;
        border: none;
    }

    .post-button {
        padding: 5px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        margin-left: 10px;
    }

    .post-button:hover {
        background-color: #45a049;
    }

    .time-inputs {
        display: flex;
        flex-direction: column;
        gap: 5px;
        margin-right: 10px;
    }

    .time-input {
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .time-label {
        color: #666;
        font-size: 14px;
        white-space: nowrap;
    }

    .time-group {
        display: flex;
        align-items: center;
        gap: 5px;
    }
</style>

<script>
    @if(session('success'))
    alert("{{ session('success') }}");
    @endif

    function openStoreModal(storeId) {
        var modal = document.getElementById('storeModal');
        var iframe = document.getElementById('storeIframe');
        iframe.src = '/dinbandon/stores/' + storeId;
        modal.style.display = "block";
    }

    function closeStoreModal() {
        var modal = document.getElementById('storeModal');
        modal.style.display = "none";
    }

    // 點擊 modal 外部時關閉
    window.onclick = function(event) {
        var modal = document.getElementById('storeModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

@php
$hasAnyContent = false;
@endphp

@if(isset($stores) && $stores->isNotEmpty())
<div class="stores-container">
    <h1 class="stores-title">商店清單</h1>
    <div class="stores-list">
        @foreach ($stores as $store)
        <div class="stores-item" style="display: flex; align-items: center; justify-content: space-between;">
            <div onclick="openStoreModal({{ $store->id }})" style="cursor: pointer; flex: 1;">
                <div class="store-name">{{ $store->name }}</div>
                <div class="store-phone">{{ $store->phone }}</div>
                <div class="store-address">{{ $store->address ?? '無資料' }}</div>
            </div>
            <form action="/dinbandon/orders" method="POST" style="margin: 0; display: flex; align-items: center;">
                @csrf
                <input type="hidden" name="store_id" value="{{ $store->id }}">
                <div class="time-inputs">
                    <div class="time-group">
                        <span class="time-label">開始：</span>
                        <input type="datetime-local" name="start_time" class="time-input" required>
                    </div>
                    <div class="time-group">
                        <span class="time-label">結束：</span>
                        <input type="datetime-local" name="end_time" class="time-input" required>
                    </div>
                </div>
                <button type="submit" class="post-button">建立新團購單</button>
            </form>
        </div>
        @endforeach
    </div>
    <div class="pagination-container">
        {{ $stores->links('pagination::bootstrap-4')  }}
    </div>
</div>

<!-- Modal -->
<div id="storeModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeStoreModal()">&times;</span>
        <iframe id="storeIframe" class="modal-iframe"></iframe>
    </div>
</div>
@php $hasAnyContent = true; @endphp
@endif

@if($hasAnyContent === false)
<p class="no-stores">目前沒有資料</p>
@endif