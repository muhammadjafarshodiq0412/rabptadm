<section class="content-header">
      <h1>
        RAB PT. ADM AHS
        <small>code your life with your oke</small>
      </h1>
      
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">        
        <div class="box-body">
    
    <!-- Form input dan edit Bua-->
    <legend>Rincian Proyek</legend>
     <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
         <form action="<?= base_url('proyek1/hitung_subtotal') ?>" method="post">
      <div class="form-group">
            <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Nama Ahs" value="<?= $proyek['project_name']; ?>" readonly />
        </div>  

        <div class="form-group">
            <label for="varchar">Rincian Data AHS <?php echo form_error('ukuran') ?></label>
            <table class="table table-bordered table-striped" id="mytable">
             <thead>
                <tr>
                    <th width="20px">No</th>        
                    <th>Uraian Pekerjaan</th>      
                    <th width="40px">Volume</th>
                    <th width="40px">Satuan</th>  
                    <th>Harga</th>
                    <th>Total</th>             
                </tr>  
            </thead>

             <?php
               $no =1; 
               foreach ($coba as $kp) {
                ?>
            <thead>
            <tr role="row" class="odd">
                                    <td align="center"><strong><?= $no; ?></strong></td>
                                    <td>
                                        <strong>
                                         <?= $kp['nama_kategori'] ?>
                                        </strong>
                                    </td>
                                    <td align="right"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    <td align="center"></td>
                                    </tr>
                                    <!-- ini buat isi bua / detail ahs nya -->
                                    
                                    <?php
                                    foreach($detail_proyek_ahs as $da) { 
                                    if ($kp['id_pekerjaan'] == $da['id_pekerjaan']) {
                                      ?>
                                    <tr>
                                      <td align="center"></td>
                                      <td><?=$da['nm_ahs']; ?></td>
                                      <td><?=$da['volume']; ?></td>
                                      <td><?=$da['satuan']; ?></td>
                                      <td>Rp. <?=$da['total']; ?></td>
                                      <td>Rp. <?=$da['subtotal']; ?></td>
                                    </tr>

                                   <!-- stop if-->
                                    <?php } ?>
                                     <!-- stop perulangan $da -->
                                    <?php } ?>  
                                   <?php foreach($detail_proyek_ahs as $da) { 
                                    if ($kp['id_pekerjaan'] == $da['id_pekerjaan']) {
                                      ?>
                                    <?php $jumlah = $this->db->select_sum('detail_proyek_ahs.subtotal')
                                          ->from('detail_proyek_ahs')
                                          ->join('ahs', 'detail_proyek_ahs.id_ahs = ahs.id_ahs', 'LEFT')
                                          ->where('detail_proyek_ahs.id_pekerjaan', $da['id_pekerjaan'])
                                          ->where('detail_proyek_ahs.id_proyek', $kp['id_proyek'])
                                          ->get()->row()->subtotal;
                                     ?>
                                    <tr role="row" class="odd">
                                    <td colspan="5" align="center"><strong>Jumlah</strong></td>
                                    <td align="left">Rp. <?= $jumlah ?> </td>
                                    </tr>
                                    <?php break; } ?>
                                    <?php } ?>
            </thead>
            <?php $no++; ?>
            <?php } ?> 
              <tr>
                <td colspan="5" align="center"><strong>Total Harga Proyek</strong></td>
                <td> <label name="total" id="total" value="<?= $sum; ?>" />Rp. <?= $sum; ?></td>
               </tr>
               <tr>
                <td colspan="5" align="center"><strong>Jasa Kontraktor</strong></td>
                <td> <label name="kontraktor" id="kontraktor" value="<?= $kt; ?>" />Rp. <?= $kt; ?></td>
               </tr>
               <tr>
                <?php $hasil = $sum + $kt; ?>
                <td colspan="5" align="center"><strong>Total Setelah Jasa Kontraktor</strong></td>
                <td><label>Rp. <?= $hasil; ?></td>
               </tr>
            </table>
                </div>  

      <input type="hidden" class="form-control" name="id_proyek" id="id_proyek" placeholder="Nama Ahs" value="<?= $proyek['id_proyek']; ?>" readonly />
      <input type="submit" class="btn btn-primary" name="status" id="status" value="acc" />
      <input type="submit" class="btn btn-success" name="status" id="status" value="return" />
      <input type="submit" class="btn btn-danger" name="status" id="status" value="close" />
      <a href="<?php echo site_url('proyek1') ?>" class="btn btn-default">Cancel</a>
    </form>

