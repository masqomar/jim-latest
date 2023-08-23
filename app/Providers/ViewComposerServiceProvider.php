<?php

namespace App\Providers;

use App\Models\CashType;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

		View::composer(['cash-transactions.create', 'cash-transactions.edit'], function ($view) {
            return $view->with(
                'cashTypes',
                \App\Models\CashType::select('id', 'nama')->get()
            );
        });

		View::composer(['cash-transactions.create', 'cash-transactions.edit'], function ($view) {
            return $view->with(
                'accountTypes',
                \App\Models\AccountType::select('id', 'kd_aktiva')->get()
            );
        });

				View::composer(['submissions.create', 'submissions.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'first_name')->get()
            );
        });

		

		View::composer(['loan-details.create', 'loan-details.edit'], function ($view) {
            return $view->with(
                'loans',
                \App\Models\Loan::select('id', 'tgl_pinjam')->get()
            );
        });

		View::composer(['loan-details.create', 'loan-details.edit'], function ($view) {
            return $view->with(
                'cashTypes',
                \App\Models\CashType::select('id', 'nama')->get()
            );
        });

		View::composer(['loan-details.create', 'loan-details.edit'], function ($view) {
            return $view->with(
                'accountTypes',
                \App\Models\AccountType::select('id', 'kd_aktiva')->get()
            );
        });

		View::composer(['saving-transactions.create', 'saving-transactions.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'first_name')->get()
            );
        });

		View::composer(['saving-transactions.create', 'saving-transactions.edit'], function ($view) {
            return $view->with(
                'savingTypes',
                \App\Models\SavingType::select('id', 'jns_simpan')->get()
            );
        });

		View::composer(['saving-transactions.create', 'saving-transactions.edit'], function ($view) {
            return $view->with(
                'cashTypes',
                \App\Models\CashType::select('id', 'nama')->get()
            );
        });

        View::composer(['cash-ins.create', 'cash-ins.edit'], function ($view) {
            return $view->with(
                'cashTypes',
                \App\Models\CashType::select('id', 'nama')->where('tmpl_pemasukan', 'Y')->where('aktif', 'Y')->get()
            );
        });

		View::composer(['cash-ins.create', 'cash-ins.edit'], function ($view) {
            return $view->with(
                'accountTypes',
                \App\Models\AccountType::select('id', 'kd_aktiva', 'jns_trans')->where('pemasukan', 'Y')->where('aktif', 'Y')->get()
            );
        });

        View::composer(['cash-outs.create', 'cash-outs.edit'], function ($view) {
            return $view->with(
                'cashTypes',
                \App\Models\CashType::select('id', 'nama')->where('tmpl_pengeluaran', 'Y')->where('aktif', 'Y')->get()
            );
        });

		View::composer(['cash-outs.create', 'cash-outs.edit'], function ($view) {
            return $view->with(
                'accountTypes',
                \App\Models\AccountType::select('id', 'kd_aktiva', 'jns_trans')->where('pengeluaran', 'Y')->where('aktif', 'Y')->get()
            );
        });

        View::composer(['cash-transfers.create', 'cash-transfers.edit'], function ($view) {
            return $view->with(
                'cashTypes',
                \App\Models\CashType::select('id', 'nama')->where('tmpl_transfer', 'Y')->where('aktif', 'Y')->get()
            );
        });

        View::composer(['deposits.create', 'deposits.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'first_name', 'member_id')->where('status', 1)->get()
            );
        });

		View::composer(['deposits.create', 'deposits.edit'], function ($view) {
            return $view->with(
                'savingTypes',
                \App\Models\SavingType::select('id', 'jns_simpan')->where('tampil', 'Y')->get()
            );
        });

		View::composer(['deposits.create', 'deposits.edit'], function ($view) {
            return $view->with(
                'cashTypes',
                \App\Models\CashType::select('id', 'nama')->where('tmpl_simpan', 'Y')->where('aktif', 'Y')->get()
            );
        });

        View::composer(['withdrawals.create', 'withdrawals.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'first_name', 'member_id')->where('status', 1)->get()
            );
        });

        View::composer(['withdrawals.create', 'withdrawals.edit'], function ($view) {
            return $view->with(
                'savingTypes',
                \App\Models\SavingType::select('id', 'jns_simpan')->where('tampil', 'Y')->get()
            );
        });

		View::composer(['withdrawals.create', 'withdrawals.edit'], function ($view) {
            return $view->with(
                'cashTypes',
                \App\Models\CashType::select('id', 'nama')->where('tmpl_penarikan', 'Y')->where('aktif', 'Y')->get()
            );
        });

        View::composer(['loans.create', 'loans.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'first_name', 'member_id')->where('status', 1)->get()
            );
        });

		View::composer(['loans.create', 'loans.edit'], function ($view) {
            return $view->with(
                'kopProducts',
                \App\Models\KopProduct::select('id', 'nm_barang', 'harga')->where('type', 'Uang')->orWhere('jml_brg', '>', 0)->get()
            );
        });

		View::composer(['loans.create', 'loans.edit'], function ($view) {
            return $view->with(
                'installmentTypes',
                \App\Models\InstallmentType::select('id', 'ket')->where('aktif', 'Y')->get()
            );
        });

		View::composer(['loans.create', 'loans.edit'], function ($view) {
            return $view->with(
                'cashTypes',
                \App\Models\CashType::select('id', 'nama')->where('tmpl_pinjaman', 'Y')->where('aktif', 'Y')->get()
            );
        });

        View::composer(['user-topups.create'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'first_name', 'member_id')->where('status', 1)->get()
            );
        });

        View::composer(['jimpay-vouchers.create'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'first_name', 'member_id')->where('type', 'user')->where('status', 1)->get()
            );
        });

        View::composer(['users.create', 'users.edit'], function ($view) {
            return $view->with(
                'roles',
                Role::select('id', 'name')->get()
            );
        });

        View::composer(['merchants.create', 'merchants.edit'], function ($view) {
            return $view->with(
                'roles',
                Role::select('id', 'name')->get()
            );
        });

        View::composer(['user-admins.create', 'user-admins.edit'], function ($view) {
            return $view->with(
                'roles',
                Role::select('id', 'name')->get()
            );
        });

        View::composer(['merchant-transactions.create'], function ($view) {
            return $view->with(
                'users',
                User::select('id', 'first_name', 'member_id')->where('type', 'store')->get()
            );
        });

        View::composer(['merchant-transactions.create'], function ($view) {
            return $view->with(
                'cashTypes',
                CashType::select('id', 'nama')->where('aktif', 'Y')->where('tmpl_bayar', 'Y')->get()
            );
        });
	}
}