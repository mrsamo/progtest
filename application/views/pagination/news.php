<div class="b-paginator">
    <?php if ($previous_page !== FALSE): ?>
        <a href="/news<?php echo ($previous_page == 1) ? '' : '/' . $previous_page ?>" class="b-paginator-lnk b-paginator-lnk_prev">Назад</a>
    <?php endif ?>    
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="/news<?php echo ($i == 1) ? '' : '/' . $i ?>" class="b-paginator-lnk<?php if ($i == $current_page): ?>  b-paginator-lnk_active<?php endif ?>"><?php echo $i ?></a>
    <?php endfor ?>         
    <?php if ($next_page !== FALSE): ?>
        <a href="/news/<?php echo $next_page ?>" class="b-paginator-lnk b-paginator-lnk_next">Вперед</a>
    <?php endif ?>
</div>