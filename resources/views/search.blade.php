@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="offset-by-three one-half column">
            <form class="form-offset center">
                <input class="u-full-width" name="name" type="text" placeholder="Name" value="{{ $values['name'] or '' }}">
                <input class="u-full-width" name="address" type="text" placeholder="Address" value="{{ $values['address'] or '' }}">
                <input class="u-full-width" name="team" type="text" placeholder="Team" value="{{ $values['team'] or ''}}">
                <input class="button-primary" type="submit" value="Search">
            </form>
        </div>
    </div>

    <div class="row">
        <div class="twelve column">
            @if (count($results) > 0)
                <table class="u-full-width">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Team</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->user_id }}</td>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->age }}</td>
                            <td>{{ $result->address }}</td>
                            <td>{{ $result->team }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@stop

