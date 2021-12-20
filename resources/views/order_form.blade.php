<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../../plugins/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body>
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">AP Restruant | Order Form</h3>
                <a href="/order" class="btn btn-primary float-right">Kitchen</a>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-12 ">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                            href="#custom-tabs-four-home" role="tab"
                                            aria-controls="custom-tabs-four-home" aria-selected="true">New Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-four-profile" role="tab"
                                            aria-controls="custom-tabs-four-profile" aria-selected="false">Order
                                            Lists</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                @if(session('message'))
                                <div class="alert alert-success">
                                    {{session('message')}}
                                </div>
                                @endif
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-home-tab">
                                        <form action="{{route('order.submit')}}" method="POST">
                                            @csrf
                                            <div class="row">

                                                @foreach ($dishes as $dish)
                                                <div class="col-lg-3 col-md-4 col-sm-10 mb-3">
                                                    <div class="card card-info ">
                                                        <div class="card-header">
                                                            <h5 class="card-tite" name="">{{$dish->name}}
                                                            </h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <img src="{{url('/images/'.$dish->image)}}" alt="dish_image"
                                                                width="100px" height="100px">
                                                        </div>
                                                        <div class="card-footer">
                                                            <label for="">Quantity</label>
                                                            <input type="number" placeholder="0" name="{{$dish->id}}"
                                                                min="0">

                                                        </div>
                                                    </div>

                                                </div>
                                                @endforeach


                                            </div>
                                            <div>
                                                <label for="">Choose Table</label>
                                                <select name="table" id="" class="form-control">
                                                    <option value="" selected disabled>Select table</option>
                                                    @foreach ($tables as $table)
                                                    <option value="{{$table->id}}">{{$table->number}}</option>
                                                    @endforeach
                                                </select><br><br>
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-profile-tab">
                                        <table id="orders" class="table table-bordered table-striped">
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
                                                    <td>{{$order->created_at}}</td>
                                                    <td>
                                                        <a href="/order/{{$order->id}}/serve"
                                                            class="btn btn-success">Serve</a>
                                                        <a href="/order/{{$order->id}}/notify"
                                                            class="btn btn-danger">Notify</a>


                                                    </td>



                                                </tr>

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- /.row -->
</body>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>


</html>