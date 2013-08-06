<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "search" ); ?>'><?php echo Html::anchor('apitest/2ch/search','Search');?></li>
	<li class='<?php echo Arr::get($subnav, "result" ); ?>'><?php echo Html::anchor('apitest/2ch/result','Result');?></li>

</ul>
<p>Result</p>
<?php foreach ($items as $item): ?>
                <div>
                        <?php echo Html::anchor($item->link, $item->title); ?><br><br>
                        <?php echo $item->snippet ?><br>
                </div>
        <hr>
<?php endforeach; ?>
