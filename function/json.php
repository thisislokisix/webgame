<?php
function extractJsonFromData($get, $data, $count) {
    $page = intval($get['page']) ? : 1;
    $show = intval($get['show']) ? : 25;
    $offset = ($page - 1) * $show;
    $totalPage = ($count % $show == 0) ? $count / $show : (int) ($count / $show + 1);
    $showingPage = array();
    if ($page <= 2) {
        $pageStop = min($totalPage, 5);

        for ($i = 1; $i <= $pageStop; $i++) {
            $showingPage[] = $i;
        }
    } else if ($page >= $totalPage - 2) {
        $pageStart = ($totalPage - 5 > 0) ? $totalPage - 5 : 1;
        for ($i = $pageStart; $i <= $totalPage; $i++) {
            $showingPage[] = $i;
        }
    } else {
        for ($i = $page - 2; $i <= $page + 2; $i++) {
            if ($i > 0 && $i <= $totalPage) {
                $showingPage[] = $i;
            }
        }
    }

    $json['data'] = $data;
    $json['total'] = $count;
    $json['from'] = $offset + 1;
    $json['to'] = $offset + $show < $count ? $offset + $show : $count;
    $json['current_page'] = $page;
    $json['total_page'] = $totalPage;
    $json['showing_page'] = $showingPage;
    echo json_encode($json);
    exit;
}

