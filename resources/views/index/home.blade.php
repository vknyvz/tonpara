@extends('layouts.master')

@section('content')
<div class="page-fixed-main-content">
    <!-- BEGIN PAGE BASE CONTENT -->
    <div class="row">
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-share font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Son İşlemler</span>
                    </div>                                    
                </div>
                <div class="portlet-body">
                    <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                        <ul class="feeds">
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-info">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> Üye olundu.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2" style="width: 127px; margin-left: -133px;">
                                    <div class="date"> Ocak 3 2017 </div>
                                </div>
                            </li>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-money"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> 2000 Kredi hesabına yüklendi. </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2" style="width: 127px; margin-left: -133px;">
                                    <div class="date"> Ocak 4 2017 </div>
                                </div>                                                
                            </li>                                            
                            
                        </ul>
                    </div>                                    
                </div>
            </div>
        </div>                        
    </div>
    <!-- END PAGE BASE CONTENT -->
</div>
@endsection
