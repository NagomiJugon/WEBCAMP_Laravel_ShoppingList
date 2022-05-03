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
@endsection( 'contents' )