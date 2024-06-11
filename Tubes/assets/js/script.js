function confirmDelete(id) {
    var result = confirm("Apakah Anda yakin ingin menghapus data instansi dengan ID " + id + "?");
    if (result) {
      window.location.href = "delete.php?id=" + id;
    }
  }  