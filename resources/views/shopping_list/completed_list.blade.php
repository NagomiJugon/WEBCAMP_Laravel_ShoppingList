@extends( 'layout' )

@section( 'contents' )
    <h1>購入済み「買うもの」一覧</h1>
    <a href="/shopping_list/list">「買うもの」一覧に戻る</a>
    <table border="1">
        <tr>
            <th>「買うもの」名</th>
            <th>購入日</th>
        </tr>
        @foreach ( $list as $item )
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->formatted_created_at }}</td>
        </tr>
        @endforeach
    </table>
    
    現在 {{ $list->currentPage() }} 目<br>
    @if ( $list->onFirstPage() === false )
        <a href="/completed_shopping_list/list">最初のページ</a>
    @else
        最初のページ
    @endif
     / 
    @if ( $list->previousPageUrl() !== null )
        <a href="{{ $list->previousPageUrl() }}">前に戻る</a>
    @else
        前に戻る
    @endif
     / 
    @if ( $list->nextPageUrl() !== null )
        <a href="{{ $list->nextPageUrl() }}">次に進む</a>
    @else
        次に進む
    @endif
    
    <br>
    <hr>
    <menu label="リンク">
        <a href="/logout">ログアウト</a>
    </menu>
@endsection( 'contents' )