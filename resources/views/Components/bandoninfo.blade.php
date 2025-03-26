<style>
    .tab-container {
        width: 100%;
        max-width: 1000px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .tabs {
        display: flex;
        border-bottom: 2px solid #ddd;
    }

    .tab-button {
        flex: 1;
        padding: 15px;
        text-align: center;
        background-color: #f4f4f4;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .tab-button:hover {
        background-color: #e0e0e0;
    }

    .tab-button.active {
        background-color: #007BFF;
        color: #fff;
    }

    .tab-content {
        display: none;
        padding: 20px;
    }

    .tab-content.active {
        display: block;
    }
</style>
<script>
    function switchTab(event, tabId) {
        // 移除所有 tab 按鈕的 active 類
        let buttons = document.querySelectorAll('.tab-button');
        buttons.forEach(button => {
            button.classList.remove('active');
        });

        // 顯示選中的 tab 內容並激活對應的 tab 按鈕
        event.currentTarget.classList.add('active');

        let contents = document.querySelectorAll('.tab-content');
        contents.forEach(content => {
            content.classList.remove('active');
        });

        document.getElementById(tabId).classList.add('active');
    }
</script>
<div class="tab-container">
    <div class="tabs">
        <button class="tab-button active" onclick="switchTab(event, 'tab1')">商家資訊</button>
        <button class="tab-button" onclick="switchTab(event, 'tab2')">訂購資訊</button>
        <button class="tab-button" onclick="switchTab(event, 'tab3')">新增店家</button>
        <button class="tab-button" onclick="switchTab(event, 'tab4')">團購去</button>
    </div>
    <div id="tab1" class="tab-content active">
        <h2>商家資訊</h2>
        <p>列出所有商家資訊。</p>
    </div>
    <div id="tab2" class="tab-content">
        <h2>訂購資訊</h2>
        <p>列出還在時限內的所有團購單 ＆ 團購連結。</p>
    </div>
    <div id="tab3" class="tab-content">
        <h2>新增店家</h2>
        <form action="" method="get" class="form-example">
            <div class="form-example">
                <label for="name">店家名稱</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-example">
                <label for="name">簡介</label>
                <input type="text" id="info" name="info">
            </div>
            <div class="form-example">
                <label for="name">電話</label>
                <input type="text" id="phone" name="phone">
            </div>
            <div class="form-example">
                <label for="name">地址</label>
                <input type="text" id="address" name="address">
            </div>
            <div class="form-example">
                <label for="name">產品</label>
                <input type="text" id="product" name="product">
            </div>
            <div class="form-example">
                <input type="submit" value="Subscribe!" />
            </div>
        </form>
    </div>
    <div id="tab4" class="tab-content">
        <h2>團購去</h2>
        <form action="" method="get" class="form-example">
            <div class="form-example">
                <label for="name">篩選</label>
                <select>
                    <option>請選擇</option>
                </select>
            </div>
            <div class="form-example">
                <label for="name">負責人</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-example">
                <label for="name">截止時間</label>
                <input type="text" id="end-time" name="end-time">
            </div>
            <div class="form-example">
                <input type="submit" value="Subscribe!" />
            </div>
        </form>
    </div>
</div>