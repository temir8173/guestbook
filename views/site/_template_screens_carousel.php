<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="row about-row">

                <div class="col-md-7">
                    <div class="img-box img-container">
                        <div>
                            <img src="images/about1.png" alt="">
                        </div>
                    </div>
                </div>


                <div class="col-md-5 d-flex flex-column justify-content-around">
                    <div class="about-box-text">
                        <p class="about-title"><?= Yii::t('common', 'Өткізілетін орын') ?></p>
                        <p>
                            <?= Yii::t(
                                'common',
                                'Жиынның өткізілетін жері туралы мағлұмат орнастыру мүмкіндігі'
                            )
                            ?>
                        </p>
                    </div>
                    <div class="about-box-position  d-flex justify-content-end">
                        <span class="about-box-number ">01</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <div class="row about-row">
                <div class="col-md-7">
                    <div class="img-box img-container">
                        <div>
                            <img src="images/about2.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-5 d-flex flex-column justify-content-around">
                    <div class="about-box-text">
                        <p class="about-title"><?= Yii::t('common', 'Естелік') ?></p>
                        <p>
                            <?= Yii::t(
                                'common',
                                'Тойдан көптеген естеліктер қалады емес пе? Қонақтар осы парақша арқылы бейне/фото материалдарға қол жеткізе алады'
                            )
                            ?>
                        </p>

                    </div>
                    <div class="about-box-position d-flex justify-content-end">

                        <span class="about-box-number">02</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <div class="row about-row">

                <div class="col-md-7">
                    <div class="img-box img-container">
                        <div>
                            <img src="images/about3.png" alt="">
                        </div>
                    </div>
                </div>

                <div class="col-md-5 d-flex flex-column justify-content-around">
                    <div class="about-box-text">
                        <p class="about-title"><?= Yii::t('common', 'Love story') ?></p>
                        <p><?= Yii::t('common', 'Сондай-ақ өміріңіздегі ұмытылмас сәттеріңізбен жақын-жуықтарыңызбен бөлісе аласыз') ?></p>

                    </div>
                    <div class="about-box-position  d-flex justify-content-end">

                        <span class="about-box-number ">03</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-item">
            <div class="row about-row">
                <div class="col-md-7">
                    <div class="img-box img-container">
                        <div>
                            <img src="images/about4.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-5 d-flex flex-column justify-content-around">
                    <div class="about-box-text">
                        <p class="about-title"><?= Yii::t('common', 'Тілектер') ?></p>
                        <p><?= Yii::t('common', 'Қонақтар өздерінің тілек-лебіздерін білдіре алады') ?></p>

                    </div>
                    <div class="about-box-position d-flex justify-content-end">

                        <span class="about-box-number">04</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<script>
    $('.carousel').carousel({
        interval: 2000
    })
</script>