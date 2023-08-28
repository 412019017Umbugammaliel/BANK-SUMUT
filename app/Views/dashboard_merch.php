<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="row">
                <div class="col-9">
                    <h1 class="app-page-title">Merchant</h1>
                </div>
                <div class="col-3 text-end">
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg></a>
                    <button class="btn app-btn-primary">Tambah</button>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <?php foreach ($merchant as $rowmerchant) {
                ?>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="app-card shadow-sm h-100 cardServer" data-tilt data-tilt-glare="true" data-tilt-max-glare="50" data-scale="2" data-tilt-max="30" data-tilt-perspective="20000" data-reset="true" data-shadow="true">
                            <div class="app-card-body p-3 p-lg-4 cardInner">
                                <img src="<?php echo base_url(); ?>/assets/images/product_merch/<?php echo $rowmerchant['gambar_barang'] ?>.PNG" class="img-fluid" alt="Responsive image">
                                <div class="mt-5">
                                    <h3><?php echo $rowmerchant['nama_barang'] ?></h3>
                                    <h5 class="fw-lighter">Rp <?php echo number_format($rowmerchant['harga_barang'], 0, '', '.') ?></h5>
                                </div>
                                <div class="mt-3 row">
                                    <div class="col-6 text-start">
                                        <button class="wide btn app-btn-warning" style="width:100%;">Edit</button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="btn app-btn-secondary" style="width:100%;">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>