function renderGridHtml(array $fields, $firstSort = 'id', $ajaxUrl = '') {
    $sortHtml = '<tr class="sort">';
    $filterHtml = '<tr class="filter">';
    $i = 0;
    foreach ($fields as $key => $value) {
        $sortClass = (++$i == 1) ? 'sorting_desc' : ($value['disable_sort'] ? '' : 'sorting');
        $sortHtml .= '<th width="'. $value['width'] .'" class="'. $sortClass .'" data-map="'. $key .'">'. $value['name'] .'</th>';

        $filterHtml .= $value['disable_filter'] ? '<td></td>' : '<td><input type="text" name="'. $key .'"></td>';
    }
    $sortHtml .= '</tr>';
    $filterHtml .= '</tr>';

    echo <<<EOD
<style type="text/css">
.filter td {
    vertical-align: middle;
    padding: 5px 12px;
}
.filter input, .filter select {
    width: 100%;
    margin: 0 0 0 -7px;
}
.filter_form .hidden_submit {
    width: 0;
    height: 0;
    overflow: hidden;
    visibility: hidden;
    opacity: 0;
}
</style>
<link rel="stylesheet" href="/admin/css/jquery.waiting.css"/>
<script src="/admin/js/plugins/jquery/jquery.waiting.min.js"></script>
<form class="filter_form" method="post" onsubmit="return false;">
    <input type="submit" class="hidden_submit" />
    <div class="dataTables_length">
        <label>Show <select size="1" name="show" onchange="loadContent(this.value)">
                <option value="25" selected="selected">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="500">500</option>
            </select> entries
        </label>
    </div>
    <table cellpadding="0" cellspacing="0" width="100%" class="table">
        <thead>
        {$sortHtml}
        </thead>
        <tbody>
        {$filterHtml}
        </tbody>
    </table>
    <div class="dataTables_info"></div>
    <div class="dataTables_paginate paging_full_numbers">
        <a tabindex="0" class="first paginate_button paginate_button_disabled">First</a>
        <a tabindex="0" class="previous paginate_button paginate_button_disabled">Previous</a>
        <span></span>
        <a tabindex="0" class="next paginate_button paginate_button_disabled">Next</a>
        <a tabindex="0" class="last paginate_button paginate_button_disabled">Last</a>
    </div>
</form>
<script>
    var ajaxUrl = '{$ajaxUrl}',
        Grid = {};
    Grid.page = 1;
    Grid.show = 25;
    Grid.sort = '{$firstSort}';
    Grid.dir = 'desc';
    Grid.search = {};

    function loadPage(grid) {
        var data = {};
        data['ajax'] = 1;
        data['page'] = grid.page;
        data['show'] = grid.show;
        data['sort'] = grid.sort;
        data['dir'] = grid.dir;
        data['search'] = grid.search;
        $.getJSON(ajaxUrl, data, function(json) {
            Grid.page = json['current_page'];
            Grid.total_page = json['total_page'];
            Grid.scroll_bot = $(document).height() - $(document).scrollTop();

            loadTable(json['data']);
            loadInfo(json['from'], json['to'], json['total']);
            loadPaging(json['current_page'], json['total_page'], json['showing_page']);
            hideLoading();
        });
    }

    function loadTable(data) {
        $('.filter_form .table tbody tr:not(".filter")').remove();
        for (i in data) {
            var rowHtml = '<tr>';
            for (j in data[i]) {
                rowHtml += '<td>' + data[i][j] + '</td>'
            }
            rowHtml += '</tr>';
            $('.filter_form .table tbody').append(rowHtml);
        }
    }

    function loadInfo(from, to, total) {
        if (total == 0) {
            from = 0;
        }
        $('.dataTables_info').html('Show ' + from + ' to ' + to + ' of ' + total + ' entries');
    }

    function loadPaging(currentPage, totalPage, showingPage) {
        $('.paging_full_numbers a').removeClass('paginate_button_disabled');

        if (currentPage == 1) {
            $('.paginate_button.first, .paginate_button.previous').addClass('paginate_button_disabled');
            $('.paginate_button.first, .paginate_button.previous').prop("onclick", false);
        }
        if (currentPage >= totalPage) {
            $('.paginate_button.last, .paginate_button.next').addClass('paginate_button_disabled');
            $('.paginate_button.last, .paginate_button.next').prop("onclick", false);
        }

        $('.paginate_button:not(".paginate_button_disabled")').each(function() {
            if ($(this).hasClass('first')) {
                $(this).attr('onclick', 'goFirst()');
            }

            if ($(this).hasClass('next')) {
                $(this).attr('onclick', 'goNext()');
            }

            if ($(this).hasClass('prev')) {
                $(this).attr('onclick', 'goPrev()');
            }

            if ($(this).hasClass('last')) {
                $(this).attr('onclick', 'goLast()');
            }
        });

        var pagingHtml = '';
        for (i in showingPage) {
            if (showingPage[i] == currentPage) {
                pagingHtml += '<a tabindex="0" class="paginate_active">' + showingPage[i] + '</a>';
            } else {
                pagingHtml += '<a tabindex="0" class="paginate_button" onclick="setPage(' + showingPage[i] + ')">' + showingPage[i] + '</a>';
            }
        }
        $('.paging_full_numbers span').html(pagingHtml);
        if ($(document).scrollTop() > 0) {
            var scrollTop = $(document).height() - Grid.scroll_bot;
            $('body, html').animate({scrollTop: scrollTop}, 500);
        }
    }

    function showLoading() {
        $('body').waiting({fixed: true});
    }
    function hideLoading() {
        $('body').waiting("done");
    }

    function reloadGrid() {
        showLoading();
        loadPage(Grid, ajaxUrl);
    }
    function setPage(page) {
        Grid.page = page;
        reloadGrid();
    }
    function goNext() {
        if (Grid.page < Grid.total_page) {
            Grid.page++;
        }
        reloadGrid();
    }
    function goPrev() {
        if (Grid.page > 1) {
            Grid.page--;
        }
        reloadGrid();
    }
    function goFirst() {
        Grid.page = 1;
        reloadGrid();
    }
    function goLast() {
        Grid.page = Grid.total_page;
        reloadGrid();
    }
    function loadContent(number) {
        Grid.page = 1;
        Grid.show = number;
        reloadGrid();
    }

    var filterForm = $('.filter_form');
    filterForm.submit(function(e) {
        e.preventDefault();
        var filterData = filterForm.serializeArray();
        for (i in filterData) {
            if (filterData[i].name == "show") {
                Grid.show = filterData[i].value;
            } else {
                Grid.search[filterData[i].name] = filterData[i].value;
            }
        }

        Grid.page = 1;
        reloadGrid();
    });

    var sortArea = $('.filter_form .sort .sorting, .filter_form .sort .sorting_desc, .filter_form .sort .sorting_asc');
    sortArea.on('click', function(e) {
        e.preventDefault();
        Grid.sort = $(this).data('map');
        sortArea.not(this).attr('class', 'sorting');

        if ($(this).hasClass('sorting_desc') || $(this).hasClass('sorting_asc')) {
            $(this).toggleClass('sorting_desc sorting_asc');
            Grid.dir = $(this).hasClass('sorting_desc') ? 'desc' : 'asc';
        } else {
            $(this).removeClass('sorting').addClass('sorting_desc');
            Grid.dir = 'desc';
        }
        reloadGrid();
    });

    $(function() {
        reloadGrid();
    });
</script>
EOD;
}
