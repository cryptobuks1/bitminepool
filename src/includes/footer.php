
<!-- jQuery -->
<script src="../vendor/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendor/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendor/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="../vendor/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="../vendor/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendor/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="../vendor/skycons/skycons.js"></script>
<!-- Flot -->
<script src="../vendor/Flot/jquery.flot.js"></script>
<script src="../vendor/Flot/jquery.flot.pie.js"></script>
<script src="../vendor/Flot/jquery.flot.time.js"></script>
<script src="../vendor/Flot/jquery.flot.stack.js"></script>
<script src="../vendor/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="../vendor/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="../vendor/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="../vendor/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="../vendor/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="../vendor/jqvmap/dist/jquery.vmap.js"></script>
<script src="../vendor/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="../vendor/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendor/moment/min/moment.min.js"></script>
<script src="../vendor/bootstrap-daterangepicker/daterangepicker.js"></script>


<!-- Custom Theme Scripts -->
<script src="../vendor/build/js/custom.min.js"></script>
<script src="../vendor/build/js/validate.js"></script>
<script src="../vendor/build/js/bootbox.min.js"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script src="../vendor/build/js/intlTelInput.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

<script>
    var oTable = '';
    function showAlertMessage(idObj, response, success) {
        var message = '';
        if (success == 1) {
            message += '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>' + response + '</span></div>';
        } else {
            message += '<div class="alert alert-warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span>' + response + '</span></div>';
        }
        $(idObj).html(message);

        $(idObj).fadeIn();
        $(idObj).delay(3000).fadeOut("slow", function () {
            $(idObj).html('');
        });
    }
    $(document).ready(function () {
        $(".alert").delay(3000).fadeOut("slow", function () {
            $(".alert").html('');
        });
    });

    $(function () {
        if ($('#datepicker_from').length && $('#datepicker_to').length) {
            $("#datepicker_from").datepicker({
                showOn: "button",
                buttonImage: "../images/calendar.gif",
                buttonImageOnly: false,
                "onSelect": function (date) {
                    minDateFilter = new Date(date);
                    //minDateFilter = minDateFilter.setDate(minDateFilter.getDate() - 1);
                    minDateFilter = new Date(minDateFilter);
                    minDateFilter = minDateFilter.getTime();
                    oTable.draw();
                }
            }).keyup(function () {
                minDateFilter = new Date(this.value);
               // minDateFilter = minDateFilter.setDate(minDateFilter.getDate() - 1);
                minDateFilter = new Date(minDateFilter);
                minDateFilter = minDateFilter.getTime();
                oTable.draw();
            });

            $("#datepicker_to").datepicker({
                showOn: "button",
                buttonImage: "../images/calendar.gif",
                buttonImageOnly: false,
                "onSelect": function (date) {
                    maxDateFilter = new Date(date);
                    maxDateFilter = maxDateFilter.setDate(maxDateFilter.getDate() + 1);
                    maxDateFilter = new Date(maxDateFilter);
                    maxDateFilter = maxDateFilter.getTime();
                    oTable.draw();
                }
            }).keyup(function () {
                maxDateFilter = new Date(this.value);
                maxDateFilter = maxDateFilter.setDate(maxDateFilter.getDate() + 1);
                maxDateFilter = new Date(maxDateFilter);
                maxDateFilter = maxDateFilter.getTime();
                oTable.draw();
            });
        }
    });

    var processDateFilter = (function (dateIndex) {
        // Date range filter
        minDateFilter = "";
        maxDateFilter = "";

        $.fn.dataTableExt.afnFiltering.push(
                function (oSettings, aData, iDataIndex) {
                    if (typeof aData._date == 'undefined') {
                        aData._date = new Date(aData[dateIndex]).getTime();
                    }
                    if (minDateFilter && !isNaN(minDateFilter)) {
                        if (aData._date < minDateFilter) {
                            return false;
                        }
                    }
                    if (maxDateFilter && !isNaN(maxDateFilter)) {
                        if (aData._date > maxDateFilter) {
                            return false;
                        }
                    }
                    return true;
                }
        );
    });

</script>