<div class="bs-callout bs-callout-warning" style="height: 300px;overflow-y:scroll;;border: #ffcc99 thin solid;" id="showMassege">

</div>
<?php
$js = "
  $(function () {
  var url = 'show-messege';
  setInterval(function () { // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 30 วินาที
  // 1 วินาที่ เท่า 1000
  // คำสั่งที่ต้องการให้ทำงาน ทุก ๆ 1 วินาที
  var getData = $.ajax({// ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล
  url: url,
  data: {ticketId:" . $ticketId . "},
  type:'POST',
  async: false,
  success: function (getData) {
  $('#showMassege').html(getData); // ส่วนที่ 3 นำข้อมูลมาแสดง
  }
  }).responseText;
  }, 1000);
  });
  ";
$this->registerJs($js);
?>