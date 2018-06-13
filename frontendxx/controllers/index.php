<?php

use yii\widgets\ListView;
use yii\grid\GridView;
//use app\components\RctReplyWidget;
use kartik\tabs\TabsX;
use yii\helpers\Url;
use evgeniyrru\yii2slick\Slick;
use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'โรงพยาบาลม่วงสามสิบ อำเภอม่วงสามสิบ จังหวัดอุบลราชธานี';
// register css files
$this->registerCssFile("@web/owl.carousel/owl-carousel/owl.carousel.css");
// $this->registerCssFile("@web/owl.carousel/owl-carousel/owl.theme.css");

//register js files
$this->registerJsFile("@web/owl.carousel/owl-carousel/owl.carousel.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile("@web/js/index.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
// popup css
$this->registerCssFile("http://www.jacklmoore.com/colorbox/example1/colorbox.css");
// popup js
 //$this->registerJsFile("http://code.jquery.com/jquery-3.2.1.min.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile("http://www.jacklmoore.com/colorbox/jquery.colorbox.js", ['depends' => [\yii\web\JqueryAsset::className()]]);
 
?>
<div class="container">
    <div class="site-index">
      <div id="owl-demo" class="owl-carousel owl-theme">
       <div class="item"><?= Html::img('@web/images/1.jpg', ['alt' => 'ทดสอบ']) ?></div>
        <div class="item"><?= Html::img('@web/images/2.jpg', ['alt' => 'ทดสอบ']) ?></div>
        <div class="item"><?= Html::img('@web/images/3.jpg', ['alt' => 'ทดสอบ']) ?></div>
        <div class="item"><?= Html::img('@web/images/4.jpg', ['alt' => 'ทดสอบ']) ?></div>
        <div class="item"><?= Html::img('@web/images/5.jpg', ['alt' => 'ทดสอบ']) ?></div>
        <div class="item"><?= Html::img('@web/images/6.jpg', ['alt' => 'ทดสอบ']) ?></div>
        <div class="item"><?= Html::img('@web/images/7.jpg', ['alt' => 'ทดสอบ']) ?></div>
        <div class="item"><?= Html::img('@web/images/8.jpg', ['alt' => 'ทดสอบ']) ?></div>
        <div class="item"><?= Html::img('@web/images/9.jpg', ['alt' => 'ทดสอบ']) ?></div>
        <div class="item"><?= Html::img('@web/images/10.jpg', ['alt' => 'ทดสอบ']) ?></div>
    </div>
        <!-- begin carousel -->
        <!-- <img src="images/black_ribbon_top_left.png" class="black-ribbon stick-left stick-bottom"> -->
        <!-- <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="images/image1.jpg">
                </div>
                <div class="item">
                    <img src="images/image2.jpg">
                </div>
                <div class="item">
                    <img src="images/image3.jpg">
                </div>
            </div>
        </div> -->

        <!-- </div> -->
        <!-- Controls -->
        <p />
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bullhorn fa-flip-horizontal"></i> ข่าวประชาสัมพันธ์</h3>
                    </div>
                    <?php
                    $newspurchase = $this->render('newspurchase', [
                        'newspurchase' => $newspurchase
                    ]);
                    $newswork = $this->render('newswork', [
                        'newswork' => $newswork
                    ]);
                    $newsall = $this->render('newsall', [
                        'dataProvider' => $dataProvider
                    ]);
                    $items = [
                        [
                            'label' => '<i class="glyphicon glyphicon-list"></i> ข่าวจัดซื้อจัดจ้าง',
                            'content' => $newspurchase,
                        ],
                        [
                            'label' => '<i class="glyphicon glyphicon-list"></i> ข่าวรับสมัครงาน',
                            'content' => $newswork,
                            'active' => true
                        ],
                        [
                            'label' => '<i class="glyphicon glyphicon-list"></i> ข่าวทั่วไป',
                            'content' => $newsall,
                        ],
                    ];
                    echo TabsX::widget([
                        'items' => $items,
                        'position' => TabsX::POS_ABOVE,
                        'bordered' => true,
                        'encodeLabels' => false
                    ]);
                    ?>
                </div>
                 <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bullhorn fa-flip-horizontal"></i> อัพเดตโปรแกรม</h3>
                    </div>
                        <div class="panel-body">
                            <div>
                         <ul class="xoxo blogroll">
                         <img src="images/arrow_all.gif" width="10" height="10"><a href="https://drive.google.com/open?id=1i_lOFDLr-e4Z6LPyUDBRhw_fvLQImMlK" target="_blank"> โครงสร้างมาตรฐานข้อมูลสุขภาพ (43แฟ้ม) Version 2.3 
    ปีงบประมาณ 2561  </a>
                         <br> <img src="images/arrow_all.gif" width="10" height="10"><a href="https://drive.google.com/open?id=0B9VVFGgnSeSuTWJuSmsyOTZJQnc" target="_blank"> โครงสร้างมาตรฐานข้อมูลสุขภาพ (43แฟ้ม) Version 2.2 
    ปีงบประมาณ 2560 </a>
                        <br> <img src="images/arrow_all.gif" width="10" height="10"><a href="http://www.nhso.go.th/files/userfiles/file/NHSOAuthen4_2017.rar" target="_blank"> โปรแกรม NHSO UCAuthentication 4.0 สำหรับ Authen เข้าระบบเว็บตรวจสอบสิทธิผ่านประชาชน(Smart Card)  </a>
                                  
                                </ul>
                            </div>
                        </div>
                    </div>
                
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-calendar" aria-hidden="true"></i> ตารางปฏิบัติงาน / กิจกรรม</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        echo \yii2fullcalendar\yii2fullcalendar::widget(array(
                            'id' => 'calendar',
                            'events' => $events,
                            'options' => [
                                'lang' => 'th',
                            ],
                            'clientOptions' => [
                                'eventMouseover' => new \yii\web\JsExpression("function (cellInfo, jsEvent) { eventDetail(cellInfo, jsEvent); }"),
                                'eventMouseout' => new \yii\web\JsExpression("function (cellInfo, jsEvent) { eMouseremove(cellInfo, jsEvent); }")
                            ]
                        ));
                        ?>

                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-picture-o" aria-hidden="true"></i> อัลบั้มภาพ</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        echo ListView::widget([
                            'dataProvider' => $dataProvider2,
                            'itemView' => '/photo-library/_item',
                            'layout' => '{items}{pager}',
                        ]);
                        ?>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-chain-broken" aria-hidden="true"></i> วิดีโอ</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                       
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="panel-body">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <!-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/XGSy3_Czz8k"></iframe> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <!--<div class="panel-group">-->
                    <div class="panel panel-warning">
                        <div class="panel-heading"><h4 class="panel-title"><i class="fa fa-user-md" aria-hidden="true"></i> ผู้บริหาร</h4></div>
                        <div class="panel-body">
                            <div class="thumbnail" align="center">
                                <img src="images/boss0.jpg" alt="...">
                                <div class="caption">
                                    <h4>นพ.ประจักษ์ สีลาชาติ</h4>
                                    <h5>รักษาการในตำแหน่ง</h5>
                                    <h5>ผู้อำนวยการโรงพยาบาลม่วงสามสิบ</h5>
                                </div>
                            </div>
                            <ul class="xoxo blogroll">
                            </ul>
                        </div>
                    </div>
                    <!--</div>-->
                    <!--</div>-->
                    <!--<div class="col-xs-6 col-md-4">-->
                    <!--<div class="panel-group">-->
    
                    
                            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fmhosp-
                            117251501692874%2F&tabs=timeline&width=270&height=500&small_header=false&adapt_container_width=true&hide_cover
                            =false&show_facepile=true&appId" width="300" height="500" style="border:none;overflow:hidden" 
                            scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                     
                   <div class="panel panel-warning">
                        <div class="panel-heading"><h4 class="panel-title"><i class="fa fa-link" aria-hidden="true"></i> ระบบออนไลน์</h4></div>
                        <div class="panel-body">
                             <ul class="xoxo blogroll">
                                <br><img src="images/arrow_all.gif" width="10" height="10"><a href="http://service.m30hospital.com/frontend/web/index.php?r=opdcard%2Fpermits" target="_blank"> ยืมเวชระเบียน</a>
                                <br><img src="images/arrow_all.gif" width="10" height="10"><a href="http://service.m30hospital.com/backend/web/index.php?r=opdcard%2Fpermits" target="_blank"> คืนเวชระเบียน</a>
                                <br><img src="images/arrow_all.gif" width="10" height="10"><a href="http://service.m30hospital.com/backend/web/index.php?r=personal%2Fperson" target="_blank"> ระบบบุคลากร</a>
                                <br><img src="images/arrow_all.gif" width="10" height="10"><a href="http://m30hospital.com/web/index.php?r=deaths30%2Fcreate" target="_blank"> แจ้งตายในเครือข่าย</a>
                                <br><img src="images/arrow_all.gif" width="10" height="10"><a href="http://service.m30hospital.com/frontend/web/index.php" target="_blank"> รายงานข้อมูลบริการ</a>
                                <br><img src="images/arrow_all.gif" width="10" height="10"><a href="http://service.m30hospital.com/frontend/web/index.php?r=ehr" target="_blank"> ประวัติบริการ</a>
                            </ul>
                        </div>
                    </div>
                    <!--</div>-->
                    <!--</div>-->
                    <!--<div class="col-xs-6 col-md-4">-->
                    <!--<div class="panel-group">-->
                    <div class="panel panel-warning">
                        <div class="panel-heading"><h4 class="panel-title"><i class="fa fa-cogs" aria-hidden="true"></i> ระบบ MIS</h4></div>
                        <div class="panel-body">
                            <ul class="xoxo blogroll">
                                <li><a href="http://www.phoubon.in.th/" target="_blank"> สำนักงานสาธารณสุขจังหวัดอุบลราชธานี</a></li>
                                <li><a href="http://203.157.166.6/chronic/index.php" target="_blank"> Chronic Link</a></li>
                                <li><a href="http://eclaim.nhso.go.th/webComponent/contact/ContactAction.do" target="_blank"> E-Claim</a></li>
                                <li><a href="http://hdc.phoubon.in.th/hdc/main/index.php" target="_blank"> Health Data Center (HDC)</a></li>
                                <li><a href="http://eclaim.nhso.go.th/webComponent/" target="_blank"> OP/PP Individual Record</a></li>
                                <li><a href="http://203.157.81.35/mis/" target="_blank"> Thai Traditional Medicine</a></li>
                                <li><a href="http://www.coopubon.com/coopubon/info_coop1/coop_login.php" target="_blank"> ข้อมูลสมาชิกสหกรณ์ออมทรัพย์ฯ</a></li>
                                <li><a href="http://m30.phoubon.in.th" target="_blank"> ทีมหมอครอบครัว (FCT)</a></li>
                                <li><a href="http://www.gprocurement.go.th/wps/portal/egp/!ut/p/z1/hY4xC8IwFIR_S4eO5r1aqOIWMihCqC5a3yKtpGmhJiWNBv-9ATdRetvdfQcHBBWQqZ-9rn1vTT1Ef6HiKrPtMhMCZXnKC-SrgxTlcYcoMjjPARRr_COOcU9zyB5ID7b5vOGmydcayKlWOeXYw8W4836cNimmGEJg2lo9KHazzHcp_hp1dvJQfbMw3itcUPMKPEne7ih2FA!!/dz/d5/L2dBISEvZ0FBIS9nQSEh/?locale=th" target="_blank"> ระบบการจัดซื้อจัดจ้างภาครัฐ</a></li>
                                <li><a href="http://phoubonbook.phoubon.in.th/" target="_blank"> ระบบหนังสือเวียน (สสจ.อุบล)</a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <!--</div>-->
                    <!--</div>-->
                    <!--<div class="col-xs-6 col-md-4">-->
                    <!--<div class="panel-group">-->
                    <div class="panel panel-warning">
                        <div class="panel-heading"><h4 class="panel-title"><i class="fa fa-h-square" aria-hidden="true"></i> โรงพยาบาลชุมชน</h4></div>
                        <div class="panel-body">
                            <div>
                                <ul class="xoxo blogroll">
                                    <li><a href="http://www.kkphospital.go.th" target="_blank">โรงพยาบาลกุดข้าวปุ้น</a></li>
                                    <li><a href="http://www.dmdhospital.com/" target="_blank">โรงพยาบาลดอนมดแดง</a></li>
                                    <li><a href="http://www.trakanhospital.org/" target="_blank">โรงพยาบาลตระการพืชผล</a></li>
                                    <li><a href="http://www.tansumhospital.go.th/" target="_blank">โรงพยาบาลตาลสุม</a></li>
                                    <li><a href="http://www.nlhospital.go.th/" target="_blank">โรงพยาบาลนาจะหลวย</a></li>
                                    <li><a href="http://www.cupnatan.com/" target="_blank">โรงพยาบาลนาตาล</a></li>
                                    <li><a href="http://www.bundharikhos.com/hospital/" target="_blank">โรงพยาบาลบุณฑริก</a></li>
                                    <li><a href="http://www.pbhosp.com/" target="_blank">โรงพยาบาลพิบูลมังสาหาร</a></li>
                                    <li><a href="http://www.m30hospital.com/" target="_blank">โรงพยาบาลม่วงสามสิบ</a></li>
                                    <li><a href="http://www.warin.go.th/" target="_blank">โรงพยาบาลวารินชำราบ</a></li>
                                    <li><a href="http://www.smmhospital.com/" target="_blank">โรงพยาบาลศรีเมืองใหม่</a></li>
                                    <li><a href="http://www.detudomhospital.org" target="_blank">โรงพยาบาลสมเด็จพระยุพราชเดชอุดม</a></li>
                                    <li><a href="https://sunpasit.go.th/2014/index.php" target="_blank">โรงพยาบาลสรรพสิทธิประสงค์</a></li>
                                    <li><a href="http://www.sirinhospital.go.th/" target="_blank">โรงพยาบาลสิรินธร</a></li>
                                    <li><a href="http://www.kmhos.org/main/" target="_blank">โรงพยาบาลเขมราฐ</a></li>
                                    <li><a href="http://www.knhosp.go.th/" target="_blank">โรงพยาบาลเขื่องใน</a></li>
                                    <li><a href="http://www.khongchiamhospital.com/" target="_blank">โรงพยาบาลโขงเจียม</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-chain-broken" aria-hidden="true"></i> ระบบในหน่วยงาน</h3>
                        </div>
                        <div class="box-body">
                            <div>
                                <ul class="xoxo blogroll">
                                    <br><img src="images/arrow_all.gif" width="10" height="10"><a href="http://192.168.200.4/service/meeting/index.php" target="_blank"> ระบบจองห้องประชุม</a>
                                    <br><img src="images/arrow_all.gif" width="10" height="10"><a href="http://192.168.200.2/dhdc2" target="_blank">DHDC(43แฟ้ม)</a>
                                    <br><img src="images/arrow_all.gif" width="10" height="10"><a href="http://192.168.200.4/service/index.php?show=add_job" target="_blank"> ระบบส่งซ่อมคอมพิวเตอร์</a>
                                    <br><img src="images/arrow_all.gif" width="10" height="10"><a href="http://192.168.200.4/service/index.php?show=add_job" target="_blank"> ระบบสื่อโสตทัศนศึกษา</a>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div
</div>
</div>
<?php
$this->registerJsFile('@web/js/main.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
