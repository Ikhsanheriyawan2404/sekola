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
				<th>Hari</th>
				<th>Mapel</th>
				<th>Kelas</th>
				<th>Ruang</th>
				<th>Jam Pelajaran</th>
			</tr>
		</thead>
		<tbody>
			@foreach($schedules as $schedule)
			<tr>
				<td>{{ $schedule->day }}</td>
				<td>
                    {{ $schedule->study->name }}
                    <small class="text-muted">({{ $schedule->teacher->name }})</small>
                </td>
				<td>{{ $schedule->classroom->name }}</td>
				<td>{{ $schedule->room->name }}</td>
                <td>
                    {{ date('H:i', strtotime($schedule->start)) }} - {{ date('H:i', strtotime($schedule->finished)) }}
                </td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
