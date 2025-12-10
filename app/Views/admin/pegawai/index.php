<?= $this->extend('layout/admin/admin_layout') ?>

<?= $this->section('content') ?>

<!-- Tombol Tambah Pegawai dan Fitur Pencarian/Filter -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="<?= base_url('admin/pegawai/create') ?>" class="btn btn-primary">Tambah Pegawai</a>
    
    <div class="d-flex gap-2">
        <!-- Search Input -->
        <div class="input-group" style="width: 250px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari semua kolom...">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        
        <!-- Filter Jenis Kelamin -->
        <select id="genderFilter" class="form-control" style="width: 150px;">
            <option value="">Semua Jenis Kelamin</option>
            <option value="laki-laki">Laki-laki</option>
            <option value="perempuan">Perempuan</option>
        </select>
    </div>
</div>

<!-- Informasi Hasil Pencarian -->
<div id="searchInfo" class="alert alert-info d-none mb-3">
    Menampilkan <span id="resultCount">0</span> dari <span id="totalCount"><?= count($pegawai) ?></span> data
</div>

<!-- Tabel Data Pegawai -->
<table class="table" id="pegawaiTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Pegawai</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="tableBody">
        <?php $no = 1; ?>
        <?php foreach ($pegawai as $p): ?>
        <tr class="data-row">
            <td class="row-index"><?= $no++ ?></td>
            <td>
                <div class="d-flex align-items-center">
                    <!-- Foto Pegawai -->
                    <?php if ($p['foto_pegawai']): ?>
                        <img src="/uploads/pegawai/<?= $p['foto_pegawai'] ?>" 
                             alt="Foto Pegawai" 
                             width="40" 
                             height="40" 
                             class="rounded-circle mr-3">
                    <?php else: ?>
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mr-3" 
                             style="width: 40px; height: 40px;">
                            <small>No</small>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Nama dan Detail -->
                    <div>
                        <strong class="nama-pegawai"><?= esc($p['nama_pegawai']) ?></strong><br>
                        <small class="text-muted id-pegawai">ID: <?= $p['id_pegawai'] ?></small>
                    </div>
                </div>
            </td>
            <td class="tanggal-lahir"><?= date('d/m/Y', strtotime($p['tanggal_lahir'])) ?></td>
            <td>
                <span class="jenis-kelamin" data-gender="<?= $p['jenis_kelamin'] ?>">
                    <?php if($p['jenis_kelamin'] === 'laki-laki'): ?>
                        <small class="text-primary"><?= ucfirst($p['jenis_kelamin']) ?></small>
                    <?php else: ?>
                        <small class="text-muted"><?= ucfirst($p['jenis_kelamin']) ?></small>
                    <?php endif ?>
                </span>
            </td>
            <td>
                <a href="<?= base_url('admin/pegawai/edit/'.$p['id_pegawai']) ?>" 
                   class="btn btn-sm btn-outline-secondary">Edit</a>
                <a href="#" 
                   data-href="<?= base_url('admin/pegawai/delete/'.$p['id_pegawai']) ?>" 
                   onclick="confirmToDelete(this)" 
                   class="btn btn-sm btn-outline-danger">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal Konfirmasi Delete -->
<div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h2 class="h2">Are you sure?</h2>
                <p>The data will be deleted and lost forever</p>
            </div>
            <div class="modal-footer">
                <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Sertakan Bootstrap, jQuery, dan Font Awesome -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Script untuk modal konfirmasi delete -->
<script>
function confirmToDelete(el){
    $("#delete-button").attr("href", el.dataset.href);
    $("#confirm-dialog").modal('show');
}
</script>

<!-- Script untuk Pencarian dan Filter -->
<script>
$(document).ready(function() {
    const $rows = $('.data-row');
    const $searchInfo = $('#searchInfo');
    const $resultCount = $('#resultCount');
    const $totalCount = $('#totalCount');
    const $tableBody = $('#tableBody');
    
    // Set total count
    $totalCount.text($rows.length);
    
    function performSearch() {
        const searchTerm = $('#searchInput').val().toLowerCase();
        const genderFilter = $('#genderFilter').val();
        let visibleCount = 0;
        
        $rows.each(function(index) {
            const $row = $(this);
            let rowText = '';
            
            // Kumpulkan teks dari semua kolom kecuali action
            $row.find('td').not(':last').each(function() {
                rowText += $(this).text().toLowerCase() + ' ';
            });
            
            // Ambil nilai gender dari data attribute
            const rowGender = $row.find('.jenis-kelamin').data('gender');
            
            // Cek apakah baris sesuai dengan kriteria pencarian dan filter
            const matchesSearch = searchTerm === '' || rowText.includes(searchTerm);
            const matchesGender = genderFilter === '' || rowGender === genderFilter;
            
            if (matchesSearch && matchesGender) {
                $row.show();
                visibleCount++;
                // Update nomor urut
                $row.find('.row-index').text(visibleCount);
            } else {
                $row.hide();
            }
        });
        
        // Update informasi pencarian
        $resultCount.text(visibleCount);
        if (searchTerm !== '' || genderFilter !== '') {
            $searchInfo.removeClass('d-none');
        } else {
            $searchInfo.addClass('d-none');
        }
        
        // Tampilkan pesan jika tidak ada hasil
        if (visibleCount === 0) {
            if ($('#noResults').length === 0) {
                $tableBody.append(
                    '<tr id="noResults"><td colspan="5" class="text-center py-4">' +
                    '<i class="fas fa-search mr-2"></i>Tidak ada data yang sesuai dengan kriteria pencarian' +
                    '</td></tr>'
                );
            }
        } else {
            $('#noResults').remove();
        }
    }
    
    // Event listener untuk input pencarian
    $('#searchInput').on('keyup', function() {
        performSearch();
    });
    
    // Event listener untuk tombol clear
    $('#clearSearch').on('click', function() {
        $('#searchInput').val('');
        performSearch();
    });
    
    // Event listener untuk filter jenis kelamin
    $('#genderFilter').on('change', function() {
        performSearch();
    });
    
    // Inisialisasi tampilan
    performSearch();
});
</script>

<?= $this->endSection() ?>