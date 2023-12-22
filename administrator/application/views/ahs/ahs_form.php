<section class="content-header">
      <h1>
        RAB PT. ADM AHS
        
      </h1>
      
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
		
		<!-- Form input dan edit Bua-->
		<legend>Rincian Ahs</legend>
        
		
	    <div class="form-group">
            <label for="varchar">Nama Pekerjaan <?php echo form_error('nm_ahs') ?></label>
            <input type="text" class="form-control" name="nm_ahs" id="nm_ahs" placeholder="Nama Ahs" value="<?= $ahs['nm_ahs']; ?>" readonly />
        </div>	

        <div class="form-group">
            <label for="varchar">Rincian Data AHS <?php echo form_error('ukuran') ?></label>
            <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>		    
					          <th>Uraian Kategori</th>		   
					          <th>Koofisien</th>
                    <th>Satuan</th>  
                    <th>Harga Satuan</th>
                    <th>Total</th>             
					<th width="100px">Action</th>
                </tr>  
            </thead>

            <thead>
            <tr role="row" class="odd">
                                    <td align="center"><strong>1</strong></td>
                                    <td>
                                        <strong>
                                         <?= $kategori['nama_kategori'] ?>
                                        </strong>
                                    </td>
                                    <td align="right"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    <td>
                                    <div class="btn-group">
                                       <a href="<?= base_url('ahs/ambil_bua/'). $ahs['id_ahs'] .'/'. $kategori['id_kategori']; ?>" <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i>
                                          </button>
                                        </a>
                                    </div>
                                    </td>
                                    </tr>
                                    <!-- ini buat isi bua / detail ahs nya -->
                                    
                                    <?php foreach ($detail_ahs as $da) : ?>
                                    <tr>
                                      <td align="center"></td>
                                      <td><?=$da['nama_bua']; ?></td>
                                      <td><?=$da['koefisien']; ?></td>
                                      <td><?=$da['satuan']; ?></td>
                                      <td><?=$da['harga']; ?></td>
                                      <td><?=$da['subtotal']; ?></td>
                                      <td>
                                      <div class="btn-group">
                                         <a href="<?= base_url('ahs/form_edit_ahs/'). $da['id_ahs'].'/'.$da['id_kategori'].'/'.$da['id_bua']; ?>" <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                      </div>
                                      <div class="btn-group">
                                          <a onclick="javascript: return confirm('Yakin ingin hapus?')" href="<?= base_url('ahs/delete_detail/'). $da['id_ahs'].'/'.$da['id_bua']; ?>" <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                      </div>  
                                      </td>
                                    </tr>
                                     <?php endforeach; ?>  

                                    <tr role="row" class="odd">
                                    <td colspan="5" align="center"><strong>Jumlah</strong></td>
                                    <td align="left"><?= $sum1;  ?></td>
                                    <td align="center">
                                   
                                    </td>
                                    </tr>
            </thead>

            <thead>
            <tr role="row" class="odd">
                                    <td align="center"><strong>2</strong></td>
                                    <td>
                                        <strong>
                                         <?= $kategori2['nama_kategori'] ?>
                                        </strong>
                                    </td>
                                    <td align="right"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    <td>
                                    <div class="btn-group">
                                       <a href="<?= base_url('ahs/ambil_bua/'). $ahs['id_ahs'] .'/'. $kategori2['id_kategori']; ?>" <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i>
                                          </button>
                                        </a>
                                    </div>
                                    </td>
                                    </tr>
                                    <!-- ini buat isi bua / detail ahs nya -->
                                    
                                    <?php foreach ($detail_ahs2 as $da2) : ?>
                                    <tr>
                                      <td align="center"></td>
                                      <td><?=$da2['nama_bua']; ?></td>
                                      <td><?=$da2['koefisien']; ?></td>
                                      <td><?=$da2['satuan']; ?></td>
                                      <td><?=$da2['harga']; ?></td>
                                      <td><?=$da2['subtotal']; ?></td>
                                      <td>
                                      <div class="btn-group">
                                         <a href="<?= base_url('ahs/form_edit_ahs/'). $da2['id_ahs'].'/'.$da2['id_kategori'].'/'.$da2['id_bua']; ?>" <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                      </div>
                                      <div class="btn-group">
                                          <a onclick="javascript: return confirm('Yakin ingin hapus?')" href="<?= base_url('ahs/delete_detail/'). $da2['id_ahs'].'/'.$da2['id_bua']; ?>" <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                      </div>
                                      </td>
                                    </tr>
                                     <?php endforeach; ?>  

                                    <tr role="row" class="odd">
                                    <td colspan="5" align="center"><strong>Jumlah</strong></td>
                                    <td align="left"><?= $sum2;  ?></td>
                                    <td align="center">
                                   
                                    </td>
                                    </tr>
            </thead>
            <thead>
            <tr role="row" class="odd">
                                    <td align="center"><strong>3</strong></td>
                                    <td>
                                        <strong>
                                        <?= $kategori3['nama_kategori'] ?>
                                        </strong>
                                    </td>
                                    <td align="right"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    <td>
                                   <div class="btn-group">
                                       <a href="<?= base_url('ahs/ambil_bua/'). $ahs['id_ahs'] .'/'. $kategori3['id_kategori']; ?>" <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-plus-circle"></i>
                                          </button>
                                        </a>
                                    </div>
                                    </td>
                                    </tr>
                                    <!-- ini buat isi bua / detail ahs nya -->
                                    
                                    <?php foreach ($detail_ahs3 as $da3) : ?>
                                    <tr>
                                      <td align="center"></td>
                                      <td><?=$da3['nama_bua']; ?></td>
                                      <td><?=$da3['koefisien']; ?></td>
                                      <td><?=$da3['satuan']; ?></td>
                                      <td><?=$da3['harga']; ?></td>
                                      <td><?=$da3['subtotal']; ?></td>
                                      <td>
                                       <div class="btn-group">
                                         <a href="<?= base_url('ahs/form_edit_ahs/'). $da3['id_ahs'].'/'.$da3['id_kategori'].'/'.$da3['id_bua']; ?>" <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                      </div>
                                      <div class="btn-group">
                                          <a onclick="javascript: return confirm('Yakin ingin hapus?')" href="<?= base_url('ahs/delete_detail/'). $da3['id_ahs'].'/'.$da3['id_bua']; ?>" <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                      </div>   
                                      </td>
                                    </tr>
                                     <?php endforeach; ?>  

                                    <tr role="row" class="odd">
                                    <td colspan="5" align="center"><strong>Jumlah</strong></td>
                                    <td align="left"><?= $sum3;  ?></td>
                                    <td align="center">
                                   
                                    </td>
                                    </tr>
            </thead>                   
                                    <form action="<?= base_url('ahs/update_total_ahs'); ?>" method="post"> 
                                    <tr>
                                      <td colspan="5" align="center"><strong>Total Harga AHS</strong></td>
                                      <td> 
                                       <label  />Rp. <?= $sum; ?>
                                          <input type="hidden" class="form-control" name="total" id="total" value="<?= $sum; ?>"/>
                                      </td>
                                      <td></td>
                                    </tr>    
            </table>
                </div>	

        <div class="form-group">
            <label for="varchar">Satuan <?php echo form_error('satuan') ?></label>
            <input type="text" class="form-control" name="satuan" id="satuan" value="<?= $ahs['satuan']; ?>"/>
        </div>
			
        <input type="hidden" class="form-control" name="id_ahs" id="id_ahs" value="<?= $ahs['id_ahs']; ?>" />
           <button type="submit" class="btn btn-primary">Simpan
           </button>
           <a href="<?php echo site_url('ahs') ?>" class="btn btn-default">Cancel</a>
      </form>
	    
	
    </body>
</html>
