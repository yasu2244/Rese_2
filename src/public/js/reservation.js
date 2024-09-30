document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');
    const timeSelect = document.getElementById('time');
    const userNumSelect = document.getElementById('user_num');
  
    const selectedDate = document.getElementById('selected-date');
    const selectedTime = document.getElementById('selected-time');
    const selectedNumber = document.getElementById('selected-number');
  
    // フォームの変更イベントをリッスン
    dateInput.addEventListener('change', function() {
      selectedDate.textContent = dateInput.value;
    });
  
    timeSelect.addEventListener('change', function() {
      selectedTime.textContent = timeSelect.value;
    });
  
    userNumSelect.addEventListener('change', function() {
      selectedNumber.textContent = userNumSelect.value + '人';
    });
  
    // 初期値を設定
    selectedDate.textContent = dateInput.value;
    selectedTime.textContent = timeSelect.value;
    selectedNumber.textContent = userNumSelect.value + '人';
  });
  