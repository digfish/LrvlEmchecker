@extends('application')
@section('contents')
<div class="row">
    <div class="span9">
        <h1>Withdrawals</h1>
        <table class="table">
            <thead>
                <tr> <th> nr serie </th> <th> chave </th> <th>Data do sorteio </th></tr>
            </thead>
            <tbody>
                @foreach ($withdrawals as $withdrawal)
                <tr>
                    <td> {{ $withdrawal->nr }} </td>
                    <td>{{ $withdrawal->key }}</td>
                    <td>{{ $withdrawal->created_at }}</td>
             </tr>
                @endforeach
        </tbody>
    </table>
    </div>
</div>
@overwrite


