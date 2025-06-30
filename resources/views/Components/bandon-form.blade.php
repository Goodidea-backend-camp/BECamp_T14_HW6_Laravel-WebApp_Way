<style>
    .form-container {
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #333;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
    }

    .form-textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        min-height: 100px;
        resize: vertical;
    }

    .menu-container {
        margin-top: 2rem;
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .menu-item {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 4px;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-primary {
        background-color: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background-color: #2980b9;
    }

    .btn-secondary {
        background-color: #95a5a6;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #7f8c8d;
    }

    .btn-danger {
        background-color: #e74c3c;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }
</style>

<form action="/dinbandon/stores" method="POST" class="form-container">
    @csrf
    <div class="form-group">
        <label class="form-label" for="name">店家名稱</label>
        <input type="text" id="name" name="name" class="form-input" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="phone">電話</label>
        <input type="tel" id="phone" name="phone" class="form-input" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="address">地址</label>
        <input type="text" id="address" name="address" class="form-input" required>
    </div>

    <div class="form-group">
        <label class="form-label" for="description">店家描述</label>
        <textarea id="description" name="description" class="form-textarea"></textarea>
    </div>

    <div class="menu-container">
        <h3>菜單項目</h3>
        <div id="menu-items">
            <div class="menu-item">
                <input type="text" name="menu[0][name]" class="form-input" placeholder="餐點名稱" required>
                <input type="number" name="menu[0][price]" class="form-input" placeholder="價格" step="0.01" required>
                <select name="menu[0][property]" class="form-input" required>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="份">份</option>
                </select>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" onclick="addMenuItem()">新增菜單項目</button>
    </div>

    <div style="margin-top: 2rem;">
        <button type="submit" class="btn btn-primary">送出</button>
    </div>
</form>

<script>
    let menuItemCount = 1;

    function addMenuItem() {
        const menuItems = document.getElementById('menu-items');
        const newItem = document.createElement('div');
        newItem.className = 'menu-item';
        newItem.innerHTML = `
            <input type="text" name="menu[${menuItemCount}][name]" class="form-input" placeholder="餐點名稱" required>
            <input type="number" name="menu[${menuItemCount}][price]" class="form-input" placeholder="價格" step="0.01" required>
            <select name="menu[${menuItemCount}][property]" class="form-input" required>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="份">份</option>
            </select>
            <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">刪除</button>
        `;
        menuItems.appendChild(newItem);
        menuItemCount++;
    }
</script>