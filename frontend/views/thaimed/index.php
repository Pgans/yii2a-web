<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
//$this->params['breadcrumbs'][] = 'รายงานอุปกรณ์คอมพิวเตอร์';
?>
<h1>หมวดรายงานแพทย์แผนไทย(mBase)</h1>
<div class="row">
<div class = "col-sm-4"> <a href ="" class="btn btn-warning">รายงานเกี่ยวข้องตัวชี้วัดและตอบโจทย์HA สามารถเลือกช่วงเวลาประมวลผลได้(mbase_data)</a></div></div>
<p>
    <?=  Html::a('1.นับการทำหัตถการแพทย์ทางเลือกในโรงพยาบาล',['thaimed/operation']) ?>
</p>
<p>
    <?=  Html::a('2.นับการทำหัตถการแพทย์ทางเลือกนอกโรงพยาบาล',['thaimed/operation_out']) ?>
</p>
<p>
    <?= html::a('3.นับผู้ทำหัตการแพทย์แผนไทย',['thaimed/intructure']) ?>
</p>
<p>
    <?= html::a('4.นับผู้สั่งหัตถการแพทย์แผนไทย', ['thaimed/'])?>
</p>
<p>
    <?= Html::a('5.นับผู้ป่วยนอกสถานบริการ(แพทย์ทางเลือก)',['thaimed/outstan']) ?>
</p>
<p>
    <?= Html::a('6.รายงานการจ่ายยาสมุนไพรฟ้าทะลายโจรในคนที่เป็นโรครหัสJ00-J99',['thaimed/cormore']) ?>
</p>