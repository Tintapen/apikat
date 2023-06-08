<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.0 | Page rendered in <strong>{elapsed_time}</strong> seconds.
  </div>
  <strong>Copyright &copy; <?= date('Y') ?> <a href="https://id.linkedin.com/in/windinurmalasari/" target="blank">Windi N</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane" id="control-sidebar-home-tab">
      <h3 class="control-sidebar-heading">Recent Activity</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

              <p>Will be 23 on April 24th</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-user bg-yellow"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

              <p>New phone +1(800)555-1234</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

              <p>nora@example.com</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-file-code-o bg-green"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

              <p>Execution time 5 seconds</p>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

      <h3 class="control-sidebar-heading">Tasks Progress</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Custom Template Design
              <span class="label label-danger pull-right">70%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Update Resume
              <span class="label label-success pull-right">95%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Laravel Integration
              <span class="label label-warning pull-right">50%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Back End Framework
              <span class="label label-primary pull-right">68%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

    </div>
    <!-- /.tab-pane -->
    <!-- Stats tab content -->
    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
    <!-- /.tab-pane -->
    <!-- Settings tab content -->
    <div class="tab-pane" id="control-sidebar-settings-tab">
      <form method="post">
        <h3 class="control-sidebar-heading">General Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Report panel usage
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Some information about this general settings option
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Allow mail redirect
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Other sets of options are available
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Expose author name in posts
            <input type="checkbox" class="pull-right" checked>
          </label>

          <p>
            Allow the user to show his name in blog posts
          </p>
        </div>
        <!-- /.form-group -->

        <h3 class="control-sidebar-heading">Chat Settings</h3>

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Show me as online
            <input type="checkbox" class="pull-right" checked>
          </label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Turn off notifications
            <input type="checkbox" class="pull-right">
          </label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">
            Delete chat history
            <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
          </label>
        </div>
        <!-- /.form-group -->
      </form>
    </div>
    <!-- /.tab-pane -->
  </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Sweet Alert -->
<script src="<?= base_url('assets') ?>/bower_components/sweetalert/sweetalert.min.js"></script>
<!-- jQuery 3 -->
<script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url('assets') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets') ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
<!-- PACE -->
<script src="<?= base_url('assets') ?>/bower_components/pace/pace.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets') ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Data Table -->
<script src="<?= base_url('assets') ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url('assets') ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- CK Editor -->
<script src="<?= base_url('assets') ?>/bower_components/ckeditor/ckeditor.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<!-- Loader waitMe -->
<script src="<?= base_url('assets/plugins/waitme-loader/waitMe.min.js') ?>"></script>
<script type="text/javascript">
  var d = new Date();
  var hours = d.getHours();
  var minutes = d.getMinutes();
  var seconds = d.getSeconds();
  var hari = d.getDay();
  var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  hariIni = namaHari[hari];
  var tanggal = ("0" + d.getDate()).slice(-2);
  var month = new Array();
  month[0] = "Januari";
  month[1] = "Februari";
  month[2] = "Maret";
  month[3] = "April";
  month[4] = "Mei";
  month[5] = "Juni";
  month[6] = "Juli";
  month[7] = "Agustus";
  month[8] = "September";
  month[9] = "Oktober";
  month[10] = "Nopember";
  month[11] = "Desember";
  var bulan = month[d.getMonth()];
  var tahun = d.getFullYear();
  var date = Date.now(),
    second = 1000;

  function pad(num) {
    return ('0' + num).slice(-2);
  }

  function updateClock() {
    var clockEl = document.getElementById('clock'),
      dateObj;
    date += second;
    dateObj = new Date(date);
    clockEl.innerHTML = '' + hariIni + ',  ' + tanggal + ' ' + bulan + ' ' + tahun + ' ' + pad(dateObj.getHours()) + ':' + pad(dateObj.getMinutes()) + ':' + pad(dateObj.getSeconds());
  }
  setInterval(updateClock, second);
