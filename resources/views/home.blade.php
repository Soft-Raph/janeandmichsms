@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="">
                        <h4>
                            Add Client
                        </h4>
                        <form action="{{ route('add.client') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" id="name" placeholder="Full Name" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <select name="plan" id="plan" class="form-control">
                                    <option>Select Plan</option>
                                    <option value="fat">Fat Plan</option>
                                    <option value="slim">Slim Plan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="duration" id="duration" class="form-control">
                                    <option>Select Duration</option>
                                    <option value="1">1 Month</option>
                                    <option value="2">2 Month</option>
                                    <option value="3">3 Month</option>
                                    <option value="4">4 Month</option>
                                    <option value="5">5 Month</option>
                                    <option value="6">6 Month</option>
                                    <option value="7">7 Month</option>
                                    <option value="8">8 Month</option>
                                    <option value="9">9 Month</option>
                                    <option value="10">10 Month</option>
                                    <option value="11">11 Month</option>
                                    <option value="12">12 Month</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="status" id="status" class="form-control">
                                    <option>Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">InActive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Client</button>
                        </form>
                        <hr>
                        <h4>
                            Clients
                        </h4>
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Plan</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($clients as $client)
                                <tr class="pb-1">
                                    <td><a href="{{ route('client.profile', $client->id) }}">{{ $client->name }}</a></td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->plan }} Plan</td>
                                    <td>{{ $client->duration }} Month</td>
                                    <td class="{{ $client->status=='active'?'bg-success text-white':'bg-danger text-white' }}">{{ $client->status }}</td>
                                    <td><a href="{{ route('client.delete',$client->id) }}">Delete</a> </td>
                                </tr>
                                @empty
                                <tr>No Client Available</tr>
                                @endforelse
                            </tbody>
                        </table>
                        <hr>
                        <h4>
                            Messages
                        </h4>
                        <form action="{{ route('update.messages') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Welcome Message(Fat Plan)</label>
                                <textarea class="form-control" rows="3" name="w_m_f">{{ $mes->w_m_f ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Welcome Message(Slim Plan)</label>
                                <textarea class="form-control" rows="3" name="w_m_s">{{ $mes->w_m_s ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Subscription Ending Message(Fat Plan)</label>
                                <textarea class="form-control" rows="3" name="s_e_m_f">{{ $mes->s_e_m_f ?? '' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Subscription Ending Message(Slim Plan)</label>
                                <textarea class="form-control" rows="3" name="s_e_m_s">{{ $mes->s_e_m_s ?? ''}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Array of Messages(Fat Plan)</label>
                                <textarea class="form-control" rows="3" name="m_a_f">{{ $mes->m_a_f ?? ''}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Array of Messages(Slim Plan)</label>
                                <textarea class="form-control" rows="3" name="m_a_s">{{ $mes->m_a_s ?? ''}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary">Update Messages</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
