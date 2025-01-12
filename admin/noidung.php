<?php include_once('page/header.php') ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="head">
                <div class="isw-grid"></div>
                <h1>Quản lý bài viết</h1>
                <ul class="buttons">
                    <li>
                        <a href="#" class="isw-settings"></a>
                        <ul class="dd-list">
                            <li><a href="add_noidung.php"><span class="isw-plus"></span> Thêm mới</a></li>
                            <li><a href="javascript:void(0);" onclick="multiDelete();"><span class="isw-delete"></span> Xóa tin đã chọn</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
            <div class="block-fluid table-sorting">
                <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_col6">
                    <thead>
                    <tr>
                        <th><input type="checkbox" name="checkall"/></th>
                        <th width="5%">ID</th>
                        <th width="20%">Tiêu đề</th>
                        <th width="5%">Kiểu tin</th>
                        <th width="30%">Nội dung</th>
                        <th width="10%">Ngày đăng</th>
                        <th width="15%">Ngày xuất bản</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include_once '../db/connect.php';
                    $data = $dbh->query("SELECT * FROM `cms` ORDER BY `id` DESC")->fetchAll();
                    foreach ($data as $item):
                    ?>
                        <tr>
                            <td><input type="checkbox" name="checkbox" class="checkbox_item"/></td>
                            <td class="itemId"><?php echo $item['id'] ?></td>
                            <td><?php echo $item['title'] ?></td>
                            <td><?php echo $item['type'] ?></td>
                            <td><?php echo substr(strip_tags($item['content']), 0, 50) . '...' ?></td>
                            <td><?php echo $item['date'] ?></td>
                            <td><?php echo $item['published_time'] ?></td>
                            <td>
                                <?php if ($item['type'] == 'sukien'): ?>
                                    <a href="/su-kien/<?php echo $item['slug'] ?>" target="_blank">Xem</a>
                                <?php elseif ($item['type'] == 'camnang'): ?>
                                    <a href="/cam-nang/<?php echo $item['slug'] ?>" target="_blank">Xem</a>
                                <?php else: ?>
                                    <a href="/tin-tuc/<?php echo $item['slug'] ?>" target="_blank">Xem</a>
                                <?php endif; ?>
                                &nbsp;
                                <a href="/admin/add_noidung.php?id=<?php echo $item['id'] ?>">Sửa</a>
                                &nbsp;
                                <a href="javascript:void(0)" onclick="deleteItem('<?php echo $item['id'] ?>');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        $("#tSortable_col6").dataTable({"iDisplayLength": 25, "aLengthMenu": [25,50,100,200,500], "sPaginationType": "full_numbers", "aoColumns": [ { "bSortable": false }, null, null, null, null, null, null, { "bSortable": false }], "aaSorting": [[ 1, "desc" ]]});
        function deleteItem(id) {
            if (confirm('Bạn chắc chắn muốn xóa bài đăng này?')) {
                location.href = '/admin/manage/delete_noidung.php?id=' + id;
            }
            return false;
        }
        function multiDelete() {
            if ($('.checkbox_item:checked').length == 0) {
                alert('Vui lòng chọn bài đăng cần xóa!');
                return false;
            }
            var idArray = [];
            $('.checkbox_item:checked').each(function(index, elem) {
                idArray.push(parseInt($(elem).closest('td').next().text()));
            });
            var ids = idArray.join();
            if (confirm('Bạn chắc chắn muốn xóa những bài đăng này?')) {
                location.href = '/admin/manage/delete_noidung.php?multiple=1&id=' + ids;
            }
            return false;
        }
    </script>
<?php include_once('page/footer.php') ?>