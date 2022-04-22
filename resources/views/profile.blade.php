@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Client Profile') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="">
                            <form action="{{ route('send.messages') }}" method="post">
                                @csrf
                                <h6> Send message to {{ $client->name }}({{ $client->phone }})</h6>
                                <hr>
                                <input type="hidden" name="phone" value="{{ $client->phone }}">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea class="form-control" rows="3" name="message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
