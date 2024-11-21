<!-- management_print.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        @media print {
            .hidden-print {
                display: none !important;
            }
        }
    </style>
    <script>
    window.onload = function() {
        window.print();
    };
        window.onafterprint = function() {
            window.location.href = "{{ url('/admin/imb') }}";
    };
</script>

</head>

<body>
    <h3 style="text-align: center;">PEMERINTAH KOTA BANJARMASIN</h3>
    <h3 style="text-align: center;">DATA IZIN MENDIRIKAN BANGUNAN (IMB)</h3>
    <table>
        <thead  >
            <tr >
                <th style="background-color: #00CCDD;">NO DP</th>
                <th style="background-color: #00CCDD;">Nama</th>
                <th style="background-color: #00CCDD;">Alamat</th>
                <th style="background-color: #00CCDD;">Lokasi</th>
                <th style="background-color: #00CCDD;">Keterangan</th>
                <th style="background-color: #00CCDD;">Boks</th>
                <th style="background-color: #00CCDD;">Tahun</th>
            </tr>
        </thead>
        <thead  >
            <tr >
                <th style="background-color: #7CF5FF;">1</th>
                <th style="background-color: #7CF5FF;">2</th>
                <th style="background-color: #7CF5FF;">3</th>
                <th style="background-color: #7CF5FF;">4</th>
                <th style="background-color: #7CF5FF;">5</th>
                <th style="background-color: #7CF5FF;">6</th>
                <th style="background-color: #7CF5FF;">7</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataImb as $item)
                <tr>
                    <td>{{ $item->nomor_dp }}</td>
                    <td>{{ $item->nama_pemilik }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->box }}</td>
                    <td>{{ $item->tahun }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
