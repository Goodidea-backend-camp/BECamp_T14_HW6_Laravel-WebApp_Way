<title>會議表單</title>
<style>
    .form-container {
        position: relative;
        top: 50%;
        transform: translateY(20%);
        margin: 100 auto;
        background-color: #ffffff;
        padding: 40px 50px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 500px;
    }

    .form-container h2 {
        text-align: center;
        align-items: center;
        margin-bottom: 25px;
        color: #333;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #555;
        font-weight: bold;
    }

    input[type="text"],
    input[type="datetime-local"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 15px;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .button-group button {
        flex: 1;
        padding: 12px 0;
        border: none;
        border-radius: 5px;
        font-size: 15px;
        cursor: pointer;
    }

    .save {
        background-color: #007bff;
        color: white;
    }

    .delete {
        background-color: #dc3545;
        color: white;
    }

    .button-group button:hover,
    .back-button:hover {
        opacity: 0.9;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('meetingForm').addEventListener('submit', function(e) {
            const start = document.getElementById('startTime').value;
            const end = document.getElementById('endTime').value;

            if (start && end && new Date(start) > new Date(end)) {
                e.preventDefault();
                alert('開始時間不能大於結束時間');
            }
        });
    });

    function setMethod(method) {
        document.getElementById('methodInput').value = method;
    }

    function confirmDelete() {
        if (confirm('確定要刪除嗎？')) {
            setMethod('DELETE');
            return true;
        }
        return false;
    }

    @if(session('message'))
        alert("{{ session('message') }}");
    @elseif(session('error'))
        alert("{{ session('error') }}");
    @endif
</script>

@php
    $now = \Carbon\Carbon::now()->format('Y-m-d\TH:i');
@endphp

<div class="form-container">
    <h2>會議表單</h2>
    <form id="meetingForm" action="/meetings/{{ $meetingInfo->id }}" method="POST">
        @csrf
        <input type="hidden" name="_method" id="methodInput" value="PATCH">

        <label for="name">會議名稱</label>
        <input type="text" id="meetingName" name="name" value="{{$meetingInfo->name}}" required>

        <label for="create_user">發起人姓名</label>
        <input type="text" id="organizer" name="create_user" value="{{$meetingInfo->creator->username}}" disabled="disabled" required>

        <label for="start_at">會議開始時間</label>
        <input type="datetime-local" id="startTime" name="start_at" min="{{ $now }}" value="{{$meetingInfo->start_at}}" required>

        <label for="end_at">會議結束時間</label>
        <input type="datetime-local" id="endTime" name="end_at" min="{{ $now }}" value="{{$meetingInfo->end_at}}" required>
        @if(session('username') == $meetingInfo->creator->username)
        <div class="button-group">
            <button class="save" type="submit" onclick="setMethod('PATCH')">保存</button>
            <button class="delete" type="submit" onclick="return confirmDelete()">刪除</button>
        </div>
        @endif
    </form>
</div>