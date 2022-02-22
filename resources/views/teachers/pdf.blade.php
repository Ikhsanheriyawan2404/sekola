<!DOCTYPE html>
<html>
<head>
	<title>Data Guru </title>
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
				<th>Nip</th>
				<th>Jenis Kelamin</th>
				<th>Email</th>
				<th>No HP</th>
			</tr>
		</thead>
		<tbody>
			@foreach($teachers as $teacher)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $teacher->name }}</td>
				<td>{{ $teacher->nip }}</td>
				<td>{{ $teacher->gender == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
				<td>{{ $teacher->email }}</td>
				<td>{{ $teacher->phone }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
