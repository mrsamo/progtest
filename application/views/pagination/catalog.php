<?php
// Категория
$cat_id = Request::current()->param('cat_id');
// Фильтры
$city = Request::current()->param('city');
$rooms = Request::current()->param('rooms');
$floor_compare = Request::current()->param('floor_compare');
$floor = Request::current()->param('floor');
$floors_1 = Request::current()->param('floors_1');
$floors_2 = Request::current()->param('floors_2');
$price_1 = Request::current()->param('price_1');
$price_2 = Request::current()->param('price_2');
$square_1 = Request::current()->param('square_1');
$square_2 = Request::current()->param('square_2');

$filter = '';
if (!empty($city))
    $filter .= '/city/' . $city;
if (!empty($rooms))
    $filter .= '/rooms/' . $rooms;
if (!empty($floor) and !empty($floor_compare))
    $filter .= '/floor/' . $floor_compare . '_' . $floor;
if (!empty($floors_1) or !empty($floors_2))
    $filter .= '/floors/' . (!empty($floors_1) ? $floors_1 : '0') . '_' . (!empty($floors_2) ? $floors_2 : '0');
if (!empty($price_1) or !empty($price_2))
    $filter .= '/price/' . (!empty($price_1) ? $price_1 : '0') . '_' . (!empty($price_2) ? $price_2 : '0');
if (!empty($square_1) or !empty($square_2))
    $filter .= '/square/' . (!empty($square_1) ? $square_1 : '0') . '_' . (!empty($square_2) ? $square_2 : '0');
?>

<div class="b-paginator">
    <?php if ($previous_page !== FALSE): ?>
        <a href="/catalog<?php print ($cat_id) ? '/' . $cat_id : '/1'  ?><?php print $filter; ?><?php echo ($previous_page == 1) ? '' : '/page/' . $previous_page ?>" class="b-paginator-lnk b-paginator-lnk_prev">Назад</a>
    <?php endif ?> 

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="/catalog<?php print ($cat_id) ? '/' . $cat_id : '/1'  ?><?php print $filter; ?><?php echo ($i == 1) ? '' : '/page/' . $i ?>" class="b-paginator-lnk<?php if ($i == $current_page): ?>  b-paginator-lnk_active<?php endif ?>"><?php echo $i ?></a>
    <?php endfor ?>         
    <?php if ($next_page !== FALSE): ?>
        <a href="/catalog<?php print ($cat_id) ? '/' . $cat_id : '/1'  ?><?php print $filter; ?>/page/<?php echo $next_page ?>" class="b-paginator-lnk b-paginator-lnk_next">Вперед</a>
    <?php endif ?>
</div>