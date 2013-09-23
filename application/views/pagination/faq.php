<div class="content-pagination pagination-center">
    <?php if ($previous_page !== FALSE): ?>
        <a href="/faq<?php print (Request::current()->param('cat_id')) ? '/' . Request::current()->param('cat_id') : ''?><?php echo ($previous_page == 1) ? '' : '/page/' . $previous_page ?>" class="content-pagination-prev"></a>
    <?php endif ?>
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php if ($i == $current_page): ?>
            <span class="content-pagination-act"><?php echo $i ?></span>
        <?php else: ?>
            <a href="/faq<?php print (Request::current()->param('cat_id')) ? '/' . Request::current()->param('cat_id') : ''?><?php echo ($i == 1) ? '' : '/page/' . $i ?>" class="content-pagination-a"><?php echo $i ?></a>
        <?php endif ?>
    <?php endfor ?>
    <?php if ($next_page !== FALSE): ?>
        <a href="/faq<?php print (Request::current()->param('cat_id')) ? '/' . Request::current()->param('cat_id') : ''?>/page/<?php echo $next_page ?>" class="content-pagination-next"></a>
    <?php endif ?>
</div>