<?php
// Создаем основу для URL страниц
$url = '/search/';
if (!empty($_route_params['search_text']))
	$url .= $_route_params['search_text'];
if (!empty($_route_params['in_cat']))
	$url .= '/in/' . $_route_params['in_cat'];
if (!empty($_route_params['on_field']))
	$url .= '/on/' . $_route_params['on_field'];
?>
<div>
<span>
	<?php if ($first_page !== FALSE): ?>
		<a href="<?php echo $url; ?>" rel="first">&lt;&lt;</a>
	<?php else: ?>
		<a href="#" class="off">&lt;&lt;</a>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<a href="<?php echo $url; echo ($previous_page == 1) ? '' : '/page/' . $previous_page ?>" rel="prev">&lt;</a>
	<?php else: ?>
		<a href="#" class="off">&lt;</a>
	<?php endif ?>
</span>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			<a href="#" class="act"><?php echo $i ?></a>
		<?php else: ?>
			<a href="<?php echo $url; echo ($i == 1) ? '' : '/page/' . $i ?>"><?php echo $i ?></a>
		<?php endif ?>

	<?php endfor ?>

<span>
	<?php if ($next_page !== FALSE): ?>
		<a href="<?php echo $url . '/page/' . $next_page ?>" rel="next">&gt;</a>
	<?php else: ?>
		<a href="#" class="off">&gt;</a>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<a href="<?php echo $url . '/page/' . $last_page ?>" rel="last">&gt;&gt;</a>
	<?php else: ?>
		<a href="#" class="off">&gt;&gt;</a>
	<?php endif ?>
</span>

</div>