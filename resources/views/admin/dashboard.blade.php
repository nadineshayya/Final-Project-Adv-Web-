@extends('admin.layouts.app')



@section('content')
<h1>Dashboard</h1>
<div class="container-fluid">

                <div class="row">
                    <div class="col-lg-4 col-6">
                        <div class="small-box">
                            <h3>150</h3>
                            <p>Total Orders</p>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box">
                            <h3>50</h3>
                            <p>Total Customers</p>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="small-box">
                            <h3>$1000</h3>
                            <p>Total Sale</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('customJs')
  <script>
  console.log('welcome');


  </script>
    @endsection