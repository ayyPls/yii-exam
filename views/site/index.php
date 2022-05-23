<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>




    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="min-height: 500px;">

        <div class="carousel-inner" style="height: ">
            <?php foreach($query as $element=>$item){

if($element === array_key_first($query))
                echo "<div class='carousel-item active' style='background-color: gray; height: 500px;'>
                <img src='{$item['image']}' class='d-block w-100' alt='1'>
                <div class='carousel-caption d-none d-md-block'>
                    <p>".$item['name']."</p>
                </div>
            </div>";
else echo "<div class='carousel-item' style='background-color: gray; height: 500px;'>
                <img src={$item['image']} class='d-block w-100' alt='1'>

                <div class='carousel-caption d-none d-md-block'>
                    <p>".$item['name']."</p>
                </div>
            </div>";
            }?>


        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>
</div>
