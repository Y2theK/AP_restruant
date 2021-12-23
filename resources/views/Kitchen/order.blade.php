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
                            <h3 class="card-title">Orders</h3>

                        </div>
                        <div class="card-body">
                            @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                            @endif
                            <table id="orders" class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <th>Dish Name</th>
                                        <th>Table Number</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$order->dish->name}}</td>
                                        <td>{{$order->table_id}}</td>
                                        <td class="text-success text-bold">{{$status[$order->status]}}</td>
                                        <td>{{$order->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="/order/{{$order->id}}/approve" class="btn btn-success">Approve</a>
                                            <a href="/order/{{$order->id}}/cancel" class="btn btn-danger">Cancel</a>
                                            <a href="/order/{{$order->id}}/ready" class="btn btn-info">Ready</a>

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
         
          $('#orders').DataTable({
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