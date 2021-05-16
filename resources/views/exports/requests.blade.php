<table border="1">
    <thead>
    <tr>
        <th colspan="9">Заявки</th>
    </tr>
    <tr>
        <th>ID абитуриента</th>
        <th>№ заявления</th>
        <th>Дата</th>
        <th>ФИО</th>
        <th>Адрес</th>
        <th>Контактный телефон</th>
        <th>Дата рождения</th>
        <th>Год окончания и наименование учреждения</th>
        <th>Финансирование</th>
        <th>Статус</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requests as $request)
        <tr>
            <td>{{ $request->enrolle->id }}</td>
            <td>{{ $request->id }}</td>
            <td>{{ $request->created_at }}</td>
            <td>{{ $request->enrolle->full_name }}</td>
            <td>{{ $request->enrolle->address_actual }}</td>
            <td>{{ $request->enrolle->phone }}</td>
            <td>{{ $request->enrolle->date_born }}</td>
            <td>{{ $request->enrolle->education_ending }}, {{ $request->enrolle->education_name }}</td>
            <td>{{ $request->speciality->format_id }}</td>
            <td>{{ $request->status->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>