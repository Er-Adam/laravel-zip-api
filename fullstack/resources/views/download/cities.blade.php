<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
    </style>
</head>
<body>
    <h2>Cities List</h2>

    <table>
        <thead>
            <tr>
                <th>County</th>
                <th>City</th>
                <th>Postal Codes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row['county'] }}</td>
                    <td>{{ $row['city'] }}</td>
                    <td>{{ $row['code'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>