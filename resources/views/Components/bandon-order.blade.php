<style>
    /* ... 您的 CSS 維持不變 ... */
    .stores-container {
        max-width: 1200px;
        margin: 0 auto;
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

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close-button:hover,
    .close-button:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-buttons {
        text-align: right;
        margin-top: 20px;
    }

    .modal-buttons button {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
    }

    .modal-buttons .confirm-button {
        background-color: #007bff;
        color: white;
    }

    .modal-buttons .cancel-button {
        background-color: #6c757d;
        color: white;
        margin-right: 10px;
    }

    .collapsible-title {
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-right: 10px;
    }

    .toggle-icon {
        font-size: 0.8em;
        transition: transform 0.3s ease;
    }

    .toggle-icon.rotated {
        transform: rotate(-90deg);
    }

    .collapsible-content.collapsed {
        display: none;
    }
</style>

@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

@php
$hasAnyContent = false;
@endphp

<div class="stores-container">
    <h2 class="menu-title collapsible-title" id="storeInfoAndMenuToggle">
        店家資訊與菜單 <span class="toggle-icon">▼</span>
    </h2>
    <div class="collapsible-content" id="storeInfoAndMenuContent">
        <div class="store-info-section">
            <h1 class="store-info-title">{{ $responseData['storeInfo'][0]['name'] }}</h1>
            <div class="store-info-content">
                <div class="store-info-item">
                    <span class="store-info-label">電話：</span>
                    <span class="store-info-value">{{ $responseData['storeInfo'][0]['phone'] }}</span>
                </div>
                <div class="store-info-item">
                    <span class="store-info-label">地址：</span>
                    <span class="store-info-value">{{ $responseData['storeInfo'][0]['address'] }}</span>
                </div>
                @if(isset($responseData['storeInfo'][0]['description']))
                <div class="store-description">
                    <div class="store-info-label">店家介紹：</div>
                    <div class="store-info-value">{{ $responseData['storeInfo'][0]['description'] }}</div>
                </div>
                @endif
            </div>
        </div>
        @php $hasAnyContent = true; @endphp
        @if(isset($responseData['storeMenu']) && $responseData['storeMenu']->isNotEmpty())
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
                    @foreach ($responseData['storeMenu'] as $menu)
                    <tr>
                        <td class="menu-name">{{ $menu['name'] }}</td>
                        <td class="menu-property">{{ $menu['property'] }}</td>
                        <td class="menu-price">$ {{ $menu['price'] ?? '無資料' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @php $hasAnyContent = true; @endphp
        @endif
    </div>

    @if(isset($responseData['userOrder']))
    <div class="menu-section">
        <h2 class="menu-title">我的訂購</h2>
        <form action="/dinbandon/orders/" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $responseData['order_id'] ?? null}}">
            <input type="hidden" name="store_id" value="{{ $responseData['store_id'] }}">
            <table class="menu-table" id="myOrdersTable">
                <thead>
                    <tr>
                        <th>品項名稱</th>
                        <th>數量</th>
                        <th>總價格</th>
                        <th>是否已付款</th>
                        <th>份量</th>
                        <th>備註</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($responseData['userOrder']['myOrderRecords']) && $responseData['userOrder']['myOrderRecords']->isNotEmpty())
                    @foreach ($responseData['userOrder']['myOrderRecords'] as $record)
                    <tr>
                        <td class="menu-name">{{ $record['product_name'] }}</td>
                        <td>
                            <input type="number" name="orders[{{ $record['id'] }}][number]" value="{{ $record['number'] }}" min="1" class="form-control">
                        </td>
                        <td class="menu-price">$ {{ number_format($record['total_price'], 2) ?? '無資料' }}</td>
                        <td>
                            <input type="hidden" name="orders[{{ $record['id'] }}][is_paid]" value="{{ $record['is_paid'] ? 1 : 0 }}">
                            {{ $record['is_paid'] ? '是' : '否' }}
                        </td>
                        <td>{{ $record['property'] ?? '無資料' }}</td>
                        <td class="menu-property">
                            <input type="text" name="orders[{{ $record['id'] }}][description]" value="{{ $record['description'] }}" class="form-control">
                        </td>
                        <input type="hidden" name="orders[{{ $record['id'] }}][id]" value="{{ $record['id'] }}">
                        <input type="hidden" name="orders[{{ $record['id'] }}][product_name]" value="{{ $record['product_name'] }}">
                        <input type="hidden" name="orders[{{ $record['id'] }}][total_price]" value="{{ $record['total_price'] }}">
                        <input type="hidden" name="orders[{{ $record['id'] }}][product_property]" value="{{ $record['property'] }}">
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" style="text-align: center;">目前沒有您的訂單</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <button type="submit" class="submit-all-orders-button">提交所有訂單變更</button>
        </form>

        <h3>新增訂單</h3>
        <label for="product_name">品項名稱:</label><br>
        <select id="product_name" name="product_name">
            @if(isset($responseData['storeMenu']) && $responseData['storeMenu']->isNotEmpty())
            @php
            $uniqueProductNames = $responseData['storeMenu']->unique('name');
            @endphp
            @foreach ($uniqueProductNames as $menuItem)
            <option value="{{ $menuItem['name'] }}">{{ $menuItem['name'] }}</option>
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
        <button type="submit" name="submit_action" value="create_unpaid">新增未付款訂單</button>
        <input type="hidden" id="isPaidInput" name="is_paid" value="0">

        <script>
            // 將菜單資料儲存在客戶端，以便 JS 使用
            const storeMenuData = <?php echo json_encode($responseData['storeMenu'] ?? []); ?>;

            document.addEventListener('DOMContentLoaded', function() {
                // --- DOM 元素 ---
                const productSelect = document.getElementById('product_name');
                const propertySelect = document.getElementById('product_property');
                const priceDisplay = document.getElementById('price_display');
                const numberInput = document.getElementById('number');
                const totalPriceDisplay = document.getElementById('total_price_display');
                const isPaidInput = document.getElementById('isPaidInput');
                const createPaidButton = document.querySelector('button[name="submit_action"][value="create_paid"]');
                const createUnpaidButton = document.querySelector('button[name="submit_action"][value="create_unpaid"]');
                const myOrdersTbody = document.querySelector('#myOrdersTable tbody');

                const editQuantityModal = document.getElementById('editQuantityModal');
                const closeButton = editQuantityModal.querySelector('.close-button');
                const cancelButton = editQuantityModal.querySelector('.cancel-button');
                const editQuantityForm = document.getElementById('editQuantityForm');
                const editProductNameInput = document.getElementById('editProductName');
                const editProductPropertyInput = document.getElementById('editProductProperty');
                const editQuantityInput = document.getElementById('editQuantity');
                const editPriceDisplay = document.getElementById('editPriceDisplay');
                const editTotalPriceDisplay = document.getElementById('editTotalPriceDisplay');

                let currentOrderRow = null; // 追蹤正在被編輯的表格行 (<tr>)
                let originalQuantity = 0; // 新增變數來儲存原始數量
                let originalTotalPrice = 0; // 新增變數來儲存原始總價

                // --- 函式 ---

                // 獲取單一菜單項目的價格
                function getMenuItemPrice(productName, productProperty) {
                    const normalizedProductName = productName.trim().toLowerCase();
                    const normalizedProductProperty = (productProperty || '').trim().toLowerCase();

                    let selectedMenuItem = storeMenuData.find(menu => {
                        const menuName = menu.name.trim().toLowerCase();
                        const menuProperty = (menu.property || '').trim().toLowerCase();
                        return menuName === normalizedProductName && menuProperty === normalizedProductProperty;
                    });

                    if (!selectedMenuItem && normalizedProductProperty === '') {
                        const potentialMatchesByName = storeMenuData.filter(menu =>
                            menu.name.trim().toLowerCase() === normalizedProductName
                        );

                        if (potentialMatchesByName.length === 1) {
                            selectedMenuItem = potentialMatchesByName[0];
                        } else if (potentialMatchesByName.length > 1) {
                            selectedMenuItem = potentialMatchesByName.find(menu =>
                                (menu.property || '').trim().toLowerCase() === ''
                            );
                        }
                    }
                    return selectedMenuItem && !isNaN(parseFloat(selectedMenuItem.price)) ? parseFloat(selectedMenuItem.price) : 0;
                }

                // [新增訂單] 填充份量選項
                function populatePropertySelect(selectedProductName) {
                    propertySelect.innerHTML = '';
                    const filteredMenus = storeMenuData.filter(menu => menu.name === selectedProductName);
                    const uniqueProperties = [...new Set(filteredMenus.map(menu => menu.property))];

                    if (uniqueProperties.length > 0) {
                        uniqueProperties.forEach(property => {
                            const option = document.createElement('option');
                            option.value = property;
                            option.textContent = property;
                            propertySelect.appendChild(option);
                        });
                        propertySelect.disabled = false;
                    } else {
                        propertySelect.innerHTML = '<option value="">無可用份量</option>';
                        propertySelect.disabled = true;
                    }
                    updateNewOrderPriceDisplay();
                }

                // [新增訂單] 更新價格顯示
                function updateNewOrderPriceDisplay() {
                    const selectedProductName = productSelect.value;
                    const selectedProperty = propertySelect.value;
                    const number = parseInt(numberInput.value);

                    const price = getMenuItemPrice(selectedProductName, selectedProperty);

                    priceDisplay.textContent = price > 0 ? `$ ${price.toFixed(2)}` : '無資料';

                    if (!isNaN(price) && !isNaN(number) && number >= 1) {
                        totalPriceDisplay.textContent = `$ ${(price * number).toFixed(2)}`;
                    } else {
                        totalPriceDisplay.textContent = '請輸入有效數量';
                    }
                }

                // [編輯訂單] 更新彈窗內的價格顯示
                function updateEditPriceAndTotalDisplay() {
                    const productName = editProductNameInput.value;
                    const productProperty = editProductPropertyInput.value;
                    const number = parseInt(editQuantityInput.value);

                    const price = getMenuItemPrice(productName, productProperty);

                    editPriceDisplay.textContent = price > 0 ? `$ ${price.toFixed(2)}` : '查無單價';

                    if (!isNaN(price) && price > 0 && !isNaN(number) && number >= 1) {
                        editTotalPriceDisplay.textContent = `$ ${(price * number).toFixed(2)}`;
                    } else {
                        editTotalPriceDisplay.textContent = '無法計算';
                    }
                }

                // --- 事件監聽器 ---

                // [新增訂單] 初始化與事件綁定
                if (productSelect.value) {
                    populatePropertySelect(productSelect.value);
                } else {
                    updateNewOrderPriceDisplay();
                }
                productSelect.addEventListener('change', () => populatePropertySelect(productSelect.value));
                propertySelect.addEventListener('change', updateNewOrderPriceDisplay);
                numberInput.addEventListener('input', updateNewOrderPriceDisplay);

                // [我的訂購] 監聽數量變化並更新總價格
                const myOrdersTable = document.getElementById('myOrdersTable');
                if (myOrdersTable) {
                    myOrdersTable.addEventListener('input', function(event) {
                        // 檢查事件目標是否為數量輸入框 (名稱包含 [number])
                        if (event.target.matches('input[name*="[number]"]')) {
                            const quantityInput = event.target;
                            const newQuantity = parseInt(quantityInput.value);

                            // 確保數量為有效數字且大於等於 1
                            if (isNaN(newQuantity) || newQuantity < 1) {
                                // 可以選擇在此處處理無效輸入，例如重置為 1 或顯示錯誤訊息
                                return;
                            }

                            const row = quantityInput.closest('tr'); // 獲取當前行
                            // 從輸入框的 name 屬性中提取 orderId (例如從 orders[123][number] 中提取 123)
                            const orderIdMatch = quantityInput.name.match(/orders\[(.*?)\]\[number\]/);
                            const orderId = orderIdMatch ? orderIdMatch[1] : null;

                            if (row && orderId) {
                                // 從同行的隱藏輸入框中獲取 product_name 和 product_property
                                const productNameInput = row.querySelector(`input[name="orders[${orderId}][product_name]"]`);
                                const productPropertyInput = row.querySelector(`input[name="orders[${orderId}][product_property]"]`);

                                const productName = productNameInput ? productNameInput.value : '';
                                const productProperty = productPropertyInput ? productPropertyInput.value : '';

                                // 使用現有的 getMenuItemPrice 函式獲取單價
                                const unitPrice = getMenuItemPrice(productName, productProperty);
                                // 計算新的總價格
                                const newTotalPrice = (unitPrice * newQuantity).toFixed(2);

                                // 更新顯示的總價格
                                const priceDisplayTd = row.querySelector('.menu-price');
                                if (priceDisplayTd) {
                                    priceDisplayTd.textContent = `$ ${newTotalPrice}`;
                                }

                                // 更新隱藏的 total_price 輸入框的值 (以便表單提交時傳遞正確的總價)
                                const hiddenTotalPriceInput = row.querySelector(`input[name="orders[${orderId}][total_price]"]`);
                                if (hiddenTotalPriceInput) {
                                    hiddenTotalPriceInput.value = newTotalPrice;
                                }
                            }
                        }
                    });
                }

                // [新增訂單] 處理「新增未付款訂單」按鈕的點擊事件 (純前端更新)
                if (createUnpaidButton) {
                    createUnpaidButton.addEventListener('click', function(event) {
                        event.preventDefault(); // 阻止表單的預設提交行為

                        const productName = productSelect.value;
                        const productProperty = propertySelect.value;
                        const number = parseInt(numberInput.value);
                        const description = document.getElementById('description').value;

                        // HTML 實體編碼描述，防止 XSS 和破壞 HTML 結構
                        const encodedDescription = document.createElement('div');
                        encodedDescription.textContent = description;
                        const safeDescription = encodedDescription.innerHTML;

                        const price = getMenuItemPrice(productName, productProperty);
                        const totalPrice = (price * number).toFixed(2); // 計算總金額

                        // For newly added rows, we need a temporary unique ID
                        const tempOrderId = `temp_${Date.now()}_${Math.floor(Math.random() * 1000)}`;

                        // 創建新的表格行
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td class="menu-name">${productName}</td>
                            <td>
                                <input type="number" name="orders[${tempOrderId}][number]" value="${number}" min="1" class="form-control">
                            </td>
                            <td class="menu-price">$ ${totalPrice}</td>
                            <td>
                                <input type="hidden" name="orders[${tempOrderId}][is_paid]" value="0">
                                否
                            </td>
                            <td>${productProperty}</td>
                            <td class="menu-property">
                                <input type="text" name="orders[${tempOrderId}][description]" value="${safeDescription}" class="form-control">
                            </td>
                            <input type="hidden" name="orders[${tempOrderId}][id]" value="${tempOrderId}">
                            <input type="hidden" name="orders[${tempOrderId}][product_name]" value="${productName}">
                            <input type="hidden" name="orders[${tempOrderId}][total_price]" value="${totalPrice}">
                            <input type="hidden" name="orders[${tempOrderId}][product_property]" value="${productProperty}">
                        `;

                        // 檢查是否有「目前沒有您的訂單」的提示行，如果有則移除
                        const noOrderRow = myOrdersTbody.querySelector('tr > td[colspan="6"]');
                        if (noOrderRow) {
                            noOrderRow.closest('tr').remove();
                        }

                        // 將新行添加到表格中
                        myOrdersTbody.appendChild(newRow);

                        // 清空表單
                        productSelect.value = storeMenuData.length > 0 ? storeMenuData[0].name : '';
                        populatePropertySelect(productSelect.value); // 重新填充份量選項
                        numberInput.value = '1';
                        document.getElementById('description').value = '';
                        updateNewOrderPriceDisplay(); // 更新價格顯示
                    });
                }

                // [編輯訂單] 點擊 "編輯" 按鈕 (使用事件委派)
                myOrdersTbody.addEventListener('click', function(event) {
                    const button = event.target.closest('.edit-order-button');
                    if (button) {
                        currentOrderRow = button.closest('tr');

                        const productName = button.getAttribute('data-product-name');
                        const productProperty = button.getAttribute('data-product-property');
                        const currentQuantityStr = button.getAttribute('data-current-quantity');

                        // 擷取原始數量和總價
                        originalQuantity = parseInt(currentQuantityStr);
                        // 從表格的第三個<td>（索引為2）獲取總價文本，去除'$'並解析為浮點數
                        const originalTotalPriceText = currentOrderRow.children[2].textContent;
                        originalTotalPrice = parseFloat(originalTotalPriceText.replace('$', '').trim());

                        editProductNameInput.value = productName;
                        editProductPropertyInput.value = productProperty;
                        editQuantityInput.value = currentQuantityStr;

                        editQuantityModal.style.display = 'flex';
                        // 打開彈窗時立即更新一次價格
                        updateEditPriceAndTotalDisplay();
                    }
                });

                // [編輯訂單] 在彈窗中修改數量時，即時更新總價
                editQuantityInput.addEventListener('input', updateEditPriceAndTotalDisplay);

                // [編輯訂單] 關閉彈窗
                closeButton.addEventListener('click', () => editQuantityModal.style.display = 'none');
                cancelButton.addEventListener('click', () => editQuantityModal.style.display = 'none');
                window.addEventListener('click', (event) => {
                    if (event.target === editQuantityModal) {
                        editQuantityModal.style.display = 'none';
                    }
                });

                // [編輯訂單] 處理表單提交 (純前端更新)
                editQuantityForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const newQuantity = parseInt(editQuantityInput.value);
                    const newTotalPriceText = editTotalPriceDisplay.textContent;
                    const newTotalPrice = parseFloat(newTotalPriceText.replace('$', '').trim());

                    // 從 currentOrderRow 中找到編輯按鈕以獲取 orderId
                    const editButtonInRow = currentOrderRow.querySelector('.edit-order-button');
                    const orderId = editButtonInRow ? editButtonInRow.getAttribute('data-order-id') : null;

                    // 檢查數量和總金額是否有實際變動
                    if (newQuantity === originalQuantity && newTotalPrice.toFixed(2) === originalTotalPrice.toFixed(2)) {
                        alert('沒有任何變更，無需更新。');
                        editQuantityModal.style.display = 'none';
                        return; // 退出函式，因為無需更新
                    }

                    // 確保有找到價格才能更新
                    if (currentOrderRow && newTotalPriceText !== '無法計算' && newTotalPriceText !== '查無單價' && !isNaN(newTotalPrice) && newTotalPrice >= 0) {
                        // 更新表格中的數量和總價
                        currentOrderRow.children[1].textContent = newQuantity;
                        currentOrderRow.children[2].textContent = newTotalPriceText;

                        // 更新按鈕上的 data-屬性，以便下次編輯
                        if (editButtonInRow) {
                            editButtonInRow.setAttribute('data-current-quantity', newQuantity);
                        }

                        editQuantityModal.style.display = 'none';

                    } else {
                        alert('無法更新，因為價格計算無效或找不到對應的菜單項目。');
                    }
                });

                // [通用] 可折疊區塊功能
                const storeInfoAndMenuToggle = document.getElementById('storeInfoAndMenuToggle');
                const storeInfoAndMenuContent = document.getElementById('storeInfoAndMenuContent');
                const toggleIcon = storeInfoAndMenuToggle.querySelector('.toggle-icon');

                if (storeInfoAndMenuToggle) {
                    storeInfoAndMenuToggle.addEventListener('click', function() {
                        storeInfoAndMenuContent.classList.toggle('collapsed');
                        toggleIcon.classList.toggle('rotated');
                    });
                }
            });
        </script>
    </div>
    @php $hasAnyContent = true; @endphp
    @endif

    @if(isset($responseData['userOrder']) && isset($responseData['userOrder']['otherParticipantsRecords']) && $responseData['userOrder']['otherParticipantsRecords']->isNotEmpty())
    @php $hasAnyContent = true; @endphp
    @endif

    @if($hasAnyContent === false)
    <p>目前沒有資料</p>
    @endif
</div>
<!-- Edit Quantity Modal -->
<div id="editQuantityModal" class="modal">
    <div class="modal-content">
        <span class="close-button">×</span>
        <h2>修改訂單數量</h2>
        <!-- 移除 onsubmit="return false;"，由 JS event listener 控制 -->
        <form id="editQuantityForm">
            <input type="hidden" id="editProductName" name="product_name">
            <input type="hidden" id="editProductProperty" name="product_property">
            <label for="editQuantity">數量:</label>
            <input type="number" id="editQuantity" name="number" min="1" required style="width: 100%; padding: 8px; margin-top: 5px; margin-bottom: 15px;">
            <div>
                <span>單價: </span><span id="editPriceDisplay" style="font-weight: bold;"></span>
                <span style="margin-left: 20px;">總金額: </span><span id="editTotalPriceDisplay" style="font-weight: bold; color: #e74c3c;"></span>
            </div>
            <div class="modal-buttons">
                <button type="button" class="cancel-button">取消</button>
                <button type="submit" class="confirm-button">更新</button>
            </div>
        </form>
    </div>
</div>