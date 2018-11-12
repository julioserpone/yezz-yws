<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<!-- <script src = "{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>-->
<script src = "{{ asset('/akkargroup-bower/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src = "{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src = "{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<script src = "{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/akkargroup-bower/pace/pace.min.js') }}" type = "text/javascript"></script> 
<script src = "{{ asset('/akkargroup-bower/pnotify/dist/pnotify.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/akkargroup-bower/pnotify/dist/pnotify.buttons.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/akkargroup-bower/pnotify/dist/pnotify.animate.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/akkargroup-bower/pnotify/dist/pnotify.desktop.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/akkargroup-bower/bootbox/bootbox.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/akkargroup-bower/bootstrap-show-password/bootstrap-show-password.min.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/plugins/input-mask/jquery.inputmask.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/plugins/select2/select2.full.min.js') }}" type = "text/javascript"></script>
<script src = "{{ asset('/js/waves.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
        //$.fn.select2.defaults.set('language', '{{ \App::getLocale() }}');
        
        //View load sent from controller to bootstrap modal container
        $('body').on('click','a[modal-url],button[modal-url]',function (event) {
        	$($(this).attr('data-target')+' .modal-body').load($(this).attr('modal-url'));
        });

        $(".modal").on("hidden.bs.modal", function(){
    		$(".modal-body").html("");
		});

    });


    (function($){
        
    	//Has Event un element?
	    $.fn.hasEvent = function(event){
	        if(!this.length || !event){
	            return false;
	        }
	        event = (event + '').split('.');
	        var d = $._data ? $._data($(this)[0], 'events') : $(this).data('events'),
	            a = [],
	            e = event[0],
	            n = event[1],
	            x = 0,
	            y, z;
	        if(d && e == ''){
	            for(y in d){
	                for(z in d[y]){
	                    if(d[y][z].namespace == n){
	                        a[x] = y;
	                        x ++;
	                    }
	                }
	            }
	            if(!a.length){
	                return false;
	            }
	            return a;
	        }
	        if(d && d[e]){
	            if(n){
	                for(y in d[e]){
	                    if(d[e][y].namespace == n){
	                        return true
	                    }
	                }
	                return false;
	            }
	            return true;
	        }
	        return false;
	    };
	})(jQuery);
</script>
@section('jsCustoms')

@show