<?php

require_once('lib.php');

$runs = get_runs();
$before = null;
$after = null;
$width = '800';
$height = '600';
if (!empty($_GET['before']) && array_key_exists($_GET['before'], $runs)) {
    $before = $_GET['before'];
    $beforekey = array_search($before, $runs);
}
if (!empty($_GET['after']) && array_key_exists($_GET['after'], $runs)) {
    $after = $_GET['after'];
    $afterkey = array_search($after, $runs);
}
if (!empty($_GET['property']) && in_array($_GET['property'], $PROPERTIES)) {
    $property = $_GET['property'];
}
if (!empty($_GET['w']) && preg_match('/^\d+$/', $_GET['w'])) {
    $width = (int)$_GET['w'];
}
if (!empty($_GET['h']) && preg_match('/^\d+$/', $_GET['h'])) {
    $height = (int)$_GET['h'];
}

$pages = array();
if ($before && $after) {
    $pages = build_pages_array($runs, $before, $after);
}

if (isset($_GET['page']) && array_key_exists($_GET['page'], $pages)) {
    $page = $pages[$_GET['page']];
}

echo "<html><head></head><body style='margin:0;padding:0;text-align:center;'>";
echo "<img src='./cache/".produce_page_graph($property, $beforekey, $page['before'], $afterkey, $page['after'], $width, $height)."' alt='$property' style='width:{$width}px;height:{$height}px;' />";
echo "</body></html>";