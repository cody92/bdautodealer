<div class="sortable row-fluid">
    <?php
    foreach ($items as $item) {
        ?>
        <a data-rel="tooltip" title="<?php echo $item['tooltip-text']; ?>" class="well span3 top-block" href="<?php echo $this->url($item['link']); ?>">
            <span class="icon32 icon-red <?php echo $item['css-icon']; ?>"></span>
            <div><?php echo $item['head-title']; ?></div>
            

        </a>   
        <?php
    }
    ?>
</div>

