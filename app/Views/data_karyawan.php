<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="h3 mb-0">Data Pegawai</h3>
                            <p class="text-muted mb-0">Hanya dapat melihat data, tidak dapat mengubah</p>
                        </div>
                        
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
                </div>
                <div class="card-body">
                    <!-- Informasi Hasil Pencarian -->
                    <div id="searchInfo" class="alert alert-info d-none mb-3">
                        Menampilkan <span id="resultCount">0</span> dari <span id="totalCount"><?= count($pegawai) ?></span> data
                    </div>
                    
                    <?php if (empty($pegawai)): ?>
                        <div class="alert alert-info">
                            Tidak ada data pegawai yang tersedia.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="pegawaiTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama Pegawai</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php $no = 1; ?>
                                    <?php foreach ($pegawai as $p): ?>
                                    <tr class="data-row">
                                        <td class="row-index"><?= $no++ ?></td>
                                        <td>
                                            <?php if ($p['foto_pegawai']): ?>
                                                <img src="/uploads/pegawai/<?= $p['foto_pegawai'] ?>" 
                                                     alt="Foto <?= $p['nama_pegawai'] ?>" 
                                                     width="60" height="60" 
                                                     class="rounded-circle object-fit-cover">
                                            <?php else: ?>
                                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                                     style="width: 60px; height: 60px;">
                                                    No Photo
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="nama-pegawai"><?= esc($p['nama_pegawai']) ?></td>
                                        <td class="tanggal-lahir"><?= date('d/m/Y', strtotime($p['tanggal_lahir'])) ?></td>
                                        <td>
                                            <span class="jenis-kelamin badge" data-gender="<?= $p['jenis_kelamin'] ?>"
                                                  style="background: <?= $p['jenis_kelamin'] == 'laki-laki' ? '#0d6efd' : '#198754' ?>;">
                                                <?= ucfirst($p['jenis_kelamin']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sertakan jQuery dan Font Awesome -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
            
            // Kumpulkan teks dari semua kolom
            $row.find('td').each(function() {
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