</script>
<script>
  //Konfirmasi
  $('.tombol-yakin').on('click', function(e) {
    e.preventDefault();
    const href = $(this).attr('href');
    const isiData = $(this).data('isidata');
    swal({
      title: 'Apakah anda yakin?',
      text: isiData,
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
        document.location.href = href;
      }
    });
  });

  // Data Table
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });

  // Data Table
  $(document).ready(function() {
    $('.dataTable').DataTable();
  });

  // Notifikasi Success
  const flashData = $('.flash-data').data('flashdata');
  if (flashData) {
    swal({
      title: "Selamat!",
      text: flashData,
      icon: "success",
    });
  }

  // Notifikasi Error
  const flashDaraError = $('.flash-data-error').data('flashdataerror');
  if (flashDaraError) {
    swal({
      title: "Maaf!",
      text: flashDaraError,
      icon: "error",
    });
  }

  // Efek Loading
  $(document).ajaxStart(function() {
    Pace.restart()
  })

  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
  })

  //Editor
  $(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })

  var _tableLaporan;
  let formReport;
  var ID = 0;
  var clear = false;

  $(document).ready(function() {
    // Show Password
    $('#checkbox').click(function() {
      if ($(this).is(':checked')) {
        $('#password').attr('type', 'text');
      } else {
        $('#password').attr('type', 'password');
      }
    });

    $("#form_respon").submit(function(e) {
      $(this).find('button').prop('disabled', true);
    });

    // Table laporan
    _tableLaporan = $('#table_laporan').DataTable({
      'ajax': {
        'url': '<?= base_url('admin/laporan/showAll') ?>',
        'type': 'POST',
        'data': function(d, setting) {
          return $.extend({}, d, {
            form: formReport,
            clear: clear
          });
        }
      },
      'columnDefs': [{
        'targets': '_all',
        'orderable': false,
        'width': 2
      }],
      'order': [],
      'displayLength': -1,
      'lengthChange': false,
      'info': false,
      'searching': false,
      'paging': false,
      'autoWidth': false,
      'scrollX': true,
      'scrollY': '70vh',
      'scrollCollapse': true,
      'dom': 'Btlip',
      'buttons': [
        'excel', 'pdf'
      ],
    }).columns.adjust();

    $('.daterange').daterangepicker({
      autoUpdateInput: false,
      locale: {
        format: 'YYYY-MM-DD',
        cancelLabel: 'Clear'
      }
    });

    $('.daterange').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    });

    $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

    $('.daterangetime').daterangepicker({
      autoUpdateInput: false,
      timePicker: true,
      timePicker24Hour: true,
      timePickerIncrement: 30,
      locale: {
        format: 'YYYY-MM-DD hh:mm:ss',
        cancelLabel: 'Clear'
      }
    });

    $('.daterangetime').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD hh:mm:ss') + ' - ' + picker.endDate.format('YYYY-MM-DD hh:mm:ss'));
    });

    $('.daterangetime').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

    $('.btn_ok_laporan').on('click', function(e) {
      e.preventDefault();
      var _this = $(this);
      var parent = _this.closest('.box');
      var form = parent.find('form');
      var oriElement = _this.html();
      var textElement = _this.text().trim();
      var disabled = form.find('[disabled]');

      //! Remove attribute disabled
      disabled.removeAttr('disabled');

      //TODO: Mengumpulkan data
      let field = form.find('input, select').map(function() {
        var row = {};

        row['name'] = $(this).attr('name');

        if (this.type === 'radio' && this.checked) {
          row['value'] = this.value;
        } else if (this.type !== 'radio') {
          row['value'] = this.value;
        } else {
          row['value'] = "";
        }

        row['type'] = this.type;

        return row;
      }).get();

      formReport = field;

      //! Set disabled
      disabled.prop('disabled', true);

      //* Set variable clear menjadi false 
      clear = false;

      (loadingForm("content_laporan", "ios"),
        _tableLaporan.ajax.reload(null, false),
        setTimeout(function() {
          hideLoadingForm("content_laporan");
        }, 500));

    });

    $('.btn_reset_laporan').on('click', function(e) {
      e.preventDefault();
      var _this = $(this);
      var parent = _this.closest('.box');
      var form = parent.find('form');
      form.find("input:text").val("");
      form.find("select").val(null).change();

      clear = true;

      (loadingForm("content_laporan", "ios"),
        _tableLaporan.ajax.reload(null, false),
        setTimeout(function() {
          hideLoadingForm("content_laporan");
        }, 500));
    });
  });

  function kirimNotifikasi(id) {
    $.ajax({
      type: "GET",
      url: "<?= site_url('admin/pengembalian/kirimNotifikasi/') ?>" + id,
      dataType: "JSON",
      beforeSend: function() {
        loadingForm("content-pengembalian", "ios");
      },
      complete: function() {
        hideLoadingForm("content-pengembalian");
      },
      success: function(response) {
        swal({
          title: "Sukses!",
          text: "Notifikasi email sudah dikirim",
          icon: "success",
        });
      }
    });
  }

  /**
   * Function to show wait Loading
   * @param {*} selectorID form html
   * @param {*} effect
   */
  function loadingForm(selectorID, effect) {
    $('#' + selectorID + '').waitMe({
      effect: effect,
      text: 'Please wait...',
      bg: 'rgba(255,255,255,0.7)',
      color: '#000',
      maxSize: '',
      waitTime: -1,
      textPos: 'vertical',
      fontSize: '100%',
      source: '',
      onClose: function() {}
    });
  }

  /**
   * Function to hide wait Loading
   * @param {*} selectorID form html
   */
  function hideLoadingForm(selectorID) {
    $('#' + selectorID + '').waitMe('hide');
  }
</script>
</body>

</html>