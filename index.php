<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/header.php'); ?>
<?php
$posts = $dbh->query("SELECT * FROM cms WHERE NOW() >= `published_time` ORDER BY id DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
$news = $dbh->query("SELECT * FROM cms WHERE type='tintuc' AND NOW() >= `published_time` ORDER BY id DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
$events = $dbh->query("SELECT * FROM cms WHERE type='sukien' AND NOW() >= `published_time` ORDER BY id DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
$guides = $dbh->query("SELECT * FROM cms WHERE type LIKE 'camnang%' AND NOW() >= `published_time` ORDER BY id DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="box-b">
        <div id="news-home" class="w500">
            <div class="box-head">
                <ul class="">
                     <li><a class="tab active" data-cat="188" onclick="load_news(188);" href="#tab_all">TẤT CẢ</a></li>
                     <li><a class="tab" data-cat="189" onclick="load_news(189);" href="#tab_news">TIN TỨC</a></li>
                     <li><a class="tab" data-cat="190" onclick="load_news(190);" href="#tab_events">SỰ KIỆN</a></li>
                     <li><a class="tab" data-cat="191" onclick="load_news(191);" href="#tab_sv">CẨM NANG</a></li>
                </ul>
                <a href="javascript:;" class="icon-plus">+</a>
            </div>
            <div class="line"></div>
            <div class="main-tab">
                <div class="content-tab" id="tab_all">
				<ul class="news before view_new">
				<?php foreach ($posts as $item): ?>
				<?php
                $itemTypeUrl = $item['type'] == 'tintuc' ? 'tin-tuc' : ($item['type'] == 'sukien' ? 'su-kien' : 'cam-nang');
                ?>
			    <li><a href="/<?php echo $itemTypeUrl ?>/<?php echo $item['slug'] ?>"><?php echo $item['title'] ?></a><span><?php echo $item['date'] ?></span></li>
			    <?php endforeach; ?>
				</ul>
				</div>
                <div class="content-tab" id="tab_news">
				<ul class="news before view_new">
				<?php foreach ($news as $item): ?>
				<?php
                $itemTypeUrl = 'tin-tuc';
                ?>
			    <li><a href="/<?php echo $itemTypeUrl ?>/<?php echo $item['slug'] ?>"><?php echo $item['title'] ?></a><span><?php echo $item['date'] ?></span></li>
			    <?php endforeach; ?>
			    </ul>
				</div>
                <div class="content-tab" id="tab_events">
				<ul class="news before view_new">
				<?php foreach ($events as $item): ?>
				<?php
                $itemTypeUrl = 'su-kien';
                ?>
			    <li><a href="/<?php echo $itemTypeUrl ?>/<?php echo $item['slug'] ?>"><?php echo $item['title'] ?></a><span><?php echo $item['date'] ?></span></li>
			    <?php endforeach; ?>
			    </ul>
				</div>
                <div class="content-tab" id="tab_sv">
				<ul class="news before view_new">
				<?php foreach ($guides as $item): ?>
				<?php
                $itemTypeUrl = 'cam-nang';
                ?>
			    <li><a href="/<?php echo $itemTypeUrl ?>/<?php echo $item['slug'] ?>"><?php echo $item['title'] ?></a><span><?php echo $item['date'] ?></span></li>
			    <?php endforeach; ?>
			    </ul>
				</div>
            </div><!--end .main-tab-->
            
        </div><!--end #news-home-->

        <div class=" box-rank" style="width:250px;">
            <div class="box-head">
                <h3><i class="icon-before"></i>BẢNG XẾP HẠNG
                    <a href="javascript:;" class="icon-plus">+</a>
                </h3>
            </div>
            <div class="line"></div>
            <div class="choose">
                <select name="" id="name-top">
                <option value="S0_">Liên Server</option>
				</select>
                <select name="" id="name-server" class="name-server">
                    <option value="1">BXH cấp</option>
                    <option value="2">BXH lực chiến</option>
                    <option value="3">BXH thần binh</option>
                </select>
            </div>
            <table>
                <tbody>
				<tr>
                    <th>Hạng</th>
                    <th>Tên</th>
                    <th>Cấp/Điểm</th>
                </tr>
            <tr class=""><td class=""></td><td class="">♥ BXH đang cập nhật ♥</td><td class=""></td></tr>
			    </tbody>
			</table>
        </div><!--end .box-rank-->
        <div class="clear"></div>

        <div id="box-class" class="w500">
            <div class="box-head">
                <ul class="class-item">
                    <li> <a class="tab active" href="#class_v1"></a> </li>
                    <li> <a class="tab " href="#class_v2"> </a> </li>
                    <li> <a class="tab " href="#class_v3"> </a> </li>
                    <li> <a class="tab " href="#class_v4"> </a> </li>
                    <li> <a class="tab " href="#class_v5"> </a> </li>
                    <li> <a class="tab " href="#class_v6"> </a> </li>
                    <li> <a class="tab " href="#class_v7"> </a> </li>
                </ul>
            </div>
            <div class="line"></div>

            <div class="main-tab">
                <div class="content-tab" id="class_v1">
                    <img class="img-gif" src="/frontend/images/class_1.gif" alt="" />
                    <img class="properties" src="/frontend/images/class_1.png" alt="" />
                    <p>
                        Được mô phỏng theo loại binh khí trong truyền thuyết của Nhị Lang Thần do Giao Long ba đầu hóa thành...
                    </p>
                </div>
                <div class="content-tab" id="class_v2">
                    <img class="img-gif" src="/frontend/images/class_2.gif" alt="" />
                    <img class="properties" src="/frontend/images/class_2.png" alt="" />
                    <p>
                        Theo truyền thuyết, đây là chiếc quạt được làm từ đuôi hạc tiên mà Gia Cát Lượng đã sử dụng....
                    </p>
                </div>
                <div class="content-tab" id="class_v3">
                    <img class="img-gif" src="/frontend/images/class_3.gif" alt="" />
                    <img class="properties" src="/frontend/images/class_3.png" alt="" />
                    <p>
                        Sử dụng Song Thiết Kích dễ thủ, linh hoạt, ra đòn nhanh tuy nhiên phải có lực tay cực lớn, thua thiệt ...
                    </p>
                </div>
                <div class="content-tab" id="class_v4">
                    <img class="img-gif" src="/frontend/images/class_4.gif" alt="" />
                    <img class="properties" src="/frontend/images/class_4.png" alt="" />
                    <p>
                        Vũ khí với lực phát ra vô cùng dũng mãnh, tương truyền mỗi lần Lệ Thái Ngọc Trùy vung lên là xác chết...
                    </p>
                </div>
                <div class="content-tab" id="class_v5">
                    <img class="img-gif" src="/frontend/images/class_5.gif" alt="" />
                    <img class="properties" src="/frontend/images/class_5.png" alt="" />
                    <p>
                        Món vũ khí đươc sử dụng khi Triệu Vân đơn thân độc mã đột phá cả vạn quân Tào khiến Tam Quốc ai ai cũng...
                    </p>
                </div>
                <div class="content-tab" id="class_v6">
                    <img class="img-gif" src="/frontend/images/class_6.gif" alt="" />
                    <img class="properties" src="/frontend/images/class_6.png" alt="" />
                    <p>
                        Thẩm Điện Lân Cung có phạm vi tấn công lớn, đòn phát ra vô cùng hiểm, thích hợp khi giao chiến với...
                    </p>
                </div>
                <div class="content-tab" id="class_v7">
                    <img class="img-gif" src="/frontend/images/class_7.gif" alt="" />
                    <img class="properties" src="/frontend/images/class_7.png" alt="" />
                    <p>
                        Đây là vũ khí mang uy lực khiến kẻ địch phải "kinh hồn bạt vía", vừa có thể tấn công và phòng thủ biến chủ nhân...
                    </p>
                </div>
            </div><!--end .main-tab-->
        </div><!--end #box-class-->

        <div class=" box-tanthu" style="width:250px;">
            <div class="box-head">
                <h3><i class="icon-before"></i>TÂN THỦ</h3>
            </div>
            <div class="line"></div>
            <div class="main-tanthu">
			        <a href="/cam-nang" class="list-item">
						<i class="icon-before"></i>
						<h4>FAQ</h4>
						<p>Những câu hỏi thường gặp</p>
					</a><a href="/cam-nang" class="list-item">
						<i class="icon-before"></i>
						<h4>Hệ thống vip</h4>
						<p>Quyền lợi , ưu đãi dành cho Vip</p>
					</a><a href="/cam-nang" class="list-item">
						<i class="icon-before"></i>
						<h4>Hướng dẫn nạp thẻ</h4>
						<p>Hệt thống thanh toán, nạp tiền</p>
					</a><a href="/cam-nang" class="list-item">
						<i class="icon-before"></i>
						<h4>Cách tăng lực chiến</h4>
						<p>Không nạp thẻ mà vẫn khỏe</p>
					</a>
		    </div>
        </div><!--end .box-tanthu-->
    </div><!--end .box-b-->

<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/page/footer.php'); ?>