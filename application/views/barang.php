<?php if ($this->session->flashdata('pesan')) { ?>
<div class="alert alert-info" role="alert">
<?php echo $this->session->flashdata('pesan'); ?>
</div>
<?php } ?>

<div class="xs">
 <h3 style="text-align: center;font-weight: 600;font-size: 36px">Data Barang</h3>
 <button type="button" class="btn btn-lg btn-info" data-toggle="modal" data-target="#tambah">Tambah Data</button>
<br>
 <div class="bs-example4" data-example-id="contextual-table">
   <table class="table" id="table">
    <thead>
      <tr>
        <th>Gambar</th>
        <th>Nama Barang </th>
        <th>Kode Barang</th>
        <th>Nama Kategori</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php  
      foreach ($barang as $barang):
    ?>
      <tr>
        <td><img src="<?php echo base_url('assets/upload/'.$barang->foto_cover)?>" width="100px"></td>
        <td><?php echo $barang->nama_barang ?></td>
        <td><?php echo $barang->kode_barang ?></td>
        <td><?php echo $barang->nama_kategori ?></td>
        <td><?php echo $barang->stok ?></td>
        <td>Rp. <?php echo number_format($barang->harga) ?></td>
        <td>
          <a class="btn btn-sm btn-default" data-toggle="modal" data-target="#edit" onclick="edit('<?php echo $barang->kode_barang ?>')">Update</a>
          <a class="btn btn-sm btn-danger" href="<?php echo base_url('index.php/barang/delete/'.$barang->kode_barang) ?>" onclick="return confirm('Data barang akan dihapus')">Delete</a>
        </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>

  <script type="text/javascript">
    function edit(a) {
    $.ajax({
      type: "post",
      url: "<?= base_url() ?>index.php/barang/detail/"+a,
      dataType: "json",
      success:function(data){
        $("#kodebarang").val(data.kode_barang);
        $("#nama_barang").val(data.nama_barang);
        $("#tahun").val(data.tahun);
        $("#kategori").val(data.kode_kategori);
        $("#harga").val(data.harga);
        $("#penerbit").val(data.merek);
        $("#stok").val(data.stok);
        $("#tampilGambar").attr('src','<?php echo base_url() ?>assets/upload/'+data.foto_cover);

      }
    });
  }
  </script>

  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h2 class="modal-title">Update Data</h2>
        </div>
        <div class="modal-body">

          <div class="well1 white">
            <form class="form-floating ng-pristine ng-invalid ng-invalid-required ng-valid-email ng-valid-url ng-valid-pattern" novalidate="novalidate" ng-submit="submit()" enctype="multipart/form-data" method="post" action="<?php echo base_url()?>index.php/barang/update">
              <fieldset>
              <input type="hidden" id="kodebarang" name="kodebarang">
                <div class="form-group">
                  <label class="control-label">Nama barang</label>
                  <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" required name="nama_barang" id="nama_barang">
                </div>

                <div class="form-group">
                  <label class="control-label">Tahun</label>
                  <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" required name="tahun" id="tahun">
                </div>
                <div class="form-group filled">
                  <label class="control-label">Kategori</label>
                  <select class="form-control1 ng-invalid ng-invalid-required" ng-model="model.select" required name="kategori" id="kategori"><option></option>
                    <?php  
                    foreach ($kategori as $kat):
                    ?>
                    <option value="<?php echo $kat->kode_kategori ?>"><?php echo $kat->nama_kategori ?></option>
                  <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label class="control-label">Harga</label>
                  <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" required name="harga" id="harga">
                </div>

                <div class="form-group">
                  <label class="control-label">Merek</label>
                  <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" required name="merek" id="merek">
                </div>

                <div class="form-group">
                  <label class="control-label">Stok</label>
                  <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" name="stok" id="stok">
                </div>

                <div class="form-group">
                  <label class="control-label">Foto Cover</label>
                  <img id="tampilGambar" src="" width="100%;">
                  <input type="file" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" name="gambar">
                </div>
              </fieldset>
            
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <input class="btn btn-info" type="submit" name="submit">
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h2 class="modal-title">Tambah Data</h2>
        </div>
        <div class="modal-body">

          <div class="well1 white">
            <form class="form-floating ng-pristine ng-invalid ng-invalid-required ng-valid-email ng-valid-url ng-valid-pattern" novalidate="novalidate" ng-submit="submit()" enctype="multipart/form-data" method="post" action="<?php echo base_url() ?>index.php/barang/add">
              <fieldset>
                <div class="form-group">
                  <label class="control-label">Nama barang</label>
                  <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" required name="nama_barang">
                </div>

                <div class="form-group">
                  <label class="control-label">Tahun</label>
                  <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" required name="tahun">
                </div>
                <div class="form-group filled">
                  <label class="control-label">Kategori</label>
                  <select class="form-control1 ng-invalid ng-invalid-required" ng-model="model.select" required name="kategori" id="kategori"><option></option>
                    <?php  
                    foreach ($kategori as $kat1):
                    ?>
                    <option value="<?php echo $kat1->kode_kategori ?>"><?php echo $kat1->nama_kategori ?></option>
                  <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label class="control-label">Harga</label>
                  <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" required name="harga">
                </div>

                <div class="form-group">
                  <label class="control-label">Merek</label>
                  <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" required name="merek">
                </div>

                <div class="form-group">
                  <label class="control-label">Stok</label>
                  <input type="text" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" name="stok">
                </div>

                <div class="form-group">
                  <label class="control-label">Foto Cover</label>
                  <input type="file" class="form-control1 ng-invalid ng-invalid-required ng-touched" ng-model="model.name" name="gambar">
                </div>
              </fieldset>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <input type="submit" class="btn btn-info" value="Tambah Data">
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
</div>
</div>