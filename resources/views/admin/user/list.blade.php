@extends( 'admin.layout' )

@section( 'contents' )
    @if ( $errors->any() )
        <div>
        @foreach ( $errors->all() as $error )
            {{ $error }}<br>
        @endforeach
        </div>
    @endif
    
    <h1>管理画面</h1>
    <table border="1">
        <tr>
            <th>ユーザID</th>
            <th>ユーザ名</th>
            <th>購入した「買うもの」の数</th>
        </tr>
    @foreach ( $users as $user )
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->item_num }}</td>
        </tr>
    @endforeach
    </table>
    
@endsection( 'contents' )