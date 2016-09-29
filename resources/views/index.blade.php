@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="offset-by-three one-half column">
            <form method="POST" action="{{ route('upload') }}" accept-charset="UTF-8" id="form-submit"
                  class="center" enctype="multipart/form-data">
                <div class="error-box error-bg"></div>
                <div class="success-box success-bg">
                    <p class="success-message">Processing file. You will get an email when it's done.</p>
                    <p class="success-message">You can <a href="{{ route('search') }}">search it</a> as soon as it's imported.</p>
                </div>
                <input class="u-full-width" id="email" placeholder="Your Email" name="email" type="text" value="">
                <label class="u-full-width" for="csv_file">
                    <span class="u-full-width button button-upload">
                        Choose a file
                        <span class="progress-bar"></span>
                    </span>
                </label>
                <p class="u-full-width file-input-name">
                </p>
                <input class="u-max-full-width file-input" id="csv_file" name="csv_file" type="file">
                <button id="submit-button" class="button-primary" type="submit">
                    <span>Import</span>
                    <span class="spinner">
                        <span class="rect1"></span>
                        <span class="rect2"></span>
                        <span class="rect3"></span>
                        <span class="rect4"></span>
                        <span class="rect5"></span>
                    </span>
                </button>
            </form>
        </div>
    </div>
@stop

