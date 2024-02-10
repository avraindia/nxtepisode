<script src="{{ asset('backend/libs/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('backend/js/popper.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.multiselect.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
<!-- Select 2 JS -->
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<!-- Menu JS -->
<script src="{{ asset('backend/js/menu.js?v=2') }}"></script>
<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" integrity="sha512-6F1RVfnxCprKJmfulcxxym1Dar5FsT/V2jiEUvABiaEiFWoQ8yHvqRM/Slf0qJKiwin6IDQucjXuolCfCKnaJQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Datatables JS -->
<script src="{{ asset('backend/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/dataTables.jqueryui.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/libs/datatables/responsive.jqueryui.min.js') }}"></script>
<!-- Custome JS -->
<script src="{{ asset('backend/js/script.js') }}"></script>

<script>
$('.report_bell_icon').on('click', function() {
    $('.notify-section li').toggle();    
});

$(".back_btn").click(function (){
  window.history.back();
});
</script>