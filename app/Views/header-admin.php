								<nav class="navbar navbar-expand-lg navbar-dark mb-3" style="background: var(--warna_2);border-radius: 10px;">
								    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-admin" aria-controls="navbar-admin" aria-expanded="false" aria-label="Toggle navigation">
								        <span class="navbar-toggler-icon"></span>
								    </button>
								    <div class="collapse navbar-collapse" id="navbar-admin" style="background: transparent;">
								        <div class="navbar-nav">
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/">Home</a>
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/konfigurasi">Konfigurasi</a>
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/admin">Admin</a>
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/games">Games</a>
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/kategori">Kategori</a>
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/produk">Produk</a>
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/pesanan">Pesanan</a>
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/topup">Topup</a>
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/metode">Metode</a>
								            <a class="nav-item nav-link" href="<?= base_url(); ?>/admin/pengguna">Pengguna</a>
								        </div>
								    </div>
								    <div class="dropdown">
									    <span class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
									    	<img src="<?= base_url(); ?>/assets/images/profile.png" alt="" width="36">
									    </span>
									    <div class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton" style="left: auto;right: 0;box-shadow: none !important;background: #1f2a36;">
									        <a class="dropdown-item text-white" href="<?= base_url(); ?>/admin/password">Ganti Password</a>
									        <a class="dropdown-item text-white" href="<?= base_url(); ?>/admin/logout">Logout</a>
									    </div>
									</div>
								</nav>