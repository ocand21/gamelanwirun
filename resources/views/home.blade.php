@extends('main')

@section('title', '| Dashboard')

@section('content')
<div class="inner-block">
<!--market updates end here-->


  <div class="blank">
    <h2>Dashboard</h2>
    <div class="blankpage-main">
      <div class="market-updates">
          <div class="col-md-4 market-update-gd">
            <div class="market-update-block clr-block-1">
              <div class="col-md-8 market-update-left">
                <h3>{{$users}}</h3>
                @if (Auth::user()->hasRole('admin'))
                <h4>Seller terdaftar</h4>
                <p>Jumlah seller terdaftar</p>
                @else
                <h4>Pengguna Terdaftar</h4>
                <p>Jumlah pengguna terdaftar</p>
                @endif
              </div>
              <div class="col-md-4 market-update-right">
                <i class="fa fa-eye"> </i>
              </div>
              <div class="clearfix"> </div>
            </div>
          </div>
          <div class="col-md-4 market-update-gd">
            <div class="market-update-block clr-block-2">
             <div class="col-md-8 market-update-left">
              <h3>{{$iklans}}</h3>
              @if (Auth::user()->hasRole('admin'))
              <h4>Iklan</h4>
              <p>Iklan diterbitkan oleh Seller</p>
              @else
              <h4>Iklan</h4>
              <p>Iklan diterbitkan</p>
              @endif
              </div>
              <div class="col-md-4 market-update-right">
                <i class="fa fa-file-text-o"> </i>
              </div>
              <div class="clearfix"> </div>
            </div>
          </div>
           <div class="clearfix"> </div>
        </div>

    </div>
  </div>
</div>
@endsection
