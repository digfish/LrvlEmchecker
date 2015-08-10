@extends('application')
@section('contents')
@if ( (Session::get('message') != NULL ) )
<div class="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Please note:</strong> {{ Session::get('message')}}
</div>
@endif
<div class="row">
    <div class="span9">
        <h1>Your registered shots</h1>
        <table class="table">
            <thead>
                <tr> <th> serial number </th> <th> shot </th> <th>Registered at</th></tr>
            </thead>
            <tbody>
                @foreach ($shots as $shot)
                <tr>
                    <td> {{ $shot->nr }} </td>
                    <td>{{ $shot->shot }}</td>
                    <td>{{ $shot->registered_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <?php echo $shots->links(); ?>
    </div>
</div>
@overwrite


