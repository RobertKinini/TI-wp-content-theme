<?php if ($showHintInfo) { ?>
	<div class='course-info'>
		In order to get the most out of this swagpath, it is recommended that you
		first collect these swag:
		<?php echo $uncollectedSwag; ?>.<br/>
		You can collect them by following these swagpaths:
		<?php echo $uncollectedSwagpaths; ?>
	</div>
<?php } ?>

<div class='content-tab-wrapper'>
	<ul class='content-tab-list'>
		<?php foreach ($swagPost->getSwagPostItems() as $swagPostItem) { ?>
			<li
				<?php if ($swagPostItem->isSelected()) echo "class='selected'"; ?>
			>
				<a href="<?php echo $swagPostItem->getUrl(); ?>">
					<?php if ($swagPostItem->isCompleted($swagUser)) { ?>
						<img
							class='coursepresentation'
							src="<?php echo get_template_directory_uri(); ?>/img/completed-logo.png"
						/>
					<?php } else { ?>
						<img
							class='coursepresentation'
							src="<?php echo get_template_directory_uri(); ?>/img/coursepresentation-logo.png"
						/>
					<?php } ?>
				</a>
			</li>
		<?php } ?>
	</ul>
	<div class='content-tab-content'>
		<h1 style="text-align:left;float:left;"><?php echo $swagPost->getSelectedItem()->getTitle(); ?></h1>
		<?php if($showLessonPlan and $lessonplanAvailable) : ?>
		<a href="<?php echo $lessonPlan; ?>" class="button-lessonplan" style="text-align:right;float:right">Download Lesson Plan</a>
	<?php elseif ($showLessonPlan and !$lessonplanAvailable) : ?>
		<button style="text-align:right;float:right" title="Please complete swag to download the lesson plan" class="button-lessonplan disabled" disabled>Download Lesson Plan</button>
		<?php endif; ?>
		<?php echo $swagPost->getSelectedItem()->getContent(); ?>
	</div>
</div>
