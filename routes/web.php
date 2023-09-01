<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->type == 'user' || Auth::user()->type == 'store')
        return Redirect::to('/home');
        else {
            return Redirect::to('/adminHome');
        }
    } else {
        return Redirect::to('/login');
    }
});

Auth::routes();

Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('adminHome', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('adminHome'); // Permission
    Route::resource('permissions', App\Http\Controllers\Admin\PermissionController::class); // Permission
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class); // Role
    Route::resource('users', App\Http\Controllers\Admin\UserController::class); // Data Anggota
    Route::post('users/storeTopup', [App\Http\Controllers\Admin\UserController::class, 'storeTopup'])->name('users.storeTopup'); // Data Anggota
    Route::resource('merchants', App\Http\Controllers\Admin\MerchantController::class); // Data Anggota
    Route::resource('user-admins', App\Http\Controllers\Admin\UserAdminController::class); // Data Pengurus
    Route::resource('account-types', App\Http\Controllers\Admin\AccountTypeController::class); // Data Jenis Akun
    Route::resource('cash-types', App\Http\Controllers\Admin\CashTypeController::class); // Data Jenis Kas
    Route::resource('installment-types', App\Http\Controllers\Admin\InstallmentTypeController::class); // Data Tenor Jenis Angsuran
    Route::resource('saving-types', App\Http\Controllers\Admin\SavingTypeController::class); // Data Jenis Simpanan
    Route::resource('profit-sharings', App\Http\Controllers\Admin\ProfitSharingController::class); // Data Pembagian SHU
    Route::resource('kop-products', App\Http\Controllers\Admin\KopProductController::class); // Data Barang Koperasi
    Route::resource('submissions', App\Http\Controllers\Admin\SubmissionController::class); // Data Pengajuan
    Route::resource('loans', App\Http\Controllers\Admin\LoanController::class); // Data Pinjaman
    Route::resource('loan-payments', App\Http\Controllers\Admin\LoanPaymentController::class); // Data Angsuran
    Route::resource('loan-paids', App\Http\Controllers\Admin\LoanPaidController::class); // Data Pinjaman Lunas
    Route::resource('loan-details', App\Http\Controllers\Admin\LoanDetailController::class); // Data Angsuran
    Route::resource('cash-ins', App\Http\Controllers\Admin\CashInController::class); // Data Pemasukan Kas
    Route::resource('cash-outs', App\Http\Controllers\Admin\CashOutController::class); // data Pengeluaran Kas
    Route::resource('cash-transfers', App\Http\Controllers\Admin\CashTransferController::class); // Data Transfer Kas
    Route::resource('deposits', App\Http\Controllers\Admin\DepositController::class); // Data Setoran Simpanan
    Route::resource('withdrawals', App\Http\Controllers\Admin\WithdrawController::class); // Data Penarikan Simpanan
    Route::resource('merchant-transactions', App\Http\Controllers\Admin\MerchantTransactionController::class); // Data Penarikan Simpanan
    Route::resource('user-topups', App\Http\Controllers\Admin\TopupController::class); // Data Topup Cash / Transfer
    Route::resource('jimpay-vouchers', App\Http\Controllers\Admin\JimpayVoucherController::class);  // Data Voucher JIMPay
    
    // Laporan - laporan
    Route::get('user-transactions', [App\Http\Controllers\Admin\UserTransactionController::class, 'index'])->name('user-transactions.index');
    Route::get('user-transactions/cetak_pdf', [App\Http\Controllers\Admin\UserTransactionController::class, 'cetak_pdf'])->name('user-transactions.cetak_pdf');
    Route::get('user-saving-transactions', [App\Http\Controllers\Admin\UserSavingTransactionController::class, 'index'])->name('user-saving-transactions.index');
    Route::get('jimpay-transactions', [App\Http\Controllers\Admin\JimpayTransactionController::class, 'index'])->name('jimpay-transactions.index');
    Route::get('balance-sheet-reports', [App\Http\Controllers\Admin\BalanceSheetReportController::class, 'index']);
    Route::get('balance-sheet-reports/filter', [App\Http\Controllers\Admin\BalanceSheetReportController::class, 'filter'])->name('balance-sheet-reports.filter');
    Route::get('balance-sheet-reports/cetak_pdf', [App\Http\Controllers\Admin\BalanceSheetReportController::class, 'cetak_pdf'])->name('balance-sheet-reports.cetak_pdf');
    Route::get('income-statement-reports', [App\Http\Controllers\Admin\IncomeStatementReportController::class, 'index']);
    Route::get('income-statement-reports/filter', [App\Http\Controllers\Admin\IncomeStatementReportController::class, 'filter'])->name('income-statement-reports.filter');
    Route::resource('deviden-reports', App\Http\Controllers\Admin\DevidenReportController::class);
    Route::resource('cash-transaction-reports', App\Http\Controllers\Admin\CashTransactionReportController::class);
    Route::resource('saving-cash-reports', App\Http\Controllers\Admin\SavingCashReportController::class);
    Route::get('sharing-prosentase', [App\Http\Controllers\Admin\SharingProsentaseController::class, 'index'])->name('sharing-prosentase.index');
    Route::get('sharing-prosentase/filter', [App\Http\Controllers\Admin\SharingProsentaseController::class, 'filter'])->name('sharing-prosentase.filter');

    // Export Import
    Route::get('export-penarikan-simpanan', [App\Http\Controllers\Admin\ExportImportController::class, 'exportPenarikanSimpanan'])->name('export-penarikan-simpanan');
    Route::post('deposits/import-penarikan-simpanan', [App\Http\Controllers\Admin\ExportImportController::class, 'penarikanImport'])->name('import-penarikan-simpanan');
    Route::get('download-sample-setoran-wajib', [App\Http\Controllers\Admin\ExportImportController::class, 'downloadFileSetoranWajib'])->name('download-sample-setoran-wajib');
    Route::get('download-sample-setoran-sukarela', [App\Http\Controllers\Admin\ExportImportController::class, 'downloadFileSetoranSukarela'])->name('download-sample-setoran-sukarela');
    Route::get('export-setoran-simpanan', [App\Http\Controllers\Admin\ExportImportController::class, 'exportSetoranSimpanan'])->name('export-setoran-simpanan');
    Route::post('deposits/import-setoran-simpanan', [App\Http\Controllers\Admin\ExportImportController::class, 'setoranImport'])->name('import-setoran-simpanan');
    Route::get('export-anggota', [App\Http\Controllers\Admin\ExportImportController::class, 'exportAnggota'])->name('export-anggota');
    Route::post('cash-ins/import-pemasukan-kas', [App\Http\Controllers\Admin\ExportImportController::class, 'pemasukanKasImport'])->name('import-pemasukan-kas');
    Route::get('download-sample-pemasukan-kas', [App\Http\Controllers\Admin\ExportImportController::class, 'downloadFilePemasukanKas'])->name('download-sample-pemasukan-kas');
    Route::get('export-kas-masuk', [App\Http\Controllers\Admin\ExportImportController::class, 'exportKasMasuk'])->name('export-kas-masuk');
    Route::post('cash-outs/import-pengeluaran-kas', [App\Http\Controllers\Admin\ExportImportController::class, 'pengeluaranKasImport'])->name('import-pengeluaran-kas');
    Route::get('export-kas-keluar', [App\Http\Controllers\Admin\ExportImportController::class, 'exportKasKeluar'])->name('export-kas-keluar');
    Route::get('download-sample-pengeluaran-kas', [App\Http\Controllers\Admin\ExportImportController::class, 'downloadFilePengeluaranKas'])->name('download-sample-pengeluaran-kas');
    Route::get('export-kas-transfer', [App\Http\Controllers\Admin\ExportImportController::class, 'exportKasTransfer'])->name('export-kas-transfer');
    Route::post('cash-transfers/import-transfer-kas', [App\Http\Controllers\Admin\ExportImportController::class, 'transferKasImport'])->name('import-transfer-kas');
    Route::get('download-sample-transfer-kas', [App\Http\Controllers\Admin\ExportImportController::class, 'downloadFileTransferKas'])->name('download-sample-transfer-kas');

    Route::get('log-activity', [App\Http\Controllers\Admin\LogActivityController::class, 'index'])->name('activities.index');
    Route::get('iframe', [App\Http\Controllers\Admin\IframeController::class, 'index'])->name('iframe.index');
});

