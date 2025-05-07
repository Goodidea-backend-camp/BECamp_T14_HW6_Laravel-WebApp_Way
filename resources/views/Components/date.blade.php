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

    .checkbox-grid {
        display: grid;
        grid-template-rows: repeat(5, auto);
        /* 5 行 */
        grid-auto-flow: column;
        /* 垂直填充，從上往下排，再往右 */
        gap: 10px;
        max-width: 800px;
        margin-top: 10px;
    }

    .checkbox-grid label {
        display: flex;
        align-items: center;
        gap: 5px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#meetingForm').on('submit', function(e) {
            const checkboxes = $('input[name="attendee[]"]');
            const errorMsg = $('#errorMsg');
            const anyChecked = checkboxes.is(':checked');

            if (!anyChecked) {
                e.preventDefault();
                errorMsg.css('display', 'inline');
            } else {
                errorMsg.css('display', 'none');
            }
        });
    });

    function limitDate() {
        const dateInput = document.getElementById('dateInput');
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const minDate = `${yyyy}-${mm}-${dd}`;
        dateInput.min = minDate;
    }

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

    function showAvaiableTime() {
        $.ajax({
            url: "api/bookmeeting",
            type: "POST",
            data: JSON.stringify({
                "date": $('#dateInput').val(),
                "_token": $('input[name="_token"]').val()
            }),
            dataType: "json",
            contentType: "application/json; charset=UTF-8",
            success: function(data) {
                $("#bookTime").empty();
                $('#bookTime').append("<option value=''>請選擇</option>")
                data.forEach(function(time) {
                    $("#bookTime").append(`<option value="${time}">${time}</option>`);
                });
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("something went wrong!");
            }
        });
    }

    function showAvaiablePeople() {
        $.ajax({
            url: "api/avaiablepeople",
            type: "POST",
            data: JSON.stringify({
                "date": $('#dateInput').val(),
                "time": $('#bookTime').val(),
                "username": "{{ session('username') }}",
                "_token": $('input[name="_token"]').val()
            }),
            dataType: "json",
            contentType: "application/json; charset=UTF-8",
            success: function(data) {
                $("#people").empty();
                let checkboxGrid = $('<div class="checkbox-grid"></div>');
                data.forEach(function(people) {
                    checkboxGrid.append(`<label><input type="checkbox" name="attendee[]" value="${people}">${people}</label>`);
                });
                $("#people").append(checkboxGrid);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("something went wrong!")
            }
        });
    }
</script>
<div class="tab-container">
    <div class="tabs">
        <button class="tab-button active" onclick="switchTab(event, 'employ-list-tab')">員工清單</button>
        <button class="tab-button" onclick="switchTab(event, 'new-appointment-tab')">新增預約</button>
    </div>
    <div id="employ-list-tab" class="tab-content active">
        <h2>會議清單</h2>
    </div>
    <div id="new-appointment-tab" class="tab-content">
        <h2>新增預約</h2><br>
        <form id="meetingForm" action="" method="post" class="appointment-form">
            @csrf
            <div>
                會議名稱:<br>
                <input type="text" name="meetingName" required>
            </div>
            <div>
                日期：<br>
                <input type="date" id="dateInput" name="date" onclick="limitDate()" onchange="showAvaiableTime()" required>
            </div>
            <div>
                <label for="name">時間</label>
                <select id="bookTime" name="time" onchange="showAvaiablePeople()" required>
                    <option value="">請選擇</option>
                </select>
            </div>
            <div>
                與會人員:<br>
                <div for="name" id="people"></div>
                <span id="errorMsg" style="color: red; display: none;">請至少選擇一位人員</span>
            </div><br>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>

</div>