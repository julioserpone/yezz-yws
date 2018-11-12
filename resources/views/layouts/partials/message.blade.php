<?php
    $class = Session::get('messageClass') ? Session::get('messageClass') : 'success';

    $icon = Session::get('messageIcon') ? Session::get('messageIcon') : '';

    $title = Session::get('messageTitle') ? Session::get('messageTitle') : '';

    $time_show = Session::get('messageTimeShow') ? Session::get('messageTimeShow') : 3500;
    
    $m = Session::get('message');

    $m = $m ? (is_array($m) ? Html::ul($m) : '<p>'.$m.'</p>' ) : '';

    $e = (isset($errors)) ? Html::ul($errors->all()) : '';

    Session::forget(['message', 'messageClass', 'messageIcon', 'messageTitle']);

    Session::save();
?>

@if($m!='' || $e!='') 

  @section('jsMessages')

    <script type="text/javascript">
    $(function()
    {
      @if($m!='')
        var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
        new PNotify({
            title: '{{ $title != "" ? $title : trans("globals.success_alert_title") }}',
            text: '{!! $m !!}',
            type: '{{ $class }}',
            delay: '{!! $time_show !!}',
            mouse_reset: true,
            styling: 'bootstrap3',
            addclass: "stack-bottomright", 
            stack: stack_bottomright,
            icon : @if ($icon!='') '{{ $icon }}' @else true @endif
        });
      @endif
      @if($e!='')
        var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25};
        new PNotify({
            title: '{{ trans("globals.error_alert_title") }}',
            text: '{!! $e !!}',
            type: 'error',
            delay: '{!! $time_show !!}',
            mouse_reset: true,
            styling: 'bootstrap3',
            addclass: "stack-bottomright", 
            stack: stack_bottomright
        });
      @endif
    });
    </script>
  @stop

@endif 