<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "search" ); ?>'><?php echo Html::anchor('apitest/twitter/search','Search');?></li>
	<li class='<?php echo Arr::get($subnav, "result" ); ?>'><?php echo Html::anchor('apitest/twitter/result','Result');?></li>

</ul>
<p>Result</p>
<?php foreach ($tweets as $tweet): ?>
	<div>
		<?php echo Html::img($tweet->user->profile_image_url, array('style' => 'float:left; margin: 10px')); ?>
		<div>
			<br>
			<?php echo $tweet->text; ?><br>
			<span style='font-weight: bold;'>From:</span><?php echo Html::anchor('https://twitter.com/'.$tweet->user->screen_name, $tweet->user->screen_name); ?>
			<span style='font-weight: bold;'>Posted Time:</span><?php echo date('Y/m/d H:i:s', strtotime($tweet->created_at)); ?>
		</div>
	</div>
	<hr>
<?php endforeach; ?>
