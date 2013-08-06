<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "search" ); ?>'><?php echo Html::anchor('apitest/2ch/search','Search');?></li>
	<li class='<?php echo Arr::get($subnav, "result" ); ?>'><?php echo Html::anchor('apitest/2ch/result','Result');?></li>

</ul>
<?php echo Form::open('apitest/2ch/result'); ?>
        <p>2chSearch</p>
        <?php echo Form::input('query', Input::post('query', isset($post) ? $post->query : '')); ?>
        <?php echo Form::submit('submit_btn', '検索'); ?>
<?php echo Form::close(); ?>
