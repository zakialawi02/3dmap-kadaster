<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/favicon.png" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">

    <link rel="stylesheet" href="/assets/css/style.css" />

    <style>
        p {
            font-weight: 400;
        }
    </style>

    <title>Table Information Layer</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/viewer_header.php' ?>

    <main>
        <div class="container">

            <div class="row justify-content-center  m-2 p-3">
                <div class="row gap-2">
                    <div id="siola-building" class="mb-3">
                        <h4>1. Bangunan Siola</h4>
                        <h5 class="bg-info m-0 p-2">A. Objek Fisik</h5>
                        <div class="overflow-auto">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="min-width: 150px;">Nama Objek Layer</th>
                                        <th scope="col" style="min-width: 150px;">Bagian</th>
                                        <th scope="col" style="min-width: 200px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Lantai 1</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Lantai 2</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Lantai 3</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Lantai 4</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Lantai 5</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>Tiang pancang atau pondasi bangunan</td>
                                        <td>Objek bawah tanah</td>
                                        <td>Tiang pancang atau pondasi bangunan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5 class="bg-info m-0 p-2">B. Objek Yuridis</h5>
                        <div class="overflow-auto">
                            <table id="table1" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="min-width: 100px;">Nama Layer</th>
                                        <th scope="col" style="min-width: 180px;">Nama Objek</th>
                                        <th scope="col" style="min-width: 100px;">Bagian</th>
                                        <th scope="col" style="min-width: 100px;">Grup</th>
                                        <th scope="col">Warna</th>
                                        <th scope="col" style="min-width: 200px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>L1.1</td>
                                        <td class="attachment" data-img="https://lh3.googleusercontent.com/p/AF1QipNSlTU0IycvvTxdMgxM0Vxi_IgG9vHA-Q-BViZn=s1360-w1360-h1020">Kriya Gallery</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00ea00;"></div>
                                        </td>
                                        <td>Pertokoan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>L1.2</td>
                                        <td class="attachment">Lorong</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #fafe04;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>L1.3</td>
                                        <td>Toliet Umum</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #fafe04;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>L1.4</td>
                                        <td>Tangga</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #fafe04;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>L1.5</td>
                                        <td>Lorong</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #fafe04;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>L1.6</td>
                                        <td class="attachment" data-img="https://tiketwisata.surabaya.go.id/storage/tour/museum-surabayagedung-siola_1666543455.jpg">Museum</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #0000eb;"></div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                        <td>L1.7</td>
                                        <td class="attachment" data-img="https://fastly.4sqi.net/img/general/600x600/14004519_0q-Kcse1w8XMunorOI4kadkNcSpNpBAz8BnzzcDTrnQ.jpg">UPTSA (Unit Pelayanan Terpadu Satu Atap)</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e7867e;"></div>
                                        </td>
                                        <td>Kantor pemerintah</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">8</th>
                                        <td>L1.8</td>
                                        <td>Emergency Staircase</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #fafe04;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">9</th>
                                        <td>L1.9</td>
                                        <td>ATM Center</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #fafe04;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">10</th>
                                        <td>L1.10</td>
                                        <td>Pantry Room</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #fafe04;"></div>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th scope="row">11</th>
                                        <td>L2.1</td>
                                        <td>Bridge 2nd floor</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e8d8df;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">12</th>
                                        <td>L2.2</td>
                                        <td>DISPERINDAG</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #9400a0;"></div>
                                        </td>
                                        <td>Kantar pemerintah</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">13</th>
                                        <td>L2.3</td>
                                        <td>2nd Floor Corridor</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #fafe04;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">14</th>
                                        <td>L2.4</td>
                                        <td>Command Center</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ba2526;"></div>
                                        </td>
                                        <td>Ruang ruangan empat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">15</th>
                                        <td>L2.5</td>
                                        <td>DISPARTA</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e4c200;"></div>
                                        </td>
                                        <td>Kantor pemerintah</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">16</th>
                                        <td>L2.6</td>
                                        <td>DISPENDUKCAPIL</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #949ea1;"></div>
                                        </td>
                                        <td>Kantor pemerintah</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">17</th>
                                        <td>L2.7</td>
                                        <td>Ramp</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:#fbff04;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">18</th>
                                        <td>L3.1</td>
                                        <td>Bridge 3rd floor</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e8d8df;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">19</th>
                                        <td>L3.2</td>
                                        <td>DISPORA</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #bfdde3;"></div>
                                        </td>
                                        <td>Kantor pemerintah</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">20</th>
                                        <td>L3.3</td>
                                        <td>3rd Floor Corridor</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:#f9fd06;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">21</th>
                                        <td>L3.4</td>
                                        <td>DPM</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #0000a6;"></div>
                                        </td>
                                        <td>Kantor pemerintah</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">22</th>
                                        <td>L3.5</td>
                                        <td>DISPENDUK</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #4c42b4;"></div>
                                        </td>
                                        <td>Kantor pemerintah</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">23</th>
                                        <td>L3.6</td>
                                        <td>Secretary Room</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #607964;"></div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">24</th>
                                        <td>L3.7</td>
                                        <td>DINKOP Kota Surabaya</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #607964;"></div>
                                        </td>
                                        <td>Kantor pemerintah</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">25</th>
                                        <td>L4.1</td>
                                        <td>Convention Hall 4th floor</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #c6514a;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">26</th>
                                        <td>L4.2</td>
                                        <td>Shared Space 4th floor</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffa500;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">27</th>
                                        <td>L4.3</td>
                                        <td>Dinas Perpustakaan Dan Kearsipan Kota Surabaya (Dispusip)</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #0000a6;"></div>
                                        </td>
                                        <td>Kantor pemerintah</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">28</th>
                                        <td>L5.1</td>
                                        <td>Parking</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(224, 161, 229);"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">29</th>
                                        <td>Ruang atas tanah</td>
                                        <td>Ruang atas tanah</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(255, 96, 244);"></div>
                                        </td>
                                        <td>Batas pemanfaatan ruang yang diperbolehkan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">30</th>
                                        <td>Ruang bawah tanah</td>
                                        <td>Ruang bawah tanah</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(0, 4, 255);"></div>
                                        </td>
                                        <td>Batas pemanfaatan ruang yang diperbolehkan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">31</th>
                                        <td>Garis Sempadan Bangunan</td>
                                        <td>Garis Sempadan Bangunan</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(255, 30, 30);"></div>
                                        </td>
                                        <td>Batas bangunan yang diperbolehkan untuk membangun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">32</th>
                                        <td>Parcel Siola</td>
                                        <td>Bidang tanah Siola</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(229, 255, 60);"></div>
                                        </td>
                                        <td>Batas bidang tanah</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">33</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 1</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">34</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 2</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">35</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum 1</td>
                                        <td>Tata bangunan Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">36</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum 2</td>
                                        <td>Tata bangunan Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">37</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 3</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">38</th>
                                        <td>Tata Bangunan Perumahan</td>
                                        <td>Tata bangunan zona perumahan</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(250, 250, 110);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">39</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 4</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">40</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 5</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">41</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum 3</td>
                                        <td>Tata bangunan zona Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">42</th>
                                        <td>Tata Bangunan Perkantoran 1</td>
                                        <td>Tata bangunan zona Perkantoran</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(198, 142, 255);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">43</th>
                                        <td>Tata Bangunan Perkantoran 2</td>
                                        <td>Tata bangunan zona Perkantoran</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(198, 142, 255);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">44</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 6</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">45</th>
                                        <td>Tata Bangunan Perkantoran 3</td>
                                        <td>Tata bangunan zona Perkantoran</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(198, 142, 255);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">46</th>
                                        <td>Tata Bangunan Perumahan 2</td>
                                        <td>Tata bangunan zona Perumahan</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(250, 250, 110);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">47</th>
                                        <td>Tata Bangunan Perumahan 3</td>
                                        <td>Tata bangunan zona Perumahan</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(250, 250, 110);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">48</th>
                                        <td>Tata Bangunan Perumahan 4</td>
                                        <td>Tata bangunan zona Perumahan</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(250, 250, 110);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">49</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum 4</td>
                                        <td>Tata bangunan zona Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">50</th>
                                        <td>Tata Bangunan Perumahan 5</td>
                                        <td>Tata bangunan zona Perumahan</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(250, 250, 110);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">51</th>
                                        <td>Tata Bangunan Perumahan 6</td>
                                        <td>Tata bangunan zona Perumahan</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(250, 250, 110);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">52</th>
                                        <td>Tata Bangunan Perkantoran 4</td>
                                        <td>Tata bangunan zona Perkantoran</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(198, 142, 255);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">53</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 7</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">54</th>
                                        <td>Tata Bangunan Perumahan 7</td>
                                        <td>Tata bangunan zona Perumahan</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(250, 250, 110);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">55</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum 4</td>
                                        <td>Tata bangunan zona Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">56</th>
                                        <td>Tata Bangunan Perkantoran 5</td>
                                        <td>Tata bangunan zona Perkantoran</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(198, 142, 255);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">57</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 8</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">59</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 8</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="balai-kota-building" class="mb-3">
                        <h4>2. Bangunan Balai Kota</h4>
                        <h5 class="bg-info m-0 p-2">A. Objek Fisik</h5>
                        <div class="overflow-auto">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="min-width: 150px;">Nama Objek Layer</th>
                                        <th scope="col" style="min-width: 150px;">Bagian</th>
                                        <th scope="col" style="min-width: 200px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Atap</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Lantai 1</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Basement</td>
                                        <td>Objek bawah tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Tiang pancang atau pondasi bangunan</td>
                                        <td>Objek bawah tanah</td>
                                        <td>Tiang pancang atau pondasi bangunan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5 class="bg-info m-0 p-2">B. Objek Yuridis</h5>
                        <div class="overflow-auto">
                            <table id="table2" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="min-width: 100px;">Nama Layer</th>
                                        <th scope="col" style="min-width: 180px;">Nama Objek</th>
                                        <th scope="col" style="min-width: 100px;">Bagian</th>
                                        <th scope="col" style="min-width: 100px;">Grup</th>
                                        <th scope="col">Warna</th>
                                        <th scope="col" style="min-width: 200px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>L1.1</td>
                                        <td>Tourism Information Center</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa6;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>L1.2</td>
                                        <td>PISA (Pusat Informasi Sahabat Anak)</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa6;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>L1.3</td>
                                        <td>public space</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e50000;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>L1.4</td>
                                        <td>Mathematics House</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e50000;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>L1.5</td>
                                        <td>Main Room</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e50000;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>L1.6</td>
                                        <td>Back Main Room</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e50000;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                        <td>L1.7</td>
                                        <td>UPT Balai Pemuda</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e50000;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">8</th>
                                        <td>L1.8</td>
                                        <td>Staff Office</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e50000;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">9</th>
                                        <td>L1.9</td>
                                        <td>Gudang</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e50000;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">10</th>
                                        <td>L1.10</td>
                                        <td>Bengkel Muda Surabaya</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e50000;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">11</th>
                                        <td>L1.11</td>
                                        <td>Hallway</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">12</th>
                                        <td>L1.12</td>
                                        <td>DKS Gallery</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">13</th>
                                        <td>L1.13</td>
                                        <td>Merah Putih Gallery</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">14</th>
                                        <td>L0.1</td>
                                        <td>Elevator</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 0 / Basement</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">15</th>
                                        <td>L0.2</td>
                                        <td>Hallway</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 0 / Basement</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">16</th>
                                        <td>L0.3</td>
                                        <td>Toilet</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 0 / Basement</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">17</th>
                                        <td>L0.4</td>
                                        <td>Operator Room</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 0 / Basement</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(250, 185, 211);"></div>
                                        </td>
                                        <td>Staff room</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">18</th>
                                        <td>L0.5</td>
                                        <td>Entrance Door</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 0 / Basement</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">20</th>
                                        <td>L0.7</td>
                                        <td>Below Space</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 0 / Basement</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">21</th>
                                        <td>L0.8</td>
                                        <td>Central doorway</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 0 / Basement</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">22</th>
                                        <td>L0.9</td>
                                        <td>Indoor Skateboard</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 0 / Basement</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00eaa7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">23</th>
                                        <td>Ruang atas tanah</td>
                                        <td>Ruang atas tanah</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(255, 96, 244);"></div>
                                        </td>
                                        <td>Batas pemanfaatan ruang yang diperbolehkan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">24</th>
                                        <td>Ruang bawah tanah</td>
                                        <td>Ruang bawah tanah</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(255, 96, 244);"></div>
                                        </td>
                                        <td>Batas pemanfaatan ruang yang diperbolehkan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">25</th>
                                        <td>Garis Sempadan Bangunan</td>
                                        <td>Garis Sempadan Bangunan</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(255, 30, 30);"></div>
                                        </td>
                                        <td>Batas bangunan yang diperbolehkan untuk membangun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">26</th>
                                        <td>Parcel Siola</td>
                                        <td>Bidang tanah Siola</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(229, 255, 60);"></div>
                                        </td>
                                        <td>Batas bidang tanah</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">27</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum 1</td>
                                        <td>Tata bangunan zona Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">28</th>
                                        <td>Tata Bangunan Perkantoran 1</td>
                                        <td>Tata bangunan zona Perkantoran</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(198, 142, 255);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">29</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum 2</td>
                                        <td>Tata bangunan zona Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">30</th>
                                        <td>Tata Bangunan Perkantoran 2</td>
                                        <td>Tata bangunan zona Perkantoran</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(198, 142, 255);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">31</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum 3</td>
                                        <td>Tata bangunan zona Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">32</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum 4</td>
                                        <td>Tata bangunan zona Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">33</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum 5</td>
                                        <td>Tata bangunan zona Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">34</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 1</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">35</th>
                                        <td>Tata Bangunan Bangunan Peruntukan Khusus</td>
                                        <td>Tata bangunan zona Bangunan Peruntukan Khusus</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(128, 128, 128);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">36</th>
                                        <td>Tata Bangunan Perkantoran 3</td>
                                        <td>Tata bangunan zona Perkantoran</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(198, 142, 255);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">37</th>
                                        <td>Tata Bangunan Perdagangan dan Jasa 2</td>
                                        <td>Tata bangunan zona perdagangan dan jasa</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(235, 120, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="rusun-building" class="mb-3">
                        <h4>3. Bangunan Rusun Buring 2 Malang</h4>
                        <h5 class="bg-info m-0 p-2">A. Objek Fisik</h5>
                        <div class="overflow-auto">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="min-width: 150px;">Nama Objek Layer</th>
                                        <th scope="col" style="min-width: 150px;">Bagian</th>
                                        <th scope="col" style="min-width: 200px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Lantai 1</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Lantai 2</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Lantai 3</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>Lantai 4</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Lantai 5</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>Atap</td>
                                        <td>Objek atas tanah</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                        <td>Tiang pancang atau pondasi bangunan</td>
                                        <td>Objek bawah tanah</td>
                                        <td>Tiang pancang atau pondasi bangunan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h5 class="bg-info m-0 p-2">B. Objek Yuridis</h5>
                        <div class="overflow-auto">
                            <table id="table3" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="min-width: 100px;">Nama Layer</th>
                                        <th scope="col" style="min-width: 180px;">Nama Objek</th>
                                        <th scope="col" style="min-width: 100px;">Bagian</th>
                                        <th scope="col" style="min-width: 100px;">Grup</th>
                                        <th scope="col">Warna</th>
                                        <th scope="col" style="min-width: 200px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>L1.1</td>
                                        <td>Area bersama</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #2300ea;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>L1.2</td>
                                        <td>Warehouse</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #949ea0;"></div>
                                        </td>
                                        <td>Area penyimpanan rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>L1.3</td>
                                        <td>Unit komersial / Stand penjualan</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #b92526;"></div>
                                        </td>
                                        <td>Unit komersial rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>L1.4</td>
                                        <td>Unit komersial / Stand penjualan</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #b92526;"></div>
                                        </td>
                                        <td>Unit komersial rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>L1.5</td>
                                        <td>Unit komersial / Stand penjualan</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #2300ea;"></div>
                                        </td>
                                        <td>Unit komersial rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>L1.6</td>
                                        <td>Office</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #fec9df;"></div>
                                        </td>
                                        <td>Kantor managemen rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                        <td>L1.7</td>
                                        <td>Toilet</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(84, 0, 0);"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">8</th>
                                        <td>L1.8</td>
                                        <td>Mushollah</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e49d5c;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">9</th>
                                        <td>L1.9</td>
                                        <td>Jantor</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #1d1d1d;"></div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">10</th>
                                        <td>L1.10</td>
                                        <td>Trash Bin</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #2300ea;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">11</th>
                                        <td>L1.11</td>
                                        <td>Parkir</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #e4e800;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">12</th>
                                        <td>L1.12</td>
                                        <td>Panel room</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #9300a0;"></div>
                                        </td>
                                        <td>Area private rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">13</th>
                                        <td>L1.13</td>
                                        <td>Ruang manager</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #b45c29;"></div>
                                        </td>
                                        <td>Kantor managemen rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">14</th>
                                        <td>L1.14</td>
                                        <td>Unit A.1.01</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #00e800;"></div>
                                        </td>
                                        <td>Unit rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">15</th>
                                        <td>L1.15</td>
                                        <td>Unit A.1.02</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #2300ea;"></div>
                                        </td>
                                        <td>Unit rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">16</th>
                                        <td>L1.16</td>
                                        <td>Unit A.1.03</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #2300ea;"></div>
                                        </td>
                                        <td>Unit rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">17</th>
                                        <td>L1.17</td>
                                        <td>Parking</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 1</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #2300ea;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">18</th>
                                        <td>L2.1</td>
                                        <td>Area bersama</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #2300ea;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">19</th>
                                        <td>L2.2</td>
                                        <td>Unit A.2.01</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">20</th>
                                        <td>L2.3</td>
                                        <td>Unit A.2.02</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">21</th>
                                        <td>L2.4</td>
                                        <td>Unit A.2.03</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">22</th>
                                        <td>L2.5</td>
                                        <td>Unit A.2.04</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">23</th>
                                        <td>L2.6</td>
                                        <td>Unit A.2.05</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">24</th>
                                        <td>L2.7</td>
                                        <td>Unit A.2.06</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">25</th>
                                        <td>L2.8</td>
                                        <td>Unit A.2.07</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">26</th>
                                        <td>L2.9</td>
                                        <td>Unit A.2.08</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">27</th>
                                        <td>L2.10</td>
                                        <td>Unit A.2.9</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">28</th>
                                        <td>L2.11</td>
                                        <td>Unit A.2.10</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">29</th>
                                        <td>L2.12</td>
                                        <td>Unit A.2.11</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">30</th>
                                        <td>L2.13</td>
                                        <td>Unit A.2.12</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">31</th>
                                        <td>L2.14</td>
                                        <td>Trash Bin</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">32</th>
                                        <td>L2.15</td>
                                        <td>Unit A.2.13</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">33</th>
                                        <td>L2.16</td>
                                        <td>Unit A.2.14</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">34</th>
                                        <td>L2.17</td>
                                        <td>Unit A.2.15</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">35</th>
                                        <td>L2.18</td>
                                        <td>Unit A.2.16</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">36</th>
                                        <td>L2.19</td>
                                        <td>Unit A.2.17</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">37</th>
                                        <td>L2.20</td>
                                        <td>Unit A.2.18</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">38</th>
                                        <td>L2.21</td>
                                        <td>Unit A.2.19</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">39</th>
                                        <td>L2.22</td>
                                        <td>Unit A.2.20</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">40</th>
                                        <td>L2.23</td>
                                        <td>Unit A.2.21</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">41</th>
                                        <td>L2.24</td>
                                        <td>Unit A.2.22</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">42</th>
                                        <td>L2.25</td>
                                        <td>Unit A.2.23</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">43</th>
                                        <td>L2.26</td>
                                        <td>Unit A.2.24</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 2</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ff2100;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">44</th>
                                        <td>L3.1</td>
                                        <td>Area bersama</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #2300ea;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">45</th>
                                        <td>L3.2</td>
                                        <td>Unit A.3.01</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">46</th>
                                        <td>L3.3</td>
                                        <td>Unit A.3.02</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">47</th>
                                        <td>L3.4</td>
                                        <td>Unit A.3.03</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">48</th>
                                        <td>L3.5</td>
                                        <td>Unit A.3.04</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">49</th>
                                        <td>L3.6</td>
                                        <td>Unit A.3.05</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">50</th>
                                        <td>L3.7</td>
                                        <td>Unit A.3.06</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">51</th>
                                        <td>L3.8</td>
                                        <td>Unit A.3.07</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">52</th>
                                        <td>L3.9</td>
                                        <td>Unit A.3.08</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">53</th>
                                        <td>L3.10</td>
                                        <td>Unit A.3.09</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">54</th>
                                        <td>L3.11</td>
                                        <td>Unit A.3.10</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">55</th>
                                        <td>L3.12</td>
                                        <td>Unit A.3.11</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">56</th>
                                        <td>L3.13</td>
                                        <td>Unit A.3.12</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">57</th>
                                        <td>L3.14</td>
                                        <td>Trash Bin</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">58</th>
                                        <td>L3.15</td>
                                        <td>Unit A.3.13</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">59</th>
                                        <td>L3.16</td>
                                        <td>Unit A.3.14</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">60</th>
                                        <td>L3.17</td>
                                        <td>Unit A.3.15</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">61</th>
                                        <td>L3.18</td>
                                        <td>Unit A.3.16</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">62</th>
                                        <td>L3.19</td>
                                        <td>Unit A.3.17</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">63</th>
                                        <td>L3.20</td>
                                        <td>Unit A.3.18</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">64</th>
                                        <td>L3.21</td>
                                        <td>Unit A.3.19</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">65</th>
                                        <td>L3.22</td>
                                        <td>Unit A.3.20</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">66</th>
                                        <td>L3.23</td>
                                        <td>Unit A.3.21</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">67</th>
                                        <td>L3.24</td>
                                        <td>Unit A.3.22</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">68</th>
                                        <td>L3.25</td>
                                        <td>Unit A.3.23</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">69</th>
                                        <td>L3.26</td>
                                        <td>Unit A.3.24</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 3</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #ffc700;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">70</th>
                                        <td>L4.1</td>
                                        <td>Area bersama</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #2300ea;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">71</th>
                                        <td>L4.2</td>
                                        <td>Unit A.4.01</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">72</th>
                                        <td>L4.3</td>
                                        <td>Unit A.4.02</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">73</th>
                                        <td>L4.4</td>
                                        <td>Unit A.4.03</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">74</th>
                                        <td>L4.5</td>
                                        <td>Unit A.4.04</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">75</th>
                                        <td>L4.6</td>
                                        <td>Unit A.4.05</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">76</th>
                                        <td>L4.7</td>
                                        <td>Unit A.4.06</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">77</th>
                                        <td>L4.8</td>
                                        <td>Unit A.4.07</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">78</th>
                                        <td>L4.9</td>
                                        <td>Unit A.4.08</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">79</th>
                                        <td>L4.10</td>
                                        <td>Unit A.4.09</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">80</th>
                                        <td>L4.11</td>
                                        <td>Unit A.4.10</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">81</th>
                                        <td>L4.12</td>
                                        <td>Unit A.4.11</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">82</th>
                                        <td>L4.13</td>
                                        <td>Unit A.4.12</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">83</th>
                                        <td>L4.14</td>
                                        <td>Trash Bin</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">84</th>
                                        <td>L4.15</td>
                                        <td>Unit A.4.13</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">85</th>
                                        <td>L4.16</td>
                                        <td>Unit A.4.14</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">86</th>
                                        <td>L4.17</td>
                                        <td>Unit A.4.15</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">87</th>
                                        <td>L4.18</td>
                                        <td>Unit A.4.16</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">88</th>
                                        <td>L4.19</td>
                                        <td>Unit A.4.17</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">89</th>
                                        <td>L4.20</td>
                                        <td>Unit A.4.18</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">90</th>
                                        <td>L4.21</td>
                                        <td>Unit A.4.19</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">91</th>
                                        <td>L4.22</td>
                                        <td>Unit A.4.20</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">92</th>
                                        <td>L4.23</td>
                                        <td>Unit A.4.21</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">93</th>
                                        <td>L4.24</td>
                                        <td>Unit A.4.22</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">94</th>
                                        <td>L4.25</td>
                                        <td>Unit A.4.23</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">95</th>
                                        <td>L4.26</td>
                                        <td>Unit A.4.24</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 4</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #80c1d7;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">96</th>
                                        <td>L5.1</td>
                                        <td>Area bersama</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #2300ea;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">97</th>
                                        <td>L5.2</td>
                                        <td>Unit A.5.01</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">98</th>
                                        <td>L5.3</td>
                                        <td>Unit A.5.02</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">99</th>
                                        <td>L5.4</td>
                                        <td>Unit A.5.03</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">100</th>
                                        <td>L5.5</td>
                                        <td>Unit A.5.04</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">101</th>
                                        <td>L5.6</td>
                                        <td>Unit A.5.05</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">102</th>
                                        <td>L5.7</td>
                                        <td>Unit A.5.06</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">103</th>
                                        <td>L5.8</td>
                                        <td>Unit A.5.07</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">104</th>
                                        <td>L5.9</td>
                                        <td>Unit A.5.08</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">105</th>
                                        <td>L5.10</td>
                                        <td>Unit A.5.09</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">106</th>
                                        <td>L5.11</td>
                                        <td>Unit A.5.10</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">107</th>
                                        <td>L5.12</td>
                                        <td>Unit A.5.11</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">108</th>
                                        <td>L5.13</td>
                                        <td>Unit A.5.12</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">109</th>
                                        <td>L5.14</td>
                                        <td>Trash Bin</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Benda bersama</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">110</th>
                                        <td>L5.15</td>
                                        <td>Unit A.5.13</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">111</th>
                                        <td>L5.16</td>
                                        <td>Unit A.5.14</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">112</th>
                                        <td>L5.17</td>
                                        <td>Unit A.5.15</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">113</th>
                                        <td>L5.18</td>
                                        <td>Unit A.5.16</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">114</th>
                                        <td>L5.19</td>
                                        <td>Unit A.5.17</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">115</th>
                                        <td>L5.20</td>
                                        <td>Unit A.5.18</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">116</th>
                                        <td>L5.21</td>
                                        <td>Unit A.5.19</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">117</th>
                                        <td>L5.22</td>
                                        <td>Unit A.5.20</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">118</th>
                                        <td>L5.23</td>
                                        <td>Unit A.5.21</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">119</th>
                                        <td>L5.24</td>
                                        <td>Unit A.5.22</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">120</th>
                                        <td>L5.25</td>
                                        <td>Unit A.5.23</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">121</th>
                                        <td>L5.26</td>
                                        <td>Unit A.5.24</td>
                                        <td>Unit Hak</td>
                                        <td>Lantai 5</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #34e90f;"></div>
                                        </td>
                                        <td>Unit Rusun</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">122</th>
                                        <td>Ruang atas tanah</td>
                                        <td>Ruang atas tanah</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #b2b2b2;"></div>
                                        </td>
                                        <td>Batas pemanfaatan ruang yang diperbolehkan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">123</th>
                                        <td>Ruang bawah tanah</td>
                                        <td>Ruang bawah tanah</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color: #b2b2b2;"></div>
                                        </td>
                                        <td>Batas pemanfaatan ruang yang diperbolehkan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">124</th>
                                        <td>Garis Sempadan Bangunan</td>
                                        <td>Garis Sempadan Bangunan</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(255, 30, 30);"></div>
                                        </td>
                                        <td>Batas bangunan yang diperbolehkan untuk membangun</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">125</th>
                                        <td>Parcel Siola</td>
                                        <td>Bidang tanah Siola</td>
                                        <td>Batas Ruang</td>
                                        <td></td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(229, 255, 60);"></div>
                                        </td>
                                        <td>Batas bidang tanah</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">126</th>
                                        <td>Tata Bangunan Ruang Terbuka Hijau</td>
                                        <td>Tata bangunan zona Ruang Terbuka Hijau</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(150, 220, 80);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">127</th>
                                        <td>Tata Bangunan Sarana Pelayanan Umum</td>
                                        <td>Tata bangunan zona Sarana Pelayanan Umum</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(220, 160, 120);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">128</th>
                                        <td>Tata Bangunan Perumahan</td>
                                        <td>Tata bangunan zona Perumahan</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(250, 250, 110);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">129</th>
                                        <td>Tata Bangunan Ruang Terbuka Hijau</td>
                                        <td>Tata bangunan zona Ruang Terbuka Hijau</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(150, 220, 80);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">130</th>
                                        <td>Tata Bangunan Perkantoran</td>
                                        <td>Tata bangunan zona Perkantoran</td>
                                        <td>Batas Ruang</td>
                                        <td>Tata bangunan</td>
                                        <td>
                                            <div style="width: 20px; height: 20px; background-color:rgb(198, 142, 255);"></div>
                                        </td>
                                        <td>Peraturan tata bangunan (RDTR) serta peraturan ketingan maksimum bangunan secara visual sekitar objek bangunan</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <!-- place footer here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>

    <script src="/assets/js/script.js"></script>

    <script>
        new DataTable('#table1', {
            "pageLength": 25
        });
        new DataTable('#table2', {
            "pageLength": 25
        });
        new DataTable('#table3', {
            "pageLength": 25
        });
    </script>

    <script>
        $(document).ready(function() {
            // Select all elements with class 'attachment'
            const attachments = document.querySelectorAll('.attachment');

            // Loop through the elements and apply styles if 'data-img' attribute exists
            attachments.forEach((attachment) => {
                if (attachment.hasAttribute('data-img')) {
                    attachment.style.color = '#2565fa'; // Set text color to blue
                    attachment.style.cursor = 'pointer'; // Set cursor to pointer
                }
            });

            // Handle click event for elements with class 'attachment'
            $(".attachment").click(function(e) {
                e.preventDefault();
                const imgUrl = $(this).data('img');

                if (imgUrl) {
                    // Create a modal dynamically
                    const modal = `
                <div id="imageModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8); display: flex; justify-content: center; align-items: center; z-index: 1000;">
                    <div style="position: relative;">
                        <img src="${imgUrl}" alt="Image" style="max-width: 90vw; max-height: 90vh; border: 5px solid white; border-radius: 5px;">
                        <button id="closeModal" style="position: absolute; top: -10px; right: -10px; background-color: red; color: white; border: none; border-radius: 50%; width: 30px; height: 30px; font-size: 18px; cursor: pointer;">&times;</button>
                    </div>
                </div>`;

                    // Append the modal to the body
                    $("body").append(modal);

                    // Add click event to close the modal
                    $("#closeModal").click(function() {
                        $("#imageModal").remove();
                    });

                    // Close the modal when clicking outside the image
                    $("#imageModal").click(function(event) {
                        if ($(event.target).is("#imageModal")) {
                            $("#imageModal").remove();
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>