<div class="btn-group">
  <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> OPSİYONLAR
  <i class="fa fa-angle-down"></i>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li>
      <a href="{{ route('user.update', [$row]) }}"><i class="fa fa-edit"></i> Düzenle </a>
    </li>
    <li class="divider"> </li>
    <li>
      <a href="javascript:;"><i class="fa fa-remove"></i> Sil</a>
    </li>
    
    
  </ul>
</div>