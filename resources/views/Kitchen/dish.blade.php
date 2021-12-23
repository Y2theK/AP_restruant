@extends('layouts.master')
@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kitchen Panel</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">


                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Dishes</h3>
                            <a href="dish/create" class="btn btn-success float-right">New Dish</a>
                        </div>
                        <div class="card-body">
                            @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                            @endif
                            <table id="dishes" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($dishes as $dish)
                                    <tr>
                                        <td>{{$dish->id}}</td>
                                        <td>{{$dish->name}}</td>
                                        <td>{{$dish->category->name}}</td>
                                        <td>{{$dish->created_at->diffForHumans()}}</td>
                                        <td>
                                            <div class="form-row">
                                                <a href="/dish/{{$dish->id}}/edit" class="btn btn-warning "
                                                    style="height: 40px">Edit</a>
                                                <form action="/dish/{{$dish->id}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger ml-3">Delete</button>
                                                </form>
                                            </div>

                                        </td>



                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.card -->
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script>
    $(function () {
         
          $('#dishes').DataTable({
            "paging": true,
            "pageLength" : 10,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
</script>