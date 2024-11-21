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
            window.location.href = "{{ url('/admin/sk') }}";
        };
    </script>

</head>

<body>
    <h3 style="text-align: center;">PEMERINTAH KOTA BANJARMASIN</h3>
    <h3 style="text-align: center;">DATA SURAT KEPUTUSAN (SK)</h3>
    <table>
        <thead>
            <tr>
                <th style="background-color: #00CCDD;">NO SK</th>
                <th style="background-color: #00CCDD;">Tahun</th>
                <th style="background-color: #00CCDD;">Tanggal Penetapan</th>
                <th style="background-color: #00CCDD;">Tentang</th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th style="background-color: #7CF5FF;">1</th>
                <th style="background-color: #7CF5FF;">2</th>
                <th style="background-color: #7CF5FF;">3</th>
                <th style="background-color: #7CF5FF;">4</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataSK as $item)
            <tr>
                <td>{{ $item->nomor_sk }}</td>
                <td>{{ $item->tahun }}</td>
                <td>{{ $item->tanggal_penetapan }}</td>
                <td>{{ $item->tentang }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>