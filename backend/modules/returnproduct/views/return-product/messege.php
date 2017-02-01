
<div class="" style="display: block;height: 500px;width:100%;overflow: auto;overflow-y:scroll;border: #ffcc99 thin solid;padding-top: 10px;padding-left: 5px;padding-right: 5px;" id="showBnMassege">

</div>

<br>
<?php
$js = "
  $(function () {
  var url = 'show-messege';
  var divHeight=$('#showBnMassege').height();
  setInterval(function () { // เขียนฟังก์ชัน javascript ให้ทำงานทุก ๆ 30 วินาที
  // 1 วินาที่ เท่า 1000
  // คำสั่งที่ต้องการให้ทำงาน ทุก ๆ 1 วินาที
  $.ajax({// ใช้ ajax ด้วย jQuery ดึงข้อมูลจากฐานข้อมูล
  url: url,
  data: {ticketId:" . $ticketId . "},
  type:'POST',
  dataType:'JSON',
  async: false,
  success: function (data) {
  $('#showBnMassege').html(data.ms); // ส่วนที่ 3 นำข้อมูลมาแสดง
  $('#showBnMassege').animate(
        {scrollTop: data.posi+'px'},
    );
  },
  }).responseText;
  }, 1000);
  });
  ";
$this->registerJs($js);
