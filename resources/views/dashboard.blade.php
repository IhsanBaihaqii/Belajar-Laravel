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
        input[type="submit"], input[type="reset"] {
            width: 40%;
            padding: 10px;
            margin: 10px 1%;
            border: none;
            border-radius: 4px;
            background-color: #0056b3;
            color: white;
            cursor: pointer;
        }
        input[type="reset"] {
            background-color: white;
            color: #333;
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
            <form action="" method="post">

                <label for="list_barang">Kode Barang</label>
                <select name="list_barang" id="list_barang">
                    <option disabled selected>-- Pilih Kode Barang --</option>
                    <option value="kode">
                         Kode | Nama barang
                    </option>
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
                    <input type="submit" value="Tambahkan" name="tambah_barang">
                    <input type="reset" value="Batal">
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
            <tr>
                <td>kode_barang</td>
                <td>nama_barang</td>
                <td style='text-align:right;'>harga</td>
                <td style='text-align:center;'>jumlah</td>
                <td style='text-align:right;'>total_harga</td>
                <td style='text-align:center;'> <form method='post'><button type='submit' name='hapus' value=$kode_barang>Hapus</button></form> </td>
            </tr>
            <!-- Total Belanja, Diskon, Total Bayar -->
            <tr>
                <td colspan="4" style="text-align:right; padding-right:20px"><strong>Total Belanja</strong></td>
                <td style="text-align:right;"><strong>grandtotal</strong></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right; padding-right:20px"><strong>Diskon ?%</strong></td>
                <td style="text-align:right;"><strong>diskon</strong></td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right; padding-right:20px"><strong>Total Bayar</strong></td>
                <td style="text-align:right;"><strong>totalbayar</strong></td>
            </tr>
            </table>
            <!-- Reset Keranjang -->
            <form action="dashboard.php" method="get" style="margin-top:20px;">
                <input type="submit" value="Reset Keranjang" name="reset">
            </form>
        </main>
    </body>
   
    <script>

    </script>

</html>