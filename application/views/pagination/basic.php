<div>
<span>
	<?php if ($first_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($first_page)) ?>" rel="first"><?php echo '&lt;&lt;' ?></a>
	<?php else: ?>
		<a href="#" class="off"><?php echo '&lt;&lt;' ?></a>
	<?php endif ?>

	<?php if ($previous_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($previous_page)) ?>" rel="prev"><?php echo '&lt;' ?></a>
	<?php else: ?>
		<a href="#" class="off"><?php echo '&lt;' ?></a>
	<?php endif ?>
</span>

	<?php for ($i = 1; $i <= $total_pages; $i++): ?>

		<?php if ($i == $current_page): ?>
			<a href="#" class="act"><?php echo $i ?></a>
		<?php else: ?>
			<a href="<?php echo HTML::chars($page->url($i)) ?>"><?php echo $i ?></a>
		<?php endif ?>

	<?php endfor ?>

<span>
	<?php if ($next_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($next_page)) ?>" rel="next"><?php echo '&gt;' ?></a>
	<?php else: ?>
		<a href="#" class="off"><?php echo '&gt;' ?></a>
	<?php endif ?>

	<?php if ($last_page !== FALSE): ?>
		<a href="<?php echo HTML::chars($page->url($last_page)) ?>" rel="last"><?php echo '&gt;&gt;' ?></a>
	<?php else: ?>
		<a href="#" class="off"><?php echo '&gt;&gt;' ?></a>
	<?php endif ?>
</span>

</div>