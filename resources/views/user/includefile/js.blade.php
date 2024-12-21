<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{asset('user/all.js')}}"></script>

@section('js_content')
	@show

<script>
    // $(document).ready(function(){
            //      $('div#loading').removeAttr('id');
    // });
    var preloader = document.getElementById("loa");
    // window.addEventListener('load', function(){
    //      preloader.style.display = 'none';
    //      })

    function myFunction(){
            preloader.style.display = 'none';
    };
</script>