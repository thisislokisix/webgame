<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$servers = array(
    's1' => array(
        'name' => '[S1] Darkwood',
		'ip' => '127.0.0.1',
		'play_ip' => '127.0.0.1',
		'api_url' => 'http://127.0.0.1/tqsg',
		'api_port' => '8192',
		'http_port' => '10002',
        'sid' => '1',
        'time' => '2016-12-12 10:00:00',
        'parent' => 's1',
    ),
);


$latestServer = array(
	's1' => array(
        'name' => '[S1] Darkwood',
		'ip' => '127.0.0.1',
		'play_ip' => '127.0.0.1',
		'api_url' => 'http://127.0.0.1/tqsg',
		'api_port' => '8192',
		'http_port' => '10002',
        'sid' => '1',
        'time' => '2016-12-12 10:00:00',
        'parent' => 's1',
    ),
	
);
$tmp = end($latestServer);
$timeOpen = $tmp['time'];
if (time() >= strtotime($timeOpen) || (isset($_SESSION['username']) && $_SESSION['username'] == 'testgame') || $_SESSION['admin_login']) {
    $servers = array_merge($servers, $latestServer);
}

function generateServerSelect($name = 'server', $selected = '', $all = false, $required = true)
{
    global $servers;
    $html = '<select name="'. $name .'"'. ($required ? ' required' : '' ) .'><option value="">Chọn máy chủ...</option>';
    foreach ($servers as $key => $value) {
        $html .= '<option value="'. $key .'"'. ($key == $selected ? ' selected' : '') .'>'. strtoupper($key) . ' - ' . $value['name'] .'</option>';
    }

    if ($all) {
        $html .= '<option value="all"'. ('all' == $selected ? ' selected' : '') .'>Tất cả máy chủ</option>';
    }

    $html .= '</select>';
    echo $html;
}

function getLatestServerId()
{
    global $servers;
    $clone = $servers;
    end($clone);
    return key($clone);
}

function getNewestServerId()
{
    global $servers;
    global $latestServer;
    $clone = $servers;
    $clone2 = $latestServer;
    $clone = array_merge($clone, $clone2);
    end($clone);
    return key($clone);
}

function generateTwoLatestServerHtml()
{
    global $servers;
    $clone = $servers;
    $twoLatest = array_slice(array_reverse($clone), 0, 2);
    $html = '';
    $i = 0;
    foreach ($twoLatest as $key => $value) {
        $timeFormatVN = preg_replace('/([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/', '$4h$5 - $3.$2.$1', $value['time']);
        $html .= '<a title="Chơi game ở server '. strtoupper($key) .' - '. $value['name'] .'" href="/choi-game/'. $key .'" class="sv'. ++$i .'" target="_parent">'
            . '<span class="imgsv'. $i .'"></span>'
            . '<span class="namesv">'. strtoupper($key) .' - '. $value['name'] .'</span>'
            . '<span class="timesv">Ra mắt '. $timeFormatVN .'</span>'
            . '</a>';
    }
    echo $html;
}

function getTwoNewestServer()
{
    global $servers;
    $clone = $servers;
    $twoLatest = array_slice(array_reverse($clone), 0, 2);
    return $twoLatest;
}
function get12sv()
{
    global $servers;
    $clone = $servers;
    $twoLatest = array_slice(array_reverse($clone), 0, 12);
    return $twoLatest;
}
function get8sv()
{
    global $servers;
    $clone = $servers;
    $twoLatest = array_slice(array_reverse($clone), 0, 8);
    return $twoLatest;
}
function get1NewestServer()
{
    global $servers;
    $clone = $servers;
    $oneLatest = array_slice(array_reverse($clone), 0, 1);
    return $oneLatest;
}
function get24NewestServer()
{
    global $servers;
    $clone = $servers;
    $twoLatest = array_slice(array_reverse($clone), 0, 24);
    return $twoLatest;
}

function generateSixLatestServerHtml()
{
    global $servers;
    $clone = $servers;
    $sixLatest = array_slice(array_reverse($clone), 0, 6);
    $html = '<ul>';
    foreach ($sixLatest as $key => $value) {
        $timeFormat = preg_replace('/([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})/', '[$3-$2]', $value['time']);
        $html .= '<li><a href="/choi-game/'. $key .'"><span class="date-server">'. $timeFormat .'</span><span class="name-server">'. strtoupper($key) .' - '. $value['name'] .'</span><img src="/static/images/index/sv-stt-tot.png" alt="'. $value['name'] .'"></a></li>';
    }
    $html .= '</ul>';
    echo $html;
}

function generateServerSelect1($name = 'server', $selected = '', $all = false, $required = true)
{
    global $servers;
    $html = '';
    foreach ($servers as $key => $value) {
        $html .= '<option value="'. $key .'"'. ($key == $selected ? ' selected' : '') .'>' . $value['name'] .'</option>';
    }

    if ($all) {
        $html .= '<option value="all"'. ('all' == $selected ? ' selected' : '') .'>Tất cả máy chủ</option>';
    }

    $html .= '';
    echo $html;
}

function getMergedServers($includeNewest = true)
{
    global $servers;
    $clone = $servers;
    if ($includeNewest) {
        global $latestServer;
        $clone = array_merge($clone, $latestServer);
    }
    $clone = array_reverse($clone);
    $merged = array();
    foreach ($clone as $id => $server) {
        $merged[strtoupper($server['parent'])] = $id;
    }
    $merged = array_reverse($merged);
    return $merged;
}
