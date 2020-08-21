    </div>
    <!--slide bar menu end here-->
    <script>
    var toggle = true;               
    $(".sidebar-icon").click(function() {                
      if (toggle)
      {
        $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
        $("#menu span").css({"position":"absolute"});
      }
      else
      {
        $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
        setTimeout(function() {
          $("#menu span").css({"position":"relative"});
        }, 400);
      }               
      toggle = !toggle;
    });
    </script>
    <!--dataTables-->
    <script src="{{asset('public/design/adminpanel/js/dataTables.bootstrap.min.css')}}"></script>
    <script src="{{asset('public/design/adminpanel/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/design/adminpanel/js/dataTables.bootstrap.min.js')}}"></script>
    <!--//dataTables-->
    <!--scrolling js-->
	  <script src="{{asset('public/design/adminpanel/js/jquery.nicescroll.js')}}"></script>
	  <script src="{{asset('public/design/adminpanel/js/scripts.js')}}"></script>
		<!--//scrolling js-->
    <script src="{{asset('public/design/adminpanel/js/bootstrap.js')}}"> </script>
    <script src="{{asset('public/design/adminpanel/js/dataTables.buttons.min.js')}}"> </script>
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"> </script>
    <script src="{{asset('public/design\adminpanel\jstree\jstree.js')}}"></script>
    <script src="{{asset('public/design\adminpanel\jstree\jstree.checkbox.js')}}"></script>
    <script src="{{asset('public/design\adminpanel\jstree\jstree.wholerow.js')}}"></script>
    <!--datepicker js-->
    <script src="{{asset('public/design/adminpanel/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('public/design/adminpanel/js/bootstrap-datepicker.ar.js')}}"></script>
    <!--//datepicker js-->

  <!-- mother grid end here-->
  @stack('js')
  @stack('css')
  </body>
</html>  
