@extends('application')
@section('contents')
<h1>Register your key</h1>
{{ Form::open(array('url' => 'register/new_shot')) }}
{{ Form::label('Your key and stars') }}
{{ Form::text('shot_numbers') }}
&plus;
{{ Form::text('shot_stars') }}
<br>
{{ Form::label('Next withdrawal ID:') }}

{{ Form::text('withdrawal_id',$next_withdrawal->nr) }}

<p>Next 1st prize value is {{ $next_withdrawal->prize_value }} &euro; to be withdrawn at {{ $next_withdrawal->scheduled_to }} 20:45 </p>
{{ link_to('/','Return to index'); }}

{{ Form::submit('Register your new key',array('class'=> 'btn btn-danger') ) }}
  {{ Form::close()}}

@stop