/*---- All User Routes List----*/
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Bayar
    Route::get('bayar', [App\Http\Controllers\User\BayarController::class, 'index'])->name('user.bayar.index');
    Route::get('bayar/cari', [App\Http\Controllers\User\BayarController::class, 'cari'])->name('user.bayar.cari');
    Route::post('bayar/store', [App\Http\Controllers\User\BayarController::class, 'store'])->name('user.bayar.store');
    Route::get('bayar/sukses', [App\Http\Controllers\User\BayarController::class, 'sukses'])->name('user.bayar.sukses');

    // Transfer Saldo ke anggota lain
    Route::get('transfer', [App\Http\Controllers\User\TransferController::class, 'index'])->name('user.transfer.index');
    Route::get('transfer/manual', [App\Http\Controllers\User\TransferController::class, 'manualTransfer'])->name('user.transfer.manual');
    Route::get('cari-anggota', [App\Http\Controllers\User\TransferController::class, 'fetch'])->name('user.transfer.fetch');
    Route::post('transfer/simpanManualTransfer', [App\Http\Controllers\User\TransferController::class, 'simpanManualTransfer'])->name('user.transfer.simpanManualTransfer');
    Route::get('transfer/scantransfer', [App\Http\Controllers\User\TransferController::class, 'scantransfer'])->name('user.transfer.scantransfer');
    Route::get('transfer/cari', [App\Http\Controllers\User\TransferController::class, 'cari'])->name('user.transfer.cari');
    Route::post('transfer/kirimSaldo', [App\Http\Controllers\User\TransferController::class, 'kirimSaldo'])->name('user.transfer.kirimSaldo');

    // Topup Saldo
    Route::get('topup', [App\Http\Controllers\User\TopupController::class, 'index'])->name('user.topup.index');
    Route::get('topup/cash', [App\Http\Controllers\User\TopUpController::class, 'topUpCash'])->name('user.topup.cash');
    Route::post('topup/store', [App\Http\Controllers\User\TopUpController::class, 'store'])->name('user.topup.store');
    Route::get('topup/konfirmasi', [App\Http\Controllers\User\TopUpController::class, 'konfirmasi'])->name('user.topup.konfirmasi');
    //  Route::get('topup/sukarela', [App\Http\Controllers\User\TopUpController::class, 'topUpSukarela'])->name('user.topup.sukarela');
    // Route::post('topup/storeSukarela', [TopUpController::class, 'storeSukarela'])->name('user.topup.storeSukarela');

    // Simpanan Wajib
    Route::get('simpanan-wajib', [App\Http\Controllers\User\SimWajibController::class, 'index'])->name('user.sim-wajib.index');

    // Simpanan Sukarela
    Route::get('simpanan-sukarela', [App\Http\Controllers\User\SimSukarelaController::class, 'index'])->name('user.sim-sukarela.index');
    Route::get('simpanan-sukarela/{id}/detail', [App\Http\Controllers\User\SimSukarelaController::class, 'show'])->name('user.sim-sukarela.show');
    Route::get('simpanan-sukarela/pencairan', [SimSukarelaController::class, 'tarik'])->name('user.sim-sukarela.tarik');
    // Route::post('simpanan-sukarela/pencairan', [App\Http\Controllers\User\SimSukarelaController::class, 'tarikStore'])->name('user.sim-sukarela.tarikStore');

     // Pembiayaan
     Route::get('pembiayaan', [\App\Http\Controllers\User\PembiayaanController::class, 'index'])->name('user.pembiayaan.index');
     Route::get('pembiayaan/{id}/show', [\App\Http\Controllers\User\PembiayaanController::class, 'show'])->name('user.pembiayaan.show');

    // Riwayat Transaksi
    Route::get('riwayat-transaksi', [App\Http\Controllers\User\RiwayatTransaksiController::class, 'index'])->name('user.riwayat-transaksi.index');

    // Profil
    Route::get('profil', [App\Http\Controllers\User\ProfilController::class, 'index'])->name('user.profil.index');
    Route::get('edit-profil', [App\Http\Controllers\User\ProfilController::class, 'editProfil'])->name('user.profil.detail');
    Route::put('edit-profil/update', [App\Http\Controllers\User\ProfilController::class, 'update'])->name('user.profil.update');
    Route::get('update-password', [App\Http\Controllers\User\ProfilController::class, 'updatePassword'])->name('user.profil.update-password');
    Route::post('update-password', [App\Http\Controllers\User\ProfilController::class, 'changePasswordSave'])->name('user.profil.changePasswordSave');
});
