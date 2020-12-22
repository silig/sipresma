<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
  <title>jQuery Lookup Box</title>
  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
  <script src="{{ asset('plugins/lookup/js/jquery.lookupbox.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/ui-lightness/jquery-ui.min.css" />
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/lookup/css/lookupbox.css') }}" />
</head>
<body>
  <fieldset>
    <legend><b>Basic Usage</b></legend>
    <p>A basic usage of lookup box. For the loading indicator we just use the "<b>Loading...</b>" text.</p>
    <form action="" method="post">
      <table>
        <tr>
          <td>NIM</td>
          <td>:</td>
          <td>
            <input type="text" name="nim" value="" readonly="" />
            <input type="button" value="..." id="lookup1" />
          </td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" name="nama" value="" readonly="" /></td>
        </tr>
        <tr>
          <td>Jurusan</td>
          <td>:</td>
          <td><input type="text" name="idjur" value="" readonly="" /></td>
        </tr>
      </table>
      <br/>
      <input type="submit" value="SAVE" />
    </form>
    <script>
    $(document).ready(function () {
      $("#lookup1").lookupbox({
        title: 'Cari mahasiswa',
        url: '{{route('take')}}?chars=',
        imgLoader: 'Loading...',
        width: 500,
        onItemSelected: function(data){
          $('input[name=nim]').val(data.NIM);
          $('input[name=nama]').val(data.nama_mhs);
          $('input[name=idjur]').val(data.id_jurusan);
        },
        tableHeader: ['NIM', 'nama_mhs', 'jurusan']
      });
    });
    </script>
  </fieldset>
</body>
</html>
