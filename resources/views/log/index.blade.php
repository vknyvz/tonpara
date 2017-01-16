@extends('layouts.master')

@section('content')
<div class="page-fixed-main-content">
  <div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12">
      <div class="portlet light bordered">
        <div class="portlet-title">
          <div class="caption">
            <i class="icon-share font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase">İŞLEM GEÇMİŞİ</span>
          </div>
        </div>
        <div class="portlet-body">
          <div class="scroller" data-always-visible="1" data-rail-visible="0">
            <ul class="feeds">
             @foreach($logs as $log)
              <li>
                <div class="col1">
                  <div class="cont">
                    <div class="cont-col1">
                      <div class="label label-sm label-info">
                        <i class="fa fa-user"></i>
                      </div>
                    </div>
                    <div class="cont-col2">
                      <div class="desc"> {!! $log->message() !!}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col2" style="width: 130px; margin-left: -133px;">
                  <div class="date"> {{ $log->created_at->format('d.m.Y, G:i') }} </div>
                </div>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
