const flashdata = $('.flash-data').data('flashdata');
const flashjudul = $('.flash-data').data('flashjudul');
const flashtitle = $('.flash-data').data('flashtitle');
if(flashdata){
  Swal.fire({
      title: flashtitle +" "+flashjudul,
      text:'Berhasil ' +flashdata,
      type:'success'
  });
}
$('.btn-hapus').on('click',function(e){
  e.preventDefault();
  const href = $(this).attr('href');
  Swal.fire({
    title: 'Apakah anda yakin',
    text: "Data yang anda pilih akan dihapus",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Delete!'
  }).then((result) => {
    if (result.value) {
        document.location.href=href;
    }
  })
});
