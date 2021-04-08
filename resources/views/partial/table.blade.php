@foreach ($people as $person)
<tr>
    <td>{{ $person->UserName }}</td>
    <td>{{ $person->FirstName }}</td>
    <td>{{ $person->LastName }}</td>
    <td>{{ $person->Gender }}</td>
</tr>
@endforeach
