<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }
        .cotainer1 {
            color: white;
            text-align: center;
        }
        .container2 {
            border-radius: 5px;
        }
        h2 {
            color: #333;
        }
        a {
            display: inline-block;
            margin-top: 5px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #0056b3;
        }

        main{
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            width: 90%;
            margin-bottom: 30px;
            padding: 20px;
        }
        #list_barang {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .container {
            display: flex;
        }
        button {
            width: 40%;
            padding: 10px;
            margin: 10px 1%;
            border: none;
            border-radius: 4px;
            background-color: #0056b3;
            color: white;
            cursor: pointer;
        }
        button[type="reset"] {
            background-color: white;
            color: #333;
            border: 1px solid #ccc;
        }
        button[name="hapus"] {
            background-color: red;
            color: white    ;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        </style>
    </head>

    <body>
        <header>
            <div class="container1">
                <h1>--Polgan Mart--</h1>
                <p>Sistem penjualan sederhana</p>
            </div>
            <div class="container2">
                <h2>Selamat datang, {{ session("username") }}</h2>
                <p>Role: {{ session("role") }}</p>
                <a href="{{ route('logout.index') }}">Logout</a>
            </div>
        </header>

        <main>
            <!-- input Kode Barang, nama barang, harga, jumlah -->
            <form action="{{ route("dashboard.barang.aksi") }}" method="post">
                @csrf
                <label for="list_barang">Kode Barang</label>
                <select name="list_barang" id="list_barang">
                    <option disabled selected>-- Pilih Kode Barang --</option>

                    @foreach ($list_barang as $kode => $item)
                    <option value="{{ $kode }}">
                         {{ $kode }} | {{ $item["nama"] }}
                    </option>
                    @endforeach

                </select>

                <label for="kode_barang">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" placeholder="Masukkan Kode Barang" required><br>
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" placeholder="Masukkan Kode Barang" required><br>
                <label for="harga_barang">Harga</label>
                <input type="number" name="harga_barang" id="harga_barang" placeholder="Masukkan Harga Barang" required><br>
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah" required><br>
                <div class="container">
                    <button type="submit" value="add" name="add"> Tambah </button>
                    <button type="reset" value="Batal">Batal</button>
                </div>
            </form>
            <h2>Daftar Barang</h2>
            <p>Menampilkan barang yang di input</p>
            <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Barang (Rp)</th>
                <th>Jumlah</th>
                <th>Total (Rp)</th>
                <th>Action</th>
            </tr>
            @php
                $data_barang = session("data_barang") ?? [];
                $grandtotal = 0;
            @endphp
            @foreach ($data_barang as $kode => $item)
                @php
                    // hitung total
                    $total_harga = $item["harga"] * $item["jumlah"];
                    $grandtotal += $total_harga;

                    // hitung diskon
                    if ($grandtotal == 0) {
                        $d = "0%";
                        $diskon = 0;
                    } elseif ($grandtotal < 50000) {
                        $d = "5%";
                        $diskon = 0.05 * $grandtotal;
                    } elseif ($grandtotal <= 100000) {
                        $d = "10%";
                        $diskon = 0.10 * $grandtotal;
                    } else {
                        $d = "15%";
                        $diskon = 0.15 * $grandtotal;
                    }
                    $totalbayar = $grandtotal - $diskon;

                @endphp
                <tr>
                    <td>{{ $kode }}</td>
                    <td>{{ $item["nama"] }}</td>
                    <td style='text-align:right;'>Rp {{ number_format($item["harga"],  0, ',', '.'); }}</td>
                    <td style='text-align:center;'>{{ $item["jumlah"] }}</td>
                    <td style='text-align:right;'>Rp {{ number_format($total_harga,  0, ',', '.'); }}</td>
                    <td style='text-align:center;'> <form method='post'><button type='submit' name='hapus' value="{{ $kode }}">Hapus</button></form> </td>
                </tr>
            @endforeach


            <!-- Total Belanja, Diskon, Total Bayar -->
            <tr>
                <td colspan="4" style="text-align:right; padding-right:20px"><strong>Total Belanja</strong></td>
                <td style="text-align:right;"><strong>Rp {{ number_format($grandtotal,  0, ',', '.'); }}</strong></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right; padding-right:20px"><strong>Diskon {{ $d }}</strong></td>
                <td style="text-align:right;"><strong>Rp {{ number_format($diskon,  0, ',', '.'); }}</strong></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right; padding-right:20px"><strong>Total Bayar</strong></td>
                <td style="text-align:right;"><strong>Rp {{ number_format($totalbayar,  0, ',', '.'); }}</strong></td>
            </tr>
            </table>
            <!-- Reset Keranjang -->
            <form action="dashboard.php" method="get" style="margin-top:20px;">
                <button type="submit" value="reset" name="reset">Reset Keranjang</button>
            </form>
        </main>
    </body>
   
    <script>
        const selectBarang =  document.getElementById("list_barang");
        const inputKodeBarang = document.getElementById("kode_barang");
        const inputNamaBarang = document.getElementById("nama_barang");
        const inputHargaBarang = document.getElementById("harga_barang");
        const inputJumlahBarang = document.getElementById("jumlah");

        let daftarBarang = @json($list_barang) ?? [];

        selectBarang.addEventListener("change", function(){
            inputKodeBarang.value = selectBarang.value;
            inputNamaBarang.value = daftarBarang[selectBarang.value]["nama"];
            inputHargaBarang.value = daftarBarang[selectBarang.value]["harga"];
            return
        });

    </script>

</html>