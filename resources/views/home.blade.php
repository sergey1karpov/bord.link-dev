@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 100px">
    <div class="row justify-content-center text-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2 class="text-center">Admin Panel</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <p><a href="{{ route('blog.create') }}">Add new blog post</a></p>
                        <hr>
                        <h3 class="text-center">Users</h3>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col-auto">Id</th>
                                <th scope="col-auto">Name</th>
                                <th scope="col-auto">Status</th>
                                <th scope="col-auto">Verify</th>
                                <th scope="col-auto">Email</th>
                                <th scope="col-auto">Change verify</th>
                                <th scope="col-auto">Del user</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr id="userId{{$user->id}}">
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->status}}</td>
                                <td id="yesOrNot{{$user->id}}">@if($user->verify)<img src="{{asset('img/verify.png')}}" class="img-fluid ml-2" width="20px" title="Verified Page">@endif</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <form action="{{route('editAdminForUsers', $user->id)}}" method="post" id="editForm{{$user->id}}">
                                        @csrf @method('PATCH')
                                        <div class="form-group">
                                            <input type="text" name="verify" id="verify" value="{{$user->verify}}">
                                            <button style="margin-bottom: 1px" type="button" class="btn btn-sm btn-primary" id="btn{{$user->id}}">edit</button>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('deleteAdminForUsers', $user->id)}}" method="post">
                                        @csrf @method('DELETE')
                                        <input type="hidden" value="{{$user->id}}">
                                        <input type="button" class="btn btn-danger btn-sm" value="del" id="delUserButton{{$user->id}}">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    @foreach($users as $user)


        $("document").ready(function() {
            $("#btn{{$user->id}}"). click(function () {

                var verify = $("#editForm{{$user->id}}").serialize();

                $.ajax({
                    url: "{{route('editAdminForUsers', $user->id)}}",
                    type: "POST",
                    data: verify,
                    success: function(yesOrNot) {
                        $("#yesOrNot{{$user->id}}").html($(yesOrNot).find("#yesOrNot{{$user->id}}").html());
                    }
                });

            });
        })

        $("document").ready(function() {
            $("#delUserButton{{$user->id}}").click(function() {

                var formData = $("form").serialize();

                $.ajax({
                    url: "{{route('deleteAdminForUsers', $user->id)}}",
                    type: "POST",
                    data: formData,
                    success: function() {
                        $("#userId{{$user->id}}").remove();
                    }
                });

            });
        });
    @endforeach
</script>

@endsection




