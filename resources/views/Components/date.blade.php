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
        <button class="tab-button active" onclick="switchTab(event, 'employ-list-tab')">員工清單</button>
        <button class="tab-button" onclick="switchTab(event, 'new-appointment-tab')">新增預約</button>
    </div>
    <div id="employ-list-tab" class="tab-content active">
        <h2>員工清單</h2>
        <p>點擊員工後會顯示目前員工可以的時間</p>
    </div>
    <div id="new-appointment-tab" class="tab-content">
        <h2>新增預約</h2>
        <form action="" method="get" class="appointment-form">
            <div>
                <label for="name">時間</label>
                <select>
                    <option>請選擇</option>
                </select>
            </div>
            <div>
                <label for="name">與會人員</label>
                <select>
                    <option>請選擇</option>
                </select>
            </div>
            <div>
                <input type="submit" value="Subscribe!" />
            </div>
        </form>
    </div>

</div>