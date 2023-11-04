            <?php $this->extend('template'); ?>
            
            <?php $this->section('css'); ?>
            <?php $this->endSection(); ?>
            
            <?php $this->section('content'); ?>
            <div class="mb-4" style="padding-top: 110px;">
                <div class="container">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php $no = 0; foreach ($banner as $loop): ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $no; ?>" <?= $no == 0 ? 'class="active"' : ''; ?>></li>
                            <?php $no++; endforeach ?>
                        </ol>
                        <div class="carousel-inner" style="border-radius: 16px;">
                            <?php $no = 1; foreach ($banner as $loop): ?>
                            <div class="carousel-item <?= $no == 1 ? 'active' : ''; ?>">
                                <img class="d-block w-100" src="<?= base_url(); ?>/assets/images/banner/<?= $loop['image']; ?>" alt="First slide">
                            </div>
                            <?php $no++; endforeach ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <?php foreach ($games as $game): ?>
            <div class="container pt-4 pb-4">
                <div class="row">
                    <div class="col-12">
                        <h5><?= $game['category']; ?></h5>
                        <span class="strip-primary"></span>
                    </div>
                </div>
            </div>
            <div class="pb-4">
                <div class="container">
                    <div class="row game">
                        <?php foreach ($game['games'] as $loop): ?>
                        <?php if ($loop['status'] == 'On'): ?>
                        <div class="col-sm-3 col-lg-2 col-4 text-center">
                            <div class="card mb-3">
                                <a href="<?= base_url(); ?>/games/<?= $loop['slug']; ?>" class="product_list">
                                    <div class="card-game" bis_skin_checked="1">
                                        <img src="<?= base_url(); ?>/assets/images/games/<?= $loop['image']; ?>" class="img-fluid" style="border-radius: 10px; display: block;">
                                    </div>
                                    <div class="card-title" bis_skin_checked="1"> <?= $loop['games']; ?> </div>
                                    <div class="card-subtitle" bis_skin_checked="1"></div>
                                    <div class="card-topup" bis_skin_checked="1">
                                        <div class="btn-topup" style="font-size: 0.60rem!important;" bis_skin_checked="1"> TOP UP </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
            <?php $this->endSection(); ?>
            
            <?php $this->section('js'); ?>
            <?php $this->endSection(); ?>