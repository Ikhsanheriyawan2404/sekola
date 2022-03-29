<!DOCTYPE html>
<html>
<head>
	<title>Data Siswa</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Deskripsi</th>
				<th>Tanggal</th>
				<th>Pemasukan</th>
				<th>Pengeluaran</th>
			</tr>
		</thead>
		<tbody>
			@foreach($finances as $finance)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $finance->name }}</td>
				<td>{{ $finance->description }}</td>
				<td>{{ date('d-m-Y', strtotime($finance->created_at)) }}</td>
				<td>
                    @if ($finance->cash_in)
                        @currency($finance->cash_in);
                    @else
                        -
                    @endif
                </td>
				<td>
                    @if ($finance->cash_out)
                        @currency($finance->cash_out);
                    @else
                        -
                    @endif
                </td>
			</tr>
			@endforeach
		</tbody>
        <tfoot>
            <tr>
				<th colspan="4">Saldo : @currency($finance->sum('cash_in') - $finances->sum('cash_out')) </th>
                <th>@currency($finances->sum('cash_in'))</th>
                <th>@currency($finances->sum('cash_out'))</th>
			</tr>
        </tfoot>
	</table>

</body>
</html>
