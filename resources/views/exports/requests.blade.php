<table>
    <thead>
    <tr>
        <th>№</th>
        <th>ФИО</th>
        <th>Специальность</th>
        <th>Статус</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requests as $request)
        <tr>
            <td>{{ $request->id }}</td>
            <td>{{ $request->enrolle->full_name }}</td>
            <td>{{ $request->speciality->qualification }}</td>
            <td>{{ $request->status->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>