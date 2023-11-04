				<?php $this->extend('template'); ?>
				
				<?php $this->section('css'); ?>
				<?php $this->endSection(); ?>
				
				<?php $this->section('content'); ?>
				<div class="content">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								
								<?= $this->include('header-admin'); ?>

								<div class="row justify-content-center">
									<div class="col-md-10">
										<div class="card">
											<div class="card-body">
												<h5 class="mb-3">Edit Pesanan</h5>
												<?= alert(); ?>
												<form action="" method="POST">
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">No Transaksi</label>
														<div class="col-md-8">
															<input type="text" class="form-control text-dark bg-white" autocomplete="off" value="<?= $orders['order_id']; ?>" readonly>
															<small>No transaksi tidak dapat diedit</small>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Username</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="username" value="<?= $orders['username']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Whatsapp</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="wa" value="<?= $orders['wa']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Produk</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="product" value="<?= $orders['product']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Metode</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="method" value="<?= $orders['method']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">User ID</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="user_id" value="<?= $orders['user_id']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Zone ID</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="zone_id" value="<?= $orders['zone_id']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Nickname</label>
														<div class="col-md-8">
															<input type="text" class="form-control" autocomplete="off" name="nickname" value="<?= $orders['nickname']; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Status</label>
														<div class="col-md-8">
															<select name="status" class="form-control">
																<option value="Pending" <?= $orders['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
																<option value="Processing" <?= $orders['status'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
																<option value="Success" <?= $orders['status'] == 'Success' ? 'selected' : ''; ?>>Success</option>
																<option value="Canceled" <?= $orders['status'] == 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
																<option value="Expired" <?= $orders['status'] == 'Expired' ? 'selected' : ''; ?>>Expired</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label col-md-4 text-white">Keterangan</label>
														<div class="col-md-8">
															<textarea name="ket" cols="30" rows="4" class="form-control"><?= $orders['ket']; ?></textarea>
														</div>
													</div>
													<a href="<?= base_url(); ?>/admin/pesanan" class="btn btn-warning float-left">Kembali</a>
													<div class="text-right">
														<button class="btn text-white" type="reset">Batal</button>
														<button class="btn btn-primary" type="submit" name="tombol" value="submit">Simpan</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $this->endSection(); ?>
				
				<?php $this->section('js'); ?>
				<?php $this->endSection(); ?>