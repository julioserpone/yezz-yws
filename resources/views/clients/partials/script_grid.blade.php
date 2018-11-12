<script>
    $(function () {
        $(document).ready(function() {
		    var table = $('#datagrid').DataTable({
		      	"paging": true,
		      	"responsive": true,
		      	"lengthChange": true,
		      	"searching": true,
		      	"ordering": true,
		      	"info": true,
		      	"autoWidth": true
		    });

		    // Setup - add a text input to footer cell with class equals 'QUERY'
		    $('#datagrid .query').each( function () {
		        var title = $(this).text();
		        $(this).html( '<input type="text" style="width: 100%;" />' );
		    });

		    // Apply the search
		    table.columns().every(function () {
		        var that = this;
		 
		        $('input', this.header()).on('keyup change', function () {
		            if ( that.search() !== this.value ) {
		                that
		                    .search( this.value )
		                    .draw();
		            }
		        });
		    });
		});
    });
</script>