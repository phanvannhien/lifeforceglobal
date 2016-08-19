<p>Dear, <strong>Mr Roger</strong></p>
<br>
<br>
<p>Bellow is the list WM user having purchase < 1500 for 3 month.</p>
<br>
<br>
<table width="100%" border="1" cellpadding="5" cellspacing="5">
    <thead>
        <th>
            <td>User Name</td>
            <td>Email</td>
            <td>User Code</td>
        </th>
    </thead>
    <tbody>
        @foreach( $users as $user )
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->membership_number }}</td>
            </tr>
        @endforeach
    </tbody>

</table>

<br>

<p>Best regards!.</p>

