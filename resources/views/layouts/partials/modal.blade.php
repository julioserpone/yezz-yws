@php
  $modalId=isset($modalId)?$modalId:'myModal';
  $modalClass=isset($modalClass)?$modalClass:'btn btn-primary';
  $modalLabel=isset($modalLabel)?$modalLabel:trans('globals.show');  
  $modalTitle=isset($modalTitle)?$modalTitle:'';  
  $modalBody=isset($modalBody)?$modalBody:'';  
  $onlyModal=isset($onlyModal)?$onlyModal:false;  
  $onlyAction=isset($onlyAction)?$onlyAction:false;  
  $link=isset($link)?$link:false;  
  $ajaxModal=isset($ajaxModal)?'modal-url="'.$ajaxModal.'"':'';  
  $modalIcon=isset($modalIcon)?$modalIcon:'';
@endphp

@if(!$onlyModal)
  {{-- Boton o enlace al modal --}}
  @if(isset($link) && $link)
    <a href="#" data-toggle="modal" {!!$ajaxModal!!} data-target="#{{$modalId}}">{{$modalLabel}}</a>
  @else
    <button type="button" class="{{$modalClass}}" data-toggle="modal" {!!$ajaxModal!!} data-target="#{{$modalId}}">
      @if($modalIcon)<i class="{{$modalIcon}}" aria-hidden="true"></i>@endif {{$modalLabel}}
    </button>
  @endif
@endif

@if(!$onlyAction)
  <!-- Modal -->
  <div class="modal fade" id="{{$modalId}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">{{$modalTitle}}</h4>
        </div>
        <div class="modal-body">{{$modalBody}}</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('globals.close') }}</button>
        </div>
      </div>
    </div>
  </div>
@endif

