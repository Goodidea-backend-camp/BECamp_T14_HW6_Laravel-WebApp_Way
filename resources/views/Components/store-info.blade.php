<div class="store-info-section">
    <h1 class="store-info-title">{{ $storeInfo[0]['name'] }}</h1>
    <div class="store-info-content">
        <div class="store-info-item">
            <span class="store-info-label">電話：</span>
            <span class="store-info-value">{{ $storeInfo[0]['phone'] }}</span>
        </div>
        <div class="store-info-item">
            <span class="store-info-label">地址：</span>
            <span class="store-info-value">{{ $storeInfo[0]['address'] }}</span>
        </div>
        @if(isset($storeInfo[0]['description']))
        <div class="store-description">
            <div class="store-info-label">店家介紹：</div>
            <div class="store-info-value">{{ $storeInfo[0]['description'] }}</div>
        </div>
        @endif
    </div>
</div>