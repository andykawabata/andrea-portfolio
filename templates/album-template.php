<div id="main-content">
    <div id="galleryWrapper">
        <div id="slideShowWrapper">
        
            <div id="slideShow">
                
                <?php foreach($path_array as $path): ?>
                <div class="slide">
                        <img src="<?php echo $path ?>">
                </div>
                <?php endforeach; ?>

                <div id="clickLeft" class="click-area"></div>
                <div id="clickRight" class="click-area"></div>
                
            </div>
        </div>
        <div id="simpleNav">
                <span id="prev">prev</span>
                <span>  /  </span>
                <span id="next">next</span>
            </div>
    </div>
</div>