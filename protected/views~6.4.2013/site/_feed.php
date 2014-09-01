<div class="feed">
    <div class="span3">
        <img src="/images/avatar.jpg" class="feed-image">
    </div>
    <h6 class="feed-author"><?php echo CHtml::encode($data->emp->Fname); ?> <small class="text-right">(<?php echo CHtml::encode(WebApp::formatDate($data->timestamp)); ?>)</small>:</h6>
    <p><?php echo CHtml::encode($data->message);  ?></p>
</div><!--feed-->