@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="jimApp">
    <div class="section" id="user-section">
        <div id="user-detail">
            <a href="{{ route('user.profil.index') }}">
                <div class="avatar">
                    @if (auth()->user()->avatar == null)
                    <img src="{{ asset ('assets') }}/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                    @else
                    <img src="{{ asset('uploads/images/avatars/' . auth()->user()->avatar) }}" alt="Avatar" style="border-radius: 30px; width: 70px; height: 70px;">
                    @endif
                </div>
            </a>
            <div id="user-info">

                <h2 id="user-name">{{ Auth::user()->first_name }} || {{ Auth::user()->member_id }}</h2>
                <span id="user-role">@rupiah ($saldo)</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ route('user.bayar.index') }}" class="green" style="font-size: 40px;">
                            <i class="fas fa-qrcode"></i>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Scan</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ route('user.topup.index') }}" class="danger" style="font-size: 40px;">
                            <i class="far fa-plus-square"></i>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Topup</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ route('user.transfer.index') }}" class="warning" style="font-size: 40px;">
                            <i class="far fa-plus-square"></i>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Transfer</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="{{ route('user.riwayat-transaksi.index') }}" class="orange" style="font-size: 40px;">
                            <i class="fas fa-history"></i>
                            </a>
                        </div>
                        <div class="menu-name">
                            Riwayat
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section mt-2" id="jimApp-section">
        <div class="todayjimApp">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">

                            <div class="list-menu">
                                <div class="item-menu text-center">
                                    <div class="menu-icon">
                                        <a href="{{ route('user.sim-wajib.index') }}" class="green" style="font-size: 40px;">
                                            <ion-icon name="bookmark-outline"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="menu-name">
                                        <span class="text-center">Simp Wajib</span>
                                    </div>
                                </div>
                                <div class="item-menu text-center">
                                    <div class="menu-icon">
                                        <a href="{{ route('user.sim-sukarela.index') }}" class="danger" style="font-size: 40px;">
                                            <ion-icon name="wallet-outline"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="menu-name">
                                        <span class="text-center">Simp Sukarela</span>
                                    </div>
                                </div>
                                <div class="item-menu text-center">
                                    <div class="menu-icon">
                                        <a href="" class="green" style="font-size: 40px;">
                                            <ion-icon name="save-outline"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="menu-name">
                                        <span class="text-center">Tabungan</span>
                                    </div>
                                </div>
                            </div>

                            <div class="list-menu">
                                <div class="item-menu text-center">
                                    <div class="menu-icon">
                                        <a href="" class="danger" style="font-size: 40px;">
                                            <ion-icon name="card-outline"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="menu-name">
                                        <span class="text-center">Paylater</span>
                                    </div>
                                </div>
                                <div class="item-menu text-center">
                                    <div class="menu-icon">
                                        <a href="" class="warning" style="font-size: 40px;">
                                            <ion-icon name="cash-outline"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="menu-name">
                                        <span class="text-center">Pembiayaan</span>
                                    </div>
                                </div>
                                <div class="item-menu text-center">
                                    <div class="menu-icon">
                                        <a href="" class="warning" style="font-size: 40px;">
                                            <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                                        </a>
                                    </div>
                                    <div class="menu-name">
                                        <span class="text-center">Semua</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rekapjimApp">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="jimAppcontent">
                                <div class="iconjimApp">
                                    <ion-icon name="arrow-down-circle"></ion-icon>
                                </div>
                                <div class="jimAppdetail">
                                    <h4 class="jimApptitle">Total Masuk</h4>
                                    <span>@rupiah ($totalHistoryIn)</span>
                                </div>
                            </div>
                        </div>
                        <!-- <a href="#" class="text-center" style="font-size: 25px;">
                                <div class="action-button">
                                    Show All
                                </div>
                            </a> -->
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="jimAppcontent">
                                <div class="iconjimApp">
                                    <ion-icon name="arrow-up-circle"></ion-icon>
                                </div>
                                <div class="jimAppdetail">
                                    <h4 class="jimApptitle">Total Keluar</h4>
                                    <span>@rupiah ($totalHistoryOut)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="jimApptab mt-1">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#history" role="tab">
                            Riwayat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#shu" role="tab">
                            SHU
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-1" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="history" role="tabpanel">
                    <ul class="listview image-listview">
                        @forelse ($histories as $history)
                        <li>
                            <div class="item">
                                @if ($history->type == 'deposit')
                                <div class="icon-box bg-primary">
                                    <ion-icon name="arrow-down"></ion-icon>
                                </div>
                                @else
                                <div class="icon-box bg-danger">
                                    <ion-icon name="arrow-up"></ion-icon>
                                </div>
                                @endif
                                <div class="in">
                                    @php
                                    $meta = json_decode($history['meta'], true);
                                    @endphp
                                    @if ($meta)
                                    <div>{{ $meta['description'] ?? 'Tidak Ada Keterangan'}}</div>
                                    @endif
                                    @if ($history->type == 'deposit')
                                    <span class="badge badge-primary">@rupiah ($history->amount)</span>
                                    @else
                                    <span class="badge badge-danger">@rupiah ($history->amount)</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @empty
                        <li>
                            <div class="item">
                                <div class="in">
                                    <div>belum ada transaksi masuk</div>
                                </div>
                            </div>
                        </li>
                        @endforelse
                    </ul>
                </div>

                <div class="tab-pane fade" id="shu" role="tabpanel">
                    <ul class="listview image-listview">
                        <li>
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h4 class="text-center">Total SHU (Belum)</h4>
                                    <table class="table table-striped">
                                        <tr>
                                            <th scope="col">Total Modal <sup><a href="#" data-toggle="tooltip" title="SHU PERMODALAN ANGGOTA Merupakan SHU yang diterima oleh anggota atas laba sebesar sd % yang di hasilkan dari aktivitas usaha dari koperasi JIM">?</a></sup> </th>
                                            <td>
                                                <h4 class="text-warning" style="text-align: right;"> sd</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">Total Aktifitas <sup><a href="#" data-toggle="tooltip" title="SHU AKTIFITAS ANGGOTA Merupakan SHU yang diterima dari laba sebesar sd % atas aktifitas transaksi yang dilakukan oleh anggota untuk mendukung usaha dari koperasi JIM">?</a></sup></th>
                                            <td>
                                                <h4 class="text-warning" style="text-align: right;"> sd</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">SHU Diterima <sup><a href="#" data-toggle="tooltip" title="Ini adalah total SHU yang diterimakan">?</a></sup></th>
                                            <td>
                                                <h4 class="text-warning" style="text-align: right;"><a href="#">Cairkan</a> dssd </h4>

                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">SHU Berjalan <sup><a href="#" data-toggle="tooltip" title="Ini adalah perkiraan total SHU yang akan diterimakan">?</a></sup></th>
                                            <td>
                                                <h4 class="text-warning" style="text-align: right;"> dssd</h4>